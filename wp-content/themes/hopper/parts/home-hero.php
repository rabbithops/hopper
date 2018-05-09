<?php
	$homepage_heading = get_field('homepage_heading', 'options');
	$wedding_date = get_field('wedding_date', 'options', false, false);
	$wedding_date = new DateTime($wedding_date);
	$background_image = get_field('background_image', 'options');
	$user = wp_get_current_user();
?>

<div class="homepage-hero">
	<div class="image-takeover" <?php if($background_image) : ?> style="background-image: url('<?php echo $background_image[url]; ?>');" <?php endif; ?>">

		<div class="content"><?php if($homepage_heading) : ?>
				<div class="guest-welcome"><?php echo 'Welcome, <strong>'.$user->first_name.'</strong>!'; ?></div>
				<div class="wedding-title"><?php echo $homepage_heading; ?></div>
			<?php endif; ?>

			<?php if($wedding_date) : ?>
				<div class="wedding-date"><?php echo $wedding_date->format('F j, Y'); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>