<?php
namespace Fuel\Migrations;

class Create_Games
{
    const TABLE_NAME = 'games';
	public function up()
	{
		\DBUtil::create_table(
			self::TABLE_NAME,
			[
                'game_id' => ['constraint' => 120, 'type' => 'varchar'],
                'user_id' => ['constraint' => 40, 'type' => 'varchar'],
                'players_number' => ['constraint' => 3, 'type' => 'int', 'unsigned' => true],
                'player_order' => ['constraint' => 3, 'type' => 'int', 'unsigned' => true],
                'regulation_type' => ['constraint' => 3, 'type' => 'tinyint', 'unsigned' => true],
                'is_moor' => ['constraint' => 1, 'type' => 'tinyint', 'unsigned' => true],
                'fields_points' => ['constraint' => 5, 'type' => 'int'],
                'pastures_points' => ['constraint' => 5, 'type' => 'int'],
                'grain_points' => ['constraint' => 5, 'type' => 'int'],
                'vegetable_points' => ['constraint' => 5, 'type' => 'int'],
                'sheep_points' => ['constraint' => 5, 'type' => 'int'],
                'boar_points' => ['constraint' => 5, 'type' => 'int'],
                'cattle_points' => ['constraint' => 5, 'type' => 'int'],
                'horses_points' => ['constraint' => 5, 'type' => 'int', 'null' => true],
                'unused_spaces_points' => ['constraint' => 5, 'type' => 'int'],
                'stable_points' => ['constraint' => 5, 'type' => 'int'],
                'rooms_points' => ['constraint' => 5, 'type' => 'int'],
                'family_points' => ['constraint' => 5, 'type' => 'int'],
                'begging_points' => ['constraint' => 5, 'type' => 'int'],
                'card_points' => ['constraint' => 5, 'type' => 'int'],
                'bonus_points' => ['constraint' => 5, 'type' => 'int'],
                'total_points' => ['constraint' => 5, 'type' => 'int'],
                'rank' => ['constraint' => 3, 'type' => 'int', 'unsigned' => true],
                'comment' => ['type' => 'text'],
                'image' => ['constraint' => 255, 'type' => 'varchar'],
                'created_at' => ['type' => 'datetime'],
			],
			['game_id'],
			false,
			'InnoDB',
			'utf8_unicode_ci'
        );
        \DBUtil::create_index(self::TABLE_NAME, ['user_id']);
	}

	public function down()
	{
		\DBUtil::drop_table(self::TABLE_NAME);
	}
}