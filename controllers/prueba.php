<?
require __DIR__ . '/../configurations/conexion.php'; 
require __DIR__ . '/../configurations/configurations.php';
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
            $temp->peso=$row["peso"];
            $temp->tipo=$row["tipo"];
            $temp->dimencion=$row["dimencion"];
            $temp->descripcionproducto=$row["descripcionproducto"];
            $datadesc[$i]=$temp;
            $i++;
        }

        if($row["totalimg"]>$j && !(empty($row["totalimg"]))){
            echo "entro con id: ".$row['id_producto']."<br>";
            echo "entro con urlimagen: ".$row['url_imagen']."<br>";
            $temp = new StdClass();
            $temp->url_imagen=$row["url_imagen"];
            $temp->descripcionimagen=$row["descripcionimagen"];
            $dataimg[$j]=$temp;
            $j++;
        }
        
        if(max($row["totaldescripcion"],$row["totalimg"])==max($i,$j)){
            //echo "reinicio con id: ".$row['id_producto']."<br>";
            $bandera=true;
            $data->descripcionesimg=$dataimg;
            $data->descripciones=$datadesc;
            $dataproductos[$k]=$data; 
            $data = new StdClass();
            $dataimg[] = new StdClass();
            $datadesc[] = new StdClass();
            $i=0;
            $j=0;
            $k++;
        }
    }
}else{
    $data->mensaje="No hay productos.";
    $data->estatus=false;
}
echo json_encode($dataproductos);
?>