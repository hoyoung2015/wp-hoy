<?php
/**
 * Functions 整体函数调用
 *
 * @package    YEAHZAN
 * @subpackage ZanBlog
 * @since      ZanBlog 2.1.0
 *
 */

// 自定义theme路径
define( 'THEMEPATH', TEMPLATEPATH . '/' );

// 自定义includes路径
define( 'INCLUDESEPATH', THEMEPATH . 'includes/' );

// 自定义widgets路径
define( 'WIDGETSPATH', INCLUDESEPATH . 'widgets/' );

// 自定义classes路径
define( 'CLASSESPATH', INCLUDESEPATH . 'classes/' );

// 自定义admin路径
define( 'ADMINPATH', INCLUDESEPATH . 'admin/' );

// 加载主题函数文件
require_once( INCLUDESEPATH . 'theme-functions.php' );

// 加载小工具文件
require_once( WIDGETSPATH . 'widgets.php' );

// 加载主题选项文件
require_once(INCLUDESEPATH . 'theme-options.php');

// 加载短代码文件
require_once(INCLUDESEPATH . 'shortcodes.php');

// 加载自定义登录文件
require_once(ADMINPATH . 'custom-login.php');

// 加载自定义用户资料文件
require_once(ADMINPATH . 'custom-user.php');

function deel_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}
function dopt($e){
		return stripslashes(get_option($e));
	}
//输出缩略图地址
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 10);
			echo get_bloginfo('template_url');
			echo '/img/pic/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//echo '/img/thumbnail.png';
		}
	};
	echo $post_thumbnail_src;
}
if ( ! function_exists( 'deel_views' ) ) :
function deel_record_visitors(){
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'deel_record_visitors');  

function deel_views($after=''){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  echo $views, $after;
}
endif;
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
?>