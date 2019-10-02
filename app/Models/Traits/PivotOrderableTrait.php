<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PivotOrderableTrait
{
    /**
     * Order model results by pivot column.
     *
     * @param Builder $builder
     * @param string $column
     * @param string $order
     * @return mixed
     */
    public function scopeOrderByPivot(Builder $builder, $column = 'created_at', $order = 'desc')
    {
        return $builder->orderBy('pivot_' . $column, $order);
    }
}