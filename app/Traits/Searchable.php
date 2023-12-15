<?php

namespace App\Traits;

use App\Http\Controllers\SearchController;
use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearchable(Builder $query, array $columns = ['name'], array $translatedKeys = [], string $handleKeyName = 'handle')
    {
        SearchController::searchForHandle($query, $columns, request($handleKeyName), $translatedKeys);
    }
}
