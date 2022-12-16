<?php
/*
Plugin Name: Malsonantes
Plugin URI:  http://link to your plugin homepage
Description: This plugin replaces words with your own choice of words.
Version:     1.2
Author:      4mbr0s10
Author URI:  http://link to your website

*/

function creacionInsercion(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sustituir=array('mierda','calvo','gordo','retrasado','hijo de la gran puta');
    $remplazo=array('heces','alopécico','hermoso','futbolista','tuitero');
    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'lista_malsonantes';
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        palabra text NOT NULL,
        reemplazo text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // libreria que necesito para usar la funcion dbDelta
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );


    $result = $wpdb->insert(
        $table_name,
        array(
            'palabra' => $sustituir,
        )
    );
    $result = $wpdb->insert(
        $table_name,
        array(
            'reemplazo' => $remplazo,
        )
    );

}
add_action('plugins_loaded','creacionInsercion');
function renym_wordpress_typo_fix( $text ){



    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    // recogemos el
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'lista_malsonantes';

    $resultado = $wpdb->get_results("SELECT palabra FROM " . $table_name, ARRAY_A);
    $resultado2 = $wpdb->get_results("SELECT reemplazo FROM " . $table_name, ARRAY_A);
    // insertamos valores
    $sustituir= array();
    $remplazo=array();


    foreach ($resultado as $row) {
        $sustituir[] = $row['palabra'];
    }
    foreach ($resultado2 as $row) {
        $remplazo[] = $row['reemplazo'];
    }
    return str_replace($sustituir,$remplazo, $text);




}add_filter( 'the_content', 'renym_wordpress_typo_fix' );
