<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Author: GWS and Tee Jay
 *
 */
?>

        <?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>


<div class="mx-auto" style="height: 35px;"></div>
<div class="container">
<div class="row">
<div class="col-md-8">
<hr>
        <h6>image goes here</h6>

<hr>
	    <?php echo __('You have found the page of wonders, to get back to wherever you want, please click on another link! Thank you!', 'wp_babobski'); ?>


</div>

<!-- Sidebar Column - Right Hand Side -->

        <?php BsWp::get_template_parts( array( 'parts/shared/sidebar' ) ); ?>

</div>
<div class="mx-auto" style="height: 35px;"></div>
</div>

        <?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
