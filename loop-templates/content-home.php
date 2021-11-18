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


		<?php echo pbl_intro_blocks_repeater();?>
		<div class="row blocks-row d-flex justify-content-between">
			<div class="col-md-4">
				<div class="intro-block">
					<h2>Learn Along with Us!</h2>
					<div class="intro-description">
						<p>We will be posting new content on our blog as we continue our PBL journey. We invite you to join us as we learn and grow. You can see our most recent posts here or <a href='?post_type=post'>explore our archive</a>.</p>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="intro-block updates">
					<h2>PBL Updates</h2>
					<div class="intro-description">
						<ul>
							<?php pbl_homepage_news_posts();?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>

		<div class='row bucks-row'>
			<div class="col-md-6" id="design-elements">
				<div class="element-column design">
					<h2>Design Elements</h2>
					<?php echo pbl_design_elements();?>
				</div>
			</div>
			<div class="col-md-6" id="teaching-practices">
					<div class="element-column teaching">
						<h2>Teaching Practices</h2>
						<?php echo pbl_teaching_practices();?>
					</div>
			</div>

		</div>
		<?php //the_content(); ?>


	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
