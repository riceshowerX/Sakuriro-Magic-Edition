<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

// 缓存配置值
$mashiro_logo = iro_opt('mashiro_logo');
$vision_resource_basepath = iro_opt('vision_resource_basepath');
$iro_logo = iro_opt('iro_logo');
$favicon_link = iro_opt('favicon_link', '');
$gfonts_api = iro_opt('gfonts_api', 'fonts.loli.net');
$gfonts_add_name = iro_opt('gfonts_add_name');
$google_analytics_id = iro_opt('google_analytics_id', '');
$site_header_insert = iro_opt("site_header_insert");
$preload_animation = iro_opt('preload_animation', 'true');
$mashiro_logo_option = iro_opt('mashiro_logo_option', false);
$nav_menu_search = iro_opt('nav_menu_search') == '1';
$nav_menu_display = iro_opt('nav_menu_display') == 'fold';
$cover_switch = iro_opt('cover_switch');
$random_graphs_filter = iro_opt('random_graphs_filter');

?>

<?php header('X-Frame-Options: SAMEORIGIN'); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta name="theme-color">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <link rel="stylesheet" href="<?= $vision_resource_basepath ?>fontawesome/css/all.min.css" type="text/css" media="all" />

    <?php
    if (iro_opt('iro_meta')) {
        $keywords = '';
        $description = '';
        if (is_singular()) {
            $tags = get_the_tags();
            $categories = get_the_category();
            $keywords = implode(',', array_map(function ($tag) {
                return $tag->name;
            }, $tags));
            $keywords .= implode(',', array_map(function ($category) {
                return $category->name;
            }, $categories));
            $description = mb_strimwidth(str_replace("\r\n", '', strip_tags($post->post_content)), 0, 240, '…');
        } else {
            $keywords = iro_opt('iro_meta_keywords');
            $description = iro_opt('iro_meta_description');
        }
    ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>

    <link rel="shortcut icon" href="<?php echo $favicon_link; ?>" />
    <meta http-equiv="x-dns-prefetch-control" content="on">

    <?php if (is_home()) : ?>
        <?php global $core_lib_basepath; ?>
        <link id="entry-content-css" rel="prefetch" as="style" href="<?= $core_lib_basepath . '/css/theme/' . (iro_opt('entry_content_style') == 'sakurairo' ? 'sakura' : 'github') . '.css?ver=' . IRO_VERSION ?>" />
        <link rel="prefetch" as="script" href="<?= $core_lib_basepath . '/js/page.js?ver=' . IRO_VERSION ?>" />
    <?php endif; ?>

    <?php wp_head(); ?>

    <link rel="stylesheet" href="https://<?php echo $gfonts_api; ?>/css?family=Noto+Serif|Noto+Serif+SC|Noto+Sans+SC|Dela+Gothic+One|Fira+Code<?php echo $gfonts_add_name; ?>&display=swap" media="all">

    <script type="text/javascript">
        if (!!window.ActiveXObject || "ActiveXObject" in window) {
            alert('朋友，IE浏览器未适配哦~\n如果是 360、QQ 等双核浏览器，请关闭 IE 模式！');
        }
    </script>

    <?php if ($google_analytics_id) : ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_id; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments)
            }
            gtag('js', new Date());
            gtag('config', '<?php echo $google_analytics_id; ?>');
        </script>
    <?php endif; ?>

    <?php echo $site_header_insert; ?>
</head>

<body <?php body_class(); ?>>
    <?php if ($preload_animation) : ?>
        <div id="preload">
            <li data-id="3" class="active">
                <div id="preloader_3"></div>
            </li>
        </div>
    <?php endif; ?>

    <div class="scrollbar" id="bar"></div>

    <header class="site-header no-select" role="banner">
        <div class="site-top">
            <div class="site-branding">
                <?php if ($iro_logo && !$mashiro_logo_option) : ?>
                    <div class="site-title">
                        <a href="<?php bloginfo('url'); ?>"><img src="<?php echo $iro_logo; ?>"></a>
                    </div>
                <?php else : ?>
                    <span class="site-title">
                        <span class="logolink moe-mashiro">
                            <a href="<?php bloginfo('url'); ?>">
                                <ruby>
                                    <span class="sakuraso"><?= $mashiro_logo['text_a'] ?? ""; ?></span>
                                    <span class="no"><?= $mashiro_logo['text_b'] ?? ""; ?></span>
                                    <span class="shironeko"><?= $mashiro_logo['text_c'] ?? ""; ?></span>
                                    <rp></rp>
                                    <rt class="chinese-font"><?= $mashiro_logo['text_secondary'] ?? ""; ?></rt>
                                    <rp></rp>
                                </ruby>
                            </a>
                        </span>
                    </span>
                <?php endif; ?>
                <!-- logo end -->
            </div><!-- .site-branding -->

            <?php header_user_menu(); ?>

            <?php if ($nav_menu_search) : ?>
                <div class="searchbox js-toggle-search"><i class="fa-solid fa-magnifying-glass"></i></div>
            <?php endif; ?>

            <div class="lower">
                <?php if ($nav_menu_display) : ?>
                    <div id="show-nav" class="showNav">
                        <div class="line line1"></div>
                        <div class="line line2"></div>
                        <div class="line line3"></div>
                    </div>
                <?php endif; ?>
                <nav>
                    <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </header><!-- #masthead -->

    <div class="openNav no-select">
        <div class="iconflat no-select" style="padding: 30px;">
            <div class="icon"></div>
        </div>
    </div><!-- m-nav-bar -->

    <section id="main-container">
        <?php if ($cover_switch) : ?>
            <div class="headertop <?= $random_graphs_filter; ?>">
                <?php get_template_part('layouts/imgbox'); ?>
            </div>
        <?php endif; ?>

        <div id="page" class="site wrapper">
            <?php
            $use_as_thumb = get_post_meta(get_the_ID(), 'use_as_thumb', true); //'true','only',(default)
            if ($use_as_thumb != 'only') {
                $cover_type = get_post_meta(get_the_ID(), 'cover_type', true);
                if ($cover_type == 'hls') {
                    the_video_headPattern(true);
                } elseif ($cover_type == 'normal') {
                    the_video_headPattern(false);
                } else {
                    the_headPattern();
                }
            } else {
                the_headPattern();
            }
            ?>
            <div id="content" class="site-content">