<?php
ob_start();
include 'ini.php';
include $classes . 'login.php';
$user = new Login();
$session::startSession();
if ($session::checkSession()){
    header("Location: home.php?page=show_items");
    exit();
}
include $pages . "handleLogin.php";
?>
<div class='container'>
    <div class="login-page shadow-sm shadow-light">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1 class="text-center fw-bold border-secondary border-1 border-bottom py-3">Welcome Back</h1>
            <label class="mt-2"><i class="bi bi-person-fill me-1"></i>Username</label>
            <input type="text" name="username" placeholder="your username..." class="btn-sm form-control my-2">
            <label><i class="bi bi-lock-fill me-1"></i>Password</label>
            <input type="password" name="password" placeholder="your password..." class="btn-sm form-control my-2">
            <?php
                if (isset($errors)){
                    foreach($errors as $error){
                        echo "<div class='alert alert-danger my-2'>".$error."</div>";
                    }
                }
            ?>
            <input type="submit" name="login" value="Login" class="btn btn-primary btn-sm w-100 mt-2">
            <span class="fw-bold ms-1" style="font-size:11px;">Don't have an account?<a href="register.php">Create one.</a></span>
        </form>
    </div>
</div>
<?php include $template . 'footer.php'; ob_end_flush(); ?>