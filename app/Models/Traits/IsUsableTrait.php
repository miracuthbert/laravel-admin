<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsUsableTrait
{
    /**
     * Scope query to only include 'active' models.
     *
     * @param Builder $builder
     * @param string $column
     */
    public function scopeActive(Builder $builder, $column = 'usable')
    {
        $builder->where($column, true);
    }

    /**
     * Scope query to only include 'disabled' models.
     *
     * @param Builder $builder
     * @param string $column
     */
    public function scopeDisabled(Builder $builder, $column = 'usable')
    {
        $builder->where($column, false);
    }

    /**
     * Scope query to include only live models.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeLive(Builder $builder)
    {
        return $builder->where('live', true);
    }
}