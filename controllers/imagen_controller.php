<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php';
date_default_timezone_set("America/Monterrey");

function Get_all($id_producto){
    $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    global $conn;
    $sql="SELECT * FROM cat_imagenes WHERE id_producto=$id_producto";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_imagen=$row['id_imagenes'];
        $data->descripcion=$row['descripcion'];
        $data->url_imagen=$row['url_imagen'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay descripciones.";
      $data->estatus=false;
    }
    return json_encode($data);
}
function Get_imagen($id){
  $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM cat_imagenes WHERE id_imagenes=$id";
    global $conn;
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_imagen=$row['id_imagenes'];
        $data->descripcion=$row['descripcion'];
        $data->url_imagen=$row['url_imagen'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay descripcion.";
      $data->estatus=false;
    }
    return json_encode($data);
}

function Create_imagen($obj){
  $data = new StdClass();
  global $conn;
  try {
      $peso=$obj->{"peso"};
      $dimencion=$obj->{"dimencion"};
      $color=$obj->{"color"};
      $tipo=$obj->{"tipo"};
      $descripcion=$obj->{"descripcion"};
      $id_producto=$obj->{"id_producto"};
      $sql="INSERT INTO cat_imagenes(`peso`, `dimencion`, `color`, `tipo`, `descripcion`, `id_producto`) VALUES ($peso, $dimencion, $color, $tipo,$descripcion,$id_producto)";
      global $conn; 
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->mensaje='Se han guardado los cambios.';  
          return json_encode($data);
      }else{
          $data->status=false; 
          $data->mensaje='No se pudo crear, revise que los datos ingresados.';  
          echo json_encode($data);
      }
  } catch (Exception $e) {
      $data->status=false; 
      $data->mensaje='No se pudo crear, revise su conexión a ingternet.';  
      return json_encode($data);
  }
}

function Update_imagen($obj){
  $data = new StdClass();
  global $conn;
  try {
    $url_imagen=$obj->{"url_imagen"};
    $descripcion=$obj->{"descripcion"};
    $sql="UPDATE cat_imagenes SET url_imagen=$url_imagen,descripcion=$descripcion WHERE id_imagenes=$id";
    global $conn; 
      if(mysqli_query($conn, $sql)){
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

function Delete_iamgen($id){
  $data = new StdClass();
  global $conn;
  try {
    global $conn;
    $sql="DELETE FROM `cat_imagenes` WHERE  id_imagenes=$id";
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->mensaje='Se ha eliminado la imagen.';  
          return json_encode($data);
      }else{
          $data->status=false; 
          $data->mensaje='No se pudo eliminar, revise que los datos ingresados.';  
          echo json_encode($data);
      }
  } catch (Exception $e) {
      $data->status=false; 
      $data->mensaje='No se pudo eliminar, revise su conexión a ingternet.';  
      return json_encode($data);
  }
}
?>