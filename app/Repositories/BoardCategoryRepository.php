<?php

namespace App\Repositories;

use App\Models\BoardCategory;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BoardCategoryRepository extends AbstractRepository {

    protected $model = BoardCategory::class;

    public function all()
    {
        return $this->model::with(['board'])
            ->orderBy('position', 'asc')
            ->get();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function update($id, array $data)
    {
        $response = $this->find($id);
        $response->update($data);

        return $response;
    }

    public function delete($id)
    {
        $response = $this->find($id);
        $response->delete();
        return $response;
    }
}
