<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;


class TaskService
{
    const PER_PAGE = 5;

    /**
     * @return Builder
     */
    private function getAllTasksWithTags(): \Illuminate\Database\Eloquent\Builder
    {
        return Task::with('tags')
            ->latest()
            ->filter(Request::only(['search', 'tag', 'is_completed']));
    }

    /**
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getWithPaginate(?int $perPage = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->getAllTasksWithTags()->paginate($perPage ?? self::PER_PAGE)->withQueryString();
    }

    /**
     * @param int $id
     * @return Task
     */
    public function getTaskById(int $id): Task
    {
        return Task::with('tags')->findOrFail($id);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data): Task
    {
        unset($data['tags']);

        $task->update($data);

        return $task;
    }

    /**
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        unset($data['tags']);

        $newTask = Task::create($data);

        return $newTask;
    }

    /**
     * @param Task $task
     * @return void
     */
    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}
