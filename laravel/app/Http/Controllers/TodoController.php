<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Auth::user()->todo()->get();
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
        return Auth::user()->
        todo()->
        create([
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
            'user_id' => Auth::user()->id,
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
        //
        return Auth::user()->
        todo()->
        find($id);
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
        $todo = Auth::user()->
        todo()->
        find($id);
        
        $todo->update([
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
            'user_id' => Auth::user()->id,
        ]);

        return $todo;
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
        Auth::user()->
        todo()->
        find($id)->
        delete();
        
        return $id;
    }

    public function trashed(){
        return Auth::user()->
        todo()->
        onlyTrashed()->
        get();
    }

    public function forceDelete($id){
        Auth::user()->
        todo()->
        onlyTrashed()->
        find($id)->
        forceDelete();

        return $id;
    }

    public function restore($id){
        Auth::user()->
        todo()->
        onlyTrashed()->
        find($id)->
        restore();

        return Auth::user()->
        todo()->
        onlyTrashed()->
        get();
    }
}
