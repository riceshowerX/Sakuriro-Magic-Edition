<?php 

/**
 Template Name: 友情链接模版
 */

get_header(); 

?>

<?php 

function display_link_items() {
  echo get_link_items();
}

?>

	<?php while(have_posts()) : the_post(); ?>
	<?php $post = get_post(); ?>
	<?php 
	$hasPatternImg = iro_opt('patternimg');
	$hasFeaturedImage = get_post_thumbnail_id(get_the_ID());

	if(!$hasPatternImg || !empty($hasFeaturedImage)) { 
		?>
		<span class="linkss-title"><?php the_title();?></span>
		<?php 
	} 
	?>
		<article <?php post_class("post-item"); ?>>
			<?php if (iro_opt('article_auto_toc', 'true') && check_title_tags($post->post_content)) { //加载目录?>
			<div class="has-toc have-toc"></div>
			<?php } ?>
			<div class="entry-content">
				<?php the_content( '', true ); ?>
			</div>			
			<div class="links">
				<?php display_link_items(); ?>
			</div>
		</article>
	<?php get_template_part('layouts/sidebox'); //加载目录容器?> 
	<?php endwhile; ?>
<?php
get_footer();

?>