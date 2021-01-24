<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 4.4.1
 * @autor 		Babobski
 */
?>
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="mx-auto" style="height: 35px;"></div>
<div class="container">
<div class="row">
<div class="col-md-8">

<div class="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<h2>
			<?php the_title(); ?>
		</h2>
		<?php the_content(); ?>
		<?php comments_template( '', true ); ?>

	<?php endwhile; ?>
</div>
	</div>

<!-- Sidebar Column - Right Hand Side -->

        <?php BsWp::get_template_parts( array( 'parts/shared/sidebar' ) ); ?>

</div>
<div class="mx-auto" style="height: 35px;"></div>
</div>

        <?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
