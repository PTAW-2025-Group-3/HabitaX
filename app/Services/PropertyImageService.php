<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Facades\Log;
use Exception;

class PropertyImageService
{
    protected string $tempDir;

    public function __construct()
    {
        $this->tempDir = storage_path('app/public/tmp/uploads/');
    }

    public function addImages(Property $property, array $filenames): void
    {
        foreach ($filenames as $filename) {
            $filename = trim(basename($filename));
            $tempPath = $this->tempDir . $filename;

            if (file_exists($tempPath)) {
                try {
                    $property->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                    unlink($tempPath);
                    Log::info('Added image from temp and removed: ' . $filename);
                } catch (Exception $e) {
                    Log::error('Failed to add image: ' . $e->getMessage());
                }
            } else {
                Log::warning('Temp file not found: ' . $tempPath);
            }
        }
    }

    public function syncImages(Property $property, array $filenames): void
    {
        $filenames = collect($filenames)
            ->map(fn($name) => trim(basename($name), "\"'"))
            ->unique()
            ->values()
            ->toArray();

        Log::info('Syncing images, cleaned filenames:', $filenames);

        $existingMedia = $property->getMedia('images');

        $existingMedia->each(function ($media) use ($filenames) {
            if (!in_array($media->file_name, $filenames)) {
                Log::info('Deleting media: ' . $media->file_name);
                $media->delete();
            } else {
                Log::info('Keeping media: ' . $media->file_name);
            }
        });

        $property->refresh();
        $mediaItems = $property->getMedia('images');

        foreach ($filenames as $index => $filename) {
            $media = $mediaItems->firstWhere('file_name', $filename);
            if ($media) {
                $media->order_column = $index + 1;
                $media->save();
                Log::info("Set order for {$filename} → " . ($index + 1));
            } else {
                Log::warning("Media not found for ordering: {$filename}");
            }
        }

        $existingNames = $mediaItems->pluck('file_name')->toArray();

        foreach ($filenames as $filename) {
            if (in_array($filename, $existingNames)) {
                continue;
            }

            $tempPath = $this->tempDir . $filename;

            if (file_exists($tempPath)) {
                try {
                    $property->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                    unlink($tempPath);
                    Log::info('Added and removed temp file: ' . $filename);
                } catch (Exception $e) {
                    Log::error('Failed to add image: ' . $e->getMessage());
                }
            } else {
                Log::warning('Temp file not found when syncing: ' . $tempPath);
            }
        }
    }
}
