<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Services\UploadImageService;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotions = Promotion::all();
        return view('admins.promotion.index',['promotions'=>$promotions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admins.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $validated = $request->validated();

        $promotionArr = array();
        $promotionArr['type'] = $request->input('type');
        $promotionArr['code'] = $request->input('code');
        $promotionArr['title'] = $request->input('title');
        $promotionArr['description'] = $request->input('description');
        $promotionArr['reduction_level'] = $request->input('reduction_level');
        if($request->hasFile('banner')) {
            $imagePath = UploadImageService::uploadImage($request->file('banner'));
            $bannerPath = UploadImageService::resizeImage($imagePath, 400, 400);
            $promotionArr['banner'] = basename($bannerPath);
        }
        if($request->hasFile('banner-thumbnail')) {
            $imagePath = UploadImageService::uploadImage($request->file('banner-thumbnail'));
            $bannerThumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
            $promotionArr['banner_thumbnail'] = basename($bannerThumbnailPath);
        }

        // dd($promotionArr['banner-thumbnail']);
        $promotionArr['started_at'] = $request->input('started_at');
        $promotionArr['finished_at'] = $request->input('finish_at');
        
        $promotion = Promotion::create($promotionArr);

        return redirect()->back()->with('success','Thêm thành công');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
        return view('admins.promotion.show',['promotion'=>$promotion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
        return view('admins.promotion.edit',['promotion'=>$promotion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    
        $promotionArr = array();
        $promotionArr['type'] = $request->input('type');
        $promotionArr['code'] = $request->input('code');
        $promotionArr['title'] = $request->input('title');
        $promotionArr['description'] = $request->input('description');
        $promotionArr['reduction_level'] = $request->input('reduction_level');
        if($request->hasFile('banner')) {
            $imagePath = UploadImageService::uploadImage($request->file('banner'));
            $bannerPath = UploadImageService::resizeImage($imagePath, 400, 400);
            $promotionArr['banner'] = basename($bannerPath);
        }
        if($request->hasFile('banner-thumbnail')) {
            $imagePath = UploadImageService::uploadImage($request->file('banner-thumbnail'));
            $bannerThumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
            $promotionArr['banner_thumbnail'] = basename($bannerThumbnailPath);
        }
        $promotionArr['started_at'] = $request->input('started_at');
        $promotionArr['finished_at'] = $request->input('finish_at');
        
        $promotion->update($promotionArr);

        return redirect()->back()->with('success','Sửa thành công');


    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->with('success', 'Xoá thành công');
    }

    public function massDestroy(Request $request){
      
        $promotion = Promotion::whereIn('id', $request->input('ids'))->delete();
        return back()->with('success', 'Xoá thành công');

    }
}
