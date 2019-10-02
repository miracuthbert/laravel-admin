<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrderableTrait
{
    /**
     * Order model results by recently published.
     *
     * @param Builder $builder
     * @return mixed
     */
    public function scopeRecentlyPublished(Builder $builder)
    {
        return $builder->orderBy('published_at', 'desc');
    }

    /**
     * Order model results by latest first.
     *
     * @param Builder $builder
     * @return mixed
     */
    public function scopeLatestFirst(Builder $builder)
    {
        return $builder->orderBy('created_at', 'desc');
    }

    /**
     * Order model results by latest delete.
     *
     * @param Builder $builder
     * @return mixed
     */
    public function scopeLatestDelete(Builder $builder)
    {
        return $builder->orderBy('deleted_at', 'desc');
    }
}