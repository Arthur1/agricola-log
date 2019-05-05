<?php
class Constants
{
	const PLAYERS_NUMBER_LIST = [
		null => '[未選択]',
		1 => '1人ゲーム',
		2 => '2人ゲーム',
		3 => '3人ゲーム',
		4 => '4人ゲーム',
		5 => '5人ゲーム',
		6 => '6人ゲーム',
	];

	const PLAYER_ORDER_LIST = [
		null => '[未選択]',
		1 => '1番手',
		2 => '2番手',
		3 => '3番手',
		4 => '4番手',
		5 => '5番手',
		6 => '6番手',
	];

	const REGULATION_TYPE_LIST = [
		null => '[未選択]',
		1 => '旧版EIK',
		2 => '旧版拡張',
		3 => 'リバイズド基本',
		4 => 'リバイズド拡張',
		5 => '旧版＋リバイズド拡張',
	];

	const IS_MOOR_LIST = [
		0 => '通常',
		1 => '泥沼',
	];

	const BASIC_CATEGORY_LIST = [
		'fields' => '畑',
		'pastures' => '牧場',
		'grain' => '小麦',
		'vegetable' => '野菜',
		'sheep' => '羊',
		'boar' => '猪',
		'cattle' => '牛',
	];

	const ADVANCED_CATEGORY_LIST = [
		'unused_spaces' => '未使用',
		'stable' => '柵内の厩',
		'clay_rooms' => 'レン部屋',
		'stone_rooms' => '石部屋',
		'family' => '家族',
		'begging' => '物乞い',
		'card' => 'カード',
		'bonus' => 'ボーナス',
	];

	const BASIC_POINTS_LIST = [
		'fields_points' => '畑',
		'pastures_points' => '牧場',
		'grain_points' => '小麦',
		'vegetable_points' => '野菜',
		'sheep_points' => '羊',
		'boar_points' => '猪',
		'cattle_points' => '牛',
	];

	const ADVANCED_POINTS_LIST = [
		'unused_spaces_points' => '未使用スペース',
		'stable_points' => '柵に囲われた厩',
		'rooms_points' => '部屋',
		'family_points' => '家族',
		'begging_points' => '物乞い',
		'card_points' => 'カード',
		'bonus_points' => 'ボーナス',
	];

	const LOGIN_SUCCESS_MESSAGE = 'ログインしました';
	const LOGOUT_SUCCESS_MESSAGE = 'ログアウトしました';
	const NOT_LOGIN_MESSAGE = '再度ログインしてください';
	const CSRF_ERROR_MESSAGE = 'お手数ですが、再度送信してください';
	const TWEET_SUCCESS_MESSAGE = 'ツイートしました';
}
