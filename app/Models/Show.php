<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Show extends Model implements HasMedia
{
    use HasFactory, HasUuids, SoftDeletes, InteractsWithMedia;

    protected $fillables = [
        'title',
        'user_id',
        'slug',
        'description',
        'published'
    ];

    public function getDescription()
    {
        return Str::words($this->description, 30);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function episode(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('show_thumbnail');
    }
}
