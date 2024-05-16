<?php

get_header();

?>

<div class="author-info">
  <div class="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
  </div>
  <div class="author-details">
    <h3><?php the_author(); ?></h3>
    <p class="author-description"><?php echo get_the_author_meta('description') ? get_the_author_meta('description') : __("No personal profile set yet","sakurairo"); ?></p>
  </div>
</div>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php
    if (have_posts()) :
      // Start the Loop
      if (iro_opt('post_list_style') == 'akinastyle') {
        // 使用 akinastyle 模板
        while (have_posts()) : the_post();
          get_template_part('tpl/content', get_post_format());
        endwhile;
      } else {
        // 使用缩略图模板
        get_template_part('tpl/content', 'thumb');
      }
    ?>
    <?php else :

      get_template_part('tpl/content', 'none');

    endif; ?>

  </main><!-- #main -->

  <?php 
  $pagenav_style = iro_opt('pagenav_style'); 
  if ($pagenav_style == 'ajax') { 
    // 使用 Ajax 分页
    ?>
    <div id="pagination">
      <?php next_posts_link(__(' Previous', 'sakurairo')); ?>
    </div>
    <div id="add_post">
      <span id="add_post_time" title="<?php echo iro_opt('page_auto_load', ''); ?>"></span>
    </div>
  <?php 
  } else { 
    // 使用传统分页
    ?>
    <nav class="navigator">
      <?php previous_posts_link('<i class="fa-solid fa-angle-left"></i>'); ?>
      <?php next_posts_link('<i class="fa-solid fa-angle-right"></i>'); ?>
    </nav>
  <?php } ?>
</div><!-- #primary -->

<?php
get_footer();
?>

<style>
  .author-info {
    display: flex;
    align-items: center;
    margin-top: 50px;
    padding: 40px 0;
    font-weight: var(--global-font-weight);
  }

  .author-avatar {
    margin-right: 30px;
  }

  .author-avatar img {
    border-radius: 50%; /* 更圆润的头像 */
    border: 2px solid #fff;
    background: #fff;
  }

  .author-details {
    line-height: 1.5;
  }

  .author-details h3 {
    font-weight: 700;
    font-size: 24px;
    margin-bottom: 10px;
    color: var(--primary-color); /* 使用主题颜色 */
  }

  .author-description {
    font-size: 16px;
  }
</style>