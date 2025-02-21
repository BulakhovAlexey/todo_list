<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateRequest;
use App\Services\TagsViewService;
use App\Services\TasksViewService;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    protected TasksViewService $tasksViewService;
    protected TagsViewService $tagsViewService;

    public function __construct(TasksViewService $tasksViewService, TagsViewService $tagsViewService)
    {
        $this->tasksViewService = $tasksViewService;
        $this->tagsViewService = $tagsViewService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params['filters'] = Request::all(['search','tag','is_completed']);
        $data = $this->tasksViewService->getIndexData($params);
        $data['tags'] = $this->tagsViewService->getIndexData();

        return Inertia::render('Tasks/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['tags'] = $this->tagsViewService->getIndexData();

        return Inertia::render('Tasks/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateRequest $request)
    {
        $data = $request->validated();
        $newTask = $this->tasksViewService->storeAction($data);
        $this->tagsViewService->updateAction($newTask->id, $data['tags']);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->tasksViewService->getShowData($id);

        return Inertia::render('Tasks/Show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->tasksViewService->getEditData($id);
        $data['tags'] = $this->tagsViewService->getIndexData();

        return Inertia::render('Tasks/Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $updatedTask = $this->tasksViewService->updateAction($id, $data);
        $task = $this->tagsViewService->updateAction($updatedTask->id, $data['tags']);

        return redirect()->route('tasks.index')->with('success', 'Task ' . $task->id . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->tasksViewService->deleteAction($id);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
