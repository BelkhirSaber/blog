<?php $baseUrlAssets = $config->get('app.url') . 'blog/assets/' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />
  <title><?= $page_title ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" href="<?php echo $baseUrlAssets  ?>favicon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>fonts/icomoon/style.css">
	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>css/tiny-slider.css">
	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>css/aos.css">
	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>css/glightbox.min.css">
	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>css/style.css">

	<link rel="stylesheet" href="<?php echo $baseUrlAssets  ?>css/flatpickr.min.css">

	<style>
		.image_resized > img{
			width: calc(100vw - 3rem);
		}
		@media (min-width: 768px) {
			.image_resized > img{
				width: 100%;
			}

			.image-style-align-left{
				display: inline-block;
				margin-right: 1vw;
			}

			.image-style-align-right{
				display: inline-block;
				margin-left: 1vw;
			}
		}
	</style>
</head>
<body>