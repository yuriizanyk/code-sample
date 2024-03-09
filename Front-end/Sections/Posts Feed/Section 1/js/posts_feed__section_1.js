

/*
	 * =============================================================
	 *   Latest Posts Slider
	 * =============================================================
	 */

const LatestPostsPage = document.querySelector('.wcl-latest-posts .swiper');

if (LatestPostsPage) {

    // breakpoint where swiper will be destroyed
    const breakpoint = window.matchMedia('(min-width: 992px)');

    // keep track of swiper instances to destroy later
    let latest_post_swiper;

    const breakpointChecker = function () {

        if (breakpoint.matches === true) {

            if (latest_post_swiper !== undefined) latest_post_swiper.destroy(true, true);
            return;

        } else if (breakpoint.matches === false) {

            return latestPostsSliderInit();
        }
    }


    const latestPostsSliderInit = function () {
        latest_post_swiper = new Swiper(LatestPostsPage, {
            spaceBetween: 16,
            loop: false,
            breakpoints: {
                320: {
                    slidesPerView: 1.15,
                    spaceBetween: 16,
                },
                425: {
                    slidesPerView: 1.3,
                    spaceBetween: 20,
                },
                576: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2.2,
                    spaceBetween: 40,
                },
            },

            // Navigation arrows
            navigation: {
                nextEl: '.wcl-button-next',
                prevEl: '.wcl-button-prev',
            },
        });
    };

    // keep an eye on viewport size changes
    breakpoint.addListener(breakpointChecker);
    // kickstart
    breakpointChecker();

}