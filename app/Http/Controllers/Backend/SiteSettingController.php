<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function showSettings (){

    return view('backend.settings-policies.setting');

    }
 
    public function updateSettings (Request $request) {

     $getSiteSettings = SiteSettings::first();


     $getSiteSettings->phone = $request->phone;
     $getSiteSettings->email = $request->email;
     $getSiteSettings->address = $request->address;
     $getSiteSettings->facebook = $request->facebook;
     $getSiteSettings->twitter = $request->twitter;
     $getSiteSettings->instagram = $request->instagram;

     if(isset($request->banner)){

        if( $getSiteSettings->banner && file_exists('backend/images/settings/'. $getSiteSettings->banner)){

          unlink('backend/images/settings/'. $getSiteSettings->banner);
        }

        $imageName = rand().'-bannerUpdate-'.'.'. $request->banner->extension();
    $request->banner->move('backend/images/settings/', $imageName);

    $getSiteSettings->banner = $imageName;

      }

      if(isset($request->logo)){

        if( $getSiteSettings->logo && file_exists('backend/images/settings/'. $getSiteSettings->logo)){

          unlink('backend/images/settings/'. $getSiteSettings->logo);
        }

        $imageName = rand().'-logoUpdate-'.'.'. $request->logo->extension();
    $request->logo->move('backend/images/settings/', $imageName);

    $getSiteSettings->logo = $imageName;

      }

      $getSiteSettings->save();

      toastr()->success('successfully update');

      return redirect()->back();

   }

      
     public function showPrivacyPolicy (){
        
      return view('backend.settings-policies.privacy-policy');

     }

       
       public function  updatePrivacyPolicy (Request $request){

        $getPolicy = Policy::first();

        $getPolicy->privacy_policy = $request->privacy_policy;
        
        $getPolicy->save();

        toastr()->success('successfully update');

         return redirect()->back();


       }


       public function termsConditions (){
        
        return view('backend.settings-policies.terms-conditions');
  
       }
  
         
         public function  updateTermsConditions (Request $request){
  
          $getPolicy = Policy::first();
  
          $getPolicy->terms_conditions = $request->terms_conditions;
          
          $getPolicy->save();
  
          toastr()->success('successfully update');
  
           return redirect()->back();
  
  
         }

         public function showRefundPolicy (){
        
          return view('backend.settings-policies.refund-policy');
    
         }
    
           
           public function  updateRefundPolicy (Request $request){
    
            $getPolicy = Policy::first();
    
            $getPolicy->refund_policy = $request->refund_policy;
            
            $getPolicy->save();
    
            toastr()->success('successfully update');
    
             return redirect()->back();
    
    
           }


           public function showPaymentPolicy (){
        
            return view('backend.settings-policies.payment-policy');
      
           }
      
             
             public function updatePaymentPolicy (Request $request){
      
              $getPolicy = Policy::first();
      
              $getPolicy->payment_policy = $request->payment_policy;
              
              $getPolicy->save();
      
              toastr()->success('successfully update');
      
               return redirect()->back();
      
      
             }


             public function showAboutUs (){
        
              return view('backend.settings-policies.about-us');
        
             }
        
               
               public function updateAboutUs(Request $request){
        
                $getPolicy = Policy::first();
        
                $getPolicy->about_us = $request->about_us;
                
                $getPolicy->save();
        
                toastr()->success('successfully update');
        
                 return redirect()->back();
        
        
               }
            
          
        
          
        
      
    

}
