<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show($id){
        $user = User::findOrFail($id)->toArray();
        $user['cover'] = Storage::url($user['cover']);
        $user['avatar']= Storage::url($user['avatar']);
        return $user;
    }

    public function self(){
        return $this->show(Auth::id());
    }

    public function update(Request $request){
        Auth::user()->update(
            $request->only(['name', 'sign', 'sex'])
        );
        return [
            'status'=>'success',
            'message'=>'修改成功'
        ];
    }

    public function modifyAvatar(Request $request){
        $path = $request->file('avatar')->store('avatar/' . date('Y/m'));

        Storage::delete(Auth::user()->avatar);
        Auth::user()->update([
            'avatar' => $path
        ]);
        return [
            'status' => 'success', 'message' => '修改成功', 'path' => Storage::url($path)
        ];
    }

    public function modifyCover(Request $request){
        $path = $request->file('cover')->store('cover/' . date('Y/m'));

        Storage::delete(Auth::user()->avatar);
        Auth::user()->update([
            'cover' => $path
        ]);
        return [
            'status' => 'success', 'message' => '修改成功', 'path' => Storage::url($path)
        ];
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        if (Hash::check($request->input('original_password'), $user->password)){
            $user->update([
                'password'=> Hash::make($request->input('new_password'))
            ]);

            return [
                'status'=>'success',
                'message'=>'修改成功'
            ];
        }
        return [
            'status'=>'error',
            'message'=>'密码错误'
        ];
    }
}
