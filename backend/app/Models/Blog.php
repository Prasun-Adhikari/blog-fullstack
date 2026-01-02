<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected static function booted(): void
    {
        // every query that hits this model will be ordered by `created_at DESC`
        static::addGlobalScope('orderByDate', function (Builder $builder) {
            $builder->orderByDesc('date');
        });
    }

    use HasFactory;
    protected $fillable = [
        "title",
        "date",
        "text",
        "user_id",
        "imgUrl"
    ];

    public function user(): BelongsTo {
        // user_id and id would be the default values also
        return $this->belongsTo(User::class,"user_id","id");
    }
}
