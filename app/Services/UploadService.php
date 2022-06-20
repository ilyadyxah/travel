<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class UploadService
{
    public function saveFile(UploadedFile $file, string $path): string
    {
        $status = $file->storeAs("places/{$path}", $file->hashName(), 'public');
        if (!$status) {
            throw new Exception('файл не загружен');
        }

        return $status;
    }

    /**
     * @param string|null $path
     * @return bool
     */
    public function deleteFile(?string $path): bool
    {
        if ($path) {
            return Storage::disk('public')->delete($path);
        } else return true;

    }
}

