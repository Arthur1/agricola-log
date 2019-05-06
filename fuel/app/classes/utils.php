<?php
class Utils
{
	public static function set_flash_messages(array $messages)
	{
		Session::set_flash('messages', $messages);
	}

	public static function set_flash_errors(array $errors)
	{
		Session::set_flash('errors', $errors);
	}

	public static function login_check($user_id = null)
	{
		if (! OAuth::check()) {
			self::set_flash_errors([Constants::NOT_LOGIN_MESSAGE]);
			Response::redirect('/about');
		}
		if (isset($user_id) and OAuth::get('user_id') !== $user_id) {
			self::set_flash_errors([Constants::NOT_LOGIN_MESSAGE]);
			Response::redirect('/about');
		}
	}

	public static function form_class($error_fields, $target_field, $key = null, $option = '') : string
	{
		$return = 'validate';
		if ($option) {
			$return .= ' ' . $option;
		}
		if (! Input::post()) {
			return $return;
		}
		if (in_array($target_field, $error_fields)) {
			return $return . ' invalid';
		}
		if ($key) {
			if (in_array($target_field . '.' . $key, $error_fields)) {
				return $return . ' invalid';
			}
		}
		return $return . ' valid';
	}
}
