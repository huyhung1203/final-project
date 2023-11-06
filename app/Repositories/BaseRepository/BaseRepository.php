<?php

namespace App\Repositories\BaseRepository;

use Illuminate\Http\Client\Request;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * get all data
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * search by id
     */
    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    /**
     * create data
     */
    public function create($data = [])
    {
        return $this->model->create($data);
    }

    /**
     * update data
     */
    public function update($id, $data = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($data);
            return $result;
        }
        return false;
    }

    /**
     * delete data to garbage
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    public function getAllFilter($data)
    {
        return $this->model->all();
    }
}
