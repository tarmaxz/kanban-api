<?php

namespace App\Repositories;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use App\Services\PermissionService;

class BoardRepository extends AbstractRepository {

    protected $model = Board::class;
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function allKanban()
    {
        $user = Auth::user();

        return $this->model::with([
            'board_categories.board_cards' => function ($query) use ($user) {
                $query->visibleByUser($user);
            }
        ])
        ->orderBy('position', 'asc')
        ->get();
    }

    public function all()
    {
        $this->permissionService->verify();

        return $this->model::orderBy('position', 'asc')->get();
    }

    public function create(array $data)
    {
        $this->permissionService->verify();

        return $this->model::create($data);
    }

    public function find($id)
    {
        $this->permissionService->verify();

        return $this->model::find($id);
    }

    public function update($id, array $data)
    {
        $this->permissionService->verify();

        $response = $this->find($id);
        $response->update($data);

        return $response;
    }

    public function delete($id)
    {
        $this->permissionService->verify();

        $response = $this->find($id);
        $response->delete();
        return $response;
    }
}
