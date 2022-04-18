<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks =DB::table('tasks')->get();
        return view('tasks',compact('tasks'));
    }

    public function store(Request $request)
    {
        DB::table('tasks')->insert([

            'name'=> $request->name,
            'created_at'=> now(),
            'updated_at'=>now()
        ]); 
        return redirect()-> back();
    }
    public function delete($id){

        DB::table('tasks')->where('id', '=', $id)->delete();
        return redirect()-> back();
    }
    public function edit ($id) {
        $task = DB::table('tasks')->where('id', $id)->first();
        return view('edit')->with('task', $task);
    }
    public function update(Request $request, $id){

        DB::table('tasks')->where('id', '=', $id)->update([
            'name' => $request->input('task_name'),
        ]);
        return redirect()->route('tasks');
    }
  
}
