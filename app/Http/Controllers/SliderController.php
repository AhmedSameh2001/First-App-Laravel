<?php

namespace App\Http\Controllers;

use App\Models\slider;
use App\Http\Requests\StoresliderRequest;
use App\Http\Requests\UpdatesliderRequest;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderByDesc('id')->paginate(10);
        return view('BazzarLayout.SliderLayout.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slider = Slider::all();
        return view('BazzarLayout.SliderLayout.create',compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresliderRequest $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        // Store Files
        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/sliders'), $img_name);
        }

        // Store In Database
        Slider::create([
            'title' => $request->title,
            'image' => $img_name,
        ]);

        // redirect
        return redirect()->route('BazzarLayout.SliderLayout.create')->with('msg', 'Slider added successfully')->with('type', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show(slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(slider $slider)
    {
        $sliders = Slider::all();
        return view('BazzarLayout.SliderLayout.edit', compact('slider','sliders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesliderRequest $request, slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slider $slider)
    {
        $slider = Slider::findOrFail($slider);

        File::delete('uploads/sliders/'.$slider->image);

        $slider->delete();

        return redirect()->route('BazzarLayout.SliderLayout.index')->with('msg', 'Slider deleted successfully')->with('type', 'danger');
    }
}
