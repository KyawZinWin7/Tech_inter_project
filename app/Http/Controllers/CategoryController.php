<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\Base64;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    use Base64;
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            request()->validate([
                "search" => "nullable",
            ]);
            if ($request->search) {
                $categories = Category::where('name', 'like', '%' . $request->search . '%')->get();
            } else {
                $categories = Category::all();
            }
            return response()->json([
                "success" => true,
                "data" => $categories,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }


    public function store(CategoryStoreRequest $request)
    {
        $image = $this->uploadBase64(
            $request->image,
            "add",
            null
        );
        $icon = $this->uploadBase64(
            $request->icon,
            "add",
            null
        );
        $category = new Category();
        $category->name = $request->name;
        $category->image = $image;
        $category->icon = $icon;
        $category->isPublish = $request->isPublish;
        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try {

            return response()->json([
                "success" => true,
                "data" => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $exitedImage = Category::findOrFail($id)->image;
        $exitedIcon = Category::findOrFail($id)->icon;
        $image = $this->uploadBase64(
            $request->image,
            "update",
            $exitedImage
        );
        $icon = $this->uploadBase64(
            $request->icon,
            "update",
            $exitedIcon
        );
        $category = Category::find($id);
        $category->name = $request->name;
        $category->image = $image;
        $category->icon = $icon;
        $category->isPublish = $request->isPublish;
        $category->update();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return $category;
    }
}
