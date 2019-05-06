<ul class="sidenav" id="slide-out">
	<?php if (OAuth::check()): ?>
	<li>
		<div class="user-view">
			<div class="background">
				<?= Asset::img('menubg.png', ['alt' => 'background', 'style' => 'max-width: 100%;']); ?>
			</div>
			<?= Html::anchor('/', Asset::img(Oauth::get(OAuth::ICON_KEY), ['alt' => 'icon', 'class' => 'circle'])); ?>
			<span class="white-text name"><?= OAuth::get(OAuth::USER_NAME_KEY); ?></span>
			<span class="white-text email">@<?= OAuth::get(OAuth::SCREEN_NAME_KEY); ?></span>
		</div>
	</li>
	<?php endif; ?>
	<li><?= Html::anchor('/about', '<i class="material-icons">help_outline</i>ABOUT'); ?></li>
	<?php if (OAuth::check()): ?>
	<li><?= Html::anchor('/games', '<i class="material-icons">import_contacts</i>戦績'); ?></li>
	<li><?= Html::anchor('/edit/step1', '<i class="material-icons">add</i>戦績入力'); ?></li>
	<?php endif; ?>
	<li><div class="divider"></div></li>
	<?php if (OAuth::check()): ?>
	<li><?= Html::anchor('/', 'マイページ'); ?></li>
	<li><?= Html::anchor('/oauth/logout', 'ログアウト'); ?></li>
	<?php else: ?>
	<li><?= Html::anchor('/oauth/login', 'ログイン'); ?></li>
	<?php endif; ?>
</ul>
<header class="navbar-fixed">
	<nav>
		<div class="nav-wrapper">
			<div class="hide-on-med-and-down left">
				<?php if (OAuth::check()): ?>
				<?= Html::anchor('/', 'LogRicola', ['class' => 'breadcrumb']); ?>
				<?php else: ?>
				<?= Html::anchor('/about', 'LogRicola', ['class' => 'breadcrumb']); ?>
				<?php endif; ?>
				<?php foreach ($breadcrumbs ?? [] as $uri => $name): ?>
				<?= Html::anchor($uri, $name, ['class' => 'breadcrumb']); ?>
				<?php endforeach; ?>
			</div>
			<?= Html::anchor(Input::uri(), $title ?? '', ['class' => 'hide-on-large-only', 'style' => 'font-size: 1.3em;']); ?>
			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><?= Html::anchor('/about', 'ABOUT'); ?></li>
				<?php if (OAuth::check()): ?>
				<li><?= Html::anchor('/games', '戦績'); ?></li>
				<li><?= Html::anchor('/edit/step1', '戦績入力'); ?></li>
				<?php endif; ?>
				<?php if (OAuth::check()): ?>
				<li><?= Html::anchor('/', 'マイページ'); ?></li>
				<li><?= Html::anchor('/oauth/logout', 'ログアウト'); ?></li>
				<?php else: ?>
				<li><?= Html::anchor('/oauth/login', 'ログイン'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</header>
