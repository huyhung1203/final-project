<?php

namespace App\Repositories\BaseRepository;

interface BaseRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */

    public function getAll();

    public function create($data = []);

    public function find($id);

    public function delete($id);

    public function update($id, $data = []);

    public function getAllFilter($data);

}
