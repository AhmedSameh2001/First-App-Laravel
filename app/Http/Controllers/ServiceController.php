<?php

namespace App\Http\Controllers;

use App\Models\service;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderByDesc('id')->paginate(10);
        return view('BazzarLayout.ServiceLayout.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = Service::all();
        return view('BazzarLayout.ServiceLayout.create',compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreserviceRequest $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'description' => 'required|max:60',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        // Store Files
        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/services'), $img_name);
        }

        // Store In Database
        Service::create([
            'title' => $request->title,
            'image' => $img_name,
            'description' => $request->description,
        ]);

        // redirect
        return redirect()->route('services.index')->with('msg', 'Service added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $service)
    {
        $services = Service::all();
        return view('BazzarLayout.SliderLayout.edit', compact('service','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserviceRequest $request, service $service)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        $service = Service::findOrFail($service);

        File::delete('uploads/services/'.$service->image);

        $service->delete();

        return redirect()->route('BazzarLayout.PortfolioLayout.index')->with('msg', 'Portfilo deleted successfully')->with('type', 'danger');
    }
}
