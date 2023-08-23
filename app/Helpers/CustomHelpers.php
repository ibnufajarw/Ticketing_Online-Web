<?php

namespace App\Helpers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Storage;

class CustomHelpers 
{
    public static function uploadImage($image, $folder, $old_image = null)
    {
        $image_name = uniqid().'.'.$image->getClientOriginalExtension();
    
        Storage::disk('public')->putFileAs('img/'.$folder, $image, $image_name);
    
        $path = Storage::disk('public')->url('img/'.$folder.'/'.$image_name);
    
        return $path;
    }
    
    public static function deleteImage($image, $folder)
    {
        $image = explode('/', $image)[6];
        $image_path = public_path('storage/img/'.$folder.'/'.$image);
    
        if(file_exists($image_path)) {
            unlink($image_path);
        }
    }
}
