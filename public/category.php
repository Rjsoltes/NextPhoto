<!-- Category Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php
    // Gets corresponding category id and retrieves the category information from database.
    if(isset($_GET['id'])){
        $category_id = $_GET['id'];
    }

    $query = query("SELECT * FROM categories WHERE cat_id = $category_id");
    confirm($query);

    while($row = fetch_array($query)){
        $category_title = $row['cat_title'];
    }
?>

<div class="container">
    <img src="../resources/img/NPlogo1.png" alt="" width="150" class="image-responsive" style="float:left">
    <img src="../resources/img/NPlogo1.png" alt="" width="150" class="image-responsive" style="float:right">
    <br><br><br>
    <h1 class="page-header text-center"><?php echo $category_title; ?></h1>
    <div style="clear:both"></div>
    <?php display_cat_products(); ?>
</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
