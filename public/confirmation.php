<!-- Payment Confirmation Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "confirmation_header.php"); ?>

<div class="container">
    <br><br><br><br><br><br>
    <div class="row">
        <h1 class="text-center">Thank You For Your Purchase!</h1>
        <br><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Name</th>
                    <th>Quantity</th>
                    <th>Items</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Displays receipt and clears all cart information for the current session.
                    display_receipt();
                    if(isset($_GET['complete'])){
                        unset($_SESSION['cart_items']);
                        unset($_SESSION['cart_subtotal']);
                        unset($_SESSION['cart_items_quantity']);
                        unset($_SESSION['cart_items_price']);
                        $_SESSION['cart_total'] = 0;
                        $_SESSION['cart_total_quantity'] = 0;

                        redirect("home.php");
                    }
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <br><br><br><br>
            <a href="confirmation.php?complete" class="btn btn-primary btn-lg text-center">Continue Shopping</a>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>

<?php require_once("../resources/close_conn.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
