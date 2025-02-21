<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TagResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TagService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    protected TaskService $taskService;
    protected TagService $tagService;

    public function __construct(TaskService $taskService, TagService $tagService)
    {
        $this->taskService = $taskService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Tasks/Index', [
            'filters' => Request::all(['search','tag','is_completed']),
            'tasks' => $this->taskService->getWithPaginate(5),
            'tags' => TagResource::collection($this->tagService->getTags())->resolve(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/Create', [
            'tags' => TagResource::collection($this->tagService->getTags())->resolve(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateRequest $request)
    {
        $data = $request->validated();
        $newTask = $this->taskService->createTask($data);
        $this->tagService->syncTaskTags($newTask, $data['tags']);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Tasks/Show', [
            'task' => TaskResource::make($this->taskService->getTaskById($id))->resolve(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Tasks/Edit', [
            'task' => TaskResource::make($this->taskService->getTaskById($id))->resolve(),
            'tags' => TagResource::collection($this->tagService->getTags())->resolve(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $task = $this->taskService->getTaskById($id);
        $updatedTask = $this->taskService->updateTask($task, $data);
        $this->tagService->syncTaskTags($updatedTask, $data['tags']);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
