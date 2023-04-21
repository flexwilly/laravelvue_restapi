<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all records
        return Status::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255',
        ]);
        $status = new Status();
        $status->name = $request->name; 
        $result =  $status->save();

        //After data has been inserted return the following :
        if($result){
            return ["result"=>"data has been  inserted successfully"];
        }else{
            return ["result"=>"operation failed"];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //show a single record
        return $status;
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //validation logic
        $request->validate([
            'id'=>'required',
            'name'=> 'required|max:255',
        ]);
        $status->name = $request->name;
        $status->id = $request->id;
        //perform the update
        $result= $status->save();

        if($result){
            return ["result"=>"data has been  updated"];
        }else{
            return ["result"=>"data update operation failed"];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
        $result = $status->delete();
        if($result){
            return ["result"=>"Record has been deleted "];
            }else{
                return ["result"=>"Record deletion failed "];
            }
    }
}
