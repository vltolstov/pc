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

        $imageWidths = [2000 => '2000x1500', 1200 => '1200x900', 800 => '800x600', 400 => '400x300', 200 => '200x150'];

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

                    $imageSizes = getimagesize($image);
                    $originalWidth = $imageSizes[0];
                    $originalHeight = $imageSizes[1];

                    $imageData = [
                        'name' => $fileName . '.' . $fileExtension,
                        'uploadFolder' => $uploadFolder,
                        'fullPath' => $uploadFolder . '/' . $fileName . '.' . $fileExtension
                    ];

                    $imageObj['main'] = $imageData['fullPath'];
                    Storage::putFileAs($imageData['uploadFolder'], $image, $imageData['name']);

                    $resizeImage = '';
                    if($originalWidth > $originalHeight) {
                        $newWidth = round($originalHeight / 3 * 4, 0);
                        $resizeImage = Image::make($image)->crop($newWidth, $originalHeight, round(($originalWidth - $newWidth) / 2, 0), 0);
                    } else {
                        $newHeight = round($originalWidth / 4 * 3, 0);
                        $resizeImage = Image::make($image)->crop($originalWidth, $newHeight, 0, round(($originalHeight - $newHeight) / 2, 0 ));
                    }

                    foreach ($imageWidths as $width  => $resolution){
                        $resizeImage->resize($width,null, function ($constraint){
                            $constraint->aspectRatio();
                        });
                        $resizeImage->insert('images/watermark-' . $width . '.png', 'center');
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
