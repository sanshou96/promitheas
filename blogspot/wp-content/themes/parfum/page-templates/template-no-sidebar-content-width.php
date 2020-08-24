<?php
/**
 * Template Name: No sidebar, content width
 *
 * @package Parfum
 *
 * @since Parfum 1.0
 */

get_header();
?>

<div id="primary" class="site-content">
	<div id="content" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( PARFUM_TEMPLATE_PARTS . 'content-page' );
			comments_template( '', true );
		endwhile; // end of the loop.
		?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php
get_footer();
