<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sliding Animated Line</title>
</head>
<body>

    <!-- STYLES -->
    <style>
        .wcl-sliding-line {
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            padding: 10px 0;
            width: 100%;
            height: 50px;
            box-sizing: border-box;
            white-space: nowrap;
        }
        .wcl-sliding-line .data-content {
            display: inline-block;
        }
        .wcl-sliding-line .data-item {
            margin-right: 70px;
            font-weight: 200;
            font-size: 30px;
            line-height: 1.23;
            color: #3e3834;
        }
        .wcl-sliding-line .data-link {
            text-decoration: none;
        }
        .wcl-sliding-line .data-link:hover {
            color: #a39488;
        }

        /* Responsive Design */
        @media only screen and (max-width: 576px) {

            .wcl-sliding-line .data-item {
                margin-right: 20px;
            }

        }
    </style>


    <!-- MARKUP -->
    <?php
        $title = 'Connect with WebComplete';
        $link = '#';
    ?>
    <div id="wcl-sliding-animated-line" class="wcl-sliding-line">
        <div class="data-content">
            <?php for ($i = 0; $i < 10; $i++) {
                if (!empty($title) && !empty($link)) {
            ?>
                    <a href="<?php echo $link; ?>" class="data-item data-link"><?php echo $title; ?></a>
                <?php
                } else {
                ?>
                    <div class="data-item"><?php echo $title; ?></div>
            <?php
                }
            } ?>
        </div>
    </div>
    

    <!-- SCRIPTS -->
    <script>

        const ready = (callback) => {
            if (document.readyState != "loading") callback();
            else document.addEventListener("DOMContentLoaded", callback);
        }

        ready(() => {

            /*
            * Sliding Animated Line
            */
            function wcl_animate_line_function(el, duration) {

                const innerEl = el.querySelector('.data-content');
                const innerWidth = innerEl.offsetWidth;
                const cloneEl = innerEl.cloneNode(true);
                el.appendChild(cloneEl);

                let start = performance.now();
                let progress;
                let translateX;

                requestAnimationFrame(function step(now) {

                    progress = (now - start) / duration;

                    if (progress > 1) {
                        progress %= 1;
                        start = now;
                    }

                    translateX = innerWidth * progress;

                    innerEl.style.transform = `translate3d(-${translateX}px, 0 , 0)`;
                    cloneEl.style.transform = `translate3d(-${translateX}px, 0 , 0)`;

                    requestAnimationFrame(step);

                });
                
            }


        const sliding_line_marquee = document.querySelector('#wcl-sliding-animated-line');

        if (sliding_line_marquee) {
            wcl_animate_line_function(sliding_line_marquee, 20000);
        }

        }); //End ready

    </script>

</body>
</html>