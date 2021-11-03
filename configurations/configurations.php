<?php
function generarCodigoNumerico($longitud) {
	$key = '';
	$pattern = '1234567890';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return $key;
}

function generarCodigoConfirmacion($longitud) {
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return $key;
}


function ValidarUrl($url) {

	if (filter_var($url, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	    // Petición HEAD
	    curl_setopt($ch, CURLOPT_HEADER, true);
	    curl_setopt($ch, CURLOPT_NOBODY, true);

	    $content = curl_exec($ch);

	    if (!curl_errno($ch)) {
	        $info = curl_getinfo($ch);

	        //print_r("\nSe recibió respuesta " . $info['http_code'] . ' en ' . $info['total_time'] . " segundos \n");
	        return true;
	    } else {
	        //print_r("\nError en petición: " . curl_error($ch) . "\n");
	        return false;
	    }

	    curl_close($ch);

	} else {
	    //print_r("\nDirección IP no válida: " . $url . "\n");
	    return false;
	}

}
?>