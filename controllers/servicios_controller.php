<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php'; 
require __DIR__ . '/../vendor/autoload.php';  

function get_productos(){
    //elementos compartidos funcion busqueda de productos
    $dataproductos[] = new StdClass();
    $data = new StdClass();
    $dataimg[] = new StdClass();
    $datadesc[] = new StdClass();
    $i=0;
    $j=0;
    $k=0;
    $bandera=true;
    $sql="SELECT * FROM lista_productos";
    global $conn;
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
        while($row = mysqli_fetch_array($query)){
            if($bandera){
                $bandera=false;
                $data->id=$row['id_producto'];
                $data->nombre_producto=$row['nombre_producto'];
                $data->stock=$row['stock'];
                $data->precio=$row['precio'];
                $data->urlimg=$row["url_imagen"];
                $data->estatus=true;
            }
            if($row["totaldescripcion"]>$i && !(empty($row["totaldescripcion"])) && $row["totaldescripcion"]!=null){
                $temp = new StdClass();
                $temp->tipo=$row["tipo"];
                $temp->dimencion=$row["dimencion"];
                $temp->descripcionproducto=$row["descripcionproducto"];
                $datadesc[$i]=$temp;
                $i++;
            }
    
            if($row["totalimg"]>$j && !(empty($row["totalimg"]))){
                $temp = new StdClass();
                $temp->id_imagen=$row["id_imagenes"];
                $temp->url_imagen=$row["url_imagen"];
                $temp->descripcionimagen=$row["descripcionimagen"];
                $dataimg[$j]=$temp;
                $j++;
            }
            
            if(max($row["totaldescripcion"],$row["totalimg"])==max($i,$j)){
                $bandera=true;
                $data->descripcionesimg=$dataimg;
                $data->descripciones=$datadesc;
                $dataproductos[$k]=$data; 
                $data = new StdClass();
                $dataimg[] = new StdClass();
                $datadesc[] = new StdClass();
                $k++;
                $i=0;
                $j=0;
            }
        }
    }else{
        $data->mensaje="No hay productos.";
        $data->estatus=false;
    }
    return json_encode($dataproductos);
}
function get_colores($id){
    $data = new StdClass();
    $colores[]=null;
    $temp=array();
    $sql="SELECT * FROM cat_imagenes WHERE id_producto=$id";
    global $conn;
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
        while($row = mysqli_fetch_array($query)){
        array_push($colores,$row["color"]);
        }
        $colores=array_unique($colores);
        foreach ($colores as $valor) {
            if($valor!=null){
                array_push($temp,$valor);
            }
        }
        $data->color=$temp;
    }else{
      $data->mensaje="No hay descripcion.";
      $data->estatus=false;
    }
    return json_encode($data);
}

function referencia_pago($obj){
    $nombre  = $obj->{"nombre"};
    $cantidad  = $obj->{"cantidad"};
    $monto  = $obj->{"monto"};
    $data = new StdClass();
    // SDK de Mercado Pago
    require __DIR__ .  '/../vendor/autoload.php';
    // Agrega credenciales
    MercadoPago\SDK::setAccessToken('TEST-1928247304842098-121702-4c34916707700a3367e85bd3556a35f6-259735522');
    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();
    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = $nombre;
    $item->quantity = $cantidad;
    //$item->currency_id= "MXN";
    $item->unit_price = $monto;
    $preference->items = array($item);
    $preference->save();
    $data->id=$preference->id;
    return json_encode($data);
}

