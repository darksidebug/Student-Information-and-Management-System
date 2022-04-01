<?php

if(session_status() === PHP_SESSION_NONE)
session_start();

class Session
{
    public static function SetFlashData($key, $value)
    {
        if(empty($key) || empty($value)){
            return false;
        }
    
        $_SESSION['_flashdata'][$key] = $value;
        return true;
    }

    public static function GetFlashData($key)
    {
        if(empty($key) || !isset($_SESSION['_flashdata'][$key])){
            var_dump(['flash key' => $key, 'message' => `Flash message '`.$key.`' is not defined!`]);
        }

        $flash_data = $_SESSION['_flashdata'][$key];
        unset($_SESSION['_flashdata'][$key]);
        return $flash_data;
    }
}