<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompleteSolutionController extends Controller
{
    public static function imageSolutionProcessing($request, $name)
    {

        $imageObj = [];

        if ($request->input('solution_image')) {
            $imageObj['main'] = $request->input('solution_image');
        }

        if($request->file('solution_image')) {

            $image = $request->file('solution_image');
            $fileName = $image->getClientOriginalName();
            $fileName = substr($fileName, 0, strrpos($fileName, '.'));
            $fileName = Str::slug($fileName);
            $fileExtension = $image->getClientOriginalExtension();
            $uploadFolder = '/img/' . $name . '-' . 'solution';
            $requestizes = getimagesize($image);
            $originalWidth = $requestizes[0];
            $originalHeight = $requestizes[1];
            $imageData = [
                'name' => $fileName . '.' . $fileExtension,
                'uploadFolder' => $uploadFolder,
                'fullPath' => $uploadFolder . '/' . $fileName . '.' . $fileExtension
            ];

            $imageObj['main'] = $imageData['fullPath'];
            Storage::putFileAs($imageData['uploadFolder'], $image, $imageData['name']);

            $background = Image::canvas($originalWidth + 10, $originalHeight + 10);
            $resizeImage = $background->insert(Image::make($image), 'center');
            $resizeImage->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizeImage->insert('images/watermark-800.png', 'center');
            $imageObj['resize'] = $uploadFolder . '/' . $fileName . '-' . 'resize' . '.png';
            Storage::put($uploadFolder . '/' . $fileName . '-' . 'resize' . '.png', $resizeImage->encode('png', 60));

        } else {
            $imageObj['resize'] = $request->input('solution_image');
        }

        return $imageObj['resize'];

    }

}
