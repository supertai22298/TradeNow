<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\UploadImageService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admins.categories.index', \compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::select('name', 'id')->get();
        return view('admins.categories.create', \compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        }
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'image' => basename($imagePath),
            'thumbnail' => basename($thumbnailPath),
        ]);
        return back()->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view('admins.categories.show', \compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::select('name', 'id')->get();
        return view('admins.categories.edit', \compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);

            $category->update([
                'image' => basename($imagePath),
                'thumbnail' => basename($thumbnailPath),
            ]);
        }
        $category->update([
            'parent_id' => $request->parent_id,
            'name' =>  $request->name,
            'description' =>  $request->description,
        ]);
        return back()->with('success', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return back()->with('success', 'Xoá thành công');
    }
    /**
     * Remove the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        //
        Category::whereIn('id', $request->ids)->delete();
        return back()->with('success', 'Xoá thành công');
    }
    
}
