<!-- Search Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
              <img src="../resources/img/NPlogo1.png" alt="" width="150" class="image-responsive" style="float:left">
              <img src="../resources/img/NPlogo1.png" alt="" width="150" class="image-responsive" style="float:right">
              <br><br><br>
              <h1 class="page-header text-center">Search Results</h1>
              <div style="clear:both"></div>
                  <?php display_search_products(); ?>
            </div>
        </div>
    </div>
</div>

<?php require_once("../resources/close_conn.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
