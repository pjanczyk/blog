<?php
/*
Plugin Name: pj-highlight.js
Author: Piotr Janczyk
*/

add_action('wp_head', function () {
    wp_enqueue_script(
        "highlight.js",
        "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js",
        [],
        null
    );
    wp_enqueue_style(
        "highlight.js",
        "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/androidstudio.min.css",
        [],
        null
    );
});

add_action('wp_print_styles', function () {
    ?>
    <style>
        code.hljs {
            display: inline;
            background: #2b2b2b;
            padding: 0.2em;
        }
        pre > code.hljs {
            display: block;
            margin: -0.8em;
            padding: 0.5em;
        }
    </style>
    <?php
});

add_action('wp_print_footer_scripts', function () {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("code[class^='lang']").each(function (i, block) {
                hljs.highlightBlock(block);
            })
        });
    </script>
    <?php
});
