<div class="container">
	<p>各カテゴリの個数を増減させると、点数が計算されます。</p>
	<?= Form::open(); ?>
	<?php foreach (Constants::BASIC_CATEGORY_LIST as $field => $label): ?>
	<?php $key = $field . '_points'; ?>
	<?= Form::hidden($key, 0, ['type' => 'number', 'class' => 'form_points']); ?>
	<?php endforeach; ?>
	<?php if ($data['is_moor']): ?>
	<?= Form::hidden('horses_points', 0, ['type' => 'number', 'class' => 'form_points']); ?>
	<?= Form::hidden('family_sick_points', 0, ['type' => 'number', 'class' => 'form_points']); ?>
	<?php endif; ?>
	<?php foreach (Constants::ADVANCED_CATEGORY_LIST as $field => $label): ?>
	<?php $key = $field . '_points'; ?>
	<?= Form::hidden($key, 0, ['type' => 'number', 'class' => 'form_points']); ?>
	<?php endforeach; ?>
	<div class="row">
		<?php foreach (Constants::BASIC_CATEGORY_LIST as $field => $label): ?>
		<div class="col s12 l6 input-field counter" id="counter-<?= $field; ?>" data-category="<?= $field; ?>">
			<span class="counter_label"><?= $label; ?></span>
			<button type="button" class="btn red btn_dec">−</button>
			<span class="counter_number">0</span>
			<button type="button" class="btn blue btn_inc">＋</button>
			<span class="counter_points">0点</span>
		</div>
		<?php endforeach; ?>
		<?php if ($data['is_moor']): ?>
		<div class="col s12 l6 input-field counter" id="counter-horses" data-category="horses">
			<span class="counter_label">馬</span>
			<button type="button" class="btn red btn_dec">−</button>
			<span class="counter_number">0</span>
			<button type="button" class="btn blue btn_inc">＋</button>
			<span class="counter_points">0点</span>
		</div>
		<?php endif; ?>
		<?php foreach (Constants::ADVANCED_CATEGORY_LIST as $field => $label): ?>
		<div class="col s12 l6 input-field counter" id="counter-<?= $field; ?>" data-category="<?= $field; ?>">
			<span class="counter_label"><?= $label; ?></span>
			<button type="button" class="btn red btn_dec">−</button>
			<span class="counter_number">0</span>
			<button type="button" class="btn blue btn_inc">＋</button>
			<span class="counter_points">0点</span>
		</div>
		<?php endforeach; ?>
		<?php if ($data['is_moor']): ?>
		<div class="col s12 l6 input-field counter" id="counter-family_sick" data-category="family_sick">
			<span class="counter_label">病気家族</span>
			<button type="button" class="btn red btn_dec">−</button>
			<span class="counter_number">0</span>
			<button type="button" class="btn blue btn_inc">＋</button>
			<span class="counter_points">0点</span>
		</div>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col s4 m3 l2 input-field">
			<?= Form::input('total_points', 0, ['type' => 'number', 'required']); ?>
			<?= Form::label('合計点', 'total_points'); ?>
		</div>
		<div class="col s4 m3 l2 input-field">
			<?= Form::input('rank', null, ['type' => 'number', 'min' => '1', 'max' => $data['players_number'], 'required']); ?>
			<?= Form::label('順位', 'rank'); ?>
		</div>
		<div class="col s12 input-field">
			<?= Form::textarea('comment', '', ['class' => 'materialize-textarea']); ?>
			<?= Form::label('コメント', 'comment'); ?>
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
