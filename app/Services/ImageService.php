<?php

namespace App\Services;

use GuzzleHttp\Psr7\UploadedFile;

class ImageService
{
    public function saveImage(mixed $file, string $storagePath): string
    {
        $fileName = time() . '_' . $file->extension();
        $file->move(storage_path($storagePath), $fileName);

        return $fileName;
    }


    public function deleteImage(string $fileName, string $storagePath): void
    {
        $filePath = storage_path("$storagePath/$fileName");

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
