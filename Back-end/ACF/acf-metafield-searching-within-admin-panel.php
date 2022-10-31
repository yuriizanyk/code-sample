<?php

/*
* Allow users to search for custom field within admin panel search field
*/

function custom_search_join ($join){

    global $pagenow, $wpdb;

    if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type'] == 'property' && isset( $_GET['s'] ) ) {    
        $join .='LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;

}
add_filter('posts_join', 'custom_search_join' );


function custom_search_where( $where ){

    global $pagenow, $wpdb;

    if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type'] == 'property' && isset( $_GET['s'] ) ) {
        $where = preg_replace( "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value = '".$_GET['s']."')", $where );
    }
    return $where;

}
add_filter( 'posts_where', 'custom_search_where' );



// !!! Not sure if this is needed
// function custom_search_distinct( $where ){
//     global $pagenow, $wpdb;
//     $types = ['property'];
//     if ( is_admin() && $pagenow=='edit.php' && in_array( $_GET['post_type'], $types ) && isset( $_GET['s'] ) ) {
//     return "DISTINCT";

//     }
//     return $where;
// }
// add_filter( 'posts_distinct', 'custom_search_distinct' );
