<div class="container">
	<p>
		<?= OAuth::get('user_name'); ?>さん、ようこそ！
	</p>
	<div class="center-align">
		<?= Html::anchor('edit/step1', '戦績を入力する', ['class' => 'btn btn-large teal']); ?>
	</div>
	<h2 class="teal-text">お問い合わせ</h2>
	<p>
		本サービスに関するお問い合わせは、<a href="https://twitter.com/arthur3864" target="_blank" rel="noopener">@arthur3864</a>までどうぞ。
	</p>
	<h2 class="teal-text">Links</h2>
	<div class="collection">
		<a href="https://buratsuki.work/" target="_blank" rel="noopener" class="collection-item">ぶらつき学生ポータル</a>
		<a href="https://draft.buratsuki.work/" target="_blank" rel="noopener" class="collection-item">Agricola Online Draft</a>
	</div>
</div>
