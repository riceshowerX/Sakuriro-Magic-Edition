<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Akina
 */

get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // 定义查询参数，开启缓存
    $args = array(
        'post_type' => 'post', 
        'posts_per_page' => 1, 
        'cache_results' => true, 
        'no_found_rows' => true 
    );

    // 使用 WP_Query 对象进行查询
    $query = new WP_Query($args);

    // 检查是否有博文
    if ($query->have_posts()) : 

        // 循环遍历博文
        while ($query->have_posts()) : $query->the_post(); 
            // 加载博文内容模板
            get_template_part('tpl/content', 'single'); 
        endwhile;

        // 加载侧边栏模板
        get_template_part('layouts/sidebox');

        // 加载上一篇/下一篇链接模板
        get_template_part('layouts/post','nextprev'); 

    else:
        // 加载没有博文时的模板
        get_template_part('template-parts/content', 'none');
    endif;

    // 重置数据
    wp_reset_postdata(); 
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); 
?>