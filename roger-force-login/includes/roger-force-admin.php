<?php
#Registra no menu admin Em Configurações 
function roger_force_login_registra_plugin_menu() {
    add_options_page( 'Roger Força Login ', 'Roger Força Login', 'manage_options', 'roger-force-login-config-plugin', 'roger_force_login_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'roger_force_login_registra_plugin_menu' );
#pagina de configuração no admin
function roger_force_login_render_plugin_settings_page() {
    ?>
    <h2>ROGER FORCE LOGIN CONFIGURAÇÕES</h2>
    <hr>
    <form action="options.php" method="post">
        <?php 
       // carrega os campos
        settings_fields( 'roger_force_login_plugin_options' );
        do_settings_sections( 'roger_force_login_plugin_options' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Salvar' ); ?>" />
        <br><br><br>
    </form>
    <?php
}
#registra os campos do no options
function roger_force_login_registra_settings() {
    register_setting( 'roger_force_login_plugin_options', 'roger_force_login_plugin_options', 'roger_force_login_plugin_options_validate' );
    add_settings_section( 'section_form_settings', 'Redireciona para Login', 'roger_force_login_plugin_section_text', 'roger_force_login_plugin_options' );
    add_settings_field( 'roger_force_login_plugin_setting_field_url', 'Informe a URL', 'roger_force_login_plugin_setting_field_url', 'roger_force_login_plugin_options', 'section_form_settings' );
}
add_action( 'admin_init', 'roger_force_login_registra_settings' );
#Monta o texto para exibicao na sessao, este texto tem a explicacao de como congurar o plugin
function  roger_force_login_plugin_section_text() {
    $texto = '<p><b>(i)</b> Caso tenha uma página customizada de login podera informar a url</p>';
    $texto .= "<p><b>(ii)</b> Onde incluir o shortcode,se o usuário não estiver logado redireciona para o login </p>";
    $texto .= '<h3>Copie o shortecode [rogerforcelogin] e cole na página desejada</h3>';
    echo $texto;
    echo "<hr>";
}

#Campo que o usuario irá informar a url 
function roger_force_login_plugin_setting_field_url() {
    $options = get_option( 'roger_force_login_plugin_options' );
    //valor defaul pe a url login padao do wp
    if(empty($options['roger_force_login_url']) || trim($options['roger_force_login_url']) == ""){
        $options['roger_force_login_url'] = get_site_url(). "/wp-login.php";
    }
    echo "<input id='roger_stock_plugin_setting_url_login' name='roger_force_login_plugin_options[roger_force_login_url]' type='text' value='" . esc_attr( $options['roger_force_login_url'] ) . "' required />";
}



