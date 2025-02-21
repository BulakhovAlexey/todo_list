<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\Interfaces\CrudInterfaces\DeleteInterface;
use App\Services\Interfaces\CrudInterfaces\EditInterface;
use App\Services\Interfaces\CrudInterfaces\IndexInterface;
use App\Services\Interfaces\CrudInterfaces\ShowInterface;
use App\Services\Interfaces\CrudInterfaces\StoreInterface;
use App\Services\Interfaces\CrudInterfaces\UpdateInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;


class TasksViewService implements IndexInterface, StoreInterface, ShowInterface, EditInterface, UpdateInterface, DeleteInterface
{
    const PER_PAGE = 5;

    /**
     * @param array $params
     * @return array
     */
    public function getIndexData(array $params = []): array
    {
        $filters = $params['filters'] ?? [];

        return [
            'filters' => $filters,
            'tasks' => $this->getWithPaginate($filters),
        ];
    }

    /**
     * @param array $data
     * @return Task
     */
    public function storeAction(array $data): Task
    {
        unset($data['tags']);
        return Task::create($data);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getShowData(int $id): array
    {
        return [
            'task' => TaskResource::make($this->getTaskById($id))->resolve(),
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getEditData(int $id): array
    {
        return [
            'task' => TaskResource::make($this->getTaskById($id))->resolve(),
        ];
    }

    /**
     * @param int $id
     * @param array $data
     * @return Task
     */
    public function updateAction(int $id, array $data): Task
    {
        $task = $this->getTaskById($id);

        unset($data['tags']);

        $task->update($data);

        return $task;

    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteAction(int $id): void
    {
        $task = Task::findOrFail($id);

        $task->delete();
    }

    /**
     * @param $filters
     * @return Builder
     */
    private function getAllTasksWithTags($filters): \Illuminate\Database\Eloquent\Builder
    {
        return Task::with('tags')
            ->latest()
            ->filter($filters);
    }

    /**
     * @param $filters
     * @return LengthAwarePaginator
     */
    private function getWithPaginate($filters): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->getAllTasksWithTags($filters)->paginate(self::PER_PAGE)->withQueryString();
    }

    /**
     * @param int $id
     * @return Task
     */
    private function getTaskById(int $id): Task
    {
        return Task::with('tags')->findOrFail($id);
    }

}
