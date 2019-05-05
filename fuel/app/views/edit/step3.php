<div class="container">
	<?= Form::open(['enctype' => 'multipart/form-data']); ?>
	<p>盤面の画像を送信してください。画像を保存する必要がなければ、そのまま「送信」を押してください。</p>
	<div class="row">
		<div class="col s12 file-field input-field">
			<p>jpg、pngファイル(最大7MB)が選択可能です。縦横比16:9を推奨します。</p>
			<div class="btn teal">
				<span>画像</span>
				<?= Form::file('image'); ?>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 input-field">
			<?= Form::submit('return', '戻る', ['class' => 'btn grey', 'formnovalidate']); ?>
			<?= Form::submit('submit', '送信', ['class' => 'btn teal']); ?>
		</div>
	</div>
	<?= Form::csrf(); ?>
	<?= Form::close(); ?>
</div>