<?php
namespace App\Repositories\Size;

use App\Models\Size;
use App\Repositories\BaseRepository\BaseRepository;
// use App\Repositories\Size\SizeRepository;

class SizeRepository extends BaseRepository implements SizeRepositoryInterface{
  public function getModel(){
    return Size::class;
  }
}