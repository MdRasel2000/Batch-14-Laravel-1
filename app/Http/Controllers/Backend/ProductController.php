<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use App\Models\Subcategory;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Laravel\Prompts\form;

class ProductController extends Controller
{
   public function create ()
   {
     $categories = Category::get();
     $subCategories = Subcategory::get();

     return view ('backend.product.create', compact('categories','subCategories'));
   }

   public function store (Request $request)
   {  
      $product = new Product();

      $product->name  = $request->name;
      $product->slug = Str::slug( $request->name);
      $product->cat_id  = $request->cat_id;
      $product->sub_cat_id  = $request->sub_cat_id;
      $product->regular_price  = $request->regular_price;
      $product->discount_price  = $request->discount_price;
      $product->buying_price  = $request->buying_price;
      $product->product_qty  = $request->qty;
      $product->sku_code = $request->sku_code;
      $product->products_type  = $request->product_type;
      $product->product_description  = $request->product_description;
      $product->product_policy  = $request->product_policy;


      if(isset($request->image))
         {

          $imageName = rand().'-product-'.'.'. $request->image->extension();
          $request->image->move('backend/images/product/', $imageName);

          $product->image = $imageName;

         }

         $product->save();

         //ad color

          if(isset($request->color) && $request->color [0] != null){

            foreach($request->color as $colorName){

                  $color = new Color();
                  $color->product_id = $product->id;
                  $color->color_name = $colorName;
                  $color->save();

            }

          }

           //ad size

           if(isset($request->size)&& $request->size [0] != null){

            foreach($request->size as $sizeName){

                  $size = new Size();
                  $size->product_id = $product->id;
                  $size->size_name = $sizeName;
                  $size->save();

            }

          }


          //gellary image

          if(isset($request->galleryimage)){

            foreach($request->galleryimage as $image){
            
              $galleryimage = new GalleryImage();
              $galleryimage->product_id = $product->id;

              $imageName = rand().'-gallery-'.'.'. $image->extension();
              $image->move('backend/images/galleryimage/', $imageName);
    
              $galleryimage->image =  $imageName;
              $galleryimage->save();

            }
          }


        return redirect()->back();

   }

    public function show ()
    { 
      $products = Product::with('category','subCategory')->get();

      return view ('backend.product.list', compact('products'));


    }

    public function delete ($id)
    {
      $product = Product::find($id);

      if($product->image && file_exists('backend/images/product/'.$product->image))
      {
           unlink('backend/images/product/'.$product->image);

      }

        //color delete

        $colors = Color::where('product_id',$id)->get();
        
        foreach($colors as $color){

          $color->delete();
        }

         //size delete

         $sizes = Size::where('product_id',$id)->get();
        
         foreach($sizes as $size){
 
           $size->delete();
         }


         //galleryImage

           $galleryImages = GalleryImage::where('product_id',$id)->get();

           foreach($galleryImages as $image){

            if($image->image && file_exists('backend/images/galleryimage/'.$image->image))
            {
                 unlink('backend/images/galleryimage/'.$image->image);
      
            }

            $image->delete();

           }


           $product->delete();

           return redirect()->back();

    }

    public function edit ($id){

     $product = Product::with('color','size','galleryimage')->where('id',$id)->first();

       $categories = Category::get();
       $subCategories = Subcategory::get();

       return view('backend/product/edit',compact('product','categories','subCategories'));
      
    }


      public function update (Request $request,$id)
      {
       
         $product = Product::find($id);

         $product->name  = $request->name;
         $product->slug = Str::slug( $request->name);
         $product->cat_id  = $request->cat_id;
         $product->sub_cat_id  = $request->sub_cat_id;
         $product->regular_price  = $request->regular_price;
         $product->discount_price  = $request->discount_price;
         $product->buying_price  = $request->buying_price;
         $product->product_qty  = $request->qty;
         $product->sku_code = $request->sku_code;
         $product->products_type  = $request->product_type;
         $product->product_description  = $request->product_description;
         $product->product_policy  = $request->product_policy;


         if(isset($request->image)){

          if($product->image && file_exists('backend/images/product/'.$product->image)){

            unlink('backend/images/product/'.$product->image);
          }

          $imageName = rand().'-categoryupdate-'.'.'. $request->image->extension();
      $request->image->move('backend/images/product/', $imageName);

      $product->image = $imageName;

        }

        $product->save();  
       

         //ad color

         if(isset($request->color)){

               $colors = Color::where('product_id',  $product->id)->get();
               foreach($colors as $colorName){
                $colorName->delete();

               }

          foreach($request->color as $colorName){
                $color = new Color();
                $color->product_id = $product->id;
                $color->color_name = $colorName;
                $color->save();

          }

        }

         //ad size

         if(isset($request->size)){

          $sizes = Size::where('product_id', $product->id)->get();
           foreach($sizes as $sizeName){
               $sizeName->delete();
           }
     
          foreach($request->size as $sizeName){

                $size = new Size();
                $size->product_id = $product->id;
                $size->size_name = $sizeName;
                $size->save();

          }

        }

        
          //gellary image

          if(isset($request->galleryimage)){

            $images = GalleryImage::where('product_id', $product->id)->get();
            foreach ($images as $galleryImage){

              if($galleryImage->image && file_exists('backend/images/galleryimage/'.$galleryImage->image))
              {
                   unlink('backend/images/galleryimage/'.$galleryImage->image);
        
              }

              $galleryImage->delete();
            }

            foreach($request->galleryimage as $image){
            
              $galleryimage = new GalleryImage();
              $galleryimage->product_id = $product->id;

              $imageName = rand().'-gallery-'.'.'. $image->extension();
              $image->move('backend/images/galleryimage/', $imageName);
    
              $galleryimage->image =  $imageName;
              $galleryimage->save();

            }
          }

          return redirect()->back();

      }

      //Review Product
        
      public function createReview (){

       $products = Product::orderBy('name', 'asc')->get();

       return view ('backend.review.create', compact('products'));     
          
      }

      public function storeReview (Request $request){
        
        $review = new Review();

        if(isset($request->image))
         {

          $imageName = rand().'-review-'.'.'. $request->image->extension();
          $request->image->move('backend/images/review/', $imageName);

          $review->image = $imageName;
      }

      $review->product_id = $request->product_id;
      $review->name = $request->name;
      $review->status = $request->status;
      $review->comments= $request->comments;
      $review->rating= $request->rating;

      $review->save();

      toastr()->success('Review is added successfully');

      return redirect()->back();

      }

      public function showReview (){
         
        $reviews = Review::with('product')->get();

        return view('backend.review.list', compact('reviews'));

      }


      public function deleteReview ($id){

        $review = Review::first($id);

        $review->delete();

        toastr()->success('Delete Successfuly');
        return redirect()->back();

      }

      public function editReview ($id){
         
        $review = Review::find($id);

        return view('backend.review.edit', compact('review'));

      }

      public function updateeReview (Request $request, $id){

        $reviews = Review::find($id);

        $reviews->product_id = $request->product_id;
        $reviews->name = $request->name;
        $reviews->status = $request->status;
        $reviews->comments = $request->comments;
        $reviews->rating = $request->rating;
        $reviews->image = $request->image;

        $reviews->save();

        toastr()->success('update successfully');

        return redirect()>back();

      }

    

     

}
