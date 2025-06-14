<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BoardRepository;
use App\Repositories\BoardCategoryRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BoardCategoryRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;

class BoardCategoryController extends Controller {

    protected BoardCategoryRepository $boardCategoryRepository;
    protected BoardRepository $boardRepository;

    public function __construct(
        BoardCategoryRepository $boardCategoryRepository,
        BoardRepository $boardRepository,
    ) {
        $this->boardRepository = $boardRepository;
        $this->boardCategoryRepository = $boardCategoryRepository;
    }

    public function listView()
	{
        //$list = $this->boardCategoryRepository->all(request()->all());
		$viewVars = [
			'baseSite' => url('/'),
            'list' => []
		];

		return view('pages.admin.board-category.list', $viewVars);
	}

    public function formView($id = null)
	{
        $details = null;
        //$list = $this->boardRepository->all(request()->all());
        /*if (!empty($id)) {
            $details = $this->boardCategoryRepository->find($id);
        }*/

		$viewVars = [
			'baseSite' => url('/'),
            'list' => [],
            'details' => $details
		];

		return view('pages.admin.board-category.form', $viewVars);
	}

    public function index()
    {
        try {
            $response = $this->boardCategoryRepository->all(request()->all());
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function show($id)
    {
        try {
            $response = $this->boardCategoryRepository->find($id);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function store(BoardCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardCategoryRepository->create($request->all());
            DB::commit();
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function update($id, BoardCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardCategoryRepository->update($id, $request->all());
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
            $response = $this->boardCategoryRepository->delete($id);
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

}
