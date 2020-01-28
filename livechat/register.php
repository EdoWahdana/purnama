<?php 
$title = "Register";

include_once "layouts/header.php";



?>
<div class="row  justify-content-center">
    <div class="col-md-5">
        <div class="login-logo">
            <a><b>Register New User</b></a>
        </div>

        <div class="card">
            <div class="card-body">
            <?= msgHandling() ?>
                <form action="process/authentication.php?process=register" method="post" enctype="multipart/form-data">
                    <label for="username">Full Name</label>
                    <input type="text" class="form-control" name="name">

                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>

                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    
                    <br><br>
                    <input type="submit" class="btn btn-primary btn-block" value="REGISTER">

                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php" ?>