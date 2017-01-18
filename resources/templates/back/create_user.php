<!-- Create User Page -->
<div class="row">
    <h1 class="page-header text-center">Create User</h1>
</div>
<div class="col-md-4">
    <form class="form-signin" method="post" autocomplete="off">
        <h4 class="text-center bg-success"><?php display_message(); ?></h4>
        <?php create_user(); ?>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="inputUsername" class="form-control" placeholder="Username" required autofocus><br>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required><br>

        <label for="inputFname" class="sr-only">First Name</label>
        <input type="text" name="inputFname" class="form-control" placeholder="First Name" required><br>

        <label for="inputLname" class="sr-only">Last Name</label>
        <input type="text" name="inputLname" class="form-control" placeholder="Last Name" required><br>

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Email" required><br>

       <div>
            <label for="inputUserRole" class="sr-only">User Role</label>
            <select name="inputUserRole" class="form-control">
                <option value="">User Role</option>
                <option value="standard">Standard</option>
                <option value="employee">Employee</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="createuser">Create User</button>
    </form>
</div>
