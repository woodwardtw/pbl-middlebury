<?php
/**
 * Blank content partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
;?>
<div class="row facet-row">
<?php while ( have_posts() ): the_post(); ?>
<div class='col-md-6'>
<div class='facet-item'>
<a class='facet-title' href="<?php the_field('link'); ?>"><?php the_title(); ?></a>
<div class='facet-body'>
<?php the_field('description');?>
</div>
</div>
</div>
<?php endwhile; ?>
</div>