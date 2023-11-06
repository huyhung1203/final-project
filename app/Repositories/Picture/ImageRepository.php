<?php
namespace App\Repositories\Picture;

use App\Models\Image;
use App\Repositories\BaseRepository\BaseRepository;
// use App\Repositories\Image\ImageRepositories;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface{
  public function getModel(){
    return Image::class;
  }
}