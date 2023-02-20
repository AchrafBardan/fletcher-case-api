<?php

namespace App\Library\Actions\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

class BuildIndexQuery {
    public function __invoke(Builder|Relation|string $subject = Hotel::class)
    {
        return QueryBuilder::for($subject);
    }
}
