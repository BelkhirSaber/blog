<?php $baseUrlAssets = $config->get('app.url') . 'blog/assets/' ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<!-- <link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" /> -->

	<title><?= $page_title ?></title>
	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- main css -->
	<link href="<?=$baseUrlAssets?>admin/css/main.css" rel="stylesheet">

	<!-- main adminkit style -->
	<!-- <link href="<?=$baseUrlAssets?>css/admin/app.css" rel="stylesheet">
	<link href="<?=$baseUrlAssets?>css/admin/style.css" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<!-- js tagify -->
	<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
	<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

	<!-- taostify -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

	<style>
		.ck-editor__editable[role="textbox"] {
				/* editing area */
				min-height: 40vh;
		}
		.ck-content .image {
				/* block images */
				max-width: 80%;
				margin: 20px auto;
		}
	</style>

	<!-- rtl style -->
	<!-- <link href="css/custom.css" rel="stylesheet"> -->
</head>