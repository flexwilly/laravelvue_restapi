<?php

namespace App\Http\Controllers;

use App\Models\UserTask;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return all records
        return UserTask::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate records
        $request->validate([
            'user_id'=>'integer|min:1|required',
            'task_id'=>'integer|min:1|required',
            'due_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'remarks'=>'required|max:255',
            'status_id'=>'integer|min:1|required',
        ]);
        $userTask = new UserTask();
        $userTask->user_id = $request->user_id;
        $userTask->task_id = $request->task_id;
        $userTask->due_date = $request->due_date;
        $userTask->start_time = $request->start_time;
        $userTask->end_time = $request->end_time;
        $userTask->remarks = $request->remarks;
        $userTask->status_id = $request->status_id;

        //save data to the database
        $result = $userTask->save();
        if($result){
            return ["result"=>"data has been  inserted successfully"];
        }else{
            return ["result"=>" Operation failed"];
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(UserTask $userTask)
    {
        //return a single record
        return $userTask;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTask $userTask)
    {
        //validation logic
        $request->validate([
            'id'=>'integer|min:1|required',
            'user_id'=>'integer|min:1|required',
            'task_id'=>'integer|min:1|required',
            'due_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'remarks'=>'required|max:255',
            'status_id'=>'integer|min:1|required',
        ]);

        
    
        $userTask->id = $request->id;
        $userTask->user_id = $request->user_id;
        $userTask->task_id = $request->task_id;
        $userTask->due_date = $request->due_date;
        $userTask->start_time = $request->start_time;
        $userTask->end_time = $request->end_time;
        $userTask->remarks = $request->remarks;
        $userTask->status_id = $request->status_id;

        //save data to the database
        $result = $userTask->save();
        if($result){
            return ["result"=>"Data has been  updated successfully"];
        }else{
            return ["result"=>" Operation failed"];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTask $userTask)
    {
        //delete a single task
        $result = $userTask->delete();
        if($result){
            return ["result"=>"Record has been deleted "];
            }else{
                return ["result"=>"Record deletion failed "];
            }

    }
}
