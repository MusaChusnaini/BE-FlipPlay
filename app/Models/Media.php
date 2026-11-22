<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'title',
        'type',
        'genre',
        'release_year',
        'description',
    ];

    protected $casts = [
        'release_year' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'media_user')->withTimestamps();
    }

    // Query scope untuk fitur pencarian berdasarkan judul
    public function scopeSearchTitle(Builder $query, ?string $title): Builder
    {
        if ($title) {
            return $query->where('title', 'like', '%' . $title . '%');
        }
        return $query;
    }
}
