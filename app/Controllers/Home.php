<?php

namespace App\Controllers;

use App\Models\Model_home;

class Home extends BaseController
{

	public function index()
	{
		$this->Model_home = new Model_home();

		$data = [
			'title' => 'Home',
			'tot_arsip' => $this->Model_home->tot_arsip(),
			'tot_user' => $this->Model_home->tot_user(),
			'tot_kategori' => $this->Model_home->tot_kategori(),
			'tot_dep' => $this->Model_home->tot_dep(),
		];
		return view('v_home', $data);
	}

	//--------------------------------------------------------------------

}
