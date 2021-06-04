<?php


namespace App\Repositories;

use App\Http\Controllers\VoyageController;
use App\Models\Voyage;


interface ServiceRepository
{

    public function getAll();

    public function getById($id);

    public function create(array $attributes);


    public function update($id, array $attributes);

    public function delete($id);



}
