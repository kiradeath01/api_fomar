<?php
require __DIR__ . '/configurations/conexion.php'; 
require __DIR__ . '/configurations/SED.php'; 
require __DIR__ . '/vendor/autoload.php';  
use Firebase\JWT\JWT; 
date_default_timezone_set("America/Monterrey");
$key = 'cocuyodev@support.com';
$fecha_actual = date("Y-m-d H:i:s"); 

function get_token($obj){
    global $fecha_actual;
    $token=$obj;
    try{
        $token_data=decode_token($token);
        $fecha_expiracion=$token_data->{"fet"};
        $user_data=$token_data->{"data"};
        $data=Get($user_data->{"kiu"});
        $data=$data[0];
        if($fecha_actual<$fecha_expiracion){
            if($token==$data["token"]){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }catch (Exception $e) {
        return false;
    }
    
}

function Get($id){
    global $servername;
    global $username;
    global $password;
    global $database;
    $db = new PDO('mysql:host=' . $servername . ';dbname=' . $database . ';charset=utf8', $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $consulta = $db->prepare("SELECT * FROM login WHERE id_login=$id");
        $estado=	$consulta->execute();
        if ($estado)
        {	
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    } catch (Exception $e) {
        return null;
    }
}
function decode_token($token){
    global $key;
   return $data = JWT::decode($token, $key, array('HS256'));
}