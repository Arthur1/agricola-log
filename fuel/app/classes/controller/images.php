<?php
use Intervention\Image\ImageManager;
class Controller_Images extends Controller
{
	const POINTS_POSITION = [
		'fields_points' => [1730, 48],
		'pastures_points' => [1730, 103],
		'grain_points' => [1730, 158],
		'vegetable_points' => [1730, 213],
		'sheep_points' => [1730, 268],
		'boar_points' => [1730, 322],
		'cattle_points' => [1730, 377],
		'unused_spaces_points' => [1730, 432],
		'stable_points' => [1730, 487],
		'rooms_points' => [1730, 542],
		'family_points' => [1730, 596],
		'begging_points' => [1730, 651],
		'card_points' => [1730, 706],
		'bonus_points' => [1730, 760],
	];
	public function action_index()
	{
		$game_id = '2867a33cf5515c4aab71b3ff095a0000';
		$data = Model_Games::get_by_pk($game_id);
		$manager = new ImageManager(['driver' => 'imagick']);
		$template_path = DOCROOT . '/assets/img/template_normal.png';
		$board_image_path = DOCROOT . '/assets/img/' . $data['image'];
		$template = $manager->make($template_path);
		$board_image = $manager->make($board_image_path);
		$board_image->resize(1344, 756);
		$template->insert($board_image, 'top-left', 20, 25);
		foreach (self::POINTS_POSITION as $field => $positions) {
			$template->text($data[$field], $positions[0], $positions[1], function($font) {
				self::font($font);
			});
		}
		$template->text('Arthur(@arthur3864)の農場', 67, 870, function($font) {
			$font_path = DOCROOT . '/assets/fonts/noto.ttf';
			$font->file($font_path);
			$font->size(38);
			$font->color('#555555');
		});
		$summary_text = Constants::REGULATION_TYPE_LIST[$data['regulation_type']] . ' / '
						. $data['players_number'] . '人ゲーム / '
						. $data['player_order'] . '番手    '
						. $data['total_points'] . '点 / '
						. $data['rank'] . '位';
		$template->text($summary_text, 67, 950, function($font) {
			$font_path = DOCROOT . '/assets/fonts/noto.ttf';
			$font->file($font_path);
			$font->size(45);
			$font->color('#000000');
		});
		echo $template->response('png');
	}

	private static function font($font) {
		$font_path = DOCROOT . '/assets/fonts/noto.ttf';
		$font->file($font_path);
		$font->size(38);
		$font->color('#000000');
		$font->align('center');
		$font->valign('middle');
	}
}
