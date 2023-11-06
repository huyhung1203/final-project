<?php
namespace App\Repositories\Color;

use App\Models\Color;
use App\Repositories\BaseRepository\BaseRepository;


class ColorRepository extends BaseRepository implements ColorRepositoryInterface{
  public function getModel(){
    return Color::class;
  }
}