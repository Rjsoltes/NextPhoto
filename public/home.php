<!-- Home Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row carousel-holder">
                <div class="col-md-12">
                    <img class="center-block img-responsive" src="../resources/img/NPlogo2.png" alt="" width="800">
                </div>
            </div>
            <div class="row">
                <?php get_products(); ?>
            </div>
        </div>
    </div>
</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
