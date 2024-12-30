<?php get_header(); ?>

<article>
  <div id="floater">
  <div id="up"></div>
  <div id="go2comment"></div>
  <div id="down"></div>
  </div>
 
  <div id="single-content">  
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
      
	  <div class="article-header">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        </div>
        <!--.postMeta-->
        <div class="article-body">
         <?php the_content(); ?>
		 </div>
		 <div class="clear"></div>
		 
		 	<?php comments_template( '', true ); ?>
		<div class="article-footer"></div>
      
    
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<script>
	
		$('.myskills li').each(function(){
			$(this).animate(
				{marginLeft:0},function ee(n){
					return(n=Math.random()*3333|0)>1500?n:ee()
				}()

				
			);
		});
	
	</script>
<?php get_footer(); ?>
