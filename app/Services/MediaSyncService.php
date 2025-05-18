<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Facades\Log;
use Exception;
use Spatie\MediaLibrary\HasMedia;

class MediaSyncService
{
    protected string $tempDir;

    public function __construct()
    {
        $this->tempDir = storage_path('app/public/tmp/uploads/');
    }

    public function addImages(HasMedia $model, array $filenames, string $collection): void
    {
        foreach ($filenames as $filename) {
            $filename = trim(basename($filename));
            $tempPath = $this->tempDir . $filename;

            if (file_exists($tempPath)) {
                try {
                    $model->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection($collection);

                    unlink($tempPath);
                    Log::info("Added file and deleted temp: {$filename}");
                } catch (Exception $e) {
                    Log::error("Failed to add file {$filename}: " . $e->getMessage());
                }
            } else {
                Log::warning("Temp file not found: {$tempPath}");
            }
        }
    }

    public function syncImages(HasMedia $model, array $filenames, string $collection): void
    {
        $filenames = collect($filenames)
            ->map(fn($name) => trim(basename($name), "\"'"))
            ->unique()
            ->values()
            ->toArray();

        Log::info("Syncing files in collection [{$collection}]:", $filenames);

        $existingMedia = $model->getMedia($collection);

        // Delete media not in the new list
        $existingMedia->each(function ($media) use ($filenames) {
            if (!in_array($media->file_name, $filenames)) {
                Log::info("Deleting media: {$media->file_name}");
                $media->delete();
            } else {
                Log::info("Keeping media: {$media->file_name}");
            }
        });

        $model->refresh();
        $mediaItems = $model->getMedia($collection);

        // Set order for existing media
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
                    $model->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection($collection);
                    unlink($tempPath);
                    Log::info("Added and removed temp file: {$filename}");
                } catch (Exception $e) {
                    Log::error("Failed to add file {$filename}: " . $e->getMessage());
                }
            } else {
                Log::warning("Temp file not found when syncing: {$tempPath}");
            }
        }
    }
}
