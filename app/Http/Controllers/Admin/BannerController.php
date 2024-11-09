<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner; // Assuming Banner model exists
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Display all banners
    public function index()
    {
        // Retrieve all banners from the database
        $banners = Banner::all();

        // Pass the banners to the view
        return view('admin.banner.index', compact('banners'));
    }

    public function edit($id)
    {
        // Retrieve the banner by its ID or show a 404 if not found
        $banner = Banner::findOrFail($id);

        // Return the edit view with the banner data
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the banner by ID
        $banner = Banner::findOrFail($id);

        // Update the banner's information
        $banner->name = $request->input('name');

        // If a new image is uploaded, handle the image file upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/banners');
            $banner->thumbnail = basename($path);
        }

        // Save the updated banner to the database
        $banner->save();

        // Redirect back to the banners page with a success message
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

}
