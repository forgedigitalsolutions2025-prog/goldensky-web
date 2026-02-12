<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadHelper
{
    /**
     * Sanitize and store uploaded file
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param array $allowedMimeTypes
     * @param int $maxSizeKB
     * @return string|false
     */
    public static function sanitizeAndStore(UploadedFile $file, string $directory = 'uploads', array $allowedMimeTypes = [], int $maxSizeKB = 5120)
    {
        // Validate file size
        if ($file->getSize() > $maxSizeKB * 1024) {
            throw new \Exception("File size exceeds maximum allowed size of {$maxSizeKB}KB");
        }

        // Validate MIME type
        $mimeType = $file->getMimeType();
        if (!empty($allowedMimeTypes) && !in_array($mimeType, $allowedMimeTypes)) {
            throw new \Exception("File type not allowed. Allowed types: " . implode(', ', $allowedMimeTypes));
        }

        // Sanitize filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        
        // Remove any potentially dangerous characters
        $sanitizedName = Str::slug($nameWithoutExtension);
        $sanitizedFilename = $sanitizedName . '_' . time() . '.' . $extension;

        // Store file
        $path = $file->storeAs($directory, $sanitizedFilename, 'public');

        return $path;
    }

    /**
     * Validate image file
     */
    public static function validateImage(UploadedFile $file, int $maxSizeKB = 2048)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        return self::sanitizeAndStore($file, 'images', $allowedMimeTypes, $maxSizeKB);
    }

    /**
     * Validate document file
     */
    public static function validateDocument(UploadedFile $file, int $maxSizeKB = 5120)
    {
        $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        return self::sanitizeAndStore($file, 'documents', $allowedMimeTypes, $maxSizeKB);
    }
}



















































































