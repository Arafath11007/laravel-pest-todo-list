<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $casts = [
        'learnings' => 'array',
    ];

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function scopeReleased(Builder $builder): void
    {
        $builder->whereNotNull('released_at');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
