<footer id="zan-footer">
	<div class="container">

		<!-- 版权信息 -->
		<?php echo stripslashes( get_option( 'zan_footer' ) ); ?><a href="http://www.hoyoung.net"  target="_blank">Hoyung</a>   
		版权所有，保留一切权利·基于WordPress构建  	©2015·
		<!-- 版权信息结束 -->

		<!--统计代码-->
    <?php $analytics = get_option('zan_analytics');if ($analytics != "") : ?>
    	<?php echo stripslashes($analytics); ?>
    <?php endif ?>
    <!--统计代码结束-->

	</div>
</footer>

<!-- 回到顶端 -->
<div id="zan-gotop">
	<i class="fa fa-angle-up"></i>
</div>
<!-- 回到顶端结束 -->

<?php wp_footer(); ?>

</body>
</html>