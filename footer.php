<?php
/**
 * 页脚模板。
 * 包含 #content div 的闭合以及后续所有内容。
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sakura
 */

// 缓存配置值
$reception_background = iro_opt('reception_background');
$footer_info = iro_opt('footer_info', '');
$load_nextpage_svg = iro_opt('load_nextpage_svg');
$footer_load_occupancy = iro_opt('footer_load_occupancy', 'true');
$footer_upyun = iro_opt('footer_upyun', 'true');
$personal_avatar = iro_opt('personal_avatar');
$iro_logo = iro_opt('iro_logo');
$vision_resource_basepath = iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.6/');
$ava = $personal_avatar ? $personal_avatar : ($iro_logo ?: $vision_resource_basepath . 'series/avatar.webp');
$live_search = iro_opt('live_search');
$sakura_widget = iro_opt('sakura_widget');
$widget_shuo = iro_opt('widget_shuo', 'true');
$widget_daynight = iro_opt('widget_daynight', 'true');
$footer_debug = iro_opt('footer_debug', 'true');

// 构建加载下一部分圈圈的HTML
$load_nextpage_svg_html = '<img alt="loading_svg" src="' . $load_nextpage_svg . '">';

?>
	</div><!-- #content -->
	<?php 
			comments_template('', true); 
	?>
