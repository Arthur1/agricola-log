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
	}
}
