<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BoardRepository;
use App\Repositories\BoardCardRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BoardRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;

class IndexController extends Controller {

    public function indexView()
	{
		$viewVars = [
			'baseSite' => url('/')
		];

        return view('pages.login', $viewVars);
	}
}
