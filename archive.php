<?php get_header(); ?>
	<article>  
			
				<div id="content">
				<div class="content-header"></div>
<div class="breadcrumbsclear"><div class="breadcrumbs"><li><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; Category Archives</li></div></div>				
				   <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				   <?php /* If this is a category archive */ if (is_category()) { ?>
					<div class="archive_category">Category Archives: <?php single_cat_title(); ?></div>
				   <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<div class="archive_tag">标签&nbsp; ”<?php single_tag_title(); ?>“ &nbsp;下的文章</div>
				   <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
				   <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h1>Archive for <?php the_time('Y年F '); ?></h1>
				   <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h1>Archive for <?php the_time('Y'); ?></h1>
				   <?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h1>Author Archive</h1>
				   <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h1>Blog Archives</h1>
				   <?php } ?>       
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
						<h2><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="post-meta"> <span>
      <?php the_time('Y.m.j'); ?>
      </span> | <span>
      <?php the_category(', ') ?>
      </span> | <span>
      超过<?php if(function_exists('the_views')) { the_views(); } ?>人围观
      </span> | <span>
      <?php comments_popup_link('还没有评论', '只有1条评论', '已有%条评论'); ?>
      </span> </div>
    <!--.postMeta-->									 					
				
							<div class="post-content">
														
							<?php the_content(__('readmore'));?>
				</div>	
			
			
				<div class="sep"></div> 
					
					<?php endwhile; endif;?>			      
				
	<nav class="pagenavi cf">
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<div id="pagenavi"><?php pagenavi(); ?></div>
			<?php endif; ?>
			
		</nav>					
				</div><!--#end content-->	
		<?php get_sidebar(); ?></article>
		
		<?php get_footer(); ?>
	<!--#end layout-->
	