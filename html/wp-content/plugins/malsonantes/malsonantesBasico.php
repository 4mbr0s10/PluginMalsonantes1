<?php
/*
Plugin Name: MalsonantesBasico
Plugin URI:  http://link to your plugin homepage
Description: This plugin replaces words with your own choice of words.
Version:     1.2
Author:      4mbr0s10
Author URI:  http://link to your website

*/
function renym_wordpress_typo_fix( $text ) {
    $sustituir=array('mierda','calvo','gordo','retrasado','hijo de la gran puta');
    $remplazo=array('heces','alopécico','hermoso','futbolista','tuitero');

    return str_replace( $sustituir, $remplazo, $text );
}
add_filter( 'the_content', 'renym_wordpress_typo_fix' );
