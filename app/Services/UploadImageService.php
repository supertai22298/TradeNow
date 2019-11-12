<?php
namespace App\Services;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class UploadImageService {
      /**
     * @param UploadFile $file
     * @return String $path
     */
    public static function uploadImage(UploadedFile $file) {
        $imageName = '';
        $imagePath = \public_path('/images');
        if($file) {
            $imageExt = $file->getClientOriginalExtension();

            $imageName = date('Y-M-D') . '-' . round(microtime(true) * 1000).'.' . $imageExt;

            $file->move($imagePath, $imageName);
        }
        return $imagePath . '/' . $imageName; // trả về đường dẫn thư mục public
    }

    /**
     * @param String $path
     * @param Integer $width
     * @param Integer $height
     * @return String $path
     */
    public static function resizeImage($path, $width, $height) {
        $thumbnailPath = \public_path('/thumbnails');
        $thumbnailName = $width .'x'. $height . '-' . \basename($path);
        $resizeImage = Image::make($path);
        
        $resizeImage->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $thumbnailName);

        return  $thumbnailPath . '/' . $thumbnailName;
    }
}