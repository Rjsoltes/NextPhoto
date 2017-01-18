<?php

//--- HELPER FUNCTIONS --------------------------------------------------------------------------

// Function used to set a message.
// For notifying the user about errors or successful actions.
function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else{
        $msg = "";
    }
}

// Function used to display a message created by the set_message() function.
function display_message(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

// Function used to redirect the user to a different page.
function redirect($location){

    header("Location: $location");
}

// Function to query the database.
function query($sql){

    global $connection;
    return mysqli_query($connection, $sql);
}

// Function to confirm the connection to the database when making a query.
function confirm($result){

    global $connection;
    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

// Function to escape strings to protect the database.
function escape_string($string){

    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

// Function to get information from a record in the database.
function fetch_array($result){

    return mysqli_fetch_array($result);
}

//--- FRONT END FUNCTIONS --------------------------------------------------------------------------

// Function that logs a user into the website.
function login_user(){

  if(isset($_POST['submit'])){

    $username = escape_string($_POST['inputUsername']);
    $password = escape_string($_POST['inputPassword']);
    $password = md5($password);

    $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
    confirm($query);

    // Sets attributes of the current user to the same values as stated in the database
    // in the record for the user that just logged in.
    while($row = fetch_array($query)){
            $c_user_id = $row['user_id'];
            $c_username = $row['username'];
            $c_email = $row['email'];
            $c_password = $row['password'];
            $c_fname = $row['fname'];
            $c_lname = $row['lname'];
            $c_user_role = $row['user_role'];
    }

    // If username and password are wrong, user is redirected to the same page.
    // If correct they are redirected to the admin home-page.
    if($username !== $c_username && $password !== $c_password){
        set_message("Username or Password is incorrect");
        redirect("index.php");

    }else if($username == $c_username && $password == $c_password){

        // Sets the current session user information to the information of
        // the user that is logged in.
        $_SESSION['username'] = $c_username;
        $_SESSION['fname'] = $c_fname;
        $_SESSION['lname'] = $c_lname;
        $_SESSION['email'] = $c_email;
        $_SESSION['user_role'] = $c_user_role;
        $_SESSION['user_id'] = $c_user_id;

        // Redirects to the home page with user logged in.
        redirect("public/home.php");

     }else{
        // Redirects to the home page with user not logged in.
        set_message("Username or Password is incorrect");
        redirect("index.php");
      }
   }
}

// Function used to get all categories from the database
// and display them as links in a list for the navigation.
function get_categories(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetch_array($query)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<li><a href='category.php?id=$cat_id'>{$cat_title}</a></li>";
    }

}

// Function used to get all products in database and display them on the page.
function get_products(){

    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){
        $products = <<<DELIMETER

        <div>
             <div class="col-md-4 col-sm-4 hero-feature text-center">
                  <div class="thumbnail">
                        <a href="item.php?id={$row['product_id']}"><img src="../resources/img/{$row['product_image']}" alt=""></a>
                        <div class="caption">
                             <h4>{$row['product_title']}</h4>
                             <h4>&#36;{$row['product_price']}</h4>
                             <p>
                                <a href="item.php?id={$row['product_id']}" class="btn btn-primary">View</a>
                                <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add To Cart</a>
                             </p>
                        </div>
                  </div>
             </div>
        </div>
DELIMETER;
        echo $products;
    }
}

// Function used to display all products of a specified category on the page.
function display_cat_products() {

     $query = query("SELECT * FROM products WHERE product_category_id =" . escape_string($_GET['id']) ."");
     confirm($query);

     while($row = fetch_array($query)){
         $products = <<<DELIMETER

         <div>
             <div class="col-md-4 col-sm-4 hero-feature text-center">
                 <div class="thumbnail">
                     <a href="item.php?id={$row['product_id']}"><img src="../resources/img/{$row['product_image']}" alt=""></a>
                     <div class="caption">
                         <h4>{$row['product_title']}</h4>
                         <h4>&#36;{$row['product_price']}</h4>
                         <p>
                            <a href="item.php?id={$row['product_id']}" class="btn btn-primary">View</a>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add To Cart</a>
                         </p>
                     </div>
                 </div>
             </div>
         </div>
DELIMETER;
        echo $products;
     }
}

// Function to display all the products that match the search terms submitted by the user.
function display_search_products(){

    // Gets strings from the search form and displays products
    // based on the product_title in the database
    if(isset($_POST['submit_search'])){

        $search = escape_string($_POST['search']);
        $query = query("SELECT * FROM products WHERE product_title LIKE '%$search%'");
        confirm($query);

        // Counts amount of products, if product count
        // is equal to 0 then it displays a message
        // saying there are no products.
        $count = mysqli_num_rows($query);
        if($count == 0){
            echo "<h1 class='text-center'> Oops! No products! </h1>";
        }else{
            // If product count is > 0 then it displays all
            // products with the product_title that were entered in the search bar.
            while($row = fetch_array($query)){
                $search_products = <<<DELIMETER
                 <div>
                     <div class="col-md-4 col-sm-4 hero-feature text-center">
                         <div class="thumbnail">
                             <a href="item.php?id={$row['product_id']}"><img src="../resources/img/{$row['product_image']}" alt=""></a>
                             <div class="caption">
                                 <h4>{$row['product_title']}</h4>
                                 <h4>&#36;{$row['product_price']}</h4>
                                 <p>
                                    <a href="item.php?id={$row['product_id']}" class="btn btn-primary">View</a>
                                    <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add To Cart</a>
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
DELIMETER;
                echo $search_products;
            }
        }
    }
}

//--- MANAGEMENT FUNCTIONS --------------------------------------------------------------------------

// Function to display all orders and their information in a table in the management system.
function display_orders(){

    $query = query("SELECT * FROM orders");
     confirm($query);

     while($row = fetch_array($query)){
         $orders = <<<DELIMETER

          <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_status']}</td>
            <td>{$row['card_name']}</td>
            <td> &#36;{$row['order_amount']}</td>
            <td>{$row['order_date']}</td>
          </tr>
DELIMETER;
        echo $orders;
     }
}

// Function to display all the products in table format in the management system.
function display_products(){

  $query = query("SELECT * FROM products");
  confirm($query);

  while($row = fetch_array($query)){
      $product_category_id = $row['product_category_id'];

      echo "<tr>";
      echo "<td>
              <a class='btn btn-danger center-block' href='index.php?products&delete={$row['product_id']}'>X</a><br>
              <a class='btn btn-info' href='index.php?products&edit_product&p_id={$row['product_id']}'>edit</a>
            </td>";
      echo "<td>{$row['product_id']}</td>";
      echo "<td>{$row['product_title']}</td>";
      echo "<td><img src='../../resources/img/{$row['product_image']}' alt='' height='50'></td>";
      echo "<td>{$row['product_desc']}</td>";
      echo "<td>{$row['product_quantity']}</td>";
      echo "<td>&#36;{$row['product_price']}</td>";

      $cat_query = query("SELECT * FROM categories WHERE cat_id = {$product_category_id}");
      confirm($cat_query);
      while($row = fetch_array($cat_query)){
          $cat_title = $row['cat_title'];
          echo "<td>{$cat_title}</td>";
      }
      echo "</tr>";
  }
    // Deletes the product when clicking the delete button created above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['delete'])){
        $the_product_id = $_GET['delete'];
        $query = query("DELETE FROM products WHERE product_id = {$the_product_id}");
        confirm($query);
        redirect("index.php?products");

    }

    // Redirects user to the edit product page. This If statement sets the product_id
    // (product id) to the id of the product the user wishes to edit.
    if(isset($_GET['p_id'])){
      $the_product_id = $_GET['p_id'];
      redirect("index.php?edit_product&p_id={$the_product_id}");
    }
}

