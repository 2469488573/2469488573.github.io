<div id="comments">

	<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	    <?php die('貌似你做了些不该做的……Big brother is watching you！'); ?>
	<?php endif; ?>
	<?php if(!empty($post->post_password)) : ?>
	    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	    <?php endif; ?>
	<?php endif; ?>
	<?php $i++; ?> 
	
	<?php //trackbacks计数分离
	if (function_exists('wp_list_comments')) {
		$trackbacks = $comments_by_type['pings'];
	} else {
		$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
	}?>

	
		<?php if($comments) : //如果有评论 ?>
		
			<div id="commnents" class="commentsorping">
			
				<div class="leavecom"></div>
			
				<div class="commentpart">Comment<?php echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></div>
				<div class="pingpart">Trackback<?php echo (' (' . count($trackbacks) . ')');?></div>
			</div>
	
	
			<?php if ( function_exists('wp_list_comments') ) : //嵌套评论 ?>
			<div class="commentshow">
			<div id="loading-comments"></div>
	<ul class="commentlist" >
	<?php wp_list_comments('type=comment&callback=devecomment&max_depth=10000'); ?>
	</ul>
	<nav class="commentnav">
		<?php paginate_comments_links('prev_text=«&next_text=»');?>
	</nav>
	</div>
			<?php else : ?>
					
			<?php endif; ?>
			
			
			<?php if ( ! empty($comments_by_type['pings']) ) : //嵌套ping?>
			<ul class="pingtlist">
					<?php wp_list_comments('type=pings&callback=devepings&per_page=999'); ?>
			</ul>
			<?php else : ?>
			<ul class="pingtlist">
				<li>还没有Trackback</li>
			</ul>
			<?php endif; ?>
									
	<?php else : ?>
	  <div id="commnents" class="commentsorping">
			
				<div class="commentsays"><?php comments_number('No Response', 'Only One Response', '% Responses' );?></div>
			
				<div class="commentpart">Comment<?php echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></div>
				<div class="pingpart">Trackback<?php echo (' (' . count($trackbacks) . ')');?></div>
			</div>
	<?php endif; ?>
	
	
	<?php if(comments_open()) : ?>
		
		<div id="respond">
		<div id="replytitle">Leave a Reply</div>
<div class="cancel_comment_reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p style="margin-bottom:10px">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
<?php else : ?>
<p>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /><span class="guestinfo">昵称<span class="red">*</span></span>
</p>
<p>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /><span class="guestinfo">邮箱<span class="red">*</span></span>
</p>
<p>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /><span class="guestinfo">网址</span>
</p>
<?php endif; ?>
<div id="textareaID" class="textarea"><textarea name="comment" id="comment" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
<div class="editor_tools">
<a id="comment-smiley" href="javascript:;">表情</a>
<a href="javascript:SIMPALED.Editor.strong()">加粗</a>
<a href="javascript:SIMPALED.Editor.del()">删除线</a>
<a href="javascript:SIMPALED.Editor.underline()">下划线</a>
<a href="javascript:SIMPALED.Editor.ahref()">链接</a>
<a href="javascript:SIMPALED.Editor.code()">代码</a>
<a href="javascript:SIMPALED.Editor.quote()">引用</a>
</div>
<div id="smileys"><?php include('smilies.php'); ?></div>
</div>


<p><input name="submit" type="submit" id="submit" tabindex="5" value="SUBMIT（Ctrl + Enter）" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>
</div>
		  
		<?php endif; ?>
	
</div>