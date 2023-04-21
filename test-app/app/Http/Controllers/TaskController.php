<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all records 
        return Task::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation logic
        $request->validate([
            'name'=>'required|max:100',
            'description'=>'required|max:255',
            'due_date'=>'required',
            'status_id'=>'required|integer|min:1'
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status_id = $request->status_id;

        $result = $task->save();
         //After data has been inserted return the following :
         if($result){
            return ["result"=>"Data has been  inserted successfully"];
        }else{
            return ["result"=>"Operation failed"];
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //retuns a single task
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // //validation logic
        $request->validate([
            'id'=>'integer|min:1',
            'name'=>'required|max:100',
            'description'=>'required|max:255',
            'due_date'=>'required',
            'status_id'=>'required|integer|min:1'
        ]);

        $task->id = $request->id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status_id = $request->status_id;

        $result = $task->save();
        if($result){
            return ["result"=>"data has been  updated"];
        }else{
            return ["result"=>"data update operation failed"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //destroy a single record
        $result = $task->delete();
        if($result){
            return ["result"=>"Record has been deleted "];
            }else{
                return ["result"=>"Record deletion failed "];
            }
    }
}
