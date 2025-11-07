<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "date",
        "text",
        "user_id"
    ];

    public function user(): BelongsTo {
        // user_id and id would be the default values also
        return $this->belongsTo(User::class,"user_id","id");
    }
}
