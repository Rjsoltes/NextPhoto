<?php require_once("config.php"); ?>

<?php
//--- SHOPPING CART FUNCTIONS ------------------------------------------------------------------------------------------
// Creates arrays as session variables to store cart values for the current session as well as initializes some values.
if(empty($_SESSION['cart_items'])){

  $_SESSION['cart_items'] = array();
  $_SESSION['cart_subtotal'] = array();
  $_SESSION['cart_items_quantity'] = array();
  $_SESSION['cart_items_price'] = array();
  $_SESSION['cart_total'] = 0;
  $_SESSION['cart_total_quantity'] = 0;
}

// If an item is requested to add to the cart.
if(isset($_GET['add'])){
    // A query is created to select that product based on the id of the product that is clicked on.
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)){
        $item_price = $row['product_price'];
        $item_quantity = $row['product_quantity'];
        $i = $_GET['add'];
        // Checks to see if the amount of one item in the cart is less than the quantity specified in the database.
        // If the quantity in the database is more than the quantity in the cart then the specified arrays
        // are filled with the corresponding information for each item in the cart.
        if($item_quantity > $_SESSION['cart_items_quantity'][$i]){

            $qty = $_SESSION['cart_items_quantity'][$i] + 1;
            $_SESSION['cart_items_quantity'][$i] = $qty;
            $_SESSION['cart_items'][$i] = $i;
            $_SESSION['cart_items_price'][$i] = $item_price;
            $_SESSION['cart_subtotal'][$i] = $item_price * (int)$qty;

            redirect("../public/view_cart.php");
        }else{
          // If the quantity of the product in the database is less than the quantity in the cart,
          // it displays an error message.
            set_message("Error: Only " . $row['product_quantity'] . " units available.");
            redirect("../public/view_cart.php");
        }
    }
}

// If an item is requested to be removed from the cart.
if(isset($_GET['remove'])){
    // A query is created to select that product based on the id of the product that is clicked on.
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['remove']). " ");
    confirm($query);

    while($row = fetch_array($query)){
        // Gets the price for the item being removed.
        $item_price = $row['product_price'];
    }

    // Sets $i to the id of the item being removed, finds the quantity of that item in the cart
    // and decrements it by one. Then sets the quantity of that item as the new quantity.
    $i = $_GET['remove'];
    $qty = $_SESSION['cart_items_quantity'][$i];
    $qty--;
    $_SESSION['cart_items_quantity'][$i] = $qty;

    // Removes item if the quantity is zero
    if ($qty == 0) {
      $_SESSION['cart_subtotal'][$i] = 0;
      unset($_SESSION['cart_items'][$i]);
    }

    // Finds the subtotal of an item in the cart based on how many there are and the price.
    else{
      $_SESSION['cart_subtotal'][$i] = $item_price * (int)$qty;
    }
    redirect("../public/view_cart.php");
}

// If an item is requested to be deleted from the cart.
if(isset($_GET['delete'])){
    // Finds the id of the product to be deleted in the cart array.
    $_SESSION['cart_items'] = array_diff($_SESSION['cart_items'], array($_GET['delete']));
    redirect("../public/view_cart.php");
}

// Function to display all items in the cart based on the user's session.
function display_cart(){

    // Foreach loop that executes the following code for every item in the cart_items array.
    foreach($_SESSION['cart_items'] as $i){

                // A query is created to select the product who's id is equal to the variable $id created above.
                $query = query("SELECT * FROM products WHERE product_id = " . $_SESSION['cart_items'][$i] . "");
                confirm($query);

                // Displays the product information of the selected product.
                while($row = fetch_array($query)){

                    $cart_products = <<<DELIMETER

                                <tr>
                                    <td>{$row['product_title']}</td>
                                    <td>&#36;{$row['product_price']}</td>
                                    <td>{$_SESSION['cart_items_quantity'][$i]}</td>
                                    <td>&#36;{$_SESSION['cart_subtotal'][$i]}</td>
                                    <td>
                                        <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}">+</a>
                                        <a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}">-</a>
                                        <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}">X</a>
                                    </td>
                                </tr>
