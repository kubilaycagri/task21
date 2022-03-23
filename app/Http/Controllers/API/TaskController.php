<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Http\Resources\TaskRsrc;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();

        return response([
            'data' => TaskRsrc::collection($tasks)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStore $request)
    {
        $data = $request->validated();

        $task = Task::create(array_merge($data, [
            'user_id' => $request->user()->id,
            'status' => Task::TODO
        ]));

        return response([
            'data' => new TaskRsrc($task)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response([
            'data' => new TaskRsrc($task)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdate $request, Task $task)
    {
        //
        $task->update($request->validated());

        return response([
            'data' => new TaskRsrc($task)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response([
            'data' => new TaskRsrc($task)
        ], 200);
    }
}
