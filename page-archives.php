<?php 
/*
Template Name: 归档模板
*/
get_header(); ?>

<article>
  <div id="floater">
  <div id="up"></div>
  <?php if ( comments_open() ) : ?>
  <div id="go2comment"></div>
  <?php endif ;?>
  <div id="down"></div>
  </div>
  <div id="single-content">  
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
      
	  <div class="article-header">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
		  <div class="post-meta">By <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></div>
		  </div>
        <div class="archives">
		<?php
        $previous_year = $year = 0;
        $previous_month = $month = 0;
        $ul_open = false;
         
        $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
        
        foreach($myposts as $post) :
            setup_postdata($post);
         
            $year = mysql2date('Y', $post->post_date);
            $month = mysql2date('n', $post->post_date);
            $day = mysql2date('j', $post->post_date);
            
            if($year != $previous_year || $month != $previous_month) :
                if($ul_open == true) : 
                    echo '</ul>';
                endif;
         
                echo '<h4>'; echo the_time('Y m'); echo '</h4>';
                echo '<ul>';
                $ul_open = true;
         
            endif;
         
            $previous_year = $year; $previous_month = $month;
        ?>
                        
                <li><span class="time"><?php the_time('j'); ?>日</span><br/><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/><span class="com"><?php comments_number('0', '1', '%'); ?>人评论</span></li>
               
           
        <?php endforeach; ?>
        </ul>
    </div>	
					
					
		 <div class="clear"></div>
		 
		 	
		<div class="article-footer"></div>
      
    
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<?php get_footer(); ?>
