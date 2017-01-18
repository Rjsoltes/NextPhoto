<!-- Edit Product Page -->
<?php
  // Retreives information of product being edited
  if(isset($_GET['p_id'])){
      $the_product_id = $_GET['p_id'];
      $query = query("SELECT * FROM products WHERE product_id = {$the_product_id}");
      confirm($query);

      while($row = fetch_array($query)){
        $product_title = $row['product_title'];
        $product_desc = $row['product_desc'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $product_image = $row['product_image'];
      }

  }
?>
<div class="col-md-12">
    <div class="row">
        <h1 class="page-header text-center">Edit Product</h1>
        <p class="bg-success"><?php display_message(); ?></p>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <?php update_product(); ?>
        <div class="col-md-4">
            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
            </div>
            <div class="form-group">
                   <label for="product-title">Product Description</label>
              <textarea name="product_desc" id="" cols="30" rows="10" class="form-control"><?php echo $product_desc; ?></textarea>
            </div>
        </div>
        <aside id="admin_sidebar" class="col-md-8">
            <div class="form-group row">
                <div class="col-xs-4">
                  <label for="product-price">Product Price</label>
                  <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
                </div>
                <div class="col-xs-4">
                  <label for="product-quantity">Product Quantity</label>
                  <input type="number" name="product_quantity" class="form-control" size="60" value="<?php echo $product_quantity; ?>">
                </div>
            </div>
            <div class="form-group col-xs-8">
                <label for="product-title">Product Category</label>
                <select name="product_category" id="" class="form-control">
                  <?php
                      // Creates query for select element to display
                      // categories from database.
                      $query = query("SELECT * FROM categories");
                      confirm($query);
                      while($row = fetch_array($query)){
                          $cat_id = $row['cat_id'];
                          $cat_title = $row['cat_title'];
                          echo "<option value='$cat_id'>{$cat_title}</option>";
                      }
                  ?>
                </select>
            </div>
            <!-- Product Image -->
            <div class="form-group col-xs-8">
                <img src="../../resources/img/<?php echo $product_image; ?>" width="75" alt="">
                <label for="product-image">Product Image</label>
                <input type="file" name="file" value="<?php echo $product_image; ?>">
            </div>
            <div class="form-group col-xs-8">
                <button name="update_product" type="submit" class="btn btn-primary btn-lg">Update Product</button>
            </div>
        </aside>
    </form>
