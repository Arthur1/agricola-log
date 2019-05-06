<div class="container">
	<?= Form::open(); ?>
	<p>ツイート内容を入力してください。Twitterの仕様変更により、140字以上入力できることもありますし、その逆も然りです。</p>
	<div class="row">
		<div class="col s12 l7 input-field">
			<?= Form::textarea('tweet_message', $data['tweet_message'] ?? null, ['class' => 'materialize-textarea', 'data-length' => '']); ?>
			<?= Form::label('ツイート内容', 'tweet_message'); ?>
		</div>
		<div class="col s12 input-field">
			<?= Form::submit('submit', 'ツイートする', ['class' => 'btn teal']); ?>
		</div>
	</div>
	<?= Form::csrf(); ?>
	<?= Form::close(); ?>
	<p>以下の画像とともにツイートします。</p>
	<?= Asset::img('upload/summary/' . $game_id . '.png', ['class' => 'responsive-img materialboxed']); ?>
</div>
