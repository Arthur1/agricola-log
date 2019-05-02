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
	<li><?= Html::anchor('/', '<i class="material-icons">home</i>TOP'); ?></li>
	<?php if (OAuth::check()): ?>
	<li><?= Html::anchor('/games', '<i class="material-icons">star_rate</i>戦績'); ?></li>
	<li><?= Html::anchor('/edit', '<i class="material-icons">find_in_page</i>戦績入力'); ?></li>
	<li><div class="divider"></div></li>
	<?php endif; ?>
	<?php if (OAuth::check()): ?>
	<li><?= Html::anchor('/home', 'マイページ'); ?></li>
	<?php else: ?>
	<li><?= Html::anchor('/login', 'ログイン'); ?></li>
	<?php endif; ?>
</ul>
<header class="navbar-fixed">
	<nav>
		<div class="nav-wrapper">
			<div class="hide-on-med-and-down left">
				<?= Html::anchor('/', 'LogRicola', ['class' => 'breadcrumb']); ?>
				<?php foreach ($breadcrumbs ?? [] as $uri => $name): ?>
				<?= Html::anchor($uri, $name, ['class' => 'breadcrumb']); ?>
				<?php endforeach; ?>
			</div>
			<?= Html::anchor(Input::uri(), $title ?? '', ['class' => 'hide-on-large-only', 'style' => 'font-size: 1.3em;']); ?>
			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<?php if (OAuth::check()): ?>
				<li><?= Html::anchor('/games', '戦績'); ?></li>
				<li><?= Html::anchor('/edit', '戦績入力'); ?></li>
				<?php endif; ?>
				<?php if (OAuth::check()): ?>
				<li><?= Html::anchor('/home', 'マイページ'); ?></li>
				<?php else: ?>
				<li><?= Html::anchor('/login', 'ログイン'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</header>
