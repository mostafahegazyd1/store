<?php
class Session
{
    public static function startSession(){
        session_start();
    }
    public static function setSession($values){
        foreach ($values as $key => $value){
            $_SESSION[$key] = $value;
        }
    }
    public static function checkSession(){
        if (!empty($_SESSION)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    public static function getSession($key){
        return $_SESSION[$key]?? null;
    }
    public static function destroySession(){
        session_unset();
        session_destroy();
    }
}