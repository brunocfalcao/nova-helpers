<?php

use Illuminate\Support\Facades\File;

/*
 * Creates directories in batch, given a directories array.
 * @var array Directories array to create (e.g.: ['test','john/smith']).
 */
File::macro('makeDirectories', function (array $directories): void {
    foreach ($directories as $directory) {
        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0775, true);
        }
    }
});
