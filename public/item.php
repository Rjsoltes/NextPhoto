<!-- Item Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<div class="container">
    <img class="center-block img-responsive" src="../resources/img/NPlogo2.png" alt="" width="400"><br>
    <div class="col-md-1">
        <!-- Keeps everything centered on page -->
    </div>
    <?php
        $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']) ."");
        confirm($query);

        while($row = fetch_array($query)):
    ?>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-7">
                <img class="img-responsive" src="../resources/img/<?php echo $row['product_image']; ?>" alt="">
            </div>
            <div class="col-md-5">
                <div class="thumbnail">
                    <div class="caption-full">
                        <h4><a href="#"><?php echo $row['product_title']; ?></a> </h4>
                        <hr>
                        <h4 class=""><?php echo '&#36;' . $row['product_price']; ?></h4>
                        <p><?php echo $row['product_desc']; ?></p>
                        <p><?php echo "<a href='../resources/cart.php?add={$row['product_id']}'' class='btn btn-primary'>Add To Cart</a>" ?></p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <?php endwhile ?>
</div>

<?php require_once("../resources/close_conn.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
