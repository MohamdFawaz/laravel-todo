<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\UpdateTaskRequest;
use App\Http\Requests\api\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class TaskController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index($completed = 'not completed')
    {
        if ($completed == 'completed'){
            $tasks = Task::completed()->orderByDesc('created_at')->get();
        }else{
            $tasks = Task::notCompleted()->orderByDesc('created_at')->get();
        }
        return $this->respond(TaskResource::collection($tasks));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTaskRequest  $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = Task::create([
                'name' => $request->name,
                'due_date' => $request->due_date
            ]);
            return $this->respondCreated(TaskResource::make($task));
        }catch (\Exception $e){
            return $this->respondInternalError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTaskRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $task = Task::whereId($id)->first();
            $task->name = $request->name;
            $task->due_date = $request->due_date;
            $task->save();
            return $this->respond(TaskResource::make($task));
        }catch (\Exception $e){
            return $this->respondInternalError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            Task::whereId($id)->delete();
            return $this->respondDeleted();
        }catch (\Exception $e){
            return $this->respondInternalError();
        }
    }

    /**
     * Toggle task as completed/not completed.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function toggleCompleted($id)
    {
        try {
            $task = Task::whereId($id)->first();
            $task->toggleCompleted();
            $task->save();
            return $this->respond(TaskResource::make($task));
        }catch (\Exception $e){
            return $this->respondInternalError();
        }
    }
}
