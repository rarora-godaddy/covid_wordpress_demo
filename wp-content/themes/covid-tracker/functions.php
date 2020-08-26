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
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'datatable', '//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' );
    
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
    wp_enqueue_script('dataTables', '//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
}
add_action( 'wp_enqueue_scripts', 'covid19_tracker_scripts' );


/*
add_filter('query_vars', 'add_state_var', 0, 1);
function add_state_var($vars){
    $vars[] = 'country';
    return $vars;
}
*/

add_filter('query_vars', function( $vars ){
    $vars[] = 'pagename'; 
    $vars[] = 'country'; 
    return $vars;
});

/*
add_action( 'init', 'add_country_rules' );
function add_country_rules() {
    add_rewrite_rule('^country/([^/]*)/?','index.php?post_type=page&name=country&country=$matches[1]','top');
}
*/
add_action('init', function(){
    add_rewrite_rule( 
       '^country/([^/]+)([/]?)(.*)', 
       //!IMPORTANT! THIS MUST BE IN SINGLE QUOTES!:
       'index.php?pagename=country&country=$matches[1]', 
       'top'
    );   
 });
function custom_rewrite_tag() {
    add_rewrite_tag('%country%', '([^&]+)');
  }
  add_action('init', 'custom_rewrite_tag', 10, 0);