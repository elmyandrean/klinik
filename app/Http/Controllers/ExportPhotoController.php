<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Cart;
use ZipArchive;

class ExportPhotoController extends Controller
{
    public function index(){
      $export = Cart::instance('export_photo')->content();

      $i = 0;
      $photo = [];

      foreach($export as $data){
        $photo[$i]['id'] = $data->id;
        $photo[$i]['name'] = $data->name;
        $photo[$i]['rowId'] = $data->rowId;
        $i++;
      }

      return json_encode($photo, 200);
    }

    public function add($id){
      $photo = Photo::findOrFail($id);
      Cart::instance('export_photo')->add($photo->id, $photo->name, 1, 0);
      
      return json_encode($photo, 200);
    }

    public function delete($id)
    {
      Cart::instance('export_photo')->remove($id);

      return json_encode('success', 200);
    }

    public function clear()
    {
      Cart::instance('export_photo')->destroy();
      return json_encode('success', 200);
    }

    public function download(Request $request) {

      if($request->has('data')){
        $photo_dir = public_path('upload_images/');
        $zipFileName = 'Download'.date('dmY').'.zip';

        $zip = new ZipArchive;
        if ($zip->open($photo_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
          
          
          foreach($request->data as $data){
            $file_path = $photo_dir.$data;
            $zip->addFile($file_path, $data);
          }
            
          $zip->close();
        }

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $filetopath=$photo_dir.'/'.$zipFileName;

        if(file_exists($filetopath)){
          Cart::instance('export_photo')->destroy();

          return response()->download($filetopath,$zipFileName,$headers);
        }
      }

      return Redirect::to('patients/export?patient_id='.$request->patient_id);
    }
}
