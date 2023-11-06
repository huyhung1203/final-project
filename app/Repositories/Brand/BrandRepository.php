<?php
namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository\BaseRepository;
// use App\Repositories\Brand\BrandRepositories;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface{
  public function getModel(){
    return Brand::class;
  }
}