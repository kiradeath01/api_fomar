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

function cross($titulo,$mensaje,$destino,$cabecera='')
{
  // abrimos la sesión cURL
  $ch = curl_init();

  // definimos la URL a la que hacemos la petición
  curl_setopt($ch, CURLOPT_URL,"https://cocuyodev.com/sendjm/jmemail.php");
  // indicamos el tipo de petición: POST
  curl_setopt($ch, CURLOPT_POST, TRUE);
  // definimos cada uno de los parámetros
  curl_setopt($ch, CURLOPT_POSTFIELDS, "titulo=$titulo&mensaje=$mensaje&correo=$destino&cabecera=$cabecera");

  // recibimos la respuesta y la guardamos en una variable
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $remote_server_output = curl_exec ($ch);
  // cerramos la sesión cURL
  curl_close ($ch);
  return $remote_server_output;
}

function enviar_correo_cliente($obj){
    $nombre  = $obj->{"nombre"};
    $apellidos  = $obj->{"apellidos"};
    $estado  = $obj->{"estado"};
    $cp  = $obj->{"cp"};
    $direccion  = $obj->{"direccion"};
    $correo  = $obj->{"correo"};
    $fecha  = $obj->{"fecha"};
    $m = explode("$", $obj->{"monto"});
    $monto  = $m[1];
    $mensaje='<!DOCTYPE html>
    <html lang="es">
    <head>
    <title>Fomar | E-mail</title>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/9dabf27fee.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
    
        /* RESET STYLES */
        body{margin:0; padding:0;}
        img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
        table{border-collapse:collapse !important;}
        body{height:100% !important; margin:0; padding:0; width:100% !important;}
    
        /* iOS BLUE LINKS */
        .appleBody a {color:#68440a; text-decoration: none;}
        .appleFooter a {color:#999999; text-decoration: none;}
    
        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {
    
            /* ALLOWS FOR FLUID TABLES */
            table[class="wrapper"]{
              width:100% !important;
            }
    
            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            td[class="logo"]{
              text-align: left;
              padding: 20px 0 20px 0 !important;
            }
    
            td[class="logo"] img{
              margin:0 auto!important;
            }
    
            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            td[class="mobile-hide"]{
              display:none;}
    
            img[class="mobile-hide"]{
              display: none !important;
            }
    
            img[class="img-max"]{
              max-width: 100% !important;
              height:auto !important;
            }
    
            /* FULL-WIDTH TABLES */
            table[class="responsive-table"]{
              width:100%!important;
            }
    
            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            td[class="padding"]{
              padding: 10px 5% 15px 5% !important;
            }
    
            td[class="padding-copy"]{
              padding: 10px 5% 10px 5% !important;
              text-align: center;
            }
    
            td[class="padding-meta"]{
              padding: 30px 5% 0px 5% !important;
              text-align: center;
            }
    
            td[class="no-pad"]{
              padding: 0 0 20px 0 !important;
            }
    
            td[class="no-padding"]{
              padding: 0 !important;
            }
    
            td[class="section-padding"]{
              padding: 50px 15px 50px 15px !important;
            }
    
            td[class="section-padding-bottom-image"]{
              padding: 50px 15px 0 15px !important;
            }
    
            /* ADJUST BUTTONS ON MOBILE */
            td[class="mobile-wrapper"]{
                padding: 10px 5% 15px 5% !important;
            }
    
            table[class="mobile-button-container"]{
                margin:0 auto;
                width:100% !important;
            }
    
            a[class="mobile-button"]{
                width:80% !important;
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
            }
    
        }
    </style>
    </head>
    <body style="margin: 0; padding: 0;">
    
    <!-- HEADER -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff">
                <div align="center" style="padding: 0px 15px 0px 15px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="500" class="wrapper">
                        <!-- LOGO/PREHEADER TEXT -->
                        <tr>
                            <td style="padding: 20px 0px 30px 0px;" class="logo">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td bgcolor="#000000" width="100" align="left"><a href="fogonesmaria.com" target="_blank"><img alt="Logo" src="http://fomar.cocuyodev.com/img/LOGO.png" width="200" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;" border="0"></a></td>
                                        <td bgcolor="#ffffff" width="400" align="right" class="mobile-hide">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="right" style="padding: 0 0 5px 0; font-size: 20px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;"><span style="color: #666666; text-decoration: none;"><b>fogonesmaria.com</b><br>Fogones Fomar.</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    
    <!-- ONE COLUMN SECTION -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
                <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="text-align: center; font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">
                                        En breve se le avisara la fecha y hora de envío de su pedido.
                                    </td>
                                </tr>
                                <tr>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Nombre: '.$nombre.' '.$apellidos.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Dirección: '.$direccion.', '.$cp.', '.$estado.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Correo: '.$correo.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Monto: '.$monto.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Fecha: '.$fecha.'</td>
                                        </tr>
                                    </table>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- COPY -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Gracias por preferir fogonesmaria.com</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; width:100%; color: #666666;" class="padding-copy">Bienvenido a Fomar, plataforma única para la venta de fogones.</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666; width:100%;" class="padding-copy">Su pago se ha realizado exitosamente</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; width:100%; color: #666666;" class="padding-copy">Dudas y aclaraciones fogonesmaria@gmail.com.</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- BULLETPROOF BUTTON -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                            <tr>
                                                <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                                                    <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                                        <tr>
                                                            <td align="center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    
    <!-- FOOTER -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td style="padding: 20px 0px 20px 0px;">
                            <!-- UNSUBSCRIBE COPY -->
                            <table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
                                <tr>
                                    <td align="center" valign="middle" style="font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                                        <span class="appleFooter" style="color:#666666;">Cunduacán, Tabasco MX</span><br><a class="original-only" style="color: #666666; text-decoration: none;">Fomar</a><span class="original-only" style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">   |   </span><a style="color: #666666; text-decoration: none;">Fogones</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table
    </body>
    </html>';
    //echo $mensaje;
    $titulo='Confirmación de Compra '.$nombre;
    cross($titulo,$mensaje,$correo);
}
function enviar_correo_fomar($obj){
    $correo_eden="chesman021@gmail.com";
    $nombre  = $obj->{"nombre"};
    $apellidos  = $obj->{"apellidos"};
    $estado  = $obj->{"estado"};
    $cp  = $obj->{"cp"};
    $direccion  = $obj->{"direccion"};
    $correo  = $obj->{"correo"};
    $fecha  = $obj->{"fecha"};
    $m = explode("$", $obj->{"monto"});
    $monto  = $m[1];
    $productos=$obj->{"productos"};
    global $conn;
    $mensaje1='<!DOCTYPE html>
    <html lang="es">
    <head>
    <title>Fomar | E-mail</title>
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/9dabf27fee.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
    
        /* RESET STYLES */
        body{margin:0; padding:0;}
        img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
        table{border-collapse:collapse !important;}
        body{height:100% !important; margin:0; padding:0; width:100% !important;}
    
        /* iOS BLUE LINKS */
        .appleBody a {color:#68440a; text-decoration: none;}
        .appleFooter a {color:#999999; text-decoration: none;}
    
        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {
    
            /* ALLOWS FOR FLUID TABLES */
            table[class="wrapper"]{
              width:100% !important;
            }
    
            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            td[class="logo"]{
              text-align: left;
              padding: 20px 0 20px 0 !important;
            }
    
            td[class="logo"] img{
              margin:0 auto!important;
            }
    
            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            td[class="mobile-hide"]{
              display:none;}
    
            img[class="mobile-hide"]{
              display: none !important;
            }
    
            img[class="img-max"]{
              max-width: 100% !important;
              height:auto !important;
            }
    
            /* FULL-WIDTH TABLES */
            table[class="responsive-table"]{
              width:100%!important;
            }
    
            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            td[class="padding"]{
              padding: 10px 5% 15px 5% !important;
            }
    
            td[class="padding-copy"]{
              padding: 5px 5% 5px 5% !important;
              text-align: center;
            }
    
            td[class="padding-meta"]{
              padding: 30px 5% 0px 5% !important;
              text-align: center;
            }
    
            td[class="no-pad"]{
              padding: 0 0 20px 0 !important;
            }
    
            td[class="no-padding"]{
              padding: 0 !important;
            }
    
            td[class="section-padding"]{
              padding: 50px 15px 50px 15px !important;
            }
    
            td[class="section-padding-bottom-image"]{
              padding: 50px 15px 0 15px !important;
            }
    
            /* ADJUST BUTTONS ON MOBILE */
            td[class="mobile-wrapper"]{
                padding: 10px 5% 15px 5% !important;
            }
    
            table[class="mobile-button-container"]{
                margin:0 auto;
                width:100% !important;
            }
    
            a[class="mobile-button"]{
                width:80% !important;
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
            }
    
        }
    </style>
    </head>
    <body style="margin: 0; padding: 0;">
    
    <!-- HEADER -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff">
                <div align="center" style="padding: 0px 15px 0px 15px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="500" class="wrapper">
                        <!-- LOGO/PREHEADER TEXT -->
                        <tr>
                            <td style="padding: 20px 0px 30px 0px;" class="logo">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td bgcolor="#000000" width="100" align="left"><a href="fogonesmaria.com" target="_blank"><img alt="Logo" src="http://fomar.cocuyodev.com/img/LOGO.png" width="200" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;" border="0"></a></td>
                                        <td bgcolor="#ffffff" width="400" align="right" class="mobile-hide">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="right" style="padding: 0 0 5px 0; font-size: 20px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;"><span style="color: #666666; text-decoration: none;"><b>fogonesmaria.com</b><br>Fogones Fomar.</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    
    <!-- ONE COLUMN SECTION -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
                <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="text-align: center; font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">
                                        Orden de compra.
                                    </td>
                                </tr>
                                <tr>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Nombre: '.$nombre.' '.$apellidos.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Dirección: '.$direccion.', '.$cp.', '.$estado.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Correo: '.$correo.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Monto: '.$monto.'</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">Fecha: '.$fecha.'</td>
                                        </tr>
                                    </table>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy">
                                        Lista de productos:
                                    </td>
                                </tr>
                                ';
    foreach ($productos as &$valor) {
        $id_producto=$valor->{"key"};
        $cantidad_producto=$valor->{"cantidad"};
        $color=$valor->{"color"};
        $nombre_producto="";
        $bandera=true;
        $sql="SELECT * FROM cat_producto where id_producto=$id_producto";
        $query =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $nombre_producto=$row["nombre_producto"];
        $mensaje1.='<tr>
                        <td align="center" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; width:100%;" class="padding-copy"><p>Producto: '.$nombre_producto.'</p><p>Cantidad: '.$cantidad_producto.'</p><p>Color: '.$color.'</p></td>
                    </tr>';
        
    }
    $mensaje2='<tr>
    <td>
        <!-- BULLETPROOF BUTTON -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
            <tr>
                <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                    <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                        <tr>
                            <td align="center"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>


<!-- FOOTER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td bgcolor="#ffffff" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td style="padding: 20px 0px 20px 0px;">
<!-- UNSUBSCRIBE COPY -->
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
<tr>
    <td align="center" valign="middle" style="font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
        <span class="appleFooter" style="color:#666666;">Cunduacán, Tabasco MX</span><br><a class="original-only" style="color: #666666; text-decoration: none;">Fomar</a><span class="original-only" style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">   |   </span><a style="color: #666666; text-decoration: none;">Fogones</a>
    </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table
</body>
</html>';
    $mensaje=$mensaje1.$mensaje2;
    //echo $mensaje;
    $titulo='Confirmación de Compra '.$nombre;
    cross($titulo,$mensaje,$correo_eden);
}
?>