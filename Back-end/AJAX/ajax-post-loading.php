
<?php 




/*
* =========================================
* 	PHP FILE
* =========================================
*/

$posts_per_page = get_option('posts_per_page');

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
);

$the_query = new WP_Query($args);


if ($the_query->have_posts()) {
    ?>

    <div class="wcl-blog-wrapper" data-cat="all" data-page="1">


        <!-- CATEGORIES -->
        <?php 

            $args = array(
                'post_type'             => 'post',
                'post_status'           => 'publish',
                'posts_per_page'        => -1,
                'orderby'               => 'name',
                'order'                 => 'ASC',
                'taxonomy'              => 'category',
            );

            $categories = get_categories($args);

        ?>

        <div class="wcl-blog-categories-wrapper">
            <a href="#" class="data-category-item active js-load-posts" data-cat="all">
                All
            </a>
            <?php foreach ($categories as $category) { ?>
                <a href="#" class="data-category-item js-load-posts" data-cat="<?php echo $category->slug; ?>">
                    <?php echo $category->name; ?>
                </a>
            <?php } ?>
        </div>


        <!-- POSTS -->
        <div class="wcl-blog-posts-wrapper">

            <?php 

                while ($the_query->have_posts()) { $the_query->the_post();
                    get_template_part('template-parts/post-content');
                }

             ?>

        </div>


        <!-- LOAD MORE BUTTON -->
        <?php 
            if ($the_query->max_num_pages <= 1) {
                $no_more_pages = true;
            }
        ?>
        <div class="wcl-link-wrapper wcl-load-more-button js-load-posts" style="display:<?php echo ( $no_more_pages ? 'none' : 'block' ); ?>">
            <a href="#" class="wcl-link">Load more</a>
        </div>


    </div> <!-- .wcl-blog-wrapper -->

    <?php
}else {

    echo '<h1>There are no posts</h1>';

}









/*
* =========================================
* 	JS FILE
* =========================================
*/
?>
<script>
    let load_posts_button = document.querySelectorAll('.js-load-posts');
	
	load_posts_button.forEach((element) => {
		element.addEventListener('click', (e) => {

			e.preventDefault();

			// If we are loading posts right now - don't allow trigger it again until first request is not finished
			if( element.classList.contains('loading') ) {
				return;
			}

			// Add "loading" class to not allow trigger another query until this one is finished
			element.classList.add('loading');


			// Set Variables 
			let is_load_more = false;
			let blog_wrapper = element.closest('.wcl-blog-wrapper');
			let load_more_button = blog_wrapper.querySelector('.wcl-load-more-button');
			let posts_wrapper = blog_wrapper.querySelector('.wcl-blog-posts-wrapper');
			let posts_cat = element.dataset.cat;
			let page = parseInt(blog_wrapper.dataset.page) + 1;

			if( posts_cat === undefined ) {
				
				// "Load more" link click 
				is_load_more = true;
				posts_cat = blog_wrapper.dataset.cat;

			}




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
	
					if( is_load_more ) {

						// "Load more" link click
						blog_wrapper.dataset.page = page;

						// Append new posts
						if( httpRequest.responseText == '0' ) {
							posts_wrapper.insertAdjacentHTML("beforeend", '<h4>There are no more posts.</h4>');
							load_more_button.style.display = 'none';
						}else {
							posts_wrapper.insertAdjacentHTML("beforeend", httpRequest.responseText);
						}

					}else {

						// "Cat" link click
						blog_wrapper.dataset.page = '1';
						blog_wrapper.dataset.cat = posts_cat;

						// Replace posts with new ones
						if( httpRequest.responseText == '0' ) {
							posts_wrapper.innerHTML = '<h4>There are no posts</h4>';
							load_more_button.style.display = 'none';
						}else {
							posts_wrapper.innerHTML = httpRequest.responseText;
							load_more_button.style.display = 'block';
						}

					}

				} else {

					// FAIL
					/*
					blog_wrapper.innerHTML = 'Something went wrong. Please, try again later';
					blog_wrapper.classList.add('error');
					blog_wrapper.classList.remove('success');
					*/

				}

				// Remove "loading" class
				element.classList.remove('loading');

			};

			httpRequest.onerror = function () {

				// Connection error
				/*
				blog_wrapper.innerHTML = 'Something went wrong. Please, try again later';
				blog_wrapper.classList.add('error');
				blog_wrapper.classList.remove('success');
				*/

				// Remove "loading" class
				element.classList.remove('loading');

			};

			httpRequest.send('action=ajax_load_posts&cat=' + posts_cat + '&page=' + page);


		});
	});
</script>
<?php 













/*
* =========================================
* 	FUNCTIONS (AJAX FUNCTION)
* =========================================
*/
add_action('wp_ajax_nopriv_ajax_load_posts', 'ajax_load_posts');
add_action('wp_ajax_ajax_load_posts', 'ajax_load_posts');

function ajax_load_posts() {

	$cat = sanitize_text_field($_REQUEST['cat']);
	$page = sanitize_text_field($_REQUEST['page']);

	$posts_per_page = get_option('posts_per_page');

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged'	=> $page,
	);

	// Add "cat" parameter
	if( $cat != 'all' ) {

		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $cat,
			),
		);

	}

	$the_query = new WP_Query($args);


	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) { $the_query->the_post();
			get_template_part('template-parts/post-content');
		}
	}else {
		echo 0;
	}

	wp_die();

}