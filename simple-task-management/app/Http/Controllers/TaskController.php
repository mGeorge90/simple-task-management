<?php


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['assignedTo', 'assignedBy'])->get();
        return response()->json(TaskResource::collection($tasks), 200);
    }
    public function store(CreateTaskRequest $request)
    {
        $task = Task::create($request->only(['title', 'description', 'assigned_to_id', 'assigned_by_id']));
        event(new \App\Events\TaskCreated($request->assigned_to_id));
        return response()->json($task, 201);
    }
}
