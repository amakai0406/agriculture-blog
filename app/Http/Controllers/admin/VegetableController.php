<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use App\Http\Requests\admin\StoreVegetableRequest;

class VegetableController extends Controller
{

    public function index()
    {
        $vegetables = Vegetable::all();
        return view('admin.vegetables.index', compact('vegetables'));
    }

    public function create()
    {
        return view('admin.vegetables.create');
    }

    public function store(StoreVegetableRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $path = $image->store('public/images');

            $imageName = basename($path);

            $validated['image'] = $imageName;
        }

        vegetable::create($validated);

        return redirect()->route('admin.vegetables.create')->with('success', '新しいやさいを追加しました');
    }
}