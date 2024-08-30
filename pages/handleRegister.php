<?php
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    // to check if user is coming from post request
    $values = [
        "username" => strtolower($_POST['username']),
        "password" => strtolower($_POST['password']),
        "email" => strtolower($_POST['email']),
    ];
    $rules = [
        "username" => [
            "required" => "",
            "min" => "5",
            "max" => "20",
        ],
        "email" => [
            "required" => "",
            "email" => "",
        ],
        "password" => [
            "required" => "",
            "min" => "8",
            "max" => "150",
        ],
    ];
    $data = Validation::validate($values, $rules);
    if (isset($data['data'])){
        // hash the user password
        $hashedPassword = password_hash($data['data']['password'] , PASSWORD_DEFAULT);
        // now we have to check if the entered username is unique 
        $usernameUnique = Validation::validateUnique($connection, "users", "WHERE username =?", [$data['data']['username']]);
        if ($usernameUnique):
            $data['errors']['username'] = "You can not use this username.";
        endif;
        $emailUnique = Validation::validateUnique($connection , "users" , "WHERE email = ?" , [$data['data']['email']]);
        if ($emailUnique):
            $data['errors']['email'] = "You can not use this email address.";
        endif;
        if (empty($data['errors'])){
            // if there are no errors, insert the user into the database
            $registerStatus = $user -> insertData($connection , "users" , ["username" , "email" , "password" , "group_name"] , [$data['data']['username'] , $data['data']['email'] , $hashedPassword , "normal_user"]);
            if ($registerStatus){
                $data['success'] = "You have been successfully registered";
            }
            else{
                $data['errors']['register'] = "Something occured while creating the new account";
            }
        }
    }
}
?>