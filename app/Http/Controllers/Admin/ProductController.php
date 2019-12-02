<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dùng để đăng nhập khi chưa có đăng nhập
        $products = Product::where([
            ['user_id', Auth::user()->id],
        ])->get();
        $waitingProducts = $products->filter(function($value, $key) {
            return $value->is_checked === Product::WAIT_FOR_CENSORSHIP;
        });
        $forSaleProducts = $products->filter(function($value, $key) {
            return $value->isChecked() && $value->active === Product::ACTIVE;
        });
        $violatedProducts = $products->filter(function($value, $key) {
            return $value->is_checked === Product::NOT_CENSORED;
        });
        $runOutOfAmountProducts = $products->filter(function($value, $key) {
            return $value->amount === 0;
        });

        return view('admins.products.index', compact(
            'products', 'waitingProducts', 'forSaleProducts', 'violatedProducts', 'runOutOfAmountProducts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $brands = Brand::all();
        return view('admins.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        }
        $newProduct = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'user_id' => Auth::user()->id,
            'product_status_id' => 1,
            'name' => $request->name,
            'is_checked' => 0,
            'violation' => null,
            'description' => $request->description,
            'price' => $request->price,
            'amount' => $request->amount,
            'title_seo' => $request->title_seo,
            'description_seo' => $request->description_seo,
            'active' => 1,
            'image' => basename($imagePath),
            'thumbnail' => basename($thumbnailPath),
        ]);
        
        $listOfDetails = [];
        foreach ($request->detail_type as $key => $value) {
            array_push($listOfDetails,
                [
                    'type'=> $request->detail_type[$key],
                    'description' => $request->detail_description[$key]
                ]
            );
        }
        $newProduct->product_details()->createMany($listOfDetails);

        $listOfImage = [];
        if($request->hasFile('images')){
            foreach($request->images as $image){
                $imagePath = UploadImageService::uploadImage($image);
                $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
                array_push($listOfImage, [
                    'image' => basename($imagePath),
                    'thumbnail' => basename($thumbnailPath),
                    'is_top' => 0
                ]);
            }
        }
        $newProduct->product_images()->createMany($listOfImage) ;

        return back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admins.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      $categories = Category::all();
      $brands = Brand::all();
      return view('admins.products.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
      $inputUpdate = $request->all();
      $inputUpdate['is_checked'] = 0;
      if($request->hasFile('image')) {
        $imagePath = UploadImageService::uploadImage($request->file('image'));
        $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        $inputUpdate['image'] = basename($imagePath);
        $inputUpdate['thumbnail'] = basename($thumbnailPath);
      }else{
        unset($inputUpdate['thumbnail']);
      }
      $product->update($inputUpdate);

      $product->product_details()->delete();
      foreach ($request->detail_type as $key => $value) {
        $product->product_details()->create(
          ['type'=> $request->detail_type[$key],
          'description' => $request->detail_description[$key]]
        );
      }
      if($request->hasFile('images')){
        $product->product_images()->delete();
        foreach($request->images as $image){
          $imagePath = UploadImageService::uploadImage($image);
          $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
          $product->product_images()->create(
            ['image' => basename($imagePath),
            'thumbnail' => basename($thumbnailPath),
            'is_top' => 0]
          );
        }
      }
      return back()->with('success', 'Sửa thành công, Yêu cẩu cập nhật của bạn đã được gửi tới người quản trị');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Xoá thành công');

    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', $request->ids)->delete();
        return back()->with('success', 'Xoá thành công');
    }

}
