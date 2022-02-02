<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return response(['data'=> TagResource::collection($tags)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $data = $request->all();
        $tag =new Tag();
        $tag->fill($data);
        $tag->save();
        return response(['message'=>'Tag created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrfail($id);
        return response(['data'=> new TagResource($tag) ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $tag= Tag::findOrfail($id);
        $tag->update($request->all());
        return response(['message'=> 'Tag update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrfail($id)->delete();
        return response(['message'=> 'Tag deleted successfully']);
    }
}
