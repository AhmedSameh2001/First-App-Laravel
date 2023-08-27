<?php

namespace App\Http\Controllers;

use App\Models\clint;
use App\Http\Requests\StoreclintRequest;
use App\Http\Requests\UpdateclintRequest;
use Illuminate\Support\Facades\File;

class ClintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clints = Clint::orderByDesc('id')->paginate(10);
        return view('BazzarLayout.ClintLayout.index', compact('clints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clint = Clint::all();
        return view('BazzarLayout.ClintLayout.create',compact('clint'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreclintRequest $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        // Store Files
        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/clints'), $img_name);
        }

        // Store In Database
        Clint::create([
            'image' => $img_name,
        ]);

        // redirect
        return redirect()->route('clints.index')->with('msg', 'Clint added successfully')->with('type', 'success');;
    }

    /**
     * Display the specified resource.
     */
    public function show(clint $clint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(clint $clint)
    {
        $clints = Clint::all();
        return view('BazzarLayout.ClintLayout.edit', compact('clint','clints'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclintRequest $request, clint $clint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(clint $clint)
    {
        $clint = Clint::findOrFail($clint);

        File::delete('uploads/clints/'.$clint->image);

        $clint->delete();

        return redirect()->route('BazzarLayout.ClintLayout.index')->with('msg', 'Clint deleted successfully')->with('type', 'danger');
    }
}
