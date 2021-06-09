<?php
/**
 * Partial template for content in home.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php echo pbl_entry_block();?>
		<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php //the_field('introduction');?>
		<?php //echo pbl_main_links_repeater();?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php echo pbl_intro_blocks_repeater();?>
		<div class='row bucks-row'>
			<div class="col-md-6">
				<div class="element-column design">
					<h2>Design Elements</h2>
					<?php echo pbl_design_elements();?>
				</div>
			</div>
			<div class="col-md-6">
					<div class="element-column teaching">
						<h2>Teaching Practices</h2>
						<?php echo pbl_teaching_practices();?>
					</div>
			</div>
		</div>
		<?php //the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
