<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\RequestReturn;
use Flasher\Laravel\Http\Request as HttpRequest;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class FrontendController extends Controller
{
    public function index ()


    {

      $hotProducts = Product::where('products_type','hot')->get();
      $regularProducst = Product::where('products_type','regular')->get();
      $newProducts = Product::where('products_type','new')->get();
      $discountProducts = Product::where('products_type','discount')->get();

        return view ('frontend.index',compact('hotProducts','regularProducst','newProducts','discountProducts'));
    }
     

     public function productDateils ($slug)
     {
         $product = Product ::where('slug',$slug)->with('color','size','galleryimage','review')->first();
          
          return view ('frontend.product-dateils' ,compact('product'));


     }


     public function viewCart ()
     {

        return view ('frontend.view-cart');

     }


     public function checkout ()
     {

        return view ('frontend.checkout');
     }


     public function addToCart (Request $request, $id)
     {      
           $cartProduct = Cart::where('product_id',$id)->where('ip_address',$request->ip())->first();
           $product = Product::find($id);

         if( $cartProduct == null)
         {

            $cart = new Cart();

            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = 1;
            if($product->discount_price != null){
              
             $cart->price = $product->discount_price;
            }
 
            if($product->discount_price == null){
 
             $cart->price = $product->regular_price;
 
            }
 
            $cart->save();
            toastr()->success('successfully added to cart!');
            return redirect()->back();


         }

         if( $cartProduct != null)
         {

            $cartProduct->qty = $cartProduct->qty+1;
            $cartProduct->save();
            toastr()->success('successfully added to cart!');
            return redirect()->back();

         }
         
     }

     public function addToCartDelete ($id)

     {
        $cart = Cart::find($id);
        $cart->delete();
          
        toastr()->success('successfully deleted from cart!');
        return redirect()->back();

     }

     public function addToCartDetails (Request $request,$id) 
      {
          $cartProduct = Cart::where('product_id',$id)->where('ip_address',$request->ip())->first();
          $product = Product::find($id);

        if( $cartProduct == null)
        {

          $cart = new Cart();

          $cart->ip_address = $request->ip();
          $cart->product_id = $product->id;
          $cart->qty = $request->qty;
          $cart->color = $request->color;
          $cart->size = $request->size;
          if($product->discount_price != null){
            
            $cart->price = $product->discount_price;
          }

          if($product->discount_price == null){

            $cart->price = $product->regular_price;

          }

          $cart->save();
          if($request->action == 'addToCart')
          {
            toastr()->success('successfully added to cart!');
            return redirect()->back();
          }
          
          else if($request->action == 'buyNow')
          {
            toastr()->success('successfully added to cart!');
            return redirect('/checkout');
          }


        }

        if( $cartProduct != null)
        {

          $cartProduct->qty = $cartProduct->qty+$request->qty;
          $cartProduct->save();
          if($request->action == 'addToCart')
          {
            toastr()->success('successfully added to cart!');
            return redirect()->back();
          }
          
          else if($request->action == 'buyNow')
          {
            toastr()->success('successfully added to cart!');
            return redirect('/checkout');
          }

        }

     }

       public function confirmOrder (Request $request) 
       {
             $order = new Order();

             $previousOrder = Order :: orderBy('id', 'desc')->first();
             if($previousOrder == null){
              $generatedInvoiceId = 'XYZ-1';
              $order->invoiceId = $generatedInvoiceId;

             }

             else{

              $generatedInvoiceId = 'XYZ-1'. $previousOrder->id+1;

              $order->invoiceId = $generatedInvoiceId;

             }

             $order->c_name = $request->c_name;
             $order->c_phone = $request->c_phone;
             $order->address = $request->address;
             $order->area = $request->area;
             $order->price = $request->inputGrandTotal;



              $cartProducts = Cart::where('ip_address', $request->ip())->get();

              if($cartProducts->isNotEmpty()){
                
              $order->save(); 

              foreach($cartProducts as $cart)
               {
                    $orderDetails = new OrderDetails();

                    $orderDetails->order_id = $order->id;
                    $orderDetails->product_id = $cart->product_id;
                    $orderDetails->size = $cart->size;
                    $orderDetails->color = $cart->color;
                    $orderDetails->qty = $cart->qty;
                    $orderDetails->price = $cart->price;

                    $orderDetails->save();
                    $cart->delete();
                    
                }

              }

               else {

                 
             toastr()->warning('no products in your cart !! ');
             return redirect()->back();

               }

             toastr()->success('order has been place successfully ');
             return redirect('order-confirmed/'.$generatedInvoiceId);
  
       }


        public function thankYouPage ($invoceId) {
            
          return view ('frontend.thank-you',compact('invoceId'));

        }
       

        //category products
        
      public function categoryProduct ($slug, $id)
   
     {
       $products = Product::where('cat_id',$id)->get();
       $productsCount = $products->count();
  
       return view('frontend.category-products', compact('products', 'productsCount'));
            
     }

     // shop products

      public function shopProducts (Request $request) {
             
            if(isset($request->categoryId)){
              
              $products = Product:: orderBy('id' ,'desc')->where('cat_id', $request->categoryId)->get();

            }

            elseif(isset($request->subcategoryId)){
              
              $products = Product:: orderBy('id' ,'desc')->where('sub_cat_id', $request->subcategoryId)->get();

            }

            else{

              $products = Product:: orderBy('id' ,'desc')->get();

            }
            $productsCount = $products->count();

           return view ('frontend.shop', compact('products', 'productsCount'));

      }
     
       
     // privacy policy

     public function privacyPolicy (){

           return view('frontend.privacy-policy');

     }


       public function termsConditions (){

             return view('frontend.terms-conditions');

       }

          public function refundPolicy (){

            return view('frontend.refund-policy');

       }


      public function  paymentPolicy(){

        return view('frontend.payment-policy');

      }  

       
      public function aboutUs (){

        return view('frontend.about-us');

      }
       


      public function typeProduct ($type){

        $typeProducts = Product::where('products_type', $type)->get();
        $productsCount =  $typeProducts->count();
        return view('frontend.type-product', compact('typeProducts','type','productsCount' ));

      }


    public function showReturnForm (){

         return view('frontend.return-product');

    }

    public function storeReturnRequest (Request $request){

         $returnRequest = new RequestReturn();

         $returnRequest->c_name = $request->c_name;
         $returnRequest->c_phone = $request->c_phone;
         $returnRequest->address= $request->address;
         $returnRequest->order_id = $request->order_id;
         $returnRequest->issue = $request->issue;


         if(isset($request->image))
         {

          $imageName = rand().'-return-'.'.'. $request->image->extension();
          $request->image->move('backend/images/return/', $imageName);

          $returnRequest->image = $imageName;

         }
         
         $returnRequest->save();

         toastr()->success('Request has been send successfully');

         return redirect()->back();

    }

    public function showContactForm (){

      return view('frontend.contact-form');

    }

     public function storeContactForm (Request $request){

        $contactMessage = new ContactMessage();

        $contactMessage->name = $request->name;
        $contactMessage->phone = $request->phone;
        $contactMessage->email = $request->email;
        $contactMessage->subject = $request->subject;
        $contactMessage->message = $request->message;

        $contactMessage->save();

        toastr()->success('Message has been send successfully');

        return redirect()->back();


      }

       public function searchProduct (Request $request){

        $products = Product::where('name','LIKE', '%' .$request->search. '%')->get();
         $productsCount =  $products->count();
        return view('frontend.searched-products', compact('products','productsCount'));

       }
       
       

    
}
