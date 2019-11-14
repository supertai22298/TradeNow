<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\UploadImageService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::all();
        return view('admins.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admins.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        }
        $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => basename($imagePath),
            'thumbnail' => basename($thumbnailPath),
        ]);
        return back()->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
        return view('admins.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
        return view('admins.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);

            $brand->update([
                'image' => basename($imagePath),
                'thumbnail' => basename($thumbnailPath),
            ]);
        }
        $brand->update([
            'name' =>  $request->name,
            'description' =>  $request->description,
        ]);
        return back()->with('success', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        return back()->with('success', 'Thao tác thành công');
    }
    public function massDestroy(MassDestroyBrandRequest $request) {
        $brands = Brand::whereIn('id', request('ids'))->delete();
        return back()->with('success', 'Xoá thành công');
    }
}
