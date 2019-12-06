<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    //
    public function getProducts(Category $category) {
        $products = $category->products->filter(function($item) {
            return $item->isChecked();
        });
        return view('clients.categories.show', 
            compact(
                'category', 'products'
            )
        );
    }
}
