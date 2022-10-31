<?php


/*
* Add Custom Cronjob Schedule (how ofter you need to run the cronjob)
*/

function zd_add_cron_interval( $schedules ) {

    if( !isset($schedules['zd_every_30_min']) ){
        $schedules['zd_every_30_min'] = array(
            'interval' => 30, // 60 * 30, // 30 min
            'display'  => __( 'Every 30 min' )
        );
    }
    return $schedules;

}

add_filter( 'cron_schedules', 'zd_add_cron_interval' );







/*
* Schedule event (custom cronjob function within created schedule) 
*/
if ( ! wp_next_scheduled( 'zd_parse_tweeter_data_cronjob' ) ) {
    wp_schedule_event( time(), 'zd_every_30_min', 'zd_parse_tweeter_data_cronjob' );
}







/*
* Cronjob Function
*/

function zd_parse_tweeter_data_cronjob () {

    // Something happens here

}

add_action( 'zd_parse_tweeter_data_cronjob', 'zd_parse_tweeter_data_cronjob' );


