<?php

namespace App\Repositories;

use App\Models\BoardCategory;
use App\Services\PermissionService;

class BoardCategoryRepository extends AbstractRepository {

    protected $model = BoardCategory::class;
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function all()
    {
        $this->permissionService->verify();

        return $this->model::with(['board'])
            ->orderBy('position', 'asc')
            ->get();
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
