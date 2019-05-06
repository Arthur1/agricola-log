<head>
	<meta charset="utf-8">
	<title><?= $title ?? ''; ?> | LogRicola</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="theme-color" content="#ff9800">
	<?= Html::meta('description', $description ?? 'LogRicolaは、ツイッタラーのためのアグリコラ戦績管理サイトです。アグリコラの戦績を保存し、サマリー画像をTwitterに投稿できます。'); ?>
	<meta name="author" content="Arthur">
	<!-- OGP [ -->
	<!--
	<meta property="og:title" content="<?= $title ?? ''; ?> | LogRicola">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= Uri::current(); ?>">
	<meta property="og:site_name" content="LogRicola">
	<meta property="og:description" content="<?= $description ?? 'LogRicolaは、ツイッタラーのためのアグリコラ戦績管理サイトです。アグリコラの戦績を保存し、サマリー画像をTwitterに投稿できます。'; ?>">
	<?php if (isset($ogp_image_large)): ?>
	<meta property="twitter:card" content="summary_large_image">
	<meta property="og:image" content="<?= ''; //Asset::get_file($ogp_image_large, 'img'); ?>">
	<?php elseif (isset($ogp_image)): ?>
	<meta property="twitter:card" content="summary">
	<meta property="og:image" content="<?= ''; //Asset::get_file($ogp_image, 'img'); ?>">
	<?php else: ?>
	<meta property="twitter:card" content="summary">
	<meta property="og:image" content="<?= ''; //Uri::create('/apple-touch-icon.png'); ?>">
	<?php endif; ?>
	-->
	<!-- OGP ] -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<?= Asset::css('app.css', [], null, true); ?>
	<?= Asset::render('add_css', true); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137369865-3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-137369865-3');
	</script>
</head>
