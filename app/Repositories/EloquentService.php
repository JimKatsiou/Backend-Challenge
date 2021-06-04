<?php


namespace App\Repositories;

use App\Models\Voyage;

class EloquentService implements ServiceRepository
{
    private $VoyageQueries;

    public function __construct(Voyage $VoyageQueries){

        $this->VoyageQueries = $VoyageQueries;
    }

    public function getAll()
    {

    }

    public function getById($id)
    {
        return $this->VoyageQueries->getByID($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
