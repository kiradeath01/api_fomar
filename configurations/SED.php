<?php
	class SED {
	    
		public function encrypt_decrypt($action, $string) {
			$output = false;
			$encrypt_method = "AES-256-CBC";
			$secret_key = 'cocuyodev@support.com';
			$secret_iv = 'mikrotwisp';
			// hash
			$key = hash('sha256', $secret_key);

			// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
			$iv = substr(hash('sha256', $secret_iv), 0, 16);
			if ( $action == 'encrypt' ) {
			    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			    $output = base64_encode($output);
			} else if( $action == 'decrypt' ) {
			    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			}
			return $output;
		}
	}
	//echo SED::encrypt_decrypt('encrypt','admin1');
?>