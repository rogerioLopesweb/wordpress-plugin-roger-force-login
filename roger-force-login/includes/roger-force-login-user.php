<?php
add_shortcode( 'rogerforcelogin', 'func_rogerforcelogin' );
function func_rogerforcelogin() {
  //pega os cadastrado no admin em Configurações Roger Força Login
  $options = get_option('roger_force_login_plugin_options');
  $url = $options['roger_force_login_url'];
  if(empty($url) || trim($url) == ""){
    $url = get_site_url(). "/wp-login.php";
  }
  if ( ! is_user_logged_in() ) {
    echo '<script>window.location.href = "'.$url.'";</script>';
    exit();
  }
}