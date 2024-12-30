<?php 
/*
Template Name: Guestbook
*/
get_header(); 
?>

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
        <!--.postMeta-->
        <div class="wall">
						<ul>
							<?php 
								$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author_email != 'lonelyxue@gmail.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 36";
								$wall = $wpdb->get_results($query); 
								foreach ($wall as $comment) 
								{ 
									if( $comment->comment_author_url ) {
									$url = $comment->comment_author_url; $tmp = "<li>".get_avatar($comment->comment_author_email, 80)."<div class='lihide'><div class='hidetext'>".$comment->comment_author."<br/>共有".$comment->cnt."条评论<br/><a href='".$url."' target='_blank'>".$url."</a></div><div class='hideav'>".get_avatar($comment->comment_author_email, 80)."</div></div></li>";}
									else{ $url="http://fatesinger.com"; $urls="http://*********.com";$tmp = "<li>".get_avatar($comment->comment_author_email, 80)."<div class='lihide'><div class='hidetext'>".$comment->comment_author."<br/>共有".$comment->cnt."条评论<br/><a href='".$url."' target='_blank'>".$urls."</a></div><div class='hideav'>".get_avatar($comment->comment_author_email, 80)."</div></div></li>"; }
									
									$output .= $tmp; 
								 } 
								echo $output ;
							?>
						</ul>
					</div>
					<!-- end wall -->
					
					
		 <div class="clear"></div>
		 
		 	<?php comments_template( '', true ); ?>
		<div class="article-footer"></div>
      
    
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<?php get_footer(); ?>
