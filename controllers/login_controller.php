<?php
require __DIR__ . '/../configurations/conexion.php'; 
//require __DIR__ . '/../configurations/SED.php'; 
require __DIR__ . '/../configurations/configurations.php'; 
require __DIR__ . '/../configurations/email.php'; 
require __DIR__ . '/../vendor/autoload.php';  
date_default_timezone_set("America/Monterrey");
$fecha_actual = date("Y-m-d H:i:s");  
use Firebase\JWT\JWT;
$key = 'cocuyodev@support.com';

function GetAll(){
    $db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $consulta = $db->prepare("SELECT * FROM login");
        $estado=	$consulta->execute();
        if ($estado)
        {	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if(empty($resultados) || is_null($resultados)){
                echo json_encode(array('status' => false, 'mensaje' => 'Usuarios no encontrados', 'ObjectJsonResult'=>null));
            }else{
                echo json_encode(array('status' => true, 'mensaje' => 'Usuarios encontrados', 'ObjectJsonResult'=>$resultados ));
            }
            
        }
        else
            echo json_encode(array('status' => false, 'mensaje' => 'Ocurrio un error al guardar el elemento', 'ObjectJsonResult'=>null ));
    } catch (Exception $e) {
        $data->status=false; 
        $data->mensaje='No se pudo actualizar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
}

function Get_user($id){
    $db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $consulta = $db->prepare("SELECT * FROM login WHERE id_login=$id");
        $estado=	$consulta->execute();
        if ($estado)
        {	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            if(empty($resultados) || is_null($resultados)){
                echo json_encode(array('status' => false, 'mensaje' => 'Usuario no encontrado', 'ObjectJsonResult'=>null ));
            }else{
                echo json_encode(array('status' => true, 'mensaje' => 'Usuario encontrado', 'ObjectJsonResult'=>$resultados));
            }
        }
        else
            echo json_encode(array('status' => false, 'mensaje' => 'Usuario no encontrado', 'ObjectJsonResult'=>null ));
    } catch (Exception $e) {
        $data=new StdClass();
        $data->status=false; 
        $data->mensaje='No se pudo actualizar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
}

function login($user,$pass){
    global $key,$fecha_actual;
    $data = new StdClass();
    global $conn;
    if(empty($user) || empty($pass)){
        $data->status=false; 
        $data->confirmacion=false;  
        $data->noexiste=true;   
        return json_encode($data);
    }
    $control_user = SED::encrypt_decrypt('encrypt',$user);
    $control_password =SED::encrypt_decrypt('encrypt',$pass);
    try {
        //validacion si esta en login
        $sql="SELECT * FROM login where username='$control_user' and password='$control_password'";
        $query =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        if (count($row) > 0) {
            $id=$row['id_login'];
            $usuario=$row['username'];
            $token = array(
                'fit' => $fecha_actual, // Tiempo que inició el token
                'fet' => date("Y-m-d H:i:s",strtotime($fecha_actual."+ 1 days")), // Tiempo que expirará el token (+1 hora)
                'data' => [ // información del usuario
                    'kiu' => $id,
                    'username' => $usuario
                ]
            );
            $jwt = JWT::encode($token, $key);
            $sql="UPDATE login SET token = '$jwt' WHERE id_login=$id";
            mysqli_query($conn, $sql);
            $data->estatus=true;  
            $data->SUN = $usuario;
            $data->STASA=$jwt;
            $data->SUID = SED::encrypt_decrypt('encrypt',$id); 
        }
        else{
            $data->estatus=false;
            $data->mensaje='Usuario o contraseña incorrecto.';    
        }
        return json_encode($data);
    } catch (Exception $e) {
        $data->status=false; 
        $data->mensaje='No se pudo actualizar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
}
/*
function create($obj){
    $db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = new StdClass();
    try {
        $consulta = $db->prepare("CALL `Crear_user_mikrotwisp`(:nombreu,
        :apaternou,
        :amaternou,
        :telefonou,
        :correou,
        :user_name,
        :password_user,
        :idcargo,
        :meses,
        :idplan,
        :confirmacion,
        :token
        )");
        $user = SED::encrypt_decrypt('encrypt',str_replace(" ", "", $obj->{"nombre"}).'_'.generarCodigoNumerico(3));
        $password = SED::encrypt_decrypt('encrypt',generarCodigoConfirmacion(6)); 
        $confirmacion=generarCodigoConfirmacion(32);
        $estado=	$consulta->execute(
            array(
                ':nombreu' => $obj->{"nombre"},
                ':apaternou' => $obj->{"apaterno"},
                ':amaternou' => $obj->{"amaterno"},
                ':telefonou' => $obj->{"telefono"},
                ':correou' => $obj->{"correo"},
                ':user_name' => $user,
                ':password_user' => $password,
                ':idcargo' => $obj->{"idcargo"},
                ':meses' => $obj->{"mes"},
                ':idplan' => $obj->{"idplan"},
                ':confirmacion' => $confirmacion,
                ':token' => generarCodigoConfirmacion(6)
                )
        );

        if ($estado){
            $user2= SED::encrypt_decrypt('decrypt',$user);
            $password2=SED::encrypt_decrypt('decrypt',$password);
            enviar_correo($correo,$user2,$password2,$confirmacion,'FREE');
            enviar_correo("soporte@mikrotwisp.com",$user2,$password2,$confirmacion,'FREE');
            $data->status=true; 
            $data->mensaje='Se ha registrado con exito, verifique su correo electronico para confirmar cuenta.';  
            return json_encode($data);
        }else{
            $data->status=false; 
            $data->mensaje='No se pudo registrar, revise que los datos ingresados.';  
            return json_encode($data);
        }
    } catch (Exception $e) {
        $data->status=false; 
        $data->mensaje='No se pudo guardar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
    
}

function update($obj,$token){
    $data = new StdClass();
    try {
        $user=SED::encrypt_decrypt('encrypt',$obj->{"user"});
        $password=SED::encrypt_decrypt('encrypt',$obj->{"password"});
        $sql="UPDATE root SET usuario = '$user', contrasenia='$password' WHERE token='$token'"; 
        global $conn2; 
        if(mysqli_query($conn2, $sql)){
            $data->status=true; 
            $data->mensaje='Se han guardado los cambios.';  
            return json_encode($data);
        }else{
            $data->status=false; 
            $data->mensaje='No se pudo actualizar, revise que los datos ingresados.';  
            echo json_encode($data);
        }
    } catch (Exception $e) {
        $data->status=false; 
        $data->mensaje='No se pudo actualizar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
}

function Delete_user($id){
    $db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = new StdClass();
    try {
        $consulta = $db->prepare("CALL Delete_user_mikrotwisp(:iduser)");
        $estado=	$consulta->execute(
            array(
                ':idplan' => $id
                )
        );

        if ($estado){
            $data->status=true; 
            $data->mensaje='Se ha eliminado con exito.';  
            return json_decode($data);
        }else{
            $data->status=false; 
            $data->mensaje='No se pudo eliminar, revise que los datos ingresados.';  
            return json_decode($data);
        }
    } catch (Exception $e) {
        $data->status=false; 
        $data->mensaje='No se pudo actualizar, revise su conexión a ingternet.';  
        return json_encode($data);
    }
}
*/
?>