<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class SubcategoryController extends Controller
{
    public function create ()
    {

        $categories = Category:: get();

          return view('backend.subcategory.create',compact('categories'));

    }

    public function store (Request $request)

    {
          $subCategory = new Subcategory();

          $subCategory->cat_id = $request->cat_id;
          $subCategory->name = $request->name;
          $subCategory->slug = Str::slug($request->name);

          $subCategory->save();
          return redirect()->back();




    }


     public function show ()

    { $SubCategories = Subcategory::with('category')->get();
     // dd($SubCategories);
     
     return view ('backend.subcategory.list',compact('SubCategories'));
    
    }

      public function delete ($id)
      {
           $subCategory =   Subcategory::find($id);
           $subCategory->delete();

           return redirect()->back();

      }

      public function edit ($id)
      {
         $SubCategory = Subcategory::find($id);
         $categories = Category::get();

         return view ('backend.subcategory.edit',compact('SubCategory','categories'));


      }

      public function update (Request $request, $id)
      {
            $SubCategory = Subcategory::find($id);

            $SubCategory->name = $request->name;
            $SubCategory->cat_id = $request->cat_id;
            $SubCategory->slug = Str::slug($request->name);


            $SubCategory->save();

            return redirect()->back();

      }
          

   





 
 
}
