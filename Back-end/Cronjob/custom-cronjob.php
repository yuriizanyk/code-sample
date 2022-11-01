<?php


/*
* Add Custom Cronjob Schedule (how ofter you need to run the cronjob)
*/

function wcl_add_cron_interval( $schedules ) {

    if( !isset($schedules['wcl_every_30_min']) ){
        $schedules['wcl_every_30_min'] = array(
            'interval' => 1800, // 60 * 30, // 30 min
            'display'  => __( 'Every 30 min' )
        );
    }
    return $schedules;

}

add_filter( 'cron_schedules', 'wcl_add_cron_interval' );







/*
* Schedule event (custom cronjob function within created schedule) 
*/
if ( ! wp_next_scheduled( 'wcl_function_cronjob' ) ) {
    wp_schedule_event( time(), 'wcl_every_30_min', 'wcl_function_cronjob' );
}







/*
* Cronjob Function
*/

function wcl_function_cronjob () {

    // Something happens here

}

add_action( 'wcl_function_cronjob', 'wcl_function_cronjob' );


