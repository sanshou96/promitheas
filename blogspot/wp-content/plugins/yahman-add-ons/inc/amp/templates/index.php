<?php
defined( 'ABSPATH' ) || exit;

$amp = array();

$amp['blog_title'] = esc_html( get_bloginfo('name') , 'display' );
$amp['home_url'] = esc_url( home_url( '/' ) );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php
	echo yahman_addons_amp_template_style_sheet();
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header id="#top" class="body_header" itemscope itemtype="https://schema.org/WPHeader">
		<div class="header_wrap wrap_frame">
			<h1 class="site_title"><a href="<?php echo $amp['home_url'] ?>" rel="home"><?php echo $amp['blog_title'] ?></a></h1>
		</div>
	</header>
	<article id="post_body" class="post_body clearfix wrap_frame" itemprop="articleBody">
		<?php
		while ( have_posts() ) : the_post();
			$amp['author_id'] = get_the_author_meta( 'ID' );
			$amp['nickname'] = get_the_author_meta('nickname');

			$amp['categories'] = NULL;
            //$get_page_id = get_the_ID();
			$amp['categories'] = get_the_category( get_the_ID() );
			$amp['tags'] = get_the_tags( get_the_ID() );


			?>
			<header class="post_header">
				<h1 class="post_title"><?php echo get_the_title(); ?></h1>
				<div class="meta_wrap f_box ai_c jc_sb">
					<div>
						<a href="<?php echo esc_url(get_author_posts_url( $amp['author_id'] )); ?>" class="f_box ai_c">
							<img src="<?php echo esc_url( get_avatar_url( $amp['author_id'] , array("size"=>96 )) ) ; ?>" width="32" height="32" class="br50" alt="<?php echo $amp['nickname']; ?>" decoding="async" />
							<span class="nickname">
								<?php echo $amp['nickname']; ?>
							</span>
						</a>
					</div>
					<div>
						<span class="post_date">
							<?php echo get_the_date(); ?>
						</span>
					</div>
				</div>
			</header>
			<div class="post_content">
				<?php the_content(); ?>
			</div>
			<footer class="post_footer">
				<?php
				
				if(!empty($amp['categories'])){
					echo '<div class="post_cats mb_L">';
					echo '<span class="post_cats_title">';
					esc_html_e('Category' , 'yahman-add-ons');
					echo ':</span>';
					foreach($amp['categories'] as $post_category) {
						echo '<a href="'.esc_url(get_category_link($post_category->cat_ID)).'" rel="category" class="post_cat">'. esc_html($post_category->cat_name). '</a>';
					}
					echo '</div>';
				}

				
				if(!empty($amp['tags']) ){
					echo '<div class="post_tags mb_L">';
					echo '<span class="post_cats_title">';
					esc_html_e('Tags' , 'yahman-add-ons');
					echo ':</span>';
					foreach($amp['tags'] as $post_tag){
						echo '<a href="'.esc_url(get_tag_link($post_tag->term_id)).'" rel="tag" class="post_tag">#'.esc_html($post_tag->name).'</a>';
					}
					echo '</div>';
				}

				
				$amp['prevpost'] = get_adjacent_post('', '', true); 
				$amp['nextpost'] = get_adjacent_post('', '', false); 

				if($amp['prevpost'] || $amp['nextpost']){
					echo '<nav class="post_navigation f_box jc_sb mb_L" role="navigation">';
					if ($amp['prevpost']) { 

						echo '<div class="adjacent adjacent_prev mra"><p>'.esc_html__( 'Prev', 'yahman-add-ons' ).'</p><a href="' . esc_url( get_permalink($amp['prevpost']->ID) ) . '" title="' . get_the_title( $amp['prevpost']->ID ) . '">';

						echo '<p class="adjacent_title adjacent_title_prev">' . esc_html( get_the_title($amp['prevpost']->ID) ) . '</p></a></div>';
					}

					if ( $amp['nextpost'] ) { 
						echo '<div class="adjacent adjacent_next mla ta_r"><p>'.esc_html__( 'Next', 'yahman-add-ons' ).'</p><a href="' . esc_url( get_permalink($amp['nextpost']->ID) ) . '" title="'. get_the_title( $amp['nextpost']->ID ) . '">';

						echo '<p class="adjacent_title adjacent_title_next">' . esc_html( get_the_title($amp['nextpost']->ID) ) . '</p></a></div>';

					}


					echo '</nav>';
				}

				?>
				<div class="post_comment mb_L">
					<?php
					echo '<a href="' . esc_url( get_permalink() ). '#comment" title="'. get_the_title() . '">';
					esc_html_e('Leave a Comment', 'yahman-add-ons');
					echo '</a>';
					?>
				</div>
			</footer>
		<?php endwhile; ?>
	</article>
	<footer id="" class="body_footer" itemscope itemtype="https://schema.org/WPFooter">
		<div class="footer_wrap wrap_frame">
			<div class="">&copy;<?php echo esc_html( date('Y') ) .' <a href="'. $amp['home_url'] .'">'.$amp['blog_title'].'</a>'; ?></div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>


