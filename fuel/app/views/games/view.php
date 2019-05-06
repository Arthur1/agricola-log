<div class="container">
	<h2 class="orange-text">ゲーム情報</h2>
	<div class="collection">
		<div class="collection-item">
			<?= $data['players_number']; ?>人ゲーム / <?= Constants::REGULATION_TYPE_LIST[$data['regulation_type']]; ?><?php if ($data['is_moor']) echo '(泥沼)'; ?><br>
			[<?= $data['created_at']; ?>]
		</div>
	</div>
	<h2 class="orange-text">スコア</h2>
	<table class="striped">
		<tbody>
			<?php foreach (Constants::BASIC_POINTS_LIST as $field => $label): ?>
			<tr>
				<th><?= $label; ?></th>
				<td><?= $data[$field] ?? '-'; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php if ($data['is_moor']): ?>
			<tr>
				<th>馬</th>
				<td><?= $data['horse'] ?? '-'; ?></td>
			</tr>
			<?php endif; ?>
			<?php foreach (Constants::ADVANCED_POINTS_LIST as $field => $label): ?>
			<tr>
				<th><?= $label; ?></th>
				<td><?= $data[$field] ?? '-'; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr class="yellow lighten-5">
				<th>合計点</th>
				<td><?= $data['total_points'] ?? '-'; ?></td>
			</tr>
			<tr class="yellow lighten-3">
				<th>順位</th>
				<td><?= $data['rank'] ?? '-'; ?></td>
			</tr>
		</tfoot>
	</table>
	<div class="row">
		<div class="col s12 m8">
			<h4 class="teal-text">ひとこと</h4>
			<p><?= nl2br($data['comment']); ?></p>
		</div>
		<div class="col s12 m4">
			<h4 class="teal-text">盤面画像</h4>
			<?= Asset::img($data['image'], ['class' => 'responsive-img']); ?>
		</div>
	</div>
	<h3 class="teal-text">メニュー</h3>
	<div class="collection">
		<?= Html::anchor('/games/tweet/' . $data['game_id'], 'Twitterに投稿', ['class' => 'collection-item blue-text']); ?>
		<?= Html::anchor('#modal_delete', 'ゲーム削除', ['class' => 'modal-trigger collection-item red-text']); ?>
	</div>
</div>
<?= Form::open(); ?>
<div id="modal_delete" class="modal">
	<div class="modal-content">
		<h4 class="red-text">ゲーム削除</h4>
		<p>一度削除すると、データを復元することはできません。本当によろしいですか。</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-grey btn-flat">戻る</a>
		<?= Form::button('submit', '削除する', ['class' => 'waves-effect waves-red btn-flat red-text', 'value' => '削除する']); ?>
	</div>
</div>
<?= Form::csrf(); ?>
<?= Form::close(); ?>
