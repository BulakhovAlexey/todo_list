<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_completed',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['tag'] ?? null, function ($query, $tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $tagsArray = explode(',', $tag);
                $query->whereIn('tags.id', $tagsArray);
            });
        });

        if (isset($filters['is_completed']) && in_array($filters['is_completed'], ['0', '1'])) {
            $query->where('is_completed', (int)$filters['is_completed']);
        }
    }

}
