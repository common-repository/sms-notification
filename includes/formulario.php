<?php global $configuracion, $abs_sms, $wpml_activo; ?>

<div class="wrap woocommerce">
  <h2>
    <?php _e( 'All Bulk Sms Notifications Options.', 'abs_sms' ); ?>
  </h2>
  <?php 
	settings_errors(); 
	$tab = 1;
	//Traducciones ocultas    
	__( 'account Sid', 'abs_sms' );
	__( 'Account Sid:', 'abs_sms' );
	__( 'authentication Token', 'abs_sms' );
	__( 'Authentication Token:', 'abs_sms' );
	__( 'key', 'abs_sms' );
	__( 'Key:', 'abs_sms' );
	__( 'authentication key', 'abs_sms' );
	__( 'Authentication key:', 'abs_sms' );
	__( 'sender ID', 'abs_sms' );
	__( 'Sender ID:', 'abs_sms' );
	__( 'route', 'abs_sms' );
	__( 'Route:', 'abs_sms' );
	__( 'sender ID', 'abs_sms' );
	__( 'Sender ID:', 'abs_sms' );
	__( 'login mobile number', 'abs_sms' );
	__( 'Login Mobile Number:', 'abs_sms' );
	__( 'password', 'abs_sms' );
	__( 'Password:', 'abs_sms' );
	__( 'mobile number', 'abs_sms' );
	__( 'Mobile number:', 'abs_sms' );
	__( 'client', 'abs_sms' );
	__( 'Client:', 'abs_sms' );
	__( 'authentication ID', 'abs_sms' );
	__( 'Authentication ID:', 'abs_sms' );
	__( 'project', 'abs_sms' );
	__( 'Project:', 'abs_sms' );
	
	//WPML
	if ( function_exists( 'icl_register_string' ) || !$wpml_activo ) { //Versión anterior a la 3.2
		$mensaje_pedido		= ( $wpml_activo ) ? icl_translate( 'abs_sms', 'mensaje_pedido', $configuracion['mensaje_pedido'] ) : $configuracion['mensaje_pedido'];
		$mensaje_recibido	= ( $wpml_activo ) ? icl_translate( 'abs_sms', 'mensaje_recibido', $configuracion['mensaje_recibido'] ) : $configuracion['mensaje_recibido'];
		$mensaje_procesando	= ( $wpml_activo ) ? icl_translate( 'abs_sms', 'mensaje_procesando', $configuracion['mensaje_procesando'] ) : $configuracion['mensaje_procesando'];
		$mensaje_completado	= ( $wpml_activo ) ? icl_translate( 'abs_sms', 'mensaje_completado', $configuracion['mensaje_completado'] ) : $configuracion['mensaje_completado'];
		$mensaje_nota		= ( $wpml_activo ) ? icl_translate( 'abs_sms', 'mensaje_nota', $configuracion['mensaje_nota'] ) : $configuracion['mensaje_nota'];
	} else if ( $wpml_activo ) { //Versión 3.2 o superior
		$mensaje_pedido		= apply_filters( 'wpml_translate_single_string', $configuracion['mensaje_pedido'], 'abs_sms', 'mensaje_pedido' );
		$mensaje_recibido	= apply_filters( 'wpml_translate_single_string', $configuracion['mensaje_recibido'], 'abs_sms', 'mensaje_recibido' );
		$mensaje_procesando	= apply_filters( 'wpml_translate_single_string', $configuracion['mensaje_procesando'], 'abs_sms', 'mensaje_procesando' );
		$mensaje_completado	= apply_filters( 'wpml_translate_single_string', $configuracion['mensaje_completado'], 'abs_sms', 'mensaje_completado' );
		$mensaje_nota		= apply_filters( 'wpml_translate_single_string', $configuracion['mensaje_nota'], 'abs_sms', 'mensaje_nota' );
	}
  ?>
  <h3><a href="<?php echo $abs_sms['plugin_url']; ?>" title="Bulk Sms Ahmedabad"><?php echo $abs_sms['plugin']; ?></a></h3>
  <p>
    <?php _e( 'Add to WooCommerce the possibility to send <abbr title="Short Message Service" lang="en">SMS</abbr> notifications to the client each time you change the order status. Notifies the owner, if desired, when the store has a new order. You can also send customer notes.', 'abs_sms' ); ?>
  </p>
  <?php include( 'cuadro-informacion.php' ); ?>
  <form method="post" action="options.php">
    <?php settings_fields( 'all_bulk_sms_settings_group' ); ?>
    <div class="cabecera"> <a href="<?php echo $abs_sms['plugin_url']; ?>" title="<?php echo $abs_sms['plugin']; ?>" target="_blank"><img src="<?php echo plugins_url( '../assets/images/cabecera.jpg', __FILE__ ); ?>" class="imagen" alt="<?php echo $abs_sms['plugin']; ?>" /></a>
    
    <h3>Note : Before Use Sms Please Create SMS Template and Approve in allbulksms.in </h3>
   <h3>Call : 09106703632</h3> 
     </div>
    <table class="form-table apg-table">
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[servicio]">
            <?php _e( '<abbr title="Short Message Service" lang="en">SMS</abbr> gateway:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Select your SMS gateway', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><select class="wc-enhanced-select servicio" id="all_bulk_sms_settings[servicio]" name="all_bulk_sms_settings[servicio]" style="width: 450px;" tabindex="<?php echo $tab++; ?>">
            <?php
			$proveedores = array( 
	
				"allbulksms" 		=> "Allbulksms", 
				
				
			);
			asort( $proveedores, SORT_NATURAL | SORT_FLAG_CASE ); //Ordena alfabeticamente los proveedores
            foreach ( $proveedores as $valor => $proveedor ) {
				$chequea = ( isset( $configuracion['servicio'] ) && $configuracion['servicio'] == $valor ) ? ' selected="selected"' : '';
				echo '<option value="' . $valor . '"' . $chequea . '>' . $proveedor . '</option>' . PHP_EOL;
            }
            ?>
          </select></td>
      </tr>
      <?php             
		$proveedores_campos = array( 		
			"allbulksms" 		=> array( 
				"identificador_allbulksms" 			=> 'sender ID',
				"usuario_allbulksms" 				=> 'username',
				"contrasena_allbulksms" 			=> 'password',
			),
		);
	  
		//Pinta los campos de los proveedores
		foreach ( $proveedores as $valor => $proveedor ) {
			foreach ( $proveedores_campos[$valor] as $valor_campo => $campo ) {
				if ( $valor_campo == "ruta_msg91" ) {
					echo '
      <tr valign="top" class="' . $valor . '"><!-- ' . $proveedor . ' -->
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[' . $valor_campo . ']">' . __( ucfirst( $campo ) . ":", "abs_sms" ) . '</label>
          <span class="woocommerce-help-tip" data-tip="' . sprintf( __( "The %s for your account in %s", "abs_sms" ), __( $campo, "abs_sms" ), $proveedor ) . '" src="' . plugins_url(  "woocommerce/assets/images/help.png" ) . '" height="16" width="16" /> </th>
        <td class="forminp forminp-number"><select id="all_bulk_sms_settings[' . $valor_campo . ']" name="all_bulk_sms_settings[' . $valor_campo . ']" tabindex="' . $tab++ . '">
					';
					$opciones = array( "default" => __( "Default", "abs_sms" ), 1 => 1, 4 => 4 );
					foreach ( $opciones as $valor => $opcion ) {
						$chequea = ( isset( $configuracion['ruta_msg91'] ) && $configuracion['ruta_msg91'] == $valor ) ? ' selected="selected"' : '';
				  		echo '<option value="' . $valor . '"' . $chequea . '>' . $opcion . '</option>' . PHP_EOL;
					}
					echo '          </select></td>
      </tr>
					';
				} else {
					echo '
      <tr valign="top" class="' . $valor . '"><!-- ' . $proveedor . ' -->
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[' . $valor_campo . ']">' . __( ucfirst( $campo ) . ":", "abs_sms" ) . '</label>
          <span class="woocommerce-help-tip" data-tip="' . sprintf( __( "The %s for your account in %s", "abs_sms" ), __( $campo, "abs_sms" ), $proveedor ) . '" src="' . plugins_url(  "woocommerce/assets/images/help.png" ) . '" height="16" width="16" /> </th>
        <td class="forminp forminp-number"><input type="text" id="all_bulk_sms_settings[' . $valor_campo . ']" name="all_bulk_sms_settings[' . $valor_campo . ']" size="50" value="' . ( isset( $configuracion[$valor_campo] ) ? $configuracion[$valor_campo] : '' ) . '" tabindex="' . $tab++ . '" /></td>
      </tr>
					';
				}
			}
		}
      ?>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[telefono]">
            <?php _e( 'Your mobile number:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'The mobile number registered in your SMS gateway account and where you receive the SMS messages', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input type="text" id="all_bulk_sms_settings[telefono]" name="all_bulk_sms_settings[telefono]" size="50" value="<?php echo ( isset( $configuracion['telefono'] ) ? $configuracion['telefono'] : '' ); ?>" tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[notificacion]">
            <?php _e( 'New order notification:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( "Check if you want to receive a SMS message when there's a new order", 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input id="all_bulk_sms_settings[notificacion]" name="all_bulk_sms_settings[notificacion]" type="checkbox" value="1" <?php echo ( isset( $configuracion['notificacion'] ) && $configuracion['notificacion'] == "1" ? 'checked="checked"' : '' ); ?> tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr  style="display: none;" valign="top">
        <th style="display: none" scope="row" class="titledesc"> <label for="all_bulk_sms_settings[internacional]">
            <?php _e( 'Send international <abbr title="Short Message Service" lang="en">SMS</abbr>?:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Check if you want to send international SMS messages', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input id="all_bulk_sms_settings[internacional]" name="all_bulk_sms_settings[internacional]" type="checkbox" value="1" <?php echo ( isset( $configuracion['internacional'] ) && $configuracion['internacional'] == "1" ? 'checked="checked"' : '' ); ?> tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[envio]">
            <?php _e( 'Send <abbr title="Short Message Service" lang="en">SMS</abbr> to shipping mobile?:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Check if you want to send SMS messages to shipping mobile numbers, only if it is different from billing mobile number', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input id="all_bulk_sms_settings[envio]" name="all_bulk_sms_settings[envio]" type="checkbox" class="envio" value="1" <?php echo ( isset( $configuracion['envio'] ) && $configuracion['envio'] == "1" ? 'checked="checked"' : '' ); ?> tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr valign="top" class="campo_envio">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[campo_envio]">
            <?php _e( 'Shipping mobile field:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Select the shipping mobile field', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><select id="all_bulk_sms_settings[campo_envio]" name="all_bulk_sms_settings[campo_envio]" class="wc-enhanced-select" tabindex="<?php echo $tab++; ?>">
        <?php
			$pais	= new WC_Countries();
			$campos	= $pais->get_address_fields( $pais->get_base_country(), 'shipping_' ); //Campos ordinarios
			$campos_personalizados = apply_filters( 'woocommerce_checkout_fields', array() );
			if ( isset( $campos_personalizados['shipping'] ) ) {
				$campos += $campos_personalizados['shipping'];
			}
            foreach ( $campos as $valor => $campo ) {
				$chequea = ( isset( $configuracion['campo_envio'] ) && $configuracion['campo_envio'] == $valor ) ? ' selected="selected"' : '';
				if ( isset( $campo['label'] ) ) {
					echo '<option value="' . $valor . '"' . $chequea . '>' . $campo['label'] . '</option>' . PHP_EOL;
				}
            }
		?>
        </select></td>
      </tr>
      <?php if ( class_exists( 'WC_SA' ) || function_exists( 'AppZab_woo_advance_order_status_init' ) || isset( $GLOBALS['advorder_lite_orderstatus'] ) ) : //Comprueba la existencia de los plugins de estado personalizado ?>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[estados_personalizados]">
            <?php _e( 'Custom Order Statuses & Actions:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Select your own statuses.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><select multiple="multiple" class="multiselect chosen_select estados_personalizados" id="all_bulk_sms_settings[estados_personalizados]" name="all_bulk_sms_settings[estados_personalizados][]" style="width: 450px;" tabindex="<?php echo $tab++; ?>">
            <?php
				if ( class_exists( 'WC_SA' ) ) { //WooCommerce Order Status & Actions Manager
					$lista_de_estados_temporal = array();
					$lista_de_estados = wc_sa_get_statuses();
					foreach ( $lista_de_estados as $clave => $estado ) {
						if ( $estado->label ) {
							$estados_personalizados = new WC_SA_Status( $clave );
							if ( $estados_personalizados->email_notification ) {
								$chequea = '';
								if ( $configuracion['estados_personalizados'] ) {
									foreach ( $configuracion['estados_personalizados'] as $estado_personalizado ) {
										if ( $estado_personalizado == $estado->label ) {
											$chequea = ' selected="selected"';
										}
									}
								}
								echo '<option value="' . $estado->label . '"' . $chequea . '>' . ucfirst( $estado->label ) . '</option>' . PHP_EOL;
							}
							$lista_de_estados_temporal[$clave] = $estado->label;
						}
					}
					$lista_de_estados = $lista_de_estados_temporal;
				} else {
					$estados_originales = array( 
						'pending',
						'failed',
						'on-hold',
						'processing',
						'completed',
						'refunded',
						'cancelled',
					);
					if ( isset( $GLOBALS['advorder_lite_orderstatus'] ) ) { //WooCommerce Advance Order Status
						$lista_de_estados = ( array ) $GLOBALS['advorder_lite_orderstatus']->get_terms( 'shop_order_status', array( 
							'hide_empty' => 0, 
							'orderby' => 'id' 
						) );
					} else {
						$lista_de_estados = ( array ) get_terms( 'shop_order_status', array( 
							'hide_empty' => 0, 
							'orderby' => 'id' 
						) );
					}
					$lista_nueva = array();
					foreach( $lista_de_estados as $estado ) {
						$estado_nombre = str_replace( "wc-", "", $estado->slug );
						if ( !in_array( $estado_nombre, $estados_originales ) ) {
							$muestra_estado = false;
							$estados_personalizados = get_option( 'taxonomy_' . $estado->term_id, false );
							if ( $estados_personalizados && ( isset( $estados_personalizados['woocommerce_woo_advance_order_status_email'] ) ) && (  '1' == $estados_personalizados['woocommerce_woo_advance_order_status_email'] || 'yes' == $estados_personalizados['woocommerce_woo_advance_order_status_email'] ) ) {
								$muestra_estado = true;
							}
							if ( get_option( 'az_custom_order_status_meta_' . $estado->slug, true ) ) { //WooCommerce Advance Order Status
								$estados_personalizados = get_option( 'az_custom_order_status_meta_' . $estado->slug, true );
								if ( $estados_personalizados ) { //Ya no hay que controlar si se notifica por correo electrónico o no
									$muestra_estado = true;
								}
							}
							if ( $muestra_estado ) {
								$chequea = '';
								if ( isset( $configuracion['estados_personalizados'] ) ) {
									foreach ( $configuracion['estados_personalizados'] as $estado_personalizado ) {
										if ( $estado_personalizado == $estado_nombre ) {
											$chequea = ' selected="selected"';
										}
									}
								}
								echo '<option value="' . $estado_nombre . '"' . $chequea . '>' . $estado->name . '</option>' . PHP_EOL;
								$lista_nueva[] = $estado_nombre;
							}
						}
					}
					$lista_de_estados = $lista_nueva;
				}
            ?>
          </select></td>
      </tr>
      <?php foreach ( $lista_de_estados as $estados_personalizados ) : ?>
      <tr valign="top" class="<?php echo $estados_personalizados; ?>"><!-- <?php echo ucfirst( $estados_personalizados ); ?> -->
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[<?php echo $estados_personalizados; ?>]"> <?php echo sprintf( __( '%s state custom message:', 'abs_sms' ), ucfirst( $estados_personalizados ) ); ?> </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[<?php echo $estados_personalizados; ?>]" name="all_bulk_sms_settings[<?php echo $estados_personalizados; ?>]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $configuracion[$estados_personalizados] ) ? $configuracion[$estados_personalizados] : "" ); ?></textarea></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
      <tr valign="top" style="display: none;">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[variables]">
            <?php _e( 'Custom variables:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can add your own variables. Each variable must be entered onto a new line without percentage character ( % ). Example: <code>_custom_variable_name</code><br /><code>_another_variable_name</code>.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[variables]" name="all_bulk_sms_settings[variables]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $configuracion['variables'] ) ? $configuracion['variables'] : '' ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[mensaje_pedido]">
            <?php _e( 'Owner custom message:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[mensaje_pedido]" name="all_bulk_sms_settings[mensaje_pedido]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $mensaje_pedido ) ? $mensaje_pedido : sprintf( __( "Order No. %s received on ", 'abs_sms' ), "%id%" ) . "%shop_name%" . "." ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[mensaje_recibido]">
            <?php _e( 'Order received custom message:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[mensaje_recibido]" name="all_bulk_sms_settings[mensaje_recibido]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $mensaje_recibido ) ? $mensaje_recibido : sprintf( __( 'Your order No. %s is received on %s. Thank you for shopping with us!', 'abs_sms' ), "%id%", "%shop_name%" ) ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[mensaje_procesando]">
            <?php _e( 'Order processing custom message:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[mensaje_procesando]" name="all_bulk_sms_settings[mensaje_procesando]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $mensaje_procesando ) ? $mensaje_procesando : sprintf( __( 'Thank you for shopping with us! Your order No. %s is now: ', 'abs_sms' ), "%id%" ) . __( 'Processing', 'abs_sms' ) . "." ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[mensaje_completado]">
            <?php _e( 'Order completed custom message:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[mensaje_completado]" name="all_bulk_sms_settings[mensaje_completado]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $mensaje_completado ) ? $mensaje_completado : sprintf( __( 'Thank you for shopping with us! Your order No. %s is now: ', 'abs_sms' ), "%id%" ) . __( 'Completed', 'abs_sms' ) . "." ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[mensaje_nota]">
            <?php _e( 'Notes custom message:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'You can customize your message. Remember that you can use this variables: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><textarea id="all_bulk_sms_settings[mensaje_nota]" name="all_bulk_sms_settings[mensaje_nota]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $mensaje_nota ) ? $mensaje_nota : sprintf( __( 'A note has just been added to your order No. %s: ', 'abs_sms' ), "%id%" ) . "%note%" ); ?></textarea></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[debug]">
            <?php _e( 'Send debug information?:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Check if you want to receive debug information from your SMS gateway', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input id="all_bulk_sms_settings[debug]" name="all_bulk_sms_settings[debug]" type="checkbox" class="debug" value="1" <?php echo ( isset( $configuracion['debug'] ) && $configuracion['debug'] == "1" ? 'checked="checked"' : '' ); ?> tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr valign="top" class="campo_debug">
        <th scope="row" class="titledesc"> <label for="all_bulk_sms_settings[campo_debug]">
            <?php _e( 'email address:', 'abs_sms' ); ?>
          </label>
          <span class="woocommerce-help-tip" data-tip="<?php _e( 'Add an email address where you want to receive the debug information', 'abs_sms' ); ?>"></span> </th>
        <td class="forminp forminp-number"><input type="text" id="all_bulk_sms_settings[campo_debug]" name="all_bulk_sms_settings[campo_debug]" size="50" value="<?php echo ( isset( $configuracion['campo_debug'] ) ? $configuracion['campo_debug'] : '' ); ?>" tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
    </table>
    <p class="submit">
      <input class="button-primary" type="submit" value="<?php _e( 'Save Changes', 'abs_sms' ); ?>"  name="submit" id="submit" tabindex="<?php echo $tab++; ?>" />
    </p>
  </form>
</div>
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
	//Cambia los campos en función del proveedor de servicios SMS
	$( '.servicio' ).on( 'change', function () { 
		control( $( this ).val() ); 
	} );
	var control = function( capa ) {
		if ( capa == '' ) {
			capa = $( '.servicio option:selected' ).val();
		}
		var proveedores= new Array();
		<?php 
		foreach( $proveedores as $indice => $valor ) {
			echo "proveedores['$indice'] = '$valor';" . PHP_EOL;
		}
		?>
		
		for ( var valor in proveedores ) {
    		if ( valor == capa ) {
				$( '.' + capa ).show();
			} else {
				$( '.' + valor ).hide();
			}
		}
	};
	control( $( '.servicio' ).val() );

	if ( typeof chosen !== 'undefined' && $.isFunction( chosen ) ) {
		jQuery( "select.chosen_select" ).chosen();
	}
	
	//Controla el campo de teléfono del formulario de envío
	$( '.campo_envio' ).hide();
	$( '.envio' ).on( 'change', function () { 
		control_envio( '.envio' ); 
	} );
	var control_envio = function( capa ) {
		if ( $( capa ).is(':checked') ){
			$( '.campo_envio' ).show();
		} else {
			$( '.campo_envio' ).hide();
		}
	};
	control_envio( '.envio' ); 
	
	//Controla el campo de correo electrónico del formulario de envío
	$( '.campo_debug' ).hide();
	$( '.debug' ).on( 'change', function () { 
		control_debug( '.debug' ); 
	} );
	var control_debug = function( capa ) {
		if ( $( capa ).is(':checked') ){
			$( '.campo_debug' ).show();
		} else {
			$( '.campo_debug' ).hide();
		}
	};
	control_debug( '.debug' ); 
	
<?php if ( class_exists( 'WC_SA' ) || function_exists( 'AppZab_woo_advance_order_status_init' ) || isset( $GLOBALS['advorder_lite_orderstatus'] ) ) : //Comprueba la existencia de los plugins de estado personalizado ?>	
	$( '.estados_personalizados' ).on( 'change', function () { 
		control_personalizados( $( this ).val() ); 
	} );
	var control_personalizados = function( capa ) {
		var estados= new Array();
		<?php 
		foreach( $lista_de_estados as $valor ) {
			echo "estados['$valor'] = '$valor';" . PHP_EOL; 
		}
		?>

		for ( var valor in estados ) {
			$( '.' + valor ).hide();
			for ( var valor_capa in capa ) {
				if ( valor == capa[valor_capa] ) {
					$( '.' + valor ).show();
				}
			}
		}
	};

	$( '.estados_personalizados' ).each( function( i, selected ) { 
	  control_personalizados( $( selected ).val() );
	} );
<?php endif; ?>	
} );
</script> 
