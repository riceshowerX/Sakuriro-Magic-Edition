<?php

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if (have_posts()) : ?>

			<?php // 判断是否显示分类标题和描述 ?>
			<?php if (!iro_opt('patternimg') || !z_taxonomy_image_url()) : ?>
				<header class="page-header">
					<h1 class="cat-title"><?php single_cat_title('', true); ?></h1>
					<span class="cat-des">
						<?php
						$category_description = category_description();
						if (!empty($category_description)) {
							echo $category_description;
						}
						?>
					</span>
				</header><!-- .page-header -->
			<?php endif; ?>

			<?php // 加载文章列表模板 ?>
			<?php 
			$post_display_style = iro_opt('post_list_style');
			$is_image_category = is_image_category(); // 使用独立函数判断是否为图片分类
			if (iro_opt('image_category') && $is_image_category) { 
				while (have_posts()) : the_post();
					get_template_part('tpl/content', 'category');
				endwhile;
			} else {
				while (have_posts()) : the_post();
					get_template_part('tpl/content', $post_display_style == 'akinastyle' ? get_post_format() : 'thumb');
				endwhile;
			}
			?>
			<div class="clearer"></div>

		<?php else :

			get_template_part('tpl/content', 'none');

		endif; ?>

	</main><!-- #main -->

	<?php // 加载分页导航 ?>
	<?php $pagination_style = iro_opt('pagenav_style'); ?>
	<?php if ($pagination_style == 'ajax') : ?>
		<div id="pagination" <?php if (iro_opt('image_category') && $is_image_category) echo 'class="pagination-archive"'; ?>><?php next_posts_link(__(' Previous', 'sakurairo')); ?></div>
		<div id="add_post"><span id="add_post_time" style="visibility: hidden;" title="<?php echo iro_opt('page_auto_load', ''); ?>"></span></div>
	<?php else : ?>
		<nav class="navigator">
			<?php previous_posts_link('<i class="fa-solid fa-angle-left"></i>') ?><?php next_posts_link('<i class="fa-solid fa-angle-right"></i>') ?>
		</nav>
	<?php endif; ?>
</div><!-- #primary -->

<?php get_footer(); ?>

<?php

// 独立函数判断是否为图片分类
function is_image_category() {
	return is_category(explode(',', iro_opt('image_category')));
}

?>