<?php 

namespace App\Helpers;

use Storage;

class ImagesHelper
{
    public static function saveFile($file, $folder)
    {
        $extension       = $file->getClientOriginalExtension();
        $originalName    = $file->getClientOriginalName();
        $originalNameRaw = substr($originalName, 0, strrpos($originalName, "."));
        
        $slug            = \Illuminate\Support\Str::slug($originalNameRaw, '-');
        $fileName        = $slug . '-' . strtotime('now') . '.' . $extension;
        $filePath        = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, \File::get( $file ));

        return [
            'slug' => $slug,
            'extension' => $extension,
            'file_original_name' => $originalName,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_url' => Storage::url($filePath),
        ];
    }

    public static function deleteFile($filePath)
    {
        $fileExists = Storage::disk('public')->exists($filePath);
        
        if ($fileExists) {
            Storage::disk('public')->delete($filePath);
        }
        
    }
}