<?php

// Finds if the user id of the session exists and if so then set it to the current user id.
if(isset($_SESSION['user_id'])){
         $c_user_id = $_SESSION['user_id'];
    }

    // Brings in information about the current user based on their id.
    $query = query("SELECT * FROM users WHERE user_id = $c_user_id");
    confirm($query);

    while($row = fetch_array($query)){
        $c_user_id = $row['user_id'];
        $c_username = $row['username'];
        $c_email = $row['email'];
        $c_password = $row['password'];
        $c_fname = $row['fname'];
        $c_lname = $row['lname'];
        $c_user_role = $row['user_role'];

    }
?>

<div class="container ">
    <!-- Improves mobile display -->
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>

    <!-- All the navigation links -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
        <!-- Left Navigation Links -->
        <ul class="nav navbar-nav">
            <!-- Home Link -->
            <li>
                <a href="home.php"><i class='fa fa-fw fa-home'></i> Home</a>
            </li>
            <!-- Categories Dropdown Link -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-list-ul"></i> Categories<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                      get_categories();
                    ?>
                </ul>
            </li>
            <!-- Search Bar -->
            <li>
                <form class="navbar-form navbar-right" action="search.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </div>
                    <button name="submit_search" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </li>
        </ul>

        <!-- Right Navigation Links  -->
      	<ul class="nav navbar-nav navbar-right">

            <!-- Username/Management System Link -->
            <li>
                <?php
                    // If the user is an admin, manager, or employee then they get a link to the management system.
                    // If the user is a standard user they just get a empty link that displays their username.
                    if(isset($_SESSION['user_role'])){
                        $user_role = $_SESSION['user_role'];
                        if($user_role == 'admin' || $user_role == 'manager' || $user_role == 'employee'){
                            echo "<li class='dropdown'>
                                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-fw fa-user'></i> {$c_username} <b class='caret'></b></a>
                                    <ul class='dropdown-menu'>
                                        <li>
                                            <a href='admin/index.php'><i class='fa fa-fw fa-bar-chart'></i> Manage</a>
                                        </li>
                                    </ul>
                                  </li>";
                        }else{
                            echo "<li><a href='#'><i class='fa fa-fw fa-user'></i> {$c_username}</a></li>";
                        }
                    }
                ?>
            </li>
            <!-- Cart Link -->
            <li>
                <a href="view_cart.php"><i class="fa fa-fw fa-shopping-cart"></i> Cart</a>
            </li>
            <!-- Logout Link -->
      	    <li>
      			    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
      		  </li>
      	</ul>
    </div>
</div>
