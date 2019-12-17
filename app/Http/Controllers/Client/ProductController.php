<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
  //
  public function show(Product $product)
  {
    $hotDealProduct = Product::where([
      ['is_checked', Product::IS_CENSORED],
      ['active', Product::ACTIVE],
    ])->simplePaginate(6);
    return view('clients.products.product_details', compact('product', 'hotDealProduct'));
  }

  public function addReview(Request $request)
  {
    $review = Review::updateOrCreate([
      'product_id' => $request->product_id,
      'user_id' => $request->user_id,
    ]);
    $review->update([
      'rate_mark' => $request->rating,
      'is_incognito' => $request->is_incognitro,
      'description' => $request->description,
    ]);

    $html = '<table class="table table-striped table-bordered">
    <tbody>
      <tr>
        <td style="width: 50%;"><strong id="user_incognito">' . $review->showIncognito() . '</strong></td>
        <td class="text-right" id="user_created_at">' . $review->created_at . '</td>
      </tr>
      <tr>
        <td colspan="2">
          <p id="user_description">' . $review->description . '</p>
          <div class="ratings">
            <div class="rating-box" id="user_rating">
              ' . $review->getHtmlRate() . '
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="text-right"></div>';

    return response()->json(
      [
        'data' => $html,
        'created_at' => $review->created_at,
        'user_id' => $request->user_id,
        'rate_mark' => $review->getHtmlRate(),
        'is_incognito' => $review->showIncognito(),
        'description' => $review->description,
      ]
    );
  }
}
