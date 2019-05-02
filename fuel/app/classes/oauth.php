<?php
class OAuth
{
	const USER_ID_KEY = 'user_id';
	const SCREEN_NAME_KEY = 'screen_name';
	const USER_NAME_KEY = 'user_name';
	const ICON_KEY = 'icon';
	const OAUTH_TOKEN_KEY = 'oauth_token';
	const OAUTH_TOKEN_SECRET_KEY = 'oauth_token_sectet';
	const ACCESS_TOKEN_KEY = 'access_token';

	/**
	 * ログイン情報をSessionに持つ
	 * @param array $access_token アクセストークン
	 * @param string $icon        アイコン画像のURL
	 * @return void
	 */
	public static function login(array $access_token, string $user_name, string $icon)
	{
		$access_token[self::USER_NAME_KEY] = $user_name;
		$access_token[self::ICON_KEY] = $icon;
		Session::set(self::ACCESS_TOKEN_KEY, $access_token);
	}

	/**
	 * ダミーアカウントでログイン
	 * @return void
	 */
	public static function mock_login()
	{
		$access_token = [
			self::OAUTH_TOKEN_KEY => 'dummy',
			self::OAUTH_TOKEN_SECRET_KEY => 'dummy',
			self::USER_ID_KEY => '000000',
			self::SCREEN_NAME_KEY => 'test',
		];
		$user_name = 'DUMMY';
		$icon = 'https://pbs.twimg.com/profile_images/949312348572889089/Gc28h5tn_400x400.jpg';
		self::login($access_token, $user_name, $icon);
	}

	/**
	 * セッションを破棄
	 * @return void
	 */
	public static function logout()
	{
		Session::delete(self::ACCESS_TOKEN_KEY);
	}

	/**
	 * ログイン状態かチェック
	 * @return bool
	 */
	public static function check() : bool
	{
		return Session::get(self::ACCESS_TOKEN_KEY . '.' . self::OAUTH_TOKEN_KEY) !== null;
	}

	/**
	 * アクセストークンの配列から情報取得
	 * @param string $key 取得したいキー
	 * @return string
	 */
	public static function get(string $key) : string
	{
		return Session::get(self::ACCESS_TOKEN_KEY . '.' . $key);
	}
}
