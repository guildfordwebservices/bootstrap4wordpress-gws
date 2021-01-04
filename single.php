<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div class="content">
		<h2>
			<?php the_title(); ?>
		</h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
			<?php the_date(); ?> <?php the_time(); ?>
		</time>
		<?php comments_popup_link(__('Leave a Comment', 'wp_babobski'), __('1 Comment', 'wp_babobski'), __('% Comments', 'wp_babobski')); ?>
		<?php the_content(); ?>

		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
			<h3>
				<?php echo __('About', 'wp_babobski'); ?> <?php echo get_the_author() ; ?>
			</h3>
			<?php the_author_meta( 'description' ); ?>
		<?php endif; ?>

		<?php comments_template( '', true ); ?>

	</div>

<?php endwhile; ?>

</div>

<!-- Sidebar Column - Right Hand Side -->


        <?php BsWp::get_template_parts( array( 'parts/shared/sidebar' ) ); ?>

</div>
<div class="mx-auto" style="height: 35px;"></div>
</div>

        <?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
