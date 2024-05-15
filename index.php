<?php
get_header();

// 显示公告板
$text = iro_opt('bulletin_board') == '1' ? iro_opt('bulletin_text') : '';
if ($text) {
    $bulletin_icon = iro_opt('bulletin_board_icon', 'true') ? '<div class="notice-icon">' . __('Notice','sakurairo') . '</div>' : '';
    $notice_content = '<div class="notice-content">' . $text . '</div>';
    echo '<div class="notice" style="margin-top:60px;">' . $bulletin_icon . $notice_content . '</div>';
}

// 显示展示区域
$exhibition_area = iro_opt('exhibition_area');
$exhibition_area_style = iro_opt('exhibition_area_style');
if ($exhibition_area['exhibition_area'] == '1' && isset($exhibition_area_style['exhibition_area_style'])) {
    get_template_part('layouts/' . ($exhibition_area_style['exhibition_area_style'] == 'left_and_right' ? 'feature_v2' : 'feature'));
}

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <h1 class="main-title"> <i class="<?php echo iro_opt('post_area_icon', 'fa-regular fa-bookmark'); ?>" aria-hidden="true"></i> <br> <?php echo iro_opt('post_area_title', '文章'); ?> </h1>
        <?php
        if (have_posts()) :
            if (is_home() && !is_front_page()) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif;
            /* 开始循环 */
            if (iro_opt('post_list_style') == 'akinastyle') {
                while (have_posts()) : the_post();
                    get_template_part('tpl/content', get_post_format());
                endwhile;
            } else {
                get_template_part('tpl/content', 'thumb');
            }
        else :
            get_template_part('tpl/content', 'none');
        endif; ?>
    </main><!-- #main -->
    <?php
    if (in_array(iro_opt('pagenav_style'), array('ajax'))) {
        ?>
        <div id="pagination"><?php next_posts_link(__(' Previous', 'sakurairo')); ?></div>
        <div id="add_post"><span id="add_post_time" style="visibility: hidden;" title="<?php echo iro_opt('page_auto_load', ''); ?>"></span></div>
    <?php } else { ?>
        <nav class="navigator">
            <?php previous_posts_link('<i class="fa-solid fa-angle-left"></i>') ?><?php next_posts_link('<i class="fa-solid fa-angle-right"></i>') ?>
        </nav>
    <?php } ?>
</div><!-- #primary -->

<?php get_footer(); ?>
