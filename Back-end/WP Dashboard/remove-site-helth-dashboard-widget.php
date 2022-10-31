<?php 

/*
* Remove Site Helth Dashboard Widget
*/

function wcl_remove_site_health_dashboard_widget() {
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

add_action('wp_dashboard_setup', 'wcl_remove_site_health_dashboard_widget');