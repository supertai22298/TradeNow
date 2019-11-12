<?php
namespace App\Services;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class UploadImageService {

    /**
     * @param \Illuminate\Http\Request  $request
     * @param Integer $width = 320
     * @param Integer $height = 320
     * @return String $imageName
     */
    public static function uploadImage(Request $request, $width = 320, $height = 320) {

        $imageFile = $request->has('image') ? $request->file('image'): null;

        $imageName = '';

        $imagePath = \public_path('/images');
        $thumbnailPath = \public_path('/thumbnails');

        if($imageFile) {
            $imageExt = $imageFile->getClientOriginalExtension();

            $imageName = date('Y-M-D') . '-' . round(microtime(true) * 1000).'.' . $imageExt;

            $resizeImage = Image::make($imageFile->getRealPath());

            $resizeImage->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbnailPath . '/' . $imageName);

            $imageFile->move($imagePath, $imageName);

        }
        return $imageName;
    }
}