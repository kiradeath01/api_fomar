<?php  
    require_once 'auth.php'; 
    require __DIR__ . '/controllers/productos_controller.php'; 
    require __DIR__ . '/configurations/bearer_token.php'; 
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST=file_get_contents('php://input',true);
            $obj=json_decode($_POST);
            if(get_token(getBearerToken())){
                Create_producto($obj);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            break;

        case 'GET':
            if(get_token(getBearerToken())){
                if(isset($_GET["id"])){
                    $id=$_GET["id"];
                    echo Get_producto($id);
                }else{
                    echo GetAll();
                }
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'PUT':
            $_PUT=file_get_contents('php://input',true);
            if(get_token(getBearerToken())){
                $obj=json_decode($_PUT);
                echo Update_producto($obj,getBearerToken());
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'DELETE':
            if(get_token(getBearerToken())){
                $id=$_GET["id"];
                echo Delete_producto($id);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
        break;
    }
?>