DELIMETER;
                echo $cart_products;
                }
      }
      // Sums the item subtotals and stores that value as the cart total.
      // Sums the item quantities and stores that value as the total cart quantity.
      $_SESSION['cart_total'] = array_sum($_SESSION['cart_subtotal']);
      $_SESSION['cart_total_quantity'] = array_sum($_SESSION['cart_items_quantity']);
}


// Function to insert all the order information when checking out.
function process_order(){

    if(isset($_POST['processorder'])){
        $_SESSION['order_id'] = mt_rand(100000, 999999);
        $order_id = $_SESSION['order_id'];
        $order_date = date('Y-m-d H:i:s');
        $order_email = escape_string($_POST['email']);
        $order_address = escape_string($_POST['address']);
        $order_state = escape_string($_POST['state']);
        $order_city = escape_string($_POST['city']);
        $order_zipcode = escape_string($_POST['zipcode']);
        $card_name = escape_string($_POST['cardName']);
        $card_number = escape_string($_POST['cardNumber']);
        $cvc_number = escape_string($_POST['cvcNumber']);
        $exp_mm = escape_string($_POST['expMM']);
        $exp_yy = escape_string($_POST['expYY']);
        $card_number = md5($card_number);
        $cvc_number = md5($cvc_number);
        $exp_mm = md5($exp_mm);
        $exp_yy = md5($exp_yy);
        $order_amount = $_SESSION['cart_total'];
        $order_quantity = $_SESSION['cart_total_quantity'];
        $order_items = serialize($_SESSION['cart_items']);

        $query = query("INSERT INTO orders(order_id, order_date, order_email, order_address, order_state, order_city, order_zipcode, card_name, card_number, cvc_number, exp_mm, exp_yy, order_status, order_amount, order_quantity, order_items) VALUES('{$order_id}', '{$order_date}', '{$order_email}', '{$order_address}', '{$order_state}', '{$order_city}', '{$order_zipcode}', '{$card_name}', '{$card_number}', '{$cvc_number}', '{$exp_mm}', '{$exp_yy}', 'pending', '{$order_amount}', '{$order_quantity}', '{$order_items}')");
        confirm($query);

        // Foreach loop that finds the product quantity of every item that was ordered and decrements it by one after making the payment.
        foreach ( $_SESSION['cart_items'] as $i ) {
            $query2 = query("SELECT product_quantity FROM products WHERE product_id = " . $_SESSION['cart_items'][$i] . "");
            confirm($query2);

            while($row = fetch_array($query2)){

              $product_quantity = $row['product_quantity'];
              $new_quantity = (int)$product_quantity - (int)($_SESSION['cart_items_quantity'][$i]);

              $query3 = query("UPDATE products SET product_quantity = '{$new_quantity}' WHERE product_id =" . $_SESSION['cart_items'][$i] . " ");
              confirm($query3);
            }
        }
        redirect("confirmation.php");
    }
}

// Function used to get the information of the items that had just been ordered in the current session.
function get_order_items(){
  $result = "";
  $query = query("SELECT * FROM products WHERE product_id IN ('".implode("', '", $_SESSION['cart_items'])."')");
  confirm($query);
  while($row = fetch_array($query)){

    $product_title = $row['product_title'];

    $result .= $product_title . "<br>";

  }
  return $result;
}

// Function to display a receipt of the items ordered as well as some order information in table format.
function display_receipt(){
    $order_items = get_order_items();
    $query = query("SELECT * FROM orders WHERE order_id = " . $_SESSION['order_id'] . "");
    confirm($query);
    while($row = fetch_array($query)){
      $order_date = $row['order_date'];
      $order_name = $row['card_name'];

      echo "<tr>";
      echo "<td>" . $_SESSION['order_id'] ."</td>";
      echo "<td>" .$order_name . "</td>";
      echo "<td>" . $_SESSION['cart_total_quantity'] . " items</td>";
      echo "<td>" . $order_items . "</td>";
      echo "<td>&#36;" . $_SESSION['cart_total'] . "</td>";
      echo "</tr>";
    }
}

?>
