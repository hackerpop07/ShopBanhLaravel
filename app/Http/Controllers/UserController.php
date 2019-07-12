<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreate;
use App\Http\Requests\ProductUpdate;
use App\Http\Requests\UserCreate;
use App\Http\Requests\UserUpdate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
    }

    public function index()
    {
        $user = User::paginate(8);
        return view('admin.user.list', compact('user'));
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(UserCreate $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.user.index');
    }

    public function show($id)
    {
        //
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $total = User::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $user = User::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);
        return view('admin.user.search', compact('total', 'user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdate $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('admin.user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
