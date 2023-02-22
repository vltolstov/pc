<?php

namespace App\Http\Controllers;

use App\Models\ParametrSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{

    public static function imageDataProcessing($images, $name)
    {

        $imageWidths = [200 => '200x150', 400 => '400x300', 800 => '800x600', 1200 => '1200x960', 2000 => '2000x1500'];

        $index = 1;
        $imageObj = [];
        $imageArr = [];

        if($images->input('upload-images')){
            foreach ($images->input('upload-images') as $item) {
                $imageObj['main'] = $item;
                foreach ($imageWidths as $key => $resolution){
                    $imageObj[$resolution] = mb_substr($item, 0 , mb_strpos($item, '.')) . '-' . $resolution . '.jpg';
                }
                $imageArr['image-' . $index] = $imageObj;
                $index++;
            }
        }


        if($images->file()) {
            foreach ($images->file() as $key => $value) {
                if (preg_match('/image-[0-9]/', $key)) {
                    $image = $images->file($key);
                    $fileName = $image->getClientOriginalName();
                    $fileName = substr($fileName, 0, strrpos($fileName, '.'));
                    $fileName = Str::slug($fileName);

                    $fileExtension = $image->getClientOriginalExtension();
                    $uploadFolder = '/img/' . $name;

                    $imageData = [
                        'name' => $fileName . '.' . $fileExtension,
                        'uploadFolder' => $uploadFolder,
                        'fullPath' => $uploadFolder . '/' . $fileName . '.' . $fileExtension
                    ];

                    $imageObj['main'] = $imageData['fullPath'];
                    Storage::putFileAs($imageData['uploadFolder'], $image, $imageData['name']);

                    foreach ($imageWidths as $width  => $resolution){
                        $resizeImage = Image::make($image)->resize($width,null, function ($constraint){
                            $constraint->aspectRatio();
                        });
                        $imageObj[$resolution] = $uploadFolder . '/' . $fileName . '-' . $resolution . '.jpg';
                        Storage::put( $uploadFolder . '/' . $fileName . '-' . $resolution . '.jpg', $resizeImage->encode('jpg', 60));
                    }

                    $imageArr['image-' . $index] = $imageObj;
                    $index++;
                }
            }
        }

        return json_encode($imageArr);

    }

}
