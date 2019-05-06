<?php
class Controller_Index extends Controller_Template
{
	public function action_index()
	{
		Utils::login_check();
		$this->template->title = 'マイページ';
		$this->template->breadcrumbs = [
			'/' => 'マイページ',
		];
		$this->template->content = View::forge('index');
		Asset::js(['index.js'], [], 'add_js');
	}
}

