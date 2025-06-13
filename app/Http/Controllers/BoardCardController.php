<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BoardRepository;
use App\Repositories\BoardCardRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BoardCardRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;

class BoardCardController extends Controller {

    protected BoardCardRepository $boardCardRepository;

    public function __construct(
        BoardCardRepository $boardCardRepository,
    ) {
        $this->boardCardRepository = $boardCardRepository;
    }

    /*public function listView()
	{
        $list = $this->boardCardRepository->all(request()->all());
		$viewVars = [
			'baseSite' => url('/'),
            'list' => $list
		];

		return view('pages.admin.board-category.list', $viewVars);
	}*/

    public function index()
    {
        try {
            $response = $this->boardCardRepository->all(request()->all());
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function show($id)
    {
        try {
            $response = $this->boardCardRepository->find($id);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function store(BoardCardRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardCardRepository->create($request->all());
            DB::commit();
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function update($id, BoardCardRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardCardRepository->update($id, $request->all());
            DB::commit();
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->boardCardRepository->delete($id);
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    /*public function formView($id = null)
	{
        $details = null;
        $list = $this->boardRepository->all(request()->all());
        if (!empty($id)) {
            $details = $this->boardCategoryRepository->find($id);
        }

		$viewVars = [
			'baseSite' => url('/'),
            'list' => $list,
            'details' => $details
		];

		return view('pages.admin.board-category.form', $viewVars);
	}

    */

}
