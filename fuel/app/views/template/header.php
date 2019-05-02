<ul class="sidenav" id="slide-out">
	<?php if (false): ?>
	<li>
		<div class="user-view">
			<div class="background">
				<?= Asset::img('menubg.png', ['alt' => 'background', 'style' => 'max-width: 100%;']); ?>
			</div>
			<?= Html::anchor('/users/' . '[[name]]', ''/*Asset::img('', ['alt' => 'icon', 'class' => 'circle'])*/); ?>
			<span class="white-text name"><?= '[[screen_name]]'; ?> [<?= '[[screen_name]]'; ?>]</span>
			<span class="white-text email"><?= '[[email]]'; ?></span>
		</div>
	</li>
	<?php endif; ?>
	<li><?= Html::anchor('/', '<i class="material-icons">home</i>TOP'); ?></li>
	<?php if (false): ?>
	<li><?= Html::anchor('/games', '<i class="material-icons">star_rate</i>戦績'); ?></li>
	<li><?= Html::anchor('/edit', '<i class="material-icons">find_in_page</i>戦績入力'); ?></li>
	<li><div class="divider"></div></li>
	<?php endif; ?>
	<?php if (false): ?>
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
				<?php if (false): ?>
				<li><?= Html::anchor('/games', '戦績'); ?></li>
				<li><?= Html::anchor('/edit', '戦績入力'); ?></li>
				<?php endif; ?>
				<?php if (false): ?>
				<li><?= Html::anchor('/home', 'マイページ'); ?></li>
				<?php else: ?>
				<li><?= Html::anchor('/login', 'ログイン'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</header>
