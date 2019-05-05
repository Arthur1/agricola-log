<?php
use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

class Controller_Oauth extends Controller
{
	const REQUEST_TOKEN_KEY = 'request_token';

	public function get_login()
	{
		$consumer_key = Config::get('twitteroauth.consumer_key');
		$consumer_secret = Config::get('twitteroauth.consumer_secret');
		$twitter = new TwitterOAuth($consumer_key, $consumer_secret);

		$request_token = $twitter->oauth(
			'oauth/request_token',
			['oauth_callback' => Uri::create('/oauth/callback')]
		);

		Session::set(self::REQUEST_TOKEN_KEY, $request_token);

		$redirect_to = $twitter->url(
			'oauth/authorize',
			['oauth_token' => $request_token['oauth_token']]
		);
		return Response::redirect($redirect_to);
	}

	public function get_callback()
	{
		if (Input::get('denied')) {
			if (OAuth::check()) {
				OAuth::logout();
				Utils::set_flash_messages([Constants::LOGOUT_SUCCESS_MESSAGE]);
			}
			return Response::redirect('/about');
		}

		$consumer_key = Config::get('twitteroauth.consumer_key');
		$consumer_secret = Config::get('twitteroauth.consumer_secret');
		$request_token = Session::get(self::REQUEST_TOKEN_KEY);

		$twitter = new TwitterOAuth(
			$consumer_key,
			$consumer_secret,
			$request_token['oauth_token'],
			$request_token['oauth_token_secret']
		);

		$oauth_verifier = Input::get('oauth_verifier');
		$oauth_token = Input::get('oauth_token');

		if (! $oauth_verifier or ! $oauth_token) {
			return Response::redirect('/about');
		}

		try {
			$access_token = $twitter->oauth(
				'oauth/access_token',
				[
					'oauth_verifier' => $oauth_verifier,
					'oauth_token'=> $oauth_token
				]
			);
		} catch (TwitterOAuthException $e) {
			return Response::redirect('/about');
		}

		$twitter = new TwitterOAuth(
			$consumer_key,
			$consumer_secret,
			$access_token['oauth_token'],
			$access_token['oauth_token_secret']
		);
		$user_data = $twitter->get(
			'account/verify_credentials',
			['skip_status' => true]
		);
		$icon = $user_data->profile_image_url_https;
		$user_name = $user_data->name;
		OAuth::login($access_token, $user_name, $icon);

		Utils::set_flash_messages([Constants::LOGIN_SUCCESS_MESSAGE]);
		return Response::redirect('');
	}

	public function get_logout()
	{
		OAuth::logout();
		Session::set_flash('messages', [Constants::LOGOUT_SUCCESS_MESSAGE]);
		return Response::redirect('/about');
	}

	public function get_mock()
	{
		if (Fuel::$env !== Fuel::DEVELOPMENT) {
			throw new HttpNotFoundException;
		}
		OAuth::mock_login();
		return Response::redirect('/');
	}
}
