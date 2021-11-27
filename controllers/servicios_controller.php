<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php'; 

function get_productos(){
    //elementos compartidos funcion busqueda de productos
    $data = new StdClass();
    $dataproductos[] = new StdClass();
    $dataimg[] = new StdClass();
    $datadesc[] = new StdClass();
    $data->descripciones=null;
    $data->urlimg=null;
    $i=0;
    $j=0;
    $index=0;
    $bandera=true;
    global $conn;
    $sql="SELECT * FROM lista_productos";
    $query =  mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0){
        while($row = mysqli_fetch_array($query)){
            if($bandera){
                $bandera=false;
                $data->id=$row['id_producto'];
                $data->nombre_producto=$row['nombre_producto'];
                $data->stock=$row['stock'];
                $data->precio=$row['precio'];
                $data->estatus=true;
            }
            
            if($row["totaldescripcion"]>$i && !(empty($row["totaldescripcion"]))){
                $temp = new StdClass();
                $temp->peso=$row["peso"];
                $temp->tipo=$row["tipo"];
                $temp->dimencion=$row["dimencion"];
                $temp->descripcionproducto=$row["descripcionproducto"];
                $datadesc[$i]=$temp;
                $i++;
            }else{
                $i=0;
                $data->descripciones=$datadesc;
            }
            if($row["totalimg"]>$j && !(empty($row["totalimg"]))){
                $temp = new StdClass();
                $temp->url_imagen=$row["url_imagen"];
                $temp->descripcionimagen=$row["descripcionimagen"];
                $dataimg[$j]=$temp;
                $j++;
            }else{
                $j=0;
                $data->descripcionesimg=$dataimg;
            }
            $index++;
            
            if(max($row["totaldescripcion"],$row["totalimg"])==max($i,$j)){
                $bandera=true;
                $dataproductos[$index] = $data;
                $data = new StdClass();
                $index=0;
            }
        };
        return json_encode($dataproductos);
    }else{
        $data->mensaje="No hay productos.";
        $data->estatus=false;
        return json_encode($data);
    }
}

function get_producto($id){
    //elementos compartidos funcion busqueda de productos
    $data = new StdClass();
    $dataimg[] = new StdClass();
    $datadesc[] = new StdClass();
    $data->descripciones=null;
    $data->urlimg=null;
    $i=0;
    $j=0;
    $bandera=true;
    $sql="SELECT * FROM lista_productos where id_producto=$id";
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
                $data->estatus=true;
            }
            if(max($row["totaldescripcion"],$row["totalimg"])==max($i,$j)){
                $bandera=true;
            }
            if($row["totaldescripcion"]>$i && !(empty($row["totaldescripcion"]))){
                $temp = new StdClass();
                $temp->peso=$row["peso"];
                $temp->tipo=$row["tipo"];
                $temp->dimencion=$row["dimencion"];
                $temp->descripcionproducto=$row["descripcionproducto"];
                $datadesc[$i]=$temp;
                $i++;
            }else{
                $i=0;
                $data->descripciones=$datadesc;
            }
            if($row["totalimg"]>$j && !(empty($row["totalimg"]))){
                $temp = new StdClass();
                $temp->url_imagen=$row["url_imagen"];
                $temp->descripcionimagen=$row["descripcionimagen"];
                $dataimg[$j]=$temp;
                $j++;
            }else{
                $j=0;
                $data->descripcionesimg=$dataimg;
            }
        }
    }else{
        $data->mensaje="No hay productos.";
        $data->estatus=false;
    }
    return json_encode($data);
}