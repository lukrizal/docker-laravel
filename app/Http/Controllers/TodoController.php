<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Render the index for todo
        return response()->json([
            "collection" => DB::table("tasks")->get(),
            "result" => "ok"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # Validate request
        $this->validate($request, [
            "task" => "required|unique:tasks|max:255",
            "done" => "required|boolean",
        ]);

        # Insert todo item
        $task = $request->input("task");
        $done = $request->input("done");
        $id = DB::table('tasks')->insertGetId(["task" => $task, "done" => $done]);
        # Return inserted item
        $item = DB::table("tasks")->where("id", $id)->first();
        return response()->json([
            "item" => $item,
            "result" => "ok"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Validate item by locating it
        $item = DB::table("tasks")->where("id", $id)->first();
        if (!$item) {
            return response()->json([
                "message" => "Not valid id.",
                "result" => "not ok"
            ]);
        }
        # Return located item
        return response()->json([
            "item" => $item,
            "result" => "ok"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # Validate item by locating it
        $item = DB::table("tasks")->where("id", $id)->first();
        if (!$item) {
            return response()->json([
                "message" => "Not valid id.",
                "result" => "not ok"
            ]);
        }
        # Validate request
        $this->validate($request, [
            "task" => "unique:tasks|max:255",
            "done" => "boolean",
        ]);
        # Update item
        DB::table("tasks")->where("id", $id)->update($request->all());
        # Return updated item
        return response()->json([
            "item" => $item,
            "result" => "ok"
        ]);
    }
}
