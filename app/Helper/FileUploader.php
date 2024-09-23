<?php

namespace App\Helper;

class FileUploader
{
    public static function uploadFile($file, $path)
    {
        $file_extension = $file->getClientOriginalExtension();
        $file_name = sha1(time()) . "." . $file_extension;
        $path = $file->storeAs("images/$path", $file_name);
        return $path;
    }
}
