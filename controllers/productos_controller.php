<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php';
date_default_timezone_set("America/Monterrey");

function Get_all(){
    $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM lista_productos";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_producto=$row['id_producto'];
        $data->nombre_producto=$row['nombre_producto'];
        $data->stock=$row['stock'];
        $data->precio=$row['precio'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay productos.";
      $data->estatus=false;
    }
    return json_encode($data);
}
function Get_producto($id){
  $data = new StdClass();
    $dataimg = new StdClass();
    $datadesc = new StdClass();
    $sql="SELECT * FROM lista_productos WHERE id_producto=$id";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_array($query)){
        $data->id_producto=$row['id_producto'];
        $data->nombre_producto=$row['nombre_producto'];
        $data->stock=$row['stock'];
        $data->precio=$row['precio'];
        $data->estatus=true;
      }
    }else{
      $data->mensaje="No hay productos.";
      $data->estatus=false;
    }
    return json_encode($data);
}

function Create_producto($obj){
  $data = new StdClass();
  try {
      $nombre_producto=$obj->{"nombre_producto"};
      $stock=$obj->{"stock"};
      $precio=$obj->{"precio"};
      $id_promocion=$obj->{"id_promocion"};
      $sql="INSERT INTO cat_producto(nombre_producto, stock, precio, id_promocion) VALUES ($nombre_producto, $stock, $precio, $id_promocion)";
      global $conn; 
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->id_producto=$row['id_producto'];
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

function Update_producto($obj){
  $data = new StdClass();
  try {
    $id_producto=$obj->{"id_producto"};
    $nombre_producto=$obj->{"nombre_producto"};
    $stock=$obj->{"stock"};
    $precio=$obj->{"precio"};
    $id_promocion=$obj->{"id_promocion"};
    $sql="UPDATE cat_producto SET nombre_producto=$nombre_producto,stock=$stock,precio=$precio,id_promocion=$id_promocion WHERE id_producto=$id_producto";
    global $conn; 
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->id_producto=$row['id_producto'];
          $data->nombre_producto=$obj->{"nombre_producto"};
          $data->stock=$obj->{"stock"};
          $data->precio=$obj->{"precio"};
          $data->_id_promocion=$obj->{"id_promocion"};
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

function Delete_producto($id_producto){
  $data = new StdClass();
  try {
    global $conn;
    $sql="DELETE FROM `descripcion_producto` WHERE  id_producto=$id_producto";
    mysqli_query($conn, $sql); 
    $sql="DELETE FROM `cat_imagenes` WHERE  id_producto=$id_producto";
    mysqli_query($conn, $sql); 
    $sql="DELETE FROM `cat_producto` WHERE  id_producto=$id_producto";
      if(mysqli_query($conn, $sql)){
          $data->status=true; 
          $data->mensaje='Se ha eliminado el producto.';  
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