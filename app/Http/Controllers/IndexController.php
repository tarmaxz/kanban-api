<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller {

    public function indexView()
	{
		$viewVars = [
			'baseSite' => url('/')
		];

        return view('pages.login', $viewVars);
	}
}
