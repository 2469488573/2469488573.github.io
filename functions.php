<?php
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );
add_filter('the_content', 'addhighslideclass_replace');
function addhighslideclass_replace ($content)
{ global $post;
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
$replacement = '<a$1href=$2$3.$4$5 class="fancybox" rel="fancybox" $6>$7</a>';
$content = preg_replace($pattern, $replacement, $content);
return $content;
}
function past_date() {
	global $post;
	$suffix = ' AGO';
	$day = ' D';
	$hour = ' H';
	$minute = ' M';
	$second = ' S';
	$m = 60;
	$h = 3600;
	$d = 86400;
	$post_time = get_post_time('G', true, $post);
	$past_time = time() - $post_time;
	if ($past_time < $m) {
		$past_date = $past_time . $second;
	} else if ($past_time < $h) {
		$past_date = $past_time / $m;
		$past_date = floor($past_date);
		$past_date .= $minute;
	} else if ($past_time < $d) {
		$past_date = $past_time / $h;
		$past_date = floor($past_date);
		$past_date .= $hour;
	} else if ($past_time < $d * 30) {
		$past_date = $past_time / $d;
		$past_date = floor($past_date);
		$past_date .= $day;
	} else {
		echo 'LONG AGO';
		return;
	} 
	echo $past_date . $suffix;
	}
	add_filter('past_date', 'past_date');
add_theme_support( 'post-formats', array( 'status') );
/*总浏览数*/
function lo_all_view(){
    global $wpdb;
    $count=0;
    $views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'"); 
    foreach($views as $key=>$value)
    {
        $meta_value=$value->meta_value;
        if($meta_value!='')
        {
            $count+=(int)$meta_value;
        }
    }
    return $count;
}
function custom_the_views($post_id, $echo=true, $views=' views') {
	$count_key = 'views';
	$count = get_post_meta($post_id, $count_key, true);
	if ($count == '') {
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
		$count = '0';
	}
	if ($echo)
		echo number_format_i18n($count) . $views;
	else
		return number_format_i18n($count) . $views;
}
function set_post_views() {
	global $post;
	$post_id = $post->ID;
	$count_key = 'views';
	$count = get_post_meta($post_id, $count_key, true);
	if (is_single() || is_page()) {
		if ($count == '') {
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');
		} else {
			update_post_meta($post_id, $count_key, $count + 1);
		}
	}
}
add_action('get_header', 'set_post_views');
function oddeven_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}
add_filter ( 'post_class' , 'oddeven_post_class' );
global $current_class;
$current_class = 'odd';
// post thumbnail support 缩略图支持
	add_theme_support( 'post-thumbnails' );
function post_thumbnail( $width = 140,$height = 100 ){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_timthumb = '<a href="'.get_permalink().'"><img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" title="'.get_the_title().'"/></a>';
        echo $post_timthumb;
    } else {
			$content = $post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo("template_url").'/timthumb.php?w=140&amp;h=100&amp;src='.$strResult[1][0].'" title="'.get_the_title().'" alt="'.get_the_title().'"/></a>';
			} else {
				echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo('template_url').'/images/random/'.rand(1,10).'.jpg" title="'.get_the_title().'" alt="'.get_the_title().'"/></a>';
			}
		}
	}
function dopt($e){
    return stripslashes(get_option($e));
}
    remove_action( 'wp_head',   'feed_links_extra', 3 ); 
    remove_action( 'wp_head',   'rsd_link' ); 
    remove_action( 'wp_head',   'wlwmanifest_link' ); 
    remove_action( 'wp_head',   'index_rel_link' ); 
    remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
    remove_action( 'wp_head',   'wp_generator' ); 
	//站点描述
    add_action('wp_head','dtheme_description');

