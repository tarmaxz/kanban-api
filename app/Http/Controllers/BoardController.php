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
		$viewVars = [
			'baseSite' => url('/'),
            'list' => []
		];

        return view('pages.kanban', $viewVars);
	}

    public function listView()
	{
		$viewVars = [
			'baseSite' => url('/'),
            'list' => []
		];

		return view('pages.admin.board.list', $viewVars);
	}

    public function formView()
	{
		$viewVars = [
			'baseSite' => url('/'),
            'details' => null
		];

		return view('pages.admin.board.form', $viewVars);
	}

    public function indexKanban()
    {
        try {
            $response = $this->boardRepository->allKanban(request()->all());
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function index()
    {
        DB::beginTransaction();
        try {
            $response = $this->boardRepository->all(request()->all());
            DB::commit();
            return response()->json($response);
        } catch (BusinessException $e){
            Log::error($e);
            DB::rollback();
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function show($id)
    {
        try {
            $response = $this->boardRepository->find($id);
            return response()->json($response);
        } catch (BusinessException $e){
            Log::error($e);
            DB::rollback();
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
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
        } catch (BusinessException $e){
            Log::error($e);
            DB::rollback();
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
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
        } catch (BusinessException $e){
            Log::error($e);
            DB::rollback();
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->boardRepository->delete($id);
            return response()->json($response);
        } catch (BusinessException $e){
            Log::error($e);
            DB::rollback();
            return $this->responseError($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return $this->responseError("Erro, não foi possível realizar a ação");
        }
    }
}
