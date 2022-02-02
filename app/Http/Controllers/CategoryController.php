<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Category::all();
        return response(['data'=> CategoryResource::collection($tags)]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        $tag = new Category();
        $tag->fill($data);
        $tag->save();


        return response(['message'=>'Category created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        $item = Category::findOrfail($id);
        return response(['data'=> new TagResource($item) ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $item = Category::findOrfail($id);
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
        try {
            Category::findOrfail($id)->delete();
            return response(['message'=> 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response(['error'=> 'This category does not exist']);
        } catch (\Exception $e) {
            return response(['error'=> 'This category has ads related to it ,Please remove them first']);
        }
    }
}
