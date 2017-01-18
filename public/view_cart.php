<!-- Cart View Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<div class="container">
    <div class="row">
        <img src="../resources/img/NPlogo1.png" alt="" width="150" class="image-responsive" style="float:left">
        <br><br><br>
        <h1 class="page-header">My Cart</h1>
        <div style="clear:both"></div>
        <h4 class="bg-danger"><?php display_message(); ?></h4>
        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php display_cart();?>
                </tbody>
            </table>
        </form>
        <hr>
        <div class="text-right">
           <?php
              // Only displays make payment button if the cart has items in it.
              if(!empty($_SESSION['cart_items'])){
                echo "<a href='payment.php' class='btn btn-primary btn-lg'>Make Payment</a> ";
              }
            ?>
            <br><br><br><br><br><br><br>
        </div>
    </div>
    <?php require_once("../resources/close_conn.php"); ?>
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
