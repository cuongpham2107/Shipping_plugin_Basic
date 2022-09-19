<div class="wrap">
	
	<?php settings_errors(); ?>
	<?php wp_enqueue_media()?> 
	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
		<h1><?php echo __('Setting Login','alecaddd-plugin') ?></h1>
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'custom_login_settings' );
					do_settings_sections( 'custom_login' );
					submit_button();
				?>
			</form>
			
		</div>
	</div>
</div>