<?php


namespace App\Services;


use App\Models\Voyage;

class VoyageService
{
    protected $voyageRepository;

    public function __construct(VoyageRepository $voyageRepository){
        $this->voyageRepository = $voyageRepository;
    }

}
