<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'published',
        'description',
        'youtube_link',
        'spotify_link'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('audio');

        $this->addMediaCollection('episode_thumbnail');
    }

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
