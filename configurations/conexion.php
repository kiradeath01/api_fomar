<?php
$servername = "localhost";
//*
$database = "u827933455_fomar";
$username = "u827933455_fomar";  
$password = "Abcxz109q";
/*/
$database = "fomar";
$username = "root";  
$password = "mysql";
//*/
$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
		    $data->status=false;
		    $data->estatus=false;
		    $data->mensaje="Error con la conexcion";
		    echo json_encode($data);
	}
	
mysqli_set_charset( $conn, 'utf8');

?>