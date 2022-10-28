<?php


/*
* Cookie Notice Message
*/


add_action( 'wp_footer', function() {


	if( $_COOKIE['zd_accept_cookie'] != 'accepted' ) {


		$cookie_notice_output = '
			<div id="zd-cookie-notice" role="banner" aria-label="Cookie Notice">

				<a href="#" class="data-close-icon js-accept-cookie" aria-label="Accept">×</a>

				<div class="data-text">We use cookies to improve your user experience and assess how you use our website. By continuing to browse you are agreeing to our use of cookies. You can get further information and find out our cookies policy <a href="/cookie-policy/" target="_blank">here</a>.<br>The information contained in this website is for general information purposes only. The information is provided by HousingSpain Portal S.L. and while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</div>

				<div class="zd-button-wrapper zd-button-orange">
					<a href="#" class="zd-button js-accept-cookie" aria-label="Accept">Accept</a>
				</div>

			</div>
		';
		

		echo $cookie_notice_output;

	}

});


?>







<script>

/*
* Accept cookie button click
*/
$(document).on('click', '.js-accept-cookie', function(e){

	e.preventDefault();
	$('#zd-cookie-notice').fadeOut();
	$.cookie('zd_accept_cookie', 'accepted', { expires : 365 });

});

</script>