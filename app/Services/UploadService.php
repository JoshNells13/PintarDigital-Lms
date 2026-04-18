<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadService
{
    public function upload(UploadedFile $file, string $path, ?string $oldFile = null): string
    {
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile);
        }

        return $file->store($path, 'public');
    }

    public function delete(?string $path): bool
    {
        if ($path) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
