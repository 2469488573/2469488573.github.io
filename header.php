<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name = "viewport" content ="initial-scale=1.0,user-scalable=no">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="format-detection" content="telephone=no"> 
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Posts" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Comments" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
<!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>

</head>
<body <?php body_class(); ?>>

<div id="wrap">
<div id="searchbox">
<form action="<?php bloginfo('home'); ?>" method="get" id="searchform"><div class="search-container"><div class="search-inner clearfix">
							<input name="s" type="text" class="google-input" value="输入关键词并回车" onmouseover="this.style.borderColor='#FF6600'" onmouseout="this.style.borderColor=''" onFocus="if (value =='输入关键词并回车'){value =''}" onBlur="if (value ==''){value='输入关键词并回车'}"/>
							<button class="google-submit" value="" type="submit" name="submit">
<span class="sbico">Google</span>
</button></div></div>
						</form>

</div>
<header id="header">  

  
    <h1><a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>" class="logo">
      <?php bloginfo('name');?>
      </a></h1>
	   
	   <div class="topsns">
	  <a href="#" class="showsearch" title="搜索"></a>
	  <a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss" target="_blank"></a>
	  <a href="http://xiaohudie.net" class="durex" title="小蝴蝶" target="_blank"></a>
	  <a href="http://weibo.com/leewenji" class="sina" title="新浪微博" target="_blank"></a>
	  <a href="https://plus.google.com/116339521172373137445?rel=author" class="googleplus" title="Google+" target="_blank"></a>
	  <a href="https://github.com/bigfalee/" class="github" title="github" target="_blank"></a>
	  <a href="http://zhihu.com/" class="zhihu" title="zhihu" target="_blank"></a>
	  <a href="http://linkedin.com/" class="linkedin" title="linkedin" target="_blank"></a>
 </div>
 </header>

