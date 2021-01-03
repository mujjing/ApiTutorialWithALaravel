<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 데이터 목록 가져오기
    public function index()
    {
        $allTodos = Todo::all();
        //$allTodos = Todo::select('id', 'title', 'content')->get();
        $filteredTodos = TodoResource::collection($allTodos);
        return $filteredTodos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 새 데이터를 만드는 화면을 반환
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 새 데이터를 추가
    public function store(Request $request)
    {
        $userInputData = $request->all();
        $newTodo = Todo::create($userInputData);
        return new TodoResource($newTodo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 특정 데이터를 가져오기
    public function show($id)
    {
        $filtereTodos = Todo::find($id);
        $filteredTodos = new TodoResource($filtereTodos);
        return $filteredTodos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //기존 데이터를 수정하는 화면을 반환
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
    //기존 데이터를 수정해서 -> 수정된 데이터를 반환
    public function update(Request $request, $id)
    {
        $fetchedTodo = Todo::find($id);
        $fetchedTodo->update($request->all());
        $filteredTodo = new TodoResource($fetchedTodo);

        return $filteredTodo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //기존 데이터를 삭제
    public function destroy($id)
    {
        $fetchedTodo = Todo::find($id);
        $fetchedTodo->delete();
        $allTodos = Todo::all();
        $filteredTodos = TodoResource::collection($allTodos);
        return $filteredTodos;
    }
}
