<?php
/**
 * Partial template for content in facet.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title facet-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>


	<?php echo facetwp_display( 'template', 'blog_posts' );?>
	<?php echo do_shortcode('[facetwp pager="true"]') ;?>
	<button class="btn btn-alp btn-dark" value="Reset" onclick="FWP.reset()" class="facet-reset" />Reset Filters</button>

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
