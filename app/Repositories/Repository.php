<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    public $model;

    /**
     * Repository constructor.
     * @param $model
     */
    public function __construct($model)
    {
        /** @var \Eloquent $model */
        $this->model = $model;
    }

    /**
     * Get record by id
     *
     * @param $id
     * @return \Eloquent|\Eloquent[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get all records
     *
     * @return \Eloquent[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('id','desc')->get();
    }

    /**
     * Create new record
     *
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $this->model->fill($data);
        return $this->model->save();
    }

    /**
     * Edit record by record instance
     *
     * @param Model $model
     * @param $data
     * @return bool
     */
    public function edit(Model $model, $data)
    {
        $model->fill($data);
        return $model->save();
    }

    /**
     * Delete record by model instance
     *
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model)
    {
        try {
            $deleted = $model->delete();
        } catch (\Exception $e) {
            $deleted = false;
        }
        return $deleted;
    }
}
