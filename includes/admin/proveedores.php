<?php
//Envía el mensaje SMS
function all_bulk_sms_envia_sms( $configuracion, $telefono, $mensaje ) {

$respuesta = wp_remote_get("http://tsms.allbulksms.in/sendsms.aspx?senderid=".$configuracion['identificador_allbulksms']."&mobile=".$configuracion['usuario_allbulksms']."&pass=".$configuracion['contrasena_allbulksms']."&to=".$telefono."&msg=".all_bulk_sms_codifica_el_mensaje($mensaje));
		  

	if ( isset( $configuracion['debug'] ) && $configuracion['debug'] == "1" && isset( $configuracion['campo_debug'] ) ) {
		$correo	= __( 'Mobile number:', 'abs_sms' ) . "\r\n" . $telefono . "\r\n\r\n";
		$correo	.= __( 'Message: ', 'abs_sms' ) . "\r\n" . $mensaje . "\r\n\r\n"; 
		$correo	.= __( 'Gateway answer: ', 'abs_sms' ) . "\r\n" . print_r($respuesta, true );
		wp_mail( $configuracion['campo_debug'], 'WooCommerce - All Bulk Sms Notifications', $correo, 'charset=UTF-8' . "\r\n" ); 
	}
}
function all_bulk_sms_prefijo( $servicio ) {
	$prefijo = array( 
			"allbulksms", 
		);
	
	return in_array( $servicio, $prefijo );
}
?>