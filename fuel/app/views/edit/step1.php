<div class="container">
	<p>ゲームの詳細を入力してください。</p>
	<?= Form::open(); ?>
	<div class="row">
		<div class="col s12 m7 input-field">
			<?= Form::select('players_number', Input::post('players_number', Arr::get($data, 'players_number')), Constants::PLAYERS_NUMBER_LIST, ['required' => true, 'class' => Utils::form_class($error_fields, 'players_number')]); ?>
			<label>プレイ人数</label>
		</div>
		<div class="col s12 m7 input-field">
			<?= Form::select('player_order', Input::post('players_order', Arr::get($data, 'player_order')), Constants::PLAYER_ORDER_LIST, ['required' => true, 'class' => Utils::form_class($error_fields, 'players_number')]); ?>
			<label>番手</label>
		</div>
		<div class="col s12 m7 input-field">
			<?= Form::select('regulation_type', Input::post('regulation_type', Arr::get($data, 'regulation_type')), Constants::REGULATION_TYPE_LIST, ['required' => true, 'class' => Utils::form_class($error_fields, 'regultion_type')]); ?>
			<label>レギュレーション</label>
		</div>
		<div class="col s12 m7">
			<p>
				<label>
					<?= Form::radio('is_moor', 0, Input::post('is_moor', Arr::get($data, 'is_moor')), ['id' => 'form_moor1', 'checked' => 'checked', 'required' => true]); ?>
					<span>通常</span>
				</label>
			</p>
			<p>
				<label>
					<?= Form::radio('is_moor', 1, Input::post('is_moor', Arr::get($data, 'is_moor')), ['id' => 'form_moor2', 'required' => true]); ?>
					<span>泥沼</span>
				</label>
			</p>
		</div>
		<div class="col s12 input-field">
			<?= Form::submit('submit', '送信', ['class' => 'btn teal']); ?>
		</div>
	</div>
	<?= Form::csrf(); ?>
	<?= Form::close(); ?>
</div>
