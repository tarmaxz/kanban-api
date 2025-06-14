<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BoardCardRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BoardCardRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;
use Illuminate\Http\Request;

class BoardCardController extends Controller {

    protected BoardCardRepository $boardCardRepository;

    public function __construct(
        BoardCardRepository $boardCardRepository,
    ) {
        $this->boardCardRepository = $boardCardRepository;
    }

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

    public function updateMove($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $response = $this->boardCardRepository->updateMove($id, $request->all());
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
}
