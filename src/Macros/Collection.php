<?php

use Illuminate\Support\Collection;

/*
 * Adds a new object in the specific index in the collection.
 * It changes the original collection, no need to use it as a return value.
 * E.g.: <mycollection>->addAt(new object(), 1) or <mycollection>->addAt('example.com', 3).
 *
 * @param      mixed   $mixed  Object to be added to the collection.
 * @param      integer $index  Zero-based index where it will be inserted (all others will be pushed forward).
 *                             Null? Appends at the end of the collection.
 *
 * @return Illuminate\Support\Collection
 */
Collection::macro('addAt', function ($mixed, int $index = null): Collection {
    return ! is_null($index) ? $this->splice($index, 0, [$mixed]) : $this->push($mixed);
});
