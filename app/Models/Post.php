<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
 * Get the indexable data array for the model.
 *
 * @return array<string, mixed>
 */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'user_id' => $this->user_id,
            'user' => (object)$this->user,
            'user.name' => $this->user->name,
            'created_at' => $this->created_at->timestamp,
        ]);
    }
}
