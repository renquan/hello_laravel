<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    //发布微博
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:8|max:255'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request->content
        ]);

        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    //删除微博
    public function destory() {}
}
