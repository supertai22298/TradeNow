<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UploadImageService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admins.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        }
        $users = User::create([
            'name' => $request->name,
            'image' => basename($imagePath),
            // 'thumbnail' => basename($thumbnailPath),
        ]);
        return back()->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admins.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->hasFile('image')) {
            $imagePath = UploadImageService::uploadImage($request->file('image'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);

            $user->update([
                //some update
            ]);
        }
        $user->update([
            //some update
        ]);
        return back()->with('success', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return back()->with('success', 'Thao tác thành công');
    }

    public function massDestroy(Request $request) {
        $users = User::whereIn('id', request('ids'))->delete();
        return back()->with('success', 'Xoá thành công');
    }
}
