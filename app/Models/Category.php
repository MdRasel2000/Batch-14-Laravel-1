<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guared = [];


public function subCategory()
{
  return $this->hasMany(Subcategory::class,'cat_id','id');


}

public function product (){

  return $this->hasMany(product::class,'cat_id','id');

 }

}