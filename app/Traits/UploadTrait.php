<?php
namespace App\Traits;
use Illuminate\Http\Request;


trait UploadTrait {


    private function imageUpload($images, $imageColumn = null)
    {
        //$images = $request->file('photos');
        $uploadedImagens = [];

         if(is_array($images)){
            foreach($images as $image){
             $uploadedImagens [] = [$imageColumn => $image->store('products', 'public')];

            }

         } else {
             $uploadedImagens = $images->store('logo', 'public');
         }



        return $uploadedImagens;
    }
}
