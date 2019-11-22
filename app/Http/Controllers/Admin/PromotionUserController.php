<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PromotionUser;
use Illuminate\Http\Request;


class PromotionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromotionUser  $promotionUser
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionUser $promotionUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromotionUser  $promotionUser
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotionUser $promotionUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromotionUser  $promotionUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotionUser $promotionUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromotionUser  $promotionUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotionUser $promotionUser)
    {
        //
    }
}
