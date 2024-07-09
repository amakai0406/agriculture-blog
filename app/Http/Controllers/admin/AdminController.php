<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreAdminRequest;
use App\Models\Admin;

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

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $path = $image->store('public/images');

            $imagehName = basename($path);

            $validated['image'] = $imagehName;
        }

        Admin::create($validated);

        return redirect()->route('admin.admins.create')->with('success', '新しい管理者を登録しました');

    }

}
