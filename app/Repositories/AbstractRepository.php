<?php

namespace App\Repositories;

abstract class AbstractRepository {
    /**
     * @var Model
     */
    protected $model;

    public function __construct() {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel() {
        return app($this->model);
    }
}
