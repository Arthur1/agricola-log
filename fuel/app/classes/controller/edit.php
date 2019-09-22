<?php
use Intervention\Image\ImageManager;

class Controller_Edit extends Controller_Template
{
	const FIELDS_STEP1 = [
		'regulation_type',
		'is_moor',
		'players_number',
		'player_order',
	];

	const FIELDS_STEP2 = [
		'fields_points',
		'pastures_points',
		'grain_points',
		'vegetable_points',
		'sheep_points',
		'boar_points',
		'cattle_points',
		'horses_points',
		'unused_spaces_points',
		'stable_points',
		'clay_rooms_points',
		'stone_rooms_points',
		'family_points',
		'family_sick_points',
		'begging_points',
		'card_points',
		'bonus_points',
		'total_points',
		'rank',
		'comment',
	];

	public function before()
	{
		parent::before();
		Utils::login_check();
	}

	public function get_step1()
	{
		foreach (self::FIELDS_STEP1 as $field) {
			$data[$field] = Session::get_flash($field);
		}

		$this->template->title = 'STEP1 ゲーム概要';
		$this->template->breadcrumbs = [
			'#' => '戦績入力',
			'/edit/step1' => 'STEP1 ゲーム概要',
		];
		$this->template->content = View::forge('edit/step1');
		$this->template->content->data = $data;
		$this->template->content->error_fields = [];
		Asset::js(['edit_step1.js'], [], 'add_js');
	}

	public function post_step1()
	{
		$this->get_step1();
		foreach (self::FIELDS_STEP1 as $field) {
			Session::set_flash($field, Input::post($field));
		}

		if (! Security::check_token()) {
			$this->template->errors = Constants::CSRF_ERROR_MESSAGE;
			return;
		}

		$val = self::validate_step1();
		if (! $val->run()) {
			foreach ($val->error() as $field => $error) {
				$this->template->errors[] = $error->get_message();
				$this->template->content->error_fields[] = $field;
			}
			return;
		}
		Response::redirect('edit/step2');
	}

	private static function validate_step1()
	{
		$val = Validation::forge();
		$val->add('players_number', 'プレイ人数')
			->add_rule('required')
			->add_rule('match_collection', array_keys(Constants::PLAYERS_NUMBER_LIST));
		$val->add('player_order', '番手')
			->add_rule('required')
			->add_rule('numeric_between', 1, Input::post('players_number'));
		$val->add('regulation_type', 'レギュレーション')
			->add_rule('required')
			->add_rule('match_collection', array_keys(Constants::REGULATION_TYPE_LIST));
		$val->add('is_moor', '通常/泥沼')
			->add_rule('required')
			->add_rule('match_collection', array_keys(Constants::IS_MOOR_LIST));
		return $val;
	}

	public function get_step2()
	{
		foreach (self::FIELDS_STEP1 as $field) {
			$data[$field] = Session::get_flash($field);
			Session::keep_flash($field);
		}
		foreach (self::FIELDS_STEP2 as $field) {
			$data[$field] = Session::get_flash($field);
			Session::keep_flash($field);
		}

		if (! $data[self::FIELDS_STEP1[0]]) {
			throw new HttpNotFoundException;
		}

		$this->template->title = 'STEP2 スコア入力';
		$this->template->breadcrumbs = [
			'#' => '戦績入力',
			'/edit/step2' => 'STEP2 スコア入力',
		];
		$this->template->content = View::forge('edit/step2');
		$this->template->content->data = $data;
		$this->template->content->error_fields = [];
		Asset::js(['edit_step2.js'], [], 'add_js');
	}

	public function post_step2()
	{
		foreach (self::FIELDS_STEP1 as $field) {
			Session::keep_flash($field);
		}
		foreach (self::FIELDS_STEP2 as $field) {
			Session::set_flash($field, Input::post($field));
		}

		if (! Security::check_token()) {
			$this->template->errors = Constants::CSRF_ERROR_MESSAGE;
			return;
		}

		if (Input::post('return')) {
			return Response::redirect('/edit/step1');
		}

		$val = self::validate_step2();
		if (! $val->run()) {
			Response::redirect(Uri::current());
		}
		Response::redirect('edit/step3');
	}

	private static function validate_step2()
	{
		$val = Validation::forge();
		return $val;
	}

	public function get_step3()
	{
		foreach (self::FIELDS_STEP1 as $field) {
			$data[$field] = Session::get_flash($field);
			Session::keep_flash($field);
		}
		foreach (self::FIELDS_STEP2 as $field) {
			$data[$field] = Session::get_flash($field);
			Session::keep_flash($field);
		}

		if (! isset($data[self::FIELDS_STEP1[0]]) or ! isset($data[self::FIELDS_STEP2[0]])) {
			throw new HttpNotFoundException;
		}

		$this->template->title = 'STEP3 盤面画像送信';
		$this->template->breadcrumbs = [
			'#' => '戦績入力',
			'/edit/step3' => 'STEP3 盤面画像送信',
		];
		$this->template->content = View::forge('edit/step3');
		$this->template->content->data = $data;
	}

	public function post_step3()
	{
		$this->get_step3();

		if (! Security::check_token()) {
			$this->template->errors = Constants::CSRF_ERROR_MESSAGE;
			return;
		}

		if (Input::post('return')) {
			return Response::redirect('/edit/step2');
		}

		$game_id = md5(uniqid(rand(), true));
		$image = null;
		if (Input::file('image')['name'] === '') {
			$image = 'noimage.png';
		} else {
			$config = [
				'path' => DOCROOT.'assets/img/upload/games',
				'ext_whitelist' => ['jpg', 'jpeg', 'png'],
				'new_name' => $game_id,
				'auto_rename' => false,
				'overwrite' => true,
				'max_size' => 7 * 1024 * 1024,
				'create_path' => true,
			];
			Upload::process($config);
			if (! Upload::is_valid()) {
				$errors = Upload::get_errors('image')['errors'];
				$this->template->errors = array_column($errors, 'message');
				return;
			}
			Upload::save();
			$file = Upload::get_files('image');
			$image = 'upload/games/' . $file['saved_as'];
			$full_path = $file['saved_to'] . $file['saved_as'];
			self::resize_image($full_path);
		}

		$data = $this->template->content->data;
		
		Model_Games::save(OAuth::get('user_id'), $game_id, $data, $image);
		Utils::set_flash_messages(['データの入力に成功しました']);
		Response::redirect('games/view/' . $game_id);
	}

	private static function resize_image($path)
	{
		$manager = new ImageManager(['driver' => 'imagick']);
		$width = 1920;
		$height = 1080;
		$image = $manager->make($path);
		$image->orientate();
		$image->resize($width, null, function($constraint) {
			$constraint->aspectRatio();
		});
		$image->crop($width, $height, 0, intdiv($image->height() - $height, 2));
		$image->save($path);
	}
}
