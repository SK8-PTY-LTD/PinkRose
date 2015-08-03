<?php
/**
 * The template for displaying the footer.
 *
 * @package Sela
 */
?>

<style type='text/css'>
.header{
   position: relative;
   float: left;
   left: 9.50%;
   width: 81.00%;

}
.wrapper{
   position: relative;
   float: left;
   left: 9.50%;
   width: 81.00%;

  
}
.left1{
   position: relative;
   float: left;
   left: 0.50%;
   width: 33.00%;

}
.left1img{
   position: relative;
   float: left;
   left: 0.50%;
   width: 33.00%;

}
.left2{
   position: relative;
   float: left;
   left: 1.50%;
   width: 32.00%;
 
}
.right{
   position: relative;
   float: right;
   right: 0.50%;
   width: 32.00%;
  
}
.footer{
   position: relative;
   float: left;
   left: 9.50%;
   width: 81.00%;
  
}

</style>
	<?php get_sidebar( 'footer' ); ?>
	


<footer id="colophon" class="site-footer">
		<?php if ( has_nav_menu ( 'social' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links', ) ); ?>
		<?php endif; ?>

<!-- .site-info -->	

<!-- Customise footer -->


    <div class="wrapper">
        <div class="left1">
	    <img src="http://pinkrose.me/wp-content/uploads/2015/04/phonelogo2.png" alt="HotLine" width="50" height="50">	
            <h3>Hotline</h3>
	    <h3>0426 067 777</h3>
        </div>
        <div class="left2">
	    <img src="http://pinkrose.me/wp-content/uploads/2015/04/wechat2.png" alt="Wechat" width="50" height="50">
           <h3>Wechat<h3> 
	<h3>sydpinkrose<h3>

        </div>
        <div class="right">
	    <img src="http://pinkrose.me/wp-content/uploads/2015/04/qq2.png" alt="QQ" width="50" height="41">
            <h3>QQ<h3>
           <h3>1055717559<h3>
        </div> 
    </div>
 <img src="http://pinkrose.me/wp-content/uploads/2015/05/footer.jpg" alt="Contact Us" width="1200">


	
<?php wp_footer(); ?>

</body>
</html>