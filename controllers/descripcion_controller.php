<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php';
date_default_timezone_set("America/Monterrey");

function Get_all($id_producto){
    $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM descripcion_producto  WHERE id_producto=$id_producto";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_descripcion=$row['id_descripcion'];
        $data->peso=$row['peso'];
        $data->dimencion=$row['dimencion'];
        $data->color=$row['color'];
        $data->tipo=$row['tipo'];
        $data->descripcion=$row['descripcion'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay descripciones.";
      $data->estatus=false;
    }
    return json_encode($data);
}
function Get_descripcion($id){
  $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM descripcion_producto WHERE id_descripcion=$id";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_descripcion=$row['id_descripcion'];
        $data->peso=$row['peso'];
        $data->dimencion=$row['dimencion'];
        $data->color=$row['color'];
        $data->tipo=$row['tipo'];
        $data->descripcion=$row['descripcion'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay descripcion.";
      $data->estatus=false;
    }
    return json_encode($data);
}

function Create_descripcion($obj){
  $data = new StdClass();
  try {
      $peso=$obj->{"peso"};
      $dimencion=$obj->{"dimencion"};
      $color=$obj->{"color"};
      $tipo=$obj->{"tipo"};
      $descripcion=$obj->{"descripcion"};
      $id_producto=$obj->{"id_producto"};
      $sql="INSERT INTO descripcion_producto(`peso`, `dimencion`, `color`, `tipo`, `descripcion`, `id_producto`) VALUES ($peso, $dimencion, $color, $tipo,$descripcion,$id_producto)";
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

function Update_descripcion($obj){
  $data = new StdClass();
  try {
    $peso=$obj->{"peso"};
    $dimencion=$obj->{"dimencion"};
    $color=$obj->{"color"};
    $tipo=$obj->{"tipo"};
    $descripcion=$obj->{"descripcion"};
    $sql="UPDATE descripcion_producto SET peso=$peso,dimencion=$dimencion,color=$color,tipo=$tipo,descripcion=$descripcion WHERE id_descripcion=$id";
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

function Delete_descripcion($id){
  $data = new StdClass();
  try {
    global $conn;
    $sql="DELETE FROM `descripcion_producto` WHERE  id_descripcion=$id";
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->mensaje='Se ha eliminado la descripcion.';  
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