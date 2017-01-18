<!-- Side Nav Links -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <!-- Displays certain navigation links based on the user's role (admin, manager, employee). -->
    <ul class="nav navbar-nav side-nav">
        <?php
        if(isset($_SESSION['user_role'])){
                $user_role = $_SESSION['user_role'];
                if($user_role == 'admin'){
                  $nav = <<<DELIMETER
                  <li class="active">
                      <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="index.php?orders"><i class="fa fa-fw fa-credit-card"></i> View Orders</a>
                  </li>
                  <li>
                      <a href="index.php?products"><i class="fa fa-fw fa-table"></i> View Products</a>
                  </li>
                  <li>
                      <a href="index.php?add_product"><i class="fa fa-fw fa-plus"></i> Add Product</a>
                  </li>
                  <li>
                      <a href="index.php?categories"><i class="fa fa-fw fa-list"></i> Categories</a>
                  </li>
                  <li>
                      <a href="index.php?users"><i class="fa fa-fw fa-users"></i> Users</a>
                  </li>
                  <li>
                      <a href="index.php?create_user"><i class="fa fa-fw fa-plus"></i> Add User</a>
                  </li>
DELIMETER;
                  echo $nav;
                }elseif($user_role == 'manager'){
                  $nav = <<<DELIMETER
                  <li class="active">
                      <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="index.php?orders"><i class="fa fa-fw fa-credit-card"></i> View Orders</a>
                  </li>
                  <li>
                      <a href="index.php?products"><i class="fa fa-fw fa-table"></i> View Products</a>
                  </li>
                  <li>
                      <a href="index.php?categories"><i class="fa fa-fw fa-list"></i> Categories</a>
                  </li>
                  <li>
                      <a href="index.php?users"><i class="fa fa-fw fa-users"></i> Users</a>
                  </li>
                  <li>
                      <a href="index.php?create_user"><i class="fa fa-fw fa-plus"></i> Add User</a>
                  </li>
DELIMETER;
                  echo $nav;
                }elseif ($user_role == 'employee') {
                  $nav = <<<DELIMETER
                  <li class="active">
                      <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="index.php?orders"><i class="fa fa-fw fa-credit-card"></i> View Orders</a>
                  </li>
                  <li>
                      <a href="index.php?products"><i class="fa fa-fw fa-table"></i> View Products</a>
                  </li>
                  <li>
                      <a href="index.php?categories"><i class="fa fa-fw fa-list"></i> Categories</a>
                  </li>
                  <li>
                      <a href="index.php?users"><i class="fa fa-fw fa-users"></i> Users</a>
                  </li>
DELIMETER;
                  echo $nav;
                }
        }
        ?>
    </ul>
</div>
