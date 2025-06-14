<?php

namespace App\Repositories;

use App\Models\BoardCard;
use App\Models\BoardCategory;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BusinessException;

class BoardCardRepository extends AbstractRepository {

    protected $model = BoardCard::class;

    public function all()
    {
        $user = Auth::user();

        return $this->model::visibleByUser($user)->orderBy('position', 'asc')->get();
    }

    public function create(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

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

    public function updateMove($id, array $data)
    {
        $newData = null;
        $response = $this->find($id);

        if (!empty($data['move']) && $data['move'] == 'next') {
            $nextBoardCategory = BoardCategory::where('board_id', '=', $data['board_id'])
                ->where('id', '>', $data['board_category_id'])
                    ->orderBy('position', 'asc')->select('id','name')
                        ->first();

            if (!empty($nextBoardCategory->id)) {
                $newData['board_category_id'] = $nextBoardCategory->id;
            } else {
                throw new BusinessException('Não é possível avançar mais!');
            }
        }

        if (!empty($data['move']) && $data['move'] === 'previous') {
            $previousBoardCategory = BoardCategory::where('board_id', $data['board_id'])
                ->where('id', '<', $data['board_category_id'])
                    ->orderBy('position', 'desc')
                        ->select('id', 'name')
                            ->first();

            if ($previousBoardCategory) {
                $newData['board_category_id'] = $previousBoardCategory->id;
            } else {
                throw new BusinessException('Não é possível retroceder mais!');
            }
        }

        if (!empty($newData)) {
            $response->update($newData);
        }

        return $response;
    }

    public function delete($id)
    {
        $response = $this->find($id);
        $response->delete();
        return $response;
    }
}
