
<!-- Categories Table -->
<h1 class="page-header">Product Categories</h1>
<p class="bg-success"><?php display_message(); ?></p>
<?php add_category(); ?>
<?php
    // Displays the option to add a new category is the user is an admin or a manager.
    // If employee then only the table is displayed.
    if(isset($_SESSION['user_role'])){
        $user_role = $_SESSION['user_role'];
        if($user_role == 'admin' || $user_role == 'manager'){
          $category_form = <<<DELIMETER

          <div class="col-md-4">
              <form action="" method="post">

                  <div class="form-group">
                      <label for="category_title">Title</label>
                      <input name="category_title" type="text" class="form-control">
                  </div>

                  <div class="form-group">

                      <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
                  </div>
              </form>
          </div>
DELIMETER;
          echo $category_form;

        }else{
            echo "";
        }
    }
 ?>

<div class="col-md-8">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php display_categories(); ?>
        </tbody>
    </table>
</div>