function guardar_pago($obj){
    $nombre  = $obj->{"nombre"};
    $apellidos  = $obj->{"apellidos"};
    $producto  = $obj->{"producto"};
    $estado  = $obj->{"estado"};
    $cp  = $obj->{"cp"};
    $direccion  = $obj->{"direccion"};
    $correo  = $obj->{"correo"};
    $telefono  = $obj->{"telefono"};
    $fecha  = $obj->{"fecha"};
    $m = explode("$", $obj->{"monto"});
    $monto  = $m[1];
    $reference_id  = $obj->{"reference_id"};
    $productos=$obj->{"productos"};
    $data = new StdClass();
    //*
    $sql="INSERT INTO tb_compras(token_compra, monto_compra, fecha_compra, fecha_confirmacion, tipo_operacion,is_cancelado) VALUES ('$reference_id',$monto,'$fecha','$fecha','compra',false)";
    global $conn; 
    if(mysqli_query($conn, $sql)){
        $sql="SELECT MAX(id_compras) as id_compras FROM tb_compras";
        $query =  mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0){
            $row = mysqli_fetch_array($query);
            $id_compras=$row["id_compras"];
            $sql="INSERT INTO tb_datos_cliente(nombre, apellidos, correo, telefono, direccion, cp, estado, id_compras) VALUES ('$nombre','$apellidos','$correo','$telefono','$direccion','$cp','$estado',$id_compras)";
            if(mysqli_query($conn, $sql)){
                $sql="SELECT MAX(id_compras) as id_compras FROM tb_compras";
                $query =  mysqli_query($conn, $sql);
                if(mysqli_num_rows($query)>0){
                    $id_datos_cliente=$row["id_datos_cliente"];
                    foreach ($productos as &$valor) {
                        $id_producto=$valor->{"key"};
                        $cantidad_producto=$valor->{"cantidad"};
                        $sql="INSERT INTO tiket_compra(id_compras, id_producto, cantidad_producto, is_promocion) VALUES ($id_compras,$id_producto,$cantidad_producto,false)";
                        if(mysqli_query($conn, $sql)){
                            $data->status=true; 
                            $data->mensaje='Datos guardados correctamente, en breve le llegara un correo de confirmación.';
                            enviar_correo_cliente($obj);
                            enviar_correo_fomar($obj);
                        }
                    }
                }
            }
        }else{
            $sql="";
            $data->status=false; 
            $data->mensaje='No se pudo crear, revise que los datos ingresados.';
        }
    }else{
        $data->status=false; 
        $data->mensaje='No se pudo crear, revise que los datos ingresados.';
        $data->sql=$sql;
    }
    return json_encode($data);
    //*/
}

function get_producto($id,$nombre_color){
    $data = new StdClass();
    $dataimg[] = new StdClass();
    $datadesc[] = new StdClass();
    $colores[]=null;
    $data->descripciones=null;
    $data->urlimg=null;
    $i=0;
    $j=0;
    $bandera=true;
    $sql="SELECT * FROM lista_productos where id_producto=$id and color='$nombre_color'";
    global $conn;
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
        while($row = mysqli_fetch_array($query)){
            if($bandera){
                $bandera=false;
                $data->id=$row['id_producto'];
                $data->nombre_producto=$row['nombre_producto'];
                $data->stock=$row['stock'];
                $data->precio=$row['precio'];
                $data->urlimg=$row["url_imagen"];
                $data->estatus=true;
            }
            if(max($row["totaldescripcion"],$row["totalimg"])==max($i,$j)){
                $bandera=true;
            }
            if($row["totaldescripcion"]>$i && !(empty($row["totaldescripcion"])) && $row["totaldescripcion"]!=null){
                $temp = new StdClass();
                $temp->tipo=$row["tipo"];
                $temp->dimencion=$row["dimencion"];
                $temp->descripcionproducto=$row["descripcionproducto"];
                $datadesc[$i]=$temp;
                $i++;
            }

            if($row["totalimg"]>$j && !(empty($row["totalimg"]))){
                $temp = new StdClass();
                $temp->id_imagen=$row["id_imagenes"];
                $temp->url_imagen=$row["url_imagen"];
                $temp->descripcionimagen=$row["descripcionimagen"];
                $dataimg[$j]=$temp;
                $j++;
            }
            array_push($colores,$row["color"]);
        }
    }else{
        $data->mensaje="No hay productos.";
        $data->estatus=false;
    }
    $colores=array_unique($colores);
    $temp=array();
    foreach ($colores as $valor) {
        if($valor!=null){
            array_push($temp,$valor);
        }
    }
    $data->descripcionesimg=$dataimg;
    $data->descripciones=$datadesc;
    $data->color=$temp;
    return json_encode($data);
}