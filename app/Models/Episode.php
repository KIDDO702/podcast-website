<?php

namespace App\Models;

use BeyondCode\Comments\Traits\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'published',
        'description'
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
}
