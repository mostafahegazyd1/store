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
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $values = [
        "username" => strtolower($_POST['username']),
        "password" => strtolower($_POST['password']),
    ];
    $rules = [
        "username" => [
            "required" => true,
        ],
        "password" => [
            "required" => true,
        ],
    ];
    $data = Validation::validate($values , $rules);
    if (isset($data['errors'])){
        $errors = $data['errors'];
    }
    else{
        $vData = $data['data'];
        // that means that there is no errors
        $userData = $user -> getData($connection , "*" , "users" ,  "WHERE username = ?" ,[$vData['username']], "fetch" , "");
        if ($userData){
            $check_password = $user->checkPassword($vData['password'] , $userData['password']);
            if ($check_password){
                // this means that the user exist in the database
                // session start
                $session::startSession();
                $sessionValues =
                [
                    "id" => $userData['id'],
                    "username" => $userData['username'],
                    "email" => $userData['email'],
                    "group_name" => $userData['group_name'],
                ];
                $session::setSession($sessionValues);
                if ($session::checkSession()){
                    header('Location: home.php?page=show_items');
                    exit();
                }
            }
            else {
                $errors[] = "User not found";
            }
        }
        else{
            $errors[] = "User not found";
        }
        // check user password
    }
}
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