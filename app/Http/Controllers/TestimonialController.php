<?php

namespace App\Http\Controllers;

use App\Models\testimonial;
use App\Http\Requests\StoretestimonialRequest;
use App\Http\Requests\UpdatetestimonialRequest;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderByDesc('id')->paginate(10);
        return view('BazzarLayout.TestimonialLayout.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $testimonial = Testimonial::all();
        return view('BazzarLayout.TestimonialLayout.create',compact('testimonial'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretestimonialRequest $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'image' => 'required|mimes:png,jpg,jpeg',
            'description' => 'required|max:60',
            'Job' => 'required|max:10',
        ]);

        // Store Files
        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/testimonials'), $img_name);
        }

        // Store In Database
        Testimonial::create([
            'name' => $request->name,
            'image' => $img_name,
            'description' => $request->description,
            'Job' => $request->Job,
        ]);

        // redirect
        return redirect()->route('testimonial.index')->with('msg', 'Testimonial added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(testimonial $testimonial)
    {
        $testimonials = Testimonial::all();
        return view('BazzarLayout.TestimonialLayout.edit', compact('testimonial','testimonials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetestimonialRequest $request, testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(testimonial $testimonial)
    {
        $testimonial = Testimonial::findOrFail($testimonial);

        File::delete('uploads/testimonials/'.$testimonial->image);

        $testimonial->delete();

        return redirect()->route('BazzarLayout.TestimonialLayout.index')->with('msg', 'Testimonial deleted successfully')->with('type', 'danger');
    }
}
