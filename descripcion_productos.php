<?php  
    require_once 'auth.php'; 
    require __DIR__ . '/controllers/descripcion_controller.php'; 
    require __DIR__ . '/configurations/bearer_token.php'; 
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST=file_get_contents('php://input',true);
            $obj=json_decode($_POST);
            if(get_token(getBearerToken())){
                Create_descripcion($obj);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            break;

        case 'GET':
            if(get_token(getBearerToken())){
                if(isset($_GET["id"])){
                    $id=$_GET["id"];
                    echo Get_descripcion($id);
                }else{
                    $id=$_GET["id_producto"];
                    echo GetAll($id);
                }
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'PUT':
            $_PUT=file_get_contents('php://input',true);
            if(get_token(getBearerToken())){
                $obj=json_decode($_PUT);
                echo Update_descripcion($obj,getBearerToken());
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'DELETE':
            if(get_token(getBearerToken())){
                $id=$_GET["id"];
                echo Delete_descripcion($id);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
        break;
    }
?>