<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php';
date_default_timezone_set("America/Monterrey");

function Get_all(){
    $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM cat_promocion";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_imagen=$row['id_promocion'];
        $data->nombre_promocion=$row['nombre_promocion'];
        $data->descuento=$row['descuento'];
        $data->fecha_inicio=$row['fecha_inicio'];
        $data->fecha_vencimiento=$row['fecha_vencimiento'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay promociones.";
      $data->estatus=false;
    }
    return json_encode($data);
}
function Get_promocion($id){
  $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM cat_promocion WHERE id_promocion=$id";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_imagen=$row['id_promocion'];
        $data->descuento=$row['descuento'];
        $data->nombre_promocion=$row['nombre_promocion'];
        $data->fecha_inicio=$row['fecha_inicio'];
        $data->fecha_vencimiento=$row['fecha_vencimiento'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay promocion.";
      $data->estatus=false;
    }
    return json_encode($data);
}

function Create_promocion($obj){
  $data = new StdClass();
  try {
      $nombre_promocion=$obj->{"nombre_promocion"};
      $descuento=$obj->{"descuento"};
      $fecha_inicio=$obj->{"fecha_inicio"};
      $fecha_vencimiento=$obj->{"fecha_vencimiento"};
      $sql="INSERT INTO cat_promocion(`nombre_promocion`, `descuento`, `fecha_inicio`, `fecha_vencimiento`) VALUES ($nombre_promocion, $descuento, $fecha_inicio, $fecha_vencimineto)";
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

function Update_promocion($obj){
  $data = new StdClass();
  try {
    $id=$obj->{"id_promocion"};
    $nombre_promocion=$obj->{"nombre_promocion"};
    $descuento=$obj->{"descuento"};
    $fecha_inicio=$obj->{"fecha_inicio"};
    $fecha_vencimiento=$obj->{"fecha_vencimiento"};
    $sql="UPDATE cat_promocion SET nombre_promocion=$nombre_promocion,descuento=$descuento,fecha_inicio=$fecha_inicio,fecha_vencimiento=$fecha_vencimiento WHERE id_promocion=$id";
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

function Delete_promocion($id){
  $data = new StdClass();
  try {
    global $conn;
    $sql="DELETE FROM `cat_promocion` WHERE  id_promocion=$id";
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->mensaje='Se ha eliminado la promocion.';  
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