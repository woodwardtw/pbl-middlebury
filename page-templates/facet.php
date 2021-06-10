<?php
/**
 * Template Name: Facet Search
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-3">
				<?php echo facetwp_display( 'facet', 'search');?>
				<div class='facet-box'>
					<h2>Discipline</h2>
					<div class='facet-select'>
						<?php echo facetwp_display( 'facet', 'disciplines');?>
					</div>
				</div>
				<div class='facet-box'>
					<h2>Types</h2>
					<div class='facet-select'>
						<?php echo facetwp_display( 'facet', 'categories');?>
					</div>
				</div>	
				<div class='facet-box'>
					<h2>Design Elements</h2>
					<div class='facet-select'>
						<?php echo facetwp_display( 'facet', 'design_elements');?>
					</div>
				</div>
				<div class='facet-box'>
					<h2>Teaching Practices</h2>
					<div class='facet-select'>					
						<?php echo facetwp_display( 'facet', 'teaching');?>
					</div>
				</div>				
			</div>

			<div class="col-md-9 content-area" id="primary">

				<main class="site-main" id="main" role="main">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'facet' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
					?>			

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
