<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Image;

trait ImageTrait {

    /**
     * @param Image $image
     * @param Model $model
     * @param String $tagName
     * @param boolean $isOld
     * @return void
     */
    public function saveImage($image, $model, $tagName, $isOld = false) {
        if ($isOld) {
            $imageExist = public_path('uploads/'.$model->src_foto);
            if ( $model->src_foto && file_exists($imageExist) ){
                unlink($imageExist);
                unlink(public_path('uploads/thumbnail/'.$model->src_foto));
                unlink(public_path('uploads/thumbnail-small/'.$model->src_foto));
            }
        }
        $imageName = $tagName.'_'.$model->id.date('ymdHis').'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        $img = Image::make(public_path('uploads/'.$imageName))->resize(300, 375);
        $img->save(public_path('uploads/thumbnail/'.$imageName));
        $imgSm = Image::make(public_path('uploads/'.$imageName))->resize(50, 50);
        $imgSm->save(public_path('uploads/thumbnail-small/'.$imageName));
        $model->src_foto = $imageName;    

        $model->save();

        return null;        
    }

}