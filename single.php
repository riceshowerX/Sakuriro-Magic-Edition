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
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('tpl/content', 'single');
                get_template_part('layouts/sidebox');
                get_template_part('layouts/post', 'nextprev');
            endwhile;
        else :
            echo '<p>' . __('Sorry, no posts matched your criteria.', 'akina') . '</p>';
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
