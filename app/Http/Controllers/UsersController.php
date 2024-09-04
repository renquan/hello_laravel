<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('users.index',['users'=>$users]);
    }
    //用户注册页面
    public function create()
    {
        return view('users.create');
    }

    //用户信息展示
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //验证并保存用户
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    //编辑用户展示
    public function edit(User $user) {
        return view('users.edit',compact('user'));
    }

    public function update(User $user,Request $request) {


        $this->validate($request,[
            'name'=>'required|max:50',
            'password'=>'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        if($request->user()->cannot('update',$user)){
            session()->flash('danger','非本人账号,不允许修改');
            $fallback = route('users.edit',Auth::user());
            return redirect()->intended($fallback);
        }

        $user->update($data);

        session()->flash('success','信息更改成功!');

        return redirect()->route('users.show',$user);


    }

    //删除用户
    public function destroy(User $user,Request $request) {
        if($request->user()->cannot('delete',$user)){
            session()->flash('info','没有权限删除!');

        }else{
            $user->delete();
            session()->flash('success','用户删除成功!');
        }


        return redirect()->route('users.index');
    }

}
