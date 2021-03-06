<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function upload_images(Request $request){
      $patient_id = $request->patient_id;

      $filename = 'pic_'.date('YmdHis').'.jpeg';
      $filepath = public_path('upload_images/');

      if(move_uploaded_file($_FILES['webcam']['tmp_name'],$filepath.$filename)){
        $photo = new Photo;
        $photo->name = $filename;
        $photo->save();

        return json_encode($photo, 200);
      }

      return json_encode('Something wrong when process upload images', 500);
    }
  
    public function get_photo_no_threatment(){
      $photos = Photo::where('treatment_id', NULL)->get();

      return json_encode($photos, 200);
    }

    public function get_photo($id){
      $photo = Photo::findOrFail($id);

      return json_encode($photo, 200);
    }

    public function delete_image(Request $request){
      $photo = Photo::findOrFail($request->id);

      $image_path = public_path('upload_images/'.$photo->name);
      if(File::exists($image_path)) {
        File::delete($image_path);
      }

      $photo->delete();

      return json_encode("Success", 200);
    }

    public function update_image(Request $request){
      $photo = Photo::findOrFail($request->id);

      $image_path = public_path('upload_images/'.$photo->name);
      if(File::exists($image_path)) {
        File::delete($image_path);
      }

      $filename = 'pic_'.rand().'_'.date('YmdHis').'.jpeg';
      $filepath = public_path('upload_images/');

      if(move_uploaded_file($_FILES['webcam']['tmp_name'],$filepath.$filename)){
        $photo->name = $filename;
        $photo->save();

        return json_encode('Foto tertanggal '.date("d-m-Y", strtotime($photo->treatment->created_at)).' telah berhasil di retake', 200);
      }

      return json_encode('Something wrong when process upload images', 500);
    }
}
