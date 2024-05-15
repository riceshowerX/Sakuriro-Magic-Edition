<?php

/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Akina
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php printf(__('Search Result: %s', 'sakurairo'), '<span>' . get_search_query() . '</span>'); ?></h1>
            </header><!-- .page-header -->

            <?php
            /* Start the Loop */
            while (have_posts()) : the_post();
                if (iro_opt('post_list_style') == 'akinastyle') {
                    get_template_part('tpl/content', get_post_format());
                } else {
                    get_template_part('tpl/content', 'thumb');
                }
            endwhile;

            the_posts_navigation();

        else : ?>
            <div class="search-box">
                <!-- search start -->
                <form class="s-search">
                    <input class="text-input" type="search" name="s" placeholder="<?php _e('Search...', 'sakurairo') ?>" required>
                </form>
                <!-- search end -->
            </div>
            <?php get_template_part('tpl/content', 'none');

        endif; ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();

