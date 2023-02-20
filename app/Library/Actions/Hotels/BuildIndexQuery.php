<?php

namespace App\Library\Actions\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

class BuildIndexQuery {
    public function __invoke(Builder|Relation|string $subject = Hotel::class, $search = null)
    {
        return QueryBuilder::for($subject)->allowedIncludes([
                'users',
            ])
            ->tap(function ($query) use ($search) {
                return $search ? $query->whereIn('id', Hotel::search($search)->keys()) : $query;
            });
    }
}
