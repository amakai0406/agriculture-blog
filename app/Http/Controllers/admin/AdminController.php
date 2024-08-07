<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $admin = new Admin();
        return view('admin.admins.create', compact('admin'));
    }

    public function store(StoreAdminRequest $request)
    {

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admin.admins.create')->with('success', '新しい管理者を登録しました');

    }

}
