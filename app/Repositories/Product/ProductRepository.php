<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository\BaseRepository;
// use App\Repositories\Product\ProductRepositories;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface{
  public function getModel(){
    return Product::class;
  }
}