<?php
class Controller_Oauth extends Controller
{
	public function get_mock()
	{
		OAuth::mock_login();
		return Response::redirect('/');
	}
}
