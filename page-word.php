<?php
 
/**
 * 模板部分：显示说说内容
 *
 * @param WP_Post $post 当前说说帖子
 */
function display_shuoshuo_content(WP_Post $post) {
    ?>
    <li class="shuoshuo-item">
        <a href="<?php echo esc_url(get_permalink($post)); ?>">
            <span class="shuoshuo_author_img">
                <img src="<?php echo get_avatar_profile_url(get_the_author_meta('ID', $post->ID)); ?>" class="avatar avatar-48" width="48" height="48">
            </span>
            <div class="cbp_tmlabel">
                <div class="entry-content">
                    <?php echo wp_kses_post(apply_filters('the_content', $post->post_content)); ?>
                </div>
                <p class="shuoshuo_meta">
                    <i class="fa-regular fa-clock"></i> <?php echo get_the_date('Y/n/j G:i', $post); ?>
                    <span class="comments-number"><i class="fa-regular fa-comments"></i> <?php comments_number('0', '1', '%', $post->ID); ?></span>
                </p>
            </div>
        </a>
    </li>
    <?php
}

/**
 * Template Name: 说说模版
 */
 
get_header();
?>
 
<div id="primary" class="content-area">
    <main class="site-main" role="main">
    <?php
        $shuoshuo_per_page = iro_opt('shuoshuo_per_page'); //每页显示的说说数量
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'shuoshuo',
            'post_status' => 'publish',
            'posts_per_page' => $shuoshuo_per_page,
            'paged' => $paged
        );
        $shuoshuo_query = new WP_Query($args);
    ?>
	<div class="entry-content">
		<?php the_content( '', true ); ?>
	</div>			
    <div class="cbp_shuoshuo">
        <?php if ($shuoshuo_query->have_posts()) : ?>
            <ul id="main" class="cbp_tmtimeline">
                <?php while ($shuoshuo_query->have_posts()) : $shuoshuo_query->the_post(); ?>
                    <?php display_shuoshuo_content(get_post()); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        <?php else : ?>
            <h3 style="text-align: center;">
                <?php _e('You have not posted a comment yet', 'sakurairo') ?>
            </h3>
            <p style="text-align: center;">
                <?php _e('Go and post your first comment now', 'sakurairo') ?>
            </p>
        <?php endif; ?>
    </div>  
    </main><!-- #main -->
    <?php if (iro_opt('pagenav_style') == 'ajax') { ?>
        <div id="pagination">
            <?php next_posts_link(__('Load More', 'sakurairo'), $shuoshuo_query->max_num_pages); ?>
        </div>
        <div id="add_post">
            <span id="add_post_time" style="visibility: hidden;" title="<?php echo iro_opt('page_auto_load', ''); ?>"></span>
        </div>
    <?php } else { ?>
        <nav class="navigator">
            <?php previous_posts_link('<i class="fa-solid fa-angle-left"></i>') ?>
            <?php next_posts_link('<i class="fa-solid fa-angle-right"></i>', $shuoshuo_query->max_num_pages) ?>
        </nav>
    <?php } ?>
</div><!-- #primary -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const timelines = document.querySelectorAll('.cbp_tmtimeline');
        timelines.forEach(timeline => {
            timeline.addEventListener('mouseover', event => {
                if (event.target.matches('.cbp_tmtimeline li .shuoshuo_author_img img')) {
                    event.target.classList.add('zhuan');
                }
            });
            timeline.addEventListener('mouseout', event => {
                if (event.target.matches('.cbp_tmtimeline li .shuoshuo_author_img img')) {
                    event.target.classList.remove('zhuan');
                }
            });
        });
    });
</script>
<?php get_footer(); ?>
