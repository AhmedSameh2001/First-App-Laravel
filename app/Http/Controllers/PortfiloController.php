<?php

namespace App\Http\Controllers;

use App\Models\portfilo;
use App\Http\Requests\StoreportfiloRequest;
use App\Http\Requests\UpdateportfiloRequest;
use Illuminate\Support\Facades\File;

class PortfiloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfilos = Portfilo::orderByDesc('id')->paginate(10);
        return view('BazzarLayout.PortfolioLayout.index', compact('portfilos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $portfilo = Portfilo::all();
        return view('BazzarLayout.PortfolioLayout.create',compact('portfilo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreportfiloRequest $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        // Store Files
        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/Portfilos'), $img_name);
        }

        // Store In Database
        Portfilo::create([
            'title' => $request->title,
            'image' => $img_name,
        ]);

        // redirect
        return redirect()->route('portfilo.index')->with('msg', 'Portfilo added successfully')->with('type', 'success');;
    }

    /**
     * Display the specified resource.
     */
    public function show(portfilo $portfilo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(portfilo $portfilo)
    {
        $portfilos = Portfilo::all();
        return view('BazzarLayout.PortfolioLayout.edit', compact('portfilo','portfilos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateportfiloRequest $request, portfilo $portfilo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(portfilo $portfilo)
    {
        $portfilo = Portfilo::findOrFail($portfilo);

        File::delete('uploads/portfilos/'.$portfilo->image);

        $portfilo->delete();

        return redirect()->route('BazzarLayout.PortfolioLayout.index')->with('msg', 'Portfilo deleted successfully')->with('type', 'danger');
    }
}
