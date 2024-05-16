<?php 

/**
 Template Name: 文章模版
 */

get_header(); 

?>

<?php 

function generate_archive_list() {
    global $currentYear, $currentMonth, $archiveOutput;

    $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); 

    while ( $the_query->have_posts() ) : $the_query->the_post(); 

        $year_tmp = get_the_time('Y'); 
        $mon_tmp = get_the_time('n'); 

        if ($currentMonth != $mon_tmp && $currentMonth > 0) {
            $archiveOutput .= '</div></div>';
        }

        if ($currentYear != $year_tmp) { // 输出年份 
            $currentYear = $year_tmp;
            $all[$currentYear] = array();
        }

        if ($currentMonth != $mon_tmp) { // 输出月份 
            $currentMonth = $mon_tmp;
            array_push($all[$currentYear], $currentMonth);
            $archiveOutput .= "<div class='archive-title' id='arti-$currentYear-$currentMonth'><h3>$currentYear-$currentMonth</h3><div class='archives archives-$currentMonth' id='monlist' data-date='$currentYear-$currentMonth'>";
        }

        $archiveOutput .= '<span class="ar-circle"></span><div class="arrow-left-ar"></div><div class="brick"><a href="'.get_permalink() .'"><span class="time"><i class="fa-regular fa-clock"></i>'.get_the_time('n-d').'</span>'.get_the_title() .'<em>('. get_comments_number('0', '1', '%') .')</em></a></div>'; 

    endwhile; 

    wp_reset_postdata(); 

    $archiveOutput .= '</div></div>';

    return $archiveOutput;
}

?>

	<?php while(have_posts()) : the_post(); ?>
	
	<article <?php post_class("post-item"); ?>>
		<?php the_content( '', true ); ?>
		<div id="archives-temp">  
		<?php if(!iro_opt('patternimg') || !get_post_thumbnail_id(get_the_ID())) { ?>
        <h2><i class="fa-solid fa-calendar-day"></i><?php the_title();?></h2>
        <?php } ?>	
    <div id="archives-content">      
    <?php       
        $currentYear = 0;
        $currentMonth = 0;
        $archiveOutput = '';
        $all = array();
        $archiveOutput = generate_archive_list();
        echo $archiveOutput;  		         
    ?>   
		</article>
	<?php endwhile; ?>
	
<?php get_footer(); ?>