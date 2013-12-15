<?php
	Assets::add_js( array( 'bootstrap.min.js', 'jwerty.js'), 'external', true);
?>
<?php echo theme_view('partials/_header'); ?>

<?php echo theme_view('partials/_nav'); ?>

		<div class="container-fluid">
      		<div class="row-fluid">
      			<div class="span12">

      			</div>
      		</div>
      		<div class="row-fluid">
				<div class="span12">
					<section>
				        <?php echo Template::message(); ?>

				        <?php echo isset($content) ? $content : Template::content(); ?>
				    </section>
				</div>
			</div>
		</div>

<?php echo theme_view('partials/_footer'); ?>
