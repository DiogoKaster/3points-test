<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(static function ($model): void {
            if (blank($model->slug) && filled($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
