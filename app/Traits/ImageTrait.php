<?php

namespace App\Traits;

use File;
use Image;
use Request;

trait ImageTrait
{
    // public function uploadImage($dir, $input)
    // {
    //     $directory = public_path().$dir;
    //     if (is_dir($directory) != true) {
    //         \File::makeDirectory($directory, $mode = 0755, true);
    //     }
    //     $fileName = uniqid().'.'.Request::file($input)->getClientOriginalExtension();
    //     $image = Image::make(Request::file($input));
    //     $image->save($directory.'/'.$fileName, 100);

    //     return $fileName;
    // }

    public function uploadImage($dir, $input, $resize = false, $width = '', $height = '')
    {
        $directory = public_path() . $dir;
        if (is_dir($directory) != true) \File::makeDirectory($directory, $mode = 0775, true);
        $fileName = uniqid() ;
        $fileThumbnail = $fileName.'-medium.' . Request::file($input)->getClientOriginalExtension(); ;
        $fileName= $fileName.'.' . Request::file($input)->getClientOriginalExtension();
        $image = Image::make(Request::file($input));
        $image->orientate();
        if ($resize) {
            $image = $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        
        $image->save($directory . '/' . $fileName, 70);

        /* THUMBNAIL */
        $directoryThumbnail = public_path() . $dir ;
        if (is_dir($directoryThumbnail) != true) \File::makeDirectory($directoryThumbnail, $mode = 0775, true);
        $imageThumbnail = Image::make(Request::file($input));
        $imageThumbnail = $image->resize(500,500, function ($constraintThumbnail) {
            $constraintThumbnail->aspectRatio();
        });
        $imageThumbnail->save($directoryThumbnail . '/' . $fileThumbnail, 50); 
        /* THUMBNAIL */
        return $fileName;
    }


    public function removeImage($dir, $image)
    {
        $f1 = public_path() . $dir . '/' . $image;
        $image = str_replace('.', '-medium.', $image);
        $f2 = public_path() . $dir . '/' . $image;
        File::delete($f1);
        File::delete($f2);
    }
}
