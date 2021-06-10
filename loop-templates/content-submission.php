<?php
/**
 * Submission partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<?php the_content(); ?>
	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php  
		$settings = array(
			'id' => 'resource-submission',
			'post_id' => 'new_post',
			//'fields' => array('type','your_name'),
	        'post_id'       => 'new_post',
	        'post_title'   => true,
			'post_content'	=> false,
	        'new_post'      => array(
	            'post_type'     => 'resource',
	        ),
	        'submit_value'  => 'Add your resource.',

		);
		acf_form($settings);?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
