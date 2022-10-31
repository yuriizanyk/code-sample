



<?php
/*
* =========================================
* 	PHP FILE
* =========================================
*/
?>
<form action="#" id="wcl-submit-form">

    <!-- Google reCaptcha       !!! CHECK THIS !!!      -->
    <!-- <input type="hidden" name="recaptcha_response" id="recaptcha_response"> -->

    <!-- WP nonce field for security -->
    <?php wp_nonce_field( 'wcl_submit_form', 'wcl_submit_form_wpnonce' ); ?>

</form>









<?php
/*
* =========================================
* 	JS FILE
* =========================================
*/
?>
<script>

    let load_posts_button = document.querySelector('#wcl-submit-form');
    load_posts_button.addEventListener('submit', (e) => {

        e.preventDefault();

        // Check if grecaptcha is not equal to "undefined"
        if (grecaptcha === undefined) {
            alert('Recaptcha not defined');
            return;
        }


        grecaptcha.ready(function () {
            grecaptcha.execute(window.GOOGLE_CAPTCHA_SITE_KEY, { action: 'ajax_submit_form' }).then(function (token) { // ajax_submit_form = custom value that is used on functions.php

                // Set token value in the front-end         !!! Check this !!!
                // let recaptcha_response = document.querySelector('#recaptcha_response');
                // recaptcha_response.value = token;

                // Get WP Nonce field
                var wcl_submit_form_wpnonce = document.querySelector('#wcl_submit_form_wpnonce').value;



                /* 
                * AJAX
                */
                const httpRequest = new XMLHttpRequest(); 

                if (!httpRequest) {
                    alert('Giving up :( Cannot create an XMLHTTP instance');
                    return false;
                }

                httpRequest.open('POST', '/wp-admin/admin-ajax.php');
                httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                httpRequest.onload = () => {

                    if (httpRequest.status >= 200 && httpRequest.status < 300) {

                        // SUCCESS
                        alert('success');

                    } else {

                        // FAIL
                        alert('error');

                    }

                    // Remove "loading" class
                    element.classList.remove('loading');

                };

                httpRequest.onerror = function () {

                    // Connection error
                    alert('error');

                };

                
                httpRequest.send('action=ajax_submit_form&token=' + token + '&wcl_submit_form_wpnonce=' + wcl_submit_form_wpnonce);


            });
        });


    });

</script>









<?php 

/*
* =========================================
* 	FUNCTIONS (AJAX FUNCTION)
* =========================================
*/
add_action('wp_ajax_nopriv_ajax_submit_form', 'ajax_submit_form');
add_action('wp_ajax_ajax_submit_form', 'ajax_submit_form');

function ajax_submit_form() {


    // Check nonce field value for security
	if (isset($_REQUEST['wcl_submit_form_wpnonce']) && wp_verify_nonce($_REQUEST['wcl_submit_form_wpnonce'], 'wcl_submit_form')) {


        // Build POST request to get the reCAPTCHA v3 score from Google
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = GOOGLE_CAPTCHA_SECRET_KEY;
		$recaptcha_response = sanitize_text_field($_REQUEST['token']);


		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);


		if ($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == 'ajax_submit_form') {


            /*
			* Captacha validated successfully
			*/

            // !!! YOUR CUSTOM FUNCTIONALITY GOES HERE


        }else {


            echo 'error'; // Captcha validation failed

        }


    }else {

        echo 'error'; // WP nonce field value is not correct

    }


    wp_die()

}