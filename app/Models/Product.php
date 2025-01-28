<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guared = [];

   
    public function color (){

        return $this->hasMany(color:: class, 'product_id', 'id');
    }

      
    public function size (){

        return $this->hasMany(size:: class, 'product_id', 'id');
    }

    public function galleryimage (){

        return $this->hasMany(GalleryImage:: class, 'product_id', 'id');
    }

    public function category (){

     return $this->belongsTo(category::class,'cat_id','id');

    }

    public function subCategory (){

        return $this->belongsTo(Subcategory::class,'sub_cat_id','id');
   
       }

       public function cart()

       {
            return $this->hasMany(Cart::class, 'product_id','id' );
       
       }

       
    public function OrderDetails(){
     
        return $this->hasMany(OrderDetails::class, 'product_id','id');

    }

    public function review (){
   
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

}
