<?php 

namespace App\Helpers;

use Image;
use Config;
use Storage;

class ImagesHelper
{
    public static function saveFile($file, $folder)
    {
        $extension       = $file->getClientOriginalExtension();
        $originalName    = $file->getClientOriginalName();
        $originalNameRaw = substr($originalName, 0, strrpos($originalName, "."));
        
        $slug            = \Illuminate\Support\Str::slug($originalNameRaw, '-');
        $timedFileName   = $slug . '-' . strtotime('now') ;
        $fileName = $timedFileName . '.' . $extension;
        $filePath        = $folder . '/' . $fileName;

        Storage::disk('public')->makeDirectory($folder);
        Storage::disk('public')->put($filePath, \File::get( $file ));
    
        self::makeThumbnails($folder, $timedFileName, $extension);

        return [
            'file_slug' => $slug,
            'file_extension' => $extension,
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

    public static function deleteThumbnails($filePath) 
    {
        $nameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filePath);
        $extension = preg_match('/\./', $filePath) ? preg_replace('/^.*\./', '', $filePath) : '';

        foreach(config('constants.thumbnails') as $sizeSlug => $size) {
            $toDelete = $nameWithoutExt . '-' . $sizeSlug . '.' . $extension;
            self::deleteFile($toDelete);
        }
    }

    public static function makeThumbnails($folder, $timedFileName, $extension) 
    {
        $allowedExtensions = config('constants.valid_image_types');
        $shouldMakeThumbnails = in_array($extension, $allowedExtensions) ? true : false;

        if($shouldMakeThumbnails) {
            $source = public_path() . '/storage/' . $folder . '/' . $timedFileName . '.' . $extension;
    
            foreach(config('constants.thumbnails') as $sizeSlug => $size) {
                $filePath = public_path() . '/storage/' . $folder . '/' . $timedFileName . '-' . $sizeSlug . '.' . $extension;
    
                Image::make($source)
                    ->fit($size['width'], $size['height'], function ($constraint) {
                        $constraint->upsize();
                    })
                    ->save($filePath);
            }
        }
    }

    public static function getUrlPath($filePath, $thumbnailType = '') 
    {
        $newFilePath = $filePath;

        $shouldPrepareThumbnail = $thumbnailType !== '';

        if($shouldPrepareThumbnail) {
            $nameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filePath);
            $extension = preg_match('/\./', $filePath) ? preg_replace('/^.*\./', '', $filePath) : '';
            
            return $nameWithoutExt . '-' . $thumbnailType . '.' . $extension;
        }
        
        return $newFilePath;
    }

}