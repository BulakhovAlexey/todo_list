<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return Tag::all();
    }

    /**
     * @param Task $task
     * @param array $tagIds
     */
    public function syncTaskTags(Task $task, array $tagIds)
    {
        $task->tags()->sync($tagIds);
    }

}
