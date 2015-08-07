<?php  
$_thumbnail = false;
if( has_post_thumbnail() || !dopt('d_thumbnail_b') ){
	$_thumbnail = true;
}
?>
<div class="article well clearfix">
	<?php if( is_sticky() ) echo '<i class="fa fa-bookmark article-stick visible-md visible-lg"></i>';?>
	
	<!-- 大型设备文章属性 -->
	<section class="hidden-xs">
		<div class="title-article">
			<?php  if( !is_category() ) {$category = get_the_category();
		        if($category[0]){echo '<a class="label label-important" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'<i class="label-arrow"></i></a>';}
	        };?>
			<h2><a href="<?php the_permalink() ?>">
				<?php the_title();?>
			</a></h2>
		</div>
		<div class="content-article clearfix">
		<?php if( $_thumbnail ){ ?>
		<div class="focus"><a target="_blank" href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=123&w=200&q=90&zc=1&ct=1" alt="<?php the_title(); ?>" /></a></div>
		<?php } ?>
		<span class="note"> <?php echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 140, '...'); ?></span>
		</div>
		<div class="tag-article">
		<?php if( !$_time ){ ?><span class="label label-zan"><i class="fa fa-clock-o"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span><?php } ?>
			<span class="label label-zan"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
			<span class="label label-zan"><i class="fa fa-eye"></i> <?php if(function_exists('the_views')) { the_views(); } ?></span>
		<a class="btn btn-danger pull-right read-more" href="<?php the_permalink() ?>"  title="详细阅读 <?php the_title(); ?>">阅读全文 <span class="badge"><?php comments_number( '0', '1', '%' ); ?></span></a>
		</div>
	</section>
	<!-- 大型设备文章属性结束 -->

	<!-- 小型设备文章属性 -->
	<section class="visible-xs">
		<div class="title-article">
			<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		</div>
		<p>
			<i class="fa fa-calendar"></i> <?php the_time('n'); ?>-<?php the_time('d'); ?>
			<i class="fa fa-eye"></i> <?php if(function_exists('the_views')) { the_views(); } ?>
		</p>
		<div class="content-article">					
			<figure class="thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></figure>							
			<div class="alert alert-zan">					
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); ?>
			</div>
		</div>
		<a class="btn btn-danger pull-right read-more btn-block" href="<?php the_permalink() ?>"  title="详细阅读 <?php the_title(); ?>">阅读全文 <span class="badge"><?php comments_number( '0', '1', '%' ); ?></span></a>
	</section>
	<!-- 小型设备文章属性结束 -->

</div>

