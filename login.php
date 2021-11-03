<?php  
    require_once 'auth.php'; 
    require __DIR__ . '/controllers/login_controller.php'; 
    require __DIR__ . '/configurations/bearer_token.php'; 
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST=file_get_contents('php://input',true);
            $obj=json_decode($_POST);
            switch($obj->{"operation"}){
                case "create":
                    echo create($obj);
                    break;
                case "login":
                    echo login($obj->{"user"},$obj->{"password"});
                    break;
            }
            break;

        case 'GET':
            if(get_token(getBearerToken())){
                if(isset($_GET["id"])){
                    $id=$_GET["id"];
                    echo Get_user($id);
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
                echo update($obj,getBearerToken());
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'DELETE':
            if(get_token(getBearerToken())){
                $id=$_GET["id"];
                echo Delete_user($id);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
        break;
    }
?>