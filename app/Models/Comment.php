<?php

namespace App\Models;

use App\Models\CommentLikeDislike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'episode_id',
        'parent_id',
        'approved',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likesDislikes()
    {
        return $this->hasMany(CommentLikeDislike::class);
    }

    public function likes()
    {
        return $this->likesDislikes()->where('reaction', 'like');
    }

    public function dislikes()
    {
        return $this->likesDislikes()->where('reaction', 'dislike');
    }
}