// Function to update a product's database information based on what the user enters in the edit product form.
function update_product(){

  if(isset($_GET['p_id'])){
    $the_product_id = $_GET['p_id'];
  }

  if(isset($_POST['update_product'])){
      $product_title = escape_string($_POST['product_title']);
      $product_desc = escape_string($_POST['product_desc']);
      $product_category_id = escape_string($_POST['product_category']);
      $product_price = escape_string($_POST['product_price']);
      $product_quantity = escape_string($_POST['product_quantity']);
      $product_image = $_FILES['file']['name'];
      $product_image_temp = $_FILES['file']['tmp_name'];

      move_uploaded_file($product_image_temp, IMG_DIR . DS . $product_image);
      $query = query("UPDATE products SET product_title = '{$product_title}',product_category_id = '{$product_category_id}', product_price = '{$product_price}', product_quantity = '{$product_quantity}', product_desc = '{$product_desc}', product_image = '{$product_image}' WHERE product_id = {$the_product_id}");

      confirm($query);
      set_message("Product Updated");
      redirect("index.php?products");
  }
}

// Function to add a product into the database based on what the user has entered in the add product form in the management system.
function add_product(){

    if(isset($_POST['add_product'])){
        $product_title = escape_string($_POST['product_title']);
        $product_desc = escape_string($_POST['product_desc']);
        $product_price = escape_string($_POST['product_price']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $product_category = escape_string($_POST['product_category']);
        $product_image = $_FILES['file']['name'];
        $product_image_temp = $_FILES['file']['tmp_name'];

        move_uploaded_file($product_image_temp, IMG_DIR . DS . $product_image);

        $insertQuery = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity, product_desc, product_image) VALUES('{$product_title}', '{$product_category}', '{$product_price}', '{$product_quantity}', '{$product_desc}', '{$product_image}')");
        confirm($insertQuery);

        set_message("Your product has been created");
        redirect("index.php?add_product");
    }
}

// Function to display the categories in the database in table format in the management system.
function display_categories(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetch_array($query)){
        $categories = <<<DELIMETER

        <tr>
            <td>{$row['cat_id']}</td>
            <td>{$row['cat_title']}</td>
        </tr>
DELIMETER;
        echo $categories;
    }
}

// Function to add a category in the management system.
function add_category(){

  if(isset($_POST['add_category'])){
      $cat_title = escape_string($_POST['category_title']);

      $insertQuery = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}')");
      confirm($insertQuery);

      set_message("Your category has been created");
      redirect("index.php?categories");
  }
}

// Function to display all users in the database in table format in the management system.
function display_users(){

    $query = query("SELECT * FROM users");
    confirm($query);

    while($row = fetch_array($query)){
        $users = <<<DELIMETER

        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['user_role']}</td>
            <td>{$row['username']}</td>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
        </tr>
DELIMETER;
        echo $users;
    }
}

// Function that creates a user in the users table in the database based on information entered in add user form..
function create_user(){

    if(isset($_POST['createuser'])){
        $username = escape_string($_POST['inputUsername']);
        $password = escape_string($_POST['inputPassword']);
        $fname = escape_string($_POST['inputFname']);
        $lname = escape_string($_POST['inputLname']);
        $email = escape_string($_POST['inputEmail']);
        $user_role = escape_string($_POST['inputUserRole']);
        $password = md5($password);

        $insertQuery = query("INSERT INTO users(username, password, fname, lname, email, user_role) VALUES('{$username}', '{$password}', '{$fname}', '{$lname}', '{$email}', '{$user_role}')");
        confirm($insertQuery);

        set_message("Your user has been created");
        redirect("index.php?create_user");
    }
}

?>
