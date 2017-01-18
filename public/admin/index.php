<!-- Homepage for Management System -->
<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <img class="center-block img-responsive" src="../../resources/img/NPlogo2.png" alt="" width="400">
              <h1 class="text-center">Management System</h1>
              <h1 class="text-center"><small><?php echo $_SESSION['username']; ?></small></h1>
              <hr>
            </div>
        </div>
        <?php
            // Displays management system information based on the paramenters in the URL bar.
            if($_SERVER['REQUEST_URI'] == "/databaseProject/public/admin/" || $_SERVER['REQUEST_URI'] == "/databaseProject/public/admin/index.php"){

                include(TEMPLATE_BACK . DS . "admin_content.php");
            }
            // Displays Orders
            if(isset($_GET['orders'])){

                include(TEMPLATE_BACK . DS . "orders.php");
            }
            // Displays Products
            if(isset($_GET['products'])){

                include(TEMPLATE_BACK . DS . "products.php");
            }
            // Displays Add Product
            if(isset($_GET['add_product'])){

                include(TEMPLATE_BACK . DS . "add_product.php");
            }
            // Displays Categories
            if(isset($_GET['categories'])){

                include(TEMPLATE_BACK . DS . "categories.php");
            }
            // Displays Users
            if(isset($_GET['users'])){

                include(TEMPLATE_BACK . DS . "users.php");
            }
            // Displays Create User
            if(isset($_GET['create_user'])){

                include(TEMPLATE_BACK . DS . "create_user.php");
            }
            // Displays Edit Product
            if(isset($_GET['edit_product'])){

                include(TEMPLATE_BACK . DS . "edit_product.php");
            }
        ?>
    </div>
</div>

<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>
