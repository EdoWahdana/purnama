<?php 
$title = "Login";

include_once "layouts/header.php";



?>

<div class="login-box">
    <div class="login-logo">
        <a><b>Private Chat</b></a>
		
    </div>
	<p align="center">Mulai chat dengan Admin untuk memesan produk sesuai dengan keinginan desain anda sendiri</p>
  <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body box-custom">
            <p class="login-box-msg">Masuk untuk memulai chat</p>
            <?= msgHandling() ?>
            <form action="process/authentication.php?process=login" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-8">
            
                        <label>
                            <a href="register.php"> Register </a>
                        </label>
                       
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
    
        </div>
        <!-- /.login-card-body -->
    </div>
   
</div>

<?php include_once "layouts/footer.php" ?>