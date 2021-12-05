<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Done;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = $request->user()->todos;
        return view('todos.index', [
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todo = Todo::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        Deadline::create([
            'todo_id' => $todo->id,
            'deadline' => $request->deadline,
        ]);
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todos.show', [
            'todo' => $todo,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateDone(Request $request, $id)
    {
        Done::create([
            'todo_id' => $id,
            'is_done' => $request->is_done,
        ]);
        return redirect()->back();
    }

    public function updateDeadline(Request $request, $id)
    {
        Deadline::create([
            'todo_id' => $id,
            'deadline' => $request->deadline,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
