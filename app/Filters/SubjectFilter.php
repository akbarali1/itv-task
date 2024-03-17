<?php
declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SubjectFilter implements EloquentFilterContract
{
    protected function __construct(
        protected readonly int $id
    ) {}

    public function applyEloquent(Builder $model): Builder
    {
        return $model->where('subject_id', '=', $this->id);
    }

    public static function getFilter(int $subjectId): SubjectFilter
    {
        return new self($subjectId);
    }
}

