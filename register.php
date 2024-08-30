<?php
ob_start();
include "ini.php";
$session::startSession();
if ($session::checkSession()){
    header("Location:home.php?page=show_items");
    exit();
}
include $classes . "register.php";
$user = new Register();
include $pages . "handleRegister.php";
?>
<div class="container">
    <div class="register-page">
        <h1 class="text-center fw-bold"><i class="bi bi-person-fill me-1"></i>Register</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label class="mt-2"><i class="bi bi-person-fill me-1"></i>Username</label>
            <input type="text" name="username" placeholder="your username..." class="btn-sm form-control my-2">
            <label class="mt-2"><i class="bi bi-envelope-fill me-1"></i>Email</label>
            <input type="email" name="email" placeholder="your email..." class="btn-sm form-control my-2">
            <label><i class="bi bi-lock-fill me-1"></i>Password</label>
            <input type="password" name="password" placeholder="your password..." class="btn-sm form-control my-2">
            <?php
                if (isset($data['errors'])){
                    foreach($data['errors'] as $error){
                        echo "<div class='alert alert-danger my-2'>".$error."</div>";
                    }
                }
                if (isset($data['success'])){
                    echo "<div class='alert alert-success my-2'>".$data['success']."</div>";
                }
            ?>
            <input type="submit" name="login" value="Sign up" class="btn btn-primary btn-sm w-100 mt-2">
            <span class="fw-bold ms-1" style="font-size:11px;">or if you have an account, <a href="index.php" class="text-secondary">Login</a></span>
        </form>
    </div>
</div>
<?php include $template . 'footer.php'; ob_end_flush(); ?>