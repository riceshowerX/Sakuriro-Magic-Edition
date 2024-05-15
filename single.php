<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Akina
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()) :
            the_post();
            // Display single post content
            get_template_part('tpl/content', 'single');

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Include sidebar
get_sidebar();

// Include next/previous post links
get_template_part('layouts/post', 'nextprev');

get_footer();
