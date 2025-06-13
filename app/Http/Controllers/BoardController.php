<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BoardRepository;
use App\Repositories\BoardCardRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BoardRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;

class BoardController extends Controller {

    protected BoardRepository $boardRepository;
    protected BoardCardRepository $boardCardRepository;

    public function __construct(
        BoardRepository $boardRepository,
        BoardCardRepository $boardCardRepository,
    ) {
        $this->boardRepository = $boardRepository;
        $this->boardCardRepository = $boardCardRepository;
    }

    public function indexView()
	{
        $list = $this->boardRepository->all(request()->all());
		$viewVars = [
			'baseSite' => url('/'),
            'list' => $list
		];

        return view('pages.kanban', $viewVars);
	}

    public function listView()
	{
        $list = $this->boardRepository->all(request()->all());
		$viewVars = [
			'baseSite' => url('/'),
            'list' => $list
		];

		return view('pages.admin.board.list', $viewVars);
	}

    public function formView($id = null)
	{
        $details = null;
        if (!empty($id)) {
            $details = $this->boardRepository->find($id);
        }

		$viewVars = [
			'baseSite' => url('/'),
            'details' => $details
		];

		return view('pages.admin.board.form', $viewVars);
	}

    public function index()
    {
        try {
            $response = $this->boardRepository->all(request()->all());
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function show($id)
    {
        try {
            $response = $this->boardRepository->find($id);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function store(BoardRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardRepository->create($request->all());
            DB::commit();
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function update($id, BoardRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardRepository->update($id, $request->all());
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
            $response = $this->boardRepository->delete($id);
            return response()->json($response);
        } catch (BusinessException $e) {
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

}