function dtheme_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = dopt('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\">\n";
}
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

        remove_action('pre_post_update','wp_save_post_revision' );


	// Truncated text
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
	{
	 if($code == 'UTF-8')
	 {
	 $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	 preg_match_all($pa, $string, $t_string);
	 if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
	 return join('', array_slice($t_string[0], $start, $sublen));
	 }
	 else
	 {
	 $start = $start*2;
	 $sublen = $sublen*2;
	 $strlen = strlen($string);
	 $tmpstr = '';
	 for($i=0; $i<$strlen; $i++)
	 {
	 if($i>=$start && $i<($start+$sublen))
	 {
	 if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
	 else $tmpstr.= substr($string, $i, 1);
	 }
	 if(ord(substr($string, $i, 1))>129) $i++;
	 }
	 if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
	 return $tmpstr;
	 }
	}
	
	 /* 禁用自动保存 */
	remove_action('pre_post_update','wp_save_post_revision'); 
	add_action('wp_print_scripts','disable_autosave'); 
	function disable_autosave(){  wp_deregister_script('autosave'); }
	
	/* Mini Pagenavi v1.0 by Willin Kan. */
	function pagenavi( $p = 2 ) {if ( is_singular() ) return; global $wp_query, $paged;$max_page = $wp_query->max_num_pages;if ( $max_page == 1 ) return; if ( empty( $paged ) ) $paged = 1;echo '<span class="pagescout">Page: ' . $paged . ' of ' . $max_page . ' </span> '; if ( $paged > $p + 1 ) p_link( 1, '第 1 页' );if ( $paged > $p + 2 ) echo '... ';for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );}if ( $paged < $max_page - $p - 1 ) echo '... ';if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );}
	function p_link( $i, $title = '' ) { if ( $title == '' ) $title = "第 {$i} 页";echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";}
	
	// comment_mail_notify v1.0 by willin kan. (所有回覆都發郵件)
	function comment_mail_notify($comment_id) {
	$comment = get_comment($comment_id);
	$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
	$spam_confirmed = $comment->comment_approved;
	if (($parent_id != '') && ($spam_confirmed != 'spam')) {
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
	$to = trim(get_comment($parent_id)->comment_author_email);
	$subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
	$message = '

	<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
	<p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
	<p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
	. trim(get_comment($parent_id)->comment_content) . '</p>
	<p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
	. trim($comment->comment_content) . '<br /></p>
	<p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
	<p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	<p>(此邮件为系统自动发送，请勿直接回复.)</p>
	</div>';

	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	  }
	}
	add_action('comment_post', 'comment_mail_notify');
	// Time Ago by Fanr
	function time_ago( $type = 'commennt', $day = 30 ) {
		$d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
		$timediff = time() - $d('U');
		if ($timediff <= 60*60*24*$day){
		echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
		}
		if ($timediff > 60*60*24*$day){
		echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
		};
	}

	
	


		
	
	
		
	//去除WordPress自动插入原生相册样式代码
	function remove_css_gal() {
	return "\n" . '<div class="gallery">';
	}
	add_filter( 'gallery_style', 'remove_css_gal', 9 );
	
	
	// 自定义头像 =	
	function fb_addgravatar( $avatar_defaults ) {
	$myavatar = get_bloginfo('template_directory') . '/images/defaultavatar.png';
	  $avatar_defaults[$myavatar] = '自定义头像';
	  return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'fb_addgravatar' );
	
	
	
	
	// custom menu support WP菜单
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	 register_nav_menus(
      array(
         'header-menu' => __( '导航自定义菜单' )
      )
   );
	}


	
	// enable threaded comments
	function enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
		}
	}
	add_action('get_header', 'enable_threaded_comments');

	
	// removes detailed login error information for security 移除wordpress登陆漏洞
	add_filter('login_errors',create_function('$a', "return null;"));
	
	
	//禁用半角符号自动转换为全角
	remove_filter('the_content', 'wptexturize');
	
	
	// 只搜索文章，排除页面
	add_filter('pre_get_posts','search_filter');
	function search_filter($query) {
	if ($query->is_search) {$query->set('post_type', 'post');}
	return $query;}
	
	
	// 新窗口打开评论链接
	function hu_popuplinks($text) {
		$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
		return $text;
	}
	add_filter('get_comment_author_link', 'hu_popuplinks', 6);
	
	
	// 反全英文垃圾评论
	function scp_comment_post( $incoming_comment ) {
		$pattern = '/[一-龥]/u';
		
		if(!preg_match($pattern, $incoming_comment['comment_content'])) {
			err( "You should type some Chinese word (like \"你好\") in your comment to pass the spam-check, thanks for your patience! 您的评论中必须包含汉字!" );
		}
		return( $incoming_comment );
	}
	add_filter('preprocess_comment', 'scp_comment_post');
	


	
	
	
	
	// custom excerpt ellipses for 2.9+  Read More的截断及跳转
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');	
	// no more jumping for read more link
	function remove_more_jump_link($link) {return preg_replace('/#more-\d+/i','',$link);}
	add_filter('the_content_more_link', 'remove_more_jump_link');
	
	
	/**
	 * when comment check the comment_author comment_author_email
	 * @param unknown_type $comment_author
	 * @param unknown_type $comment_author_email
	 * @return unknown_type
	 *防止访客冒充博主发表评论 by Winy
	 */
	function CheckEmailAndName(){
		global $wpdb;
		$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
		$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
		if(!$comment_author || !$comment_author_email){
			return;
		}
		$result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
		if ($result_set) {
			if ($result_set[0]->display_name == $comment_author){
				err(__('警告: 您不能用这个昵称，因为这是博主的昵称！'));
			}else{
				err(__('警告: 您不能使用该邮箱，因为这是博主的邮箱！'));
			}
			fail($errorMessage);
		}
	}
	add_action('pre_comment_on_post', 'CheckEmailAndName');
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
function is_pjax(){
	return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'];
}

function devecomment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author"><?php echo get_avatar( $comment, $size = '32'); ?></div>
			<div class="comment-head">
				<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?> : </span>
				<div class="date"><?php echo time_ago(); ?><?php if(!$parent_id = $comment->comment_parent) {printf('&nbsp;#%1$s', ++$commentcount);} ?></div>
				<div class="comment-entry"><span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '@Ta','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span> <?php comment_text() ?> </div>
			</div>

     </div>
<?php
}
////////嵌套ping
		function devepings($comment, $args, $depth) {
			   $GLOBALS['comment'] = $comment;
		?>
			<li id="comment-<?php comment_ID(); ?>">
				<div class="pingdiv">
					<?php comment_author_link(); ?>
				</div>
		<?php }

	
include_once('themeset.php');



?>