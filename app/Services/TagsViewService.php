<?php

namespace App\Services;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Models\Task;
use App\Services\Interfaces\CrudInterfaces\IndexInterface;
use App\Services\Interfaces\CrudInterfaces\UpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TagsViewService implements IndexInterface, UpdateInterface
{
    public function getIndexData(array $params = []): array
    {
        return TagResource::collection($this->getTags())->resolve();
    }

    /**
     * @param $id
     * @param array $data
     * @return Model
     */
    public function updateAction($id, array $data): Model
    {
        $task = Task::find($id);
        $task->tags()->sync($data);

        return $task;
    }
    /**
     * @return Collection
     */
    private function getTags(): Collection
    {
        return Tag::all();
    }

}
