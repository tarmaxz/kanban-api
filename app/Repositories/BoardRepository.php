<?php

namespace App\Repositories;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BoardRepository extends AbstractRepository {

    protected $model = Board::class;

    public function all()
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
