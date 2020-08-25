<?php
/**
 * @package WordPress
 * @subpackage Covid19 Tracker
 * @since Covid19 Tracker 1.0
 */
?>


<?php 

function covid19_tracker_scripts() {

    wp_enqueue_style( 'main_style', get_template_directory_uri() . '/assets/css/main.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . 'style.css' );
    wp_enqueue_style( 'datatable', '//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' );
    
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
    wp_enqueue_script('dataTables', '//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
}
add_action( 'wp_enqueue_scripts', 'covid19_tracker_scripts' );