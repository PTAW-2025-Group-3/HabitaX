<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

final class DeleteTempUploadedFiles extends Command
{
    protected $signature = 'app:delete-temp-uploaded-files';

    protected $description = 'Delete temporary folders older than 24 hours.';

    public function handle(): void
    {
        $this->info('Command started.');

        $directories = Storage::directories('tmp');

        foreach ($directories as $directory) {
            $lastModified = Carbon::createFromTimestamp(Storage::lastModified($directory));
            $this->line("Processing: $directory (last modified: $lastModified)");

            if (now()->diffInHours($lastModified) > 24) {
                Storage::deleteDirectory($directory);
                $this->info("Deleted: $directory (last modified: $lastModified)");
            } else {
                $this->line("Skipped (too recent): $directory");
            }
        }
    }
}
