<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $allCustomers = User::getUserByType(1);
        $allSuppliers = User::getUserByType();
        return view('admins.users.index', compact('users','allCustomers','allSuppliers'));
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
    public function store(StoreUserRequest $request)
    {
        if($request->hasFile('avatar')) {
            $imagePath = UploadImageService::uploadImage($request->file('avatar'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 300, 300);
        }

        $arrInput = $request->all();
        $arrInput['avatar'] = basename($thumbnailPath);
        $arrInput['password'] = bcrypt($request->password);
        $request->active == "true"? $arrInput['active'] = true : $arrInput['active'] = false;
        $request->is_admin == "true"? $arrInput['is_admin'] = true : $arrInput['is_admin'] = false;
        
        $users = User::create($arrInput);
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $arrUpdate = $request->all();
        $request->active == "true"? $arrUpdate['active'] = true : $arrUpdate['active'] = false;
        $request->is_admin == "true"? $arrUpdate['is_admin'] = true : $arrUpdate['is_admin'] = false;
        //mật khẩu & avatar k nhập k update
        if($request->hasFile('avatar')) {
            $imagePath = UploadImageService::uploadImage($request->file('avatar'));
            $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
            $arrUpdate['avatar'] = basename($thumbnailPath);
        }
        if($arrUpdate['password'] == null){
            unset($arrUpdate['password']);
            $user->update($arrUpdate);
        }else{
            $arrUpdate['password'] = bcrypt($arrUpdate['password']);
            $user->update($arrUpdate);
        }

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

    public function massDestroy(MassDestroyUserRequest $request) {
        $users = User::whereIn('id', request('ids'))->delete();
        return back()->with('success', 'Xoá thành công');
    }
}
