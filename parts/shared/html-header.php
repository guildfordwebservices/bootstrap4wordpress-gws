<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
       <?php wp_title('-', true, 'right'); ?></title><span class="redactor-invisible-space"></span>
    </title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
		<?php wp_head(); ?>
  </head>
<?php if (is_admin_bar_showing()): ?>
		<style>
			.fixed-top{
				top: 32px;
			}
		</style>
	<?php endif ?>
