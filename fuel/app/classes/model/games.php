<?php
class Model_Games
{
	const TABLE_NAME = 'games';

	public static function save(string $user_id, string $game_id, array $data, string $image)
	{
		$data['user_id'] = $user_id;
		$data['game_id'] = $game_id;
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['image'] = $image;

		if ($data['is_moor']) {
			$data['family_points'] += $data['family_sick_points'];
		}
		unset($data['family_sick_points']);
		$data['rooms_points'] = $data['clay_rooms_points'] + $data['stone_rooms_points'];
		unset($data['clay_rooms_points']);
		unset($data['stone_rooms_points']);

		$query = DB::insert(self::TABLE_NAME)->set($data);
		$query->execute();
	}

	public static function get_by_pk(string $game_id)
	{
		$query = DB::select()
					->from(self::TABLE_NAME)
					->where('game_id', '=', $game_id)
					->limit(1);
		return $query->execute()->as_array()[0] ?? null;
	}

	public static function count_list(string $user_id)
	{
		$query = DB::select(DB::expr('COUNT(*) AS `count`'))
					->from(self::TABLE_NAME)
					->where('user_id', '=', $user_id);
		return $query->execute()->as_array()[0]['count'] ?? 0;
	}

	public static function get_list(string $user_id, $pagination)
	{
		$query = DB::select()
					->from(self::TABLE_NAME)
					->where('user_id', '=', $user_id)
					->order_by('created_at', 'desc')
					->limit($pagination->per_page)
					->offset($pagination->offset);
		return $query->execute()->as_array();
	}

	public static function delete_by_pk(string $game_id)
	{
		$query = DB::delete(self::TABLE_NAME)
					->where('game_id', '=', $game_id);
		return $query->execute();
	}
}
