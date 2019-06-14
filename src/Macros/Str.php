<?php

use Illuminate\Support\Str;

/*
 * Returns the string that matchest the longest FULL string from an array of strings.
 * @param array $haystack The strings array.
 * @param string $needle The string to match.
 * @return string|null The full longest string matched, or null in case there is no match.
 */
Str::macro('longestMatch', function (array $haystack, string $needle) {
    $longestDegree = 0;
    $result = null;
    collect($haystack)->each(function ($item) use ($needle, &$result, &$longestDegree) {
        $partialDegree = 0;
        foreach (str_split($item) as $index => $letter) {
            // Test each letter, and exit when letter is different.
            if ($letter != substr($needle, $index, 1)) {
                break;
            }
            $partialDegree++;
        }

        if ($partialDegree > $longestDegree && $partialDegree == strlen($item)) {
            $longestDegree = $partialDegree;
            $result = $item;
        }
    });

    return $result;
});
