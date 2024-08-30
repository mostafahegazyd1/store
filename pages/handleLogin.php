<?php
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