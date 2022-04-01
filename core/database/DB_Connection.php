<?php 

require_once 'DB_Config.php'; 

ini_set("display_errors", 'on');
ini_set("error_reporting",E_ALL);

class DB_Connection
{
    public $conn;

    public function __construct()
    {
        try{
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_DATABSE.";charset=".CHARSET;
            $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "<div class='db-error' align='center' style='color: #5A6472; font-family: sans-serif; font-weight: bold; font-size: 1.5em; margin-bottom: 2rem; margin-top: 10vh;'>
                    500 | SERVER ERROR
                </div>
                <div style='border-radius: 5px; font-family: sans-serif; padding: 8px; border: 1px solid #F36338; 
                    background-color: #FF7262; color: #fff; width: 60%; margin: auto;'>
                    ERROR: ".$e->getMessage().". Please check database configuration file!
                </div>";
        }
    }
}

?>