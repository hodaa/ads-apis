<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ads = new Ad();
        if ($request->tag_id) {
            $ads = Ad::join('ad_tag', 'ad_tag.ad_id', '=', 'ads.id', )->where('tag_id', '=', $request->tag_id);
        }
        if ($request->category_id) {
            $ads = $ads->where('category_id', (int)$request->category_id);
        }
        $data= $ads->get();
        return response(['data'=> AdResource::collection($data)]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(AdRequest $request)
    {
        $data = $request->all();
        $item = new Ad();
        $item->fill($data);
        $item->save();

        $item->tags()->sync($request->tags);

        return response(['message'=>'Ad created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Ad::findOrfail($id);
        return response(['data'=> new AdResource($item)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $item = Ad::findOrfail($id);
        $item->update($request->all());
        return response(['message'=> 'Category update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ad = Ad::findOrfail($id);
        $ad->tags()->sync([]);
        $ad->delete();

        return response(['message'=> 'Ad deleted successfully']);
    }
}
