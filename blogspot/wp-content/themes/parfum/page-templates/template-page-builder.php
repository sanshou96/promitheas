<?php
/**
 * Template Name: GT Page builder (Theme header, Theme footer)
 *
 * @package Parfum
 */

get_header();
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php
			while ( have_posts() ) {

				the_post();

				?>
				<div class="entry-content">

					<?php the_content(); ?>

				</div><!-- .entry-content -->
				<?php

			}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
