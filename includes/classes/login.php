<?php
include "crud.php";
class Login extends Crud
{
    public function checkPassword($password , $storedPassword){
        if (password_verify($password , $storedPassword)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}