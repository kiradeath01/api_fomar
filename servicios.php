<?php  
    require_once 'auth.php'; 
    require __DIR__ . '/controllers/servicios_controller.php'; 
    require __DIR__ . '/configurations/bearer_token.php'; 
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST=file_get_contents('php://input',true);
            $obj=json_decode($_POST);
            switch($obj->{"operation"}){
                case "1":
                    echo get_colores($obj->{"id"});
                    break;
                case "2":
                    //echo "entro";
                    echo referencia_pago($obj);
                    break;
                case "3":
                    echo guardar_pago($obj);
                    break;
            }
            break;
        case 'GET':
            if(isset($_GET["id"])){
                $id=$_GET["id"];
                $nombre_color="Gris";
                if(isset($_GET["color"])){
                    $nombre_color=$_GET["color"];
                }
                echo get_producto($id,$nombre_color);
            }else{
                echo get_productos();
            }
        break;

        case 'PUT':
            $_PUT=file_get_contents('php://input',true);
            if(get_token(getBearerToken())){
                $obj=json_decode($_PUT);
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
            
        break;

        case 'DELETE':
            if(get_token(getBearerToken())){
                $id=$_GET["id"];
            }else{
                echo json_encode(array('status' => false, 'mensaje' => 'token invalido'));
            }
        break;
    }
?>