</div><!-- #page Pjax container-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info" theme-info="Sakurairo v<?php echo IRO_VERSION; ?>">
			<div class="footertext">
				<div class="img-preload">
					<?php echo $load_nextpage_svg_html; ?>
				</div>
				<div class="sakura-icon" style="width:max-content;height:max-content;margin: auto;">
					<svg width="30px" height="30px" t="1682340134496" class="sakura-svg" viewBox="0 0 1049 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5240">
						<path d="M525.58396628 573.34694353s268.83106938-2.62915481 309.36387092 193.24287089l-76.46458293 21.90962291 12.92667757 84.13295086a214.05701289 214.05701289 0 0 1-96.84053193-4.82011663A224.79272784 224.79272784 0 0 1 525.58396628 578.38615666z" fill="#EE9ca7" p-id="5241"></path>
						<path d="M552.75189802 512.4381922s131.45773592-233.7756732 321.63325979-170.89505575L854.2283053 418.66500728l79.31283344 30.89256828a215.59068679 215.59068679 0 0 1-52.58309388 81.50379604 224.57363215 224.57363215 0 0 1-325.35789552-14.67944718z" fill="#EE9ca7" p-id="5242"></path>
						<path d="M508.49446078 494.0341093S317.00435871 306.48774025 426.77156822 139.31731943l69.4535037 38.78003191L547.4935884 109.30113636a214.05701289 214.05701289 0 0 1 65.72886796 71.86356201 225.01182435 225.01182435 0 0 1-98.37420505 310.67844912z" fill="#EE9ca7" p-id="5243"></path>
						<path d="M473.21996809 525.58396628S242.2925454 661.64272234 109.30113636 512.4381922l55.43134521-57.18411482-53.45947909-65.72886795a213.61882069 213.61882069 0 0 1 86.32391269-43.81924506 224.79272784 224.79272784 0 0 1 274.527572 175.27698099z" fill="#EE9ca7" p-id="5244"></path>
						<path d="M481.76472043 566.55496s72.0826585 258.31445093-106.4807652 348.14390364l-40.31370582-68.13892627-78.21735252 34.17901099a212.30424328 212.30424328 0 0 1-20.15685331-94.64956933 224.57363215 224.57363215 0 0 1 241.00584894-219.09622602z" fill="#EE9ca7" p-id="5245"></path>
					</svg>
				</div>
				<p style="color: #666666;"><?php echo $footer_info; ?></p>
			</div>
			<div class="footer-device function_area">
				<?php if(iro_opt('footer_yiyan')): ?>
					<p id="footer_yiyan"></p>
				<?php endif; ?>
				<span style="color: #b9b9b9;">
					<?php /* 能保留下面两个链接吗？算是我一个小小的心愿吧~ */ ?>
					<?php if ($footer_load_occupancy): ?>
						<?php printf(
							_x( 'Load Time %.3f seconds | %d Query | RAM Usage %.2f MB ', 'footer load occupancy', 'sakurairo' ),
							timer_stop( 0, 3 ),get_num_queries(),memory_get_peak_usage() / 1024 / 1024);
						?>
					<?php endif; ?>
					<?php if ($footer_upyun): ?>
						本网站由 <a href="https://www.upyun.com/?utm_source=lianmeng&utm_medium=referral" target="_blank"> <img alt="upyun-logo" src="https://s.nmxc.ltd/sakurairo_vision/@2.6/options/upyun_logo.webp"  style="display:inline-block;vertical-align:middle;width:60px;height:30px;"/> 提供 CDN 加速 / 云存储 服务
					<?php endif; ?>
					<br>
					<a href="https://github.com/mirai-mamori/Sakurairo" rel="noopener" target="_blank" id="site-info" >Theme Sakurairo</a><a href="https://docs.fuukei.org/" rel="noopener" target="_blank" id="site-info" > by Fuukei</a> 
				</span>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</section><!-- #section -->
	<!-- m-nav-center -->
	<div id="mo-nav">
		<div class="m-avatar">
			<img alt="m-avatar" src="<?php echo $ava ?>">
		</div>
		<div class="m-search">
			<form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
				<input class="m-search-input" type="search" name="s" placeholder="<?php _e('Search...', 'sakurairo') /*搜索...*/?>" required>
			</form>
		</div>
		<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?>
	</div><!-- m-nav-center end -->
	<button id="moblieGoTop" title="<?=__('Go to top','sakurairo');?>"><i class="fa-solid fa-caret-up fa-lg"></i></button>
	<button id="changskin" title="<?=__('Control Panel','sakurairo');?>" ><i class="fa-solid fa-compass-drafting fa-lg fa-flip" style="--fa-animation-duration: 3s;"></i></button>
	<!-- search start -->
	<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
		<div class="search-form__inner">
		<?php if($live_search): ?>
			<div class="micro">
				<input id="search-input" class="text-input" type="search" name="s" placeholder="<?php _e('Want to find something?', 'sakurairo') /*想要找点什么呢*/?>" required>
			</div>
			<div class="ins-section-wrapper">
				<a id="Ty" href="#"></a>
				<div class="ins-section-container" id="PostlistBox"></div>
			</div>
		<?php else: ?>
			<div class="micro">
				<p class="micro mb-"><?php _e('Want to find something?', 'sakurairo') /*想要找点什么呢*/?></p>
				<input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'sakurairo') ?>" required>
			</div>
		<?php endif; ?>
		</div>
		<div class="search_close"></div>
	</form>
	<!-- search end -->
	<?php wp_footer(); ?>
	<div class="skin-menu no-select">
		<?php if ($sakura_widget) : ?>
			<aside id="iro-widget" class="widget-area" role="complementary">
				<div class="sakura_widget">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sakura_widget')) : endif; ?>
				</div>
			</aside>
		<?php endif; ?>
		<?php if ($widget_shuo) : ?>    
			<?php
				$args = array(
						'post_type' => 'shuoshuo',
						'post_status' => 'publish',
						'posts_per_page' => 1
						);
				$shuoshuo_query = new WP_Query($args);
			?>
			<?php while ($shuoshuo_query->have_posts()) : $shuoshuo_query->the_post(); ?>
				<div class="footer-shuo">
				<p><?php echo strip_tags(get_the_content()); ?></p>
				<p class="footer-shuotime"><i class="fa-regular fa-clock"></i> <?php the_time('Y/n/j G:i'); ?></p>
				</div>
			<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
		<?php endif; ?>  
		<div class="theme-controls row-container">
			<?php if ($widget_daynight): ?>
				<ul class="menu-list">
					<li id="white-bg" title="<?=__('Light Mode','sakurairo');?>" >
						<i class="fa-solid fa-display fa-sm"></i>
					</li><!--Default-->
					<li id="dark-bg" title="<?=__('Dark Mode','sakurairo');?>" >
						<i class="fa-regular fa-moon"></i>
					</li><!--Night-->
				</ul>
			<?php endif; ?>
			<?php if(array_key_exists('heart_shaped', $reception_background) && $reception_background['heart_shaped'] == '1' || array_key_exists('star_shaped', $reception_background) && $reception_background['star_shaped'] == '1' || array_key_exists('square_shaped', $reception_background) && $reception_background['square_shaped'] == '1' || array_key_exists('lemon_shaped', $reception_background) && $reception_background['lemon_shaped'] == '1'): ?>
				<ul class="menu-list" title="<?=__('Toggle Page Background Image','sakurairo');?>">
					<?php
					$bgIcons = [
						['heart_shaped', 'fa-regular fa-heart', 'diy1-bg'],
						['star_shaped', 'fa-regular fa-star', 'diy2-bg'],
						['square_shaped', 'fa-brands fa-delicious', 'diy3-bg'],
						['lemon_shaped', 'fa-solid fa-lemon', 'diy4-bg']
					];
					foreach ($bgIcons as $icon) :
						if (array_key_exists($icon[0], $reception_background) && $reception_background[$icon[0]] == '1') : ?>
							<li class="bg-theme-toggle" id="<?php echo $icon[2]; ?>" >
								<i class="<?php echo $icon[1]; ?>"></i>
							</li>
						<?php endif;
					endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($footer_debug) : ?>
		<div id="debug">
			<ul>
				<li><?php printf(_x('加载时间 %.3f 秒', '底部负载情况', 'sakurairo'), timer_stop(0, 3)); ?></li>
				<li><?php printf(_x('数据库查询 %d 次', '底部负载情况', 'sakurairo'), get_num_queries()); ?></li>
				<li><?php printf(_x('RAM 使用量 %.2f MB', '底部负载情况', 'sakurairo'), memory_get_peak_usage() / 1024 / 1024); ?></li>
			</ul>
		</div>
	<?php endif; ?>
</body>
</html>