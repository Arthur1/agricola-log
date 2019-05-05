<?php
use Intervention\Image\ImageManager;
use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

class Controller_Games extends Controller_Template
{
	const POINTS_POSITION_Y_NORMAL = [
		'fields_points' => 48,
		'pastures_points' => 103,
		'grain_points' => 158,
		'vegetable_points' => 213,
		'sheep_points' => 268,
		'boar_points' => 322,
		'cattle_points' => 377,
		'unused_spaces_points' => 432,
		'stable_points' => 487,
		'rooms_points' => 542,
		'family_points' => 596,
		'begging_points' => 651,
		'card_points' => 706,
		'bonus_points' => 760,
	];

	const POINTS_POSITION_Y_MOOR = [
		'fields_points' => 48,
		'pastures_points' => 103,
		'grain_points' => 158,
		'vegetable_points' => 213,
		'sheep_points' => 268,
		'boar_points' => 322,
		'cattle_points' => 377,
		'horses_points' => 432,
		'unused_spaces_points' => 487,
		'stable_points' => 542,
		'rooms_points' => 596,
		'family_points' => 651,
		'begging_points' => 706,
		'card_points' => 760,
		'bonus_points' => 815,
	];

	public function before()
	{
		parent::before();
	}

	public function get_index()
	{
		Utils::login_check();
		$this->template->title = '戦績';
		$this->template->breadcrumbs = [
			'/games' => '戦績',
		];
		// $this->template->content = View::forge('games/index');
		// $this->template->content->data = $data;
	}

	public function get_view($game_id)
	{
		$data = Model_Games::get_by_pk($game_id);
		if ($data === null) {
			throw new HttpNotFoundException;
		}
		Utils::login_check($data['user_id']);

		$this->template->title = date('Y/m/d', strtotime($data['created_at'])) . 'の戦績';
		$this->template->breadcrumbs = [
			'/games' => '戦績',
			'/games/view/' . $game_id => $this->template->title,
		];
		$this->template->content = View::forge('games/view');
		$this->template->content->data = $data;
	}

	public function get_tweet($game_id)
	{
		$data = Model_Games::get_by_pk($game_id);
		if ($data === null) {
			throw new HttpNotFoundException;
		}
		Utils::login_check($data['user_id']);

		if (! Asset::get_file($game_id . '.png', 'img', 'upload/summary')) {
			self::create_summary_image($data);
		}

		$this->template->title = 'ツイート';
		$this->template->breadcrumbs = [
			'/games' => '戦績',
			'/games/view/' . $game_id => date('Y/m/d', strtotime($data['created_at'])) . 'の戦績',
			'/games/tweet/' . $game_id => 'ツイート',
		];
		$this->template->content = View::forge('games/tweet');
		$this->template->content->game_id = $game_id;
		Asset::js(['games_tweet.js'], [], 'add_js');
	}

	public function post_tweet($game_id)
	{
		$this->get_tweet($game_id);
		if (! Security::check_token()) {
			$this->template->errors = Constants::CSRF_ERROR_MESSAGE;
			return;
		}

		if (OAuth::get(OAuth::OAUTH_TOKEN_KEY) === 'dummy') {
			Utils::set_flash_messages([Constants::TWEET_SUCCESS_MESSAGE]);
			Response::redirect('games/view/' . $game_id);
		}

		$consumer_key = Config::get('twitteroauth.consumer_key');
		$consumer_secret = Config::get('twitteroauth.consumer_secret');

		$twitter = new TwitterOAuth(
			$consumer_key,
			$consumer_secret,
			OAuth::get(OAuth::OAUTH_TOKEN_KEY),
			OAuth::get(OAuth::OAUTH_TOKEN_SECRET_KEY)
		);

		try {
			$media = $twitter->upload(
				'media/upload',
				['media' => DOCROOT . 'assets/img/upload/summary/' . $game_id . '.png']
			);		
		} catch (Exception $e) {
			$this->template->errors = '画像のアップロードに失敗しました。再度お試しください';
			return;
		}

		try {
			$twitter->post(
				'statuses/update',
				[
					'status' => Input::post('tweet_message'),
					'media_ids' => $media->media_id_string,
				]
			);
		} catch (Exception $e) {
			$this->template->errors = 'ツイートに失敗しました。再度お試しください';
			return;
		}

		Utils::set_flash_messages([Constants::TWEET_SUCCESS_MESSAGE]);
		Response::redirect('games/view/' . $game_id);
	}

	private static function create_summary_image($data)
	{
		$font_path = DOCROOT . '/assets/fonts/noto.ttf';
		$board_image_path = DOCROOT . '/assets/img/' . $data['image'];
		$save_path = DOCROOT . '/assets/img/upload/summary/' . $data['game_id'] . '.png';
		$summary_text = Constants::REGULATION_TYPE_LIST[$data['regulation_type']];
		if ($data['is_moor']) {
			$template_path = DOCROOT . '/assets/img/template_moor.png';
			$points_position_y = self::POINTS_POSITION_Y_MOOR;
			$summary_text .= '(泥沼)';
		} else {
			$template_path = DOCROOT . '/assets/img/template_normal.png';
			$points_position_y = self::POINTS_POSITION_Y_NORMAL;
		}
		$summary_text .= ' / '
					. $data['players_number'] . '人ゲーム / '
					. $data['player_order'] . '番手    '
					. $data['total_points'] . '点 / '
					. $data['rank'] . '位';
		$author_text = OAuth::get('user_name') . '(@' . OAuth::get('screen_name') .  ')の農場  ' . date('Y/m/d', strtotime($data['created_at']));

		$manager = new ImageManager(['driver' => 'imagick']);
		$template = $manager->make($template_path);
		$board_image = $manager->make($board_image_path);
		$board_image->resize(1344, 756);
		$template->insert($board_image, 'top-left', 20, 25);
		foreach ($points_position_y as $field => $y) {
			$template->text($data[$field], 1730, $y, function($font) use ($font_path) {
				$font->file($font_path);
				$font->size(38);
				$font->color('#000000');
				$font->align('center');
				$font->valign('middle');
			});
		}
		$template->text($author_text, 67, 870, function($font) use ($font_path) {
			$font->file($font_path);
			$font->size(38);
			$font->color('#555555');
		});
		$template->text($summary_text, 67, 950, function($font) use ($font_path) {
			$font->file($font_path);
			$font->size(45);
			$font->color('#000000');
		});
		$template->save($save_path);
	}
}
