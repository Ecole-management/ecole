<?php
		//css
		$css_arr = array('bootplus.css','bootstrap-responsive.css','font-awesome.min.css','app.css');
    	Assets::add_css( $css_arr);


		//<!-- Load JavaScript Libraries -->
		$js_arr = array('jquery.min.js','bootstrap.js');
    	Assets::add_js($js_arr);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      	<meta name="viewport" content="width=device-width, initial-scale=1.0">
      	<meta name="description" content="">
      	<meta name="author" content="">

		<title>Ecole - student management</title>

		<?php echo Assets::css();?>
	</head>
	<body>