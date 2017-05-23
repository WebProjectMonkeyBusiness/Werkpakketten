<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Tag;
use App\Item;
use Auth;
use Gate;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getIndex(){

        $items = Item::get();

        return view ('todo.index', ['items' => $items]);

    }

    public function postIndex(){
        $id = Input::get('id');
        $item = Item::findOrFail($id);

        $item->mark();

        return redirect()->back();

    }

    public function getNew(){

//return View::make('new');
        return view ('todo.new');

    }

    public function postNew(){

        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }
$item = new Item;
$item->item = Input::get('name');
$item->save();

return redirect()->back();
    }


    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
