<?php
class Controller_About extends Controller_Template
{
	public function action_index()
	{
		$this->template->title = 'ABOUT';
		if (Oauth::check()) {
			$this->template->breadcrumbs = [
				'/about' => 'ABOUT',
			];
		}
		$this->template->content = View::forge('about/index');
	}

	public function action_404()
	{
		$this->template->title = "Not Found";
		$this->template->breadcrumbs = [
			'#' => 'Not Found',
		];
		$this->template->content = View::forge('about/404');
	}
}
