<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $user = auth()->guard('admin')->user();
        $query = Gallery::latest();

        if ($user->role !== 'super_admin') {
            $categoryMap = [
                'Sports' => 'sports',
                'Arts' => 'arts',
                'softskill' => 'elevate',
                'Algorithm' => 'tech',
                'Cultural' => 'cultural'
            ];
            $myCategory = $categoryMap[$user->category_access] ?? null;
            $query->where('category', $myCategory);
        }

        $galleries = $query->get()->groupBy('category');
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();

        $request->validate([
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($user->role !== 'super_admin') {
            $categoryMap = [
                'Sports' => 'sports',
                'Arts' => 'arts',
                'softskill' => 'elevate',
                'Algorithm' => 'tech',
                'Cultural' => 'cultural'
            ];
            $myCategory = $categoryMap[$user->category_access] ?? null;
            if ($request->category !== $myCategory) {
                return redirect()->back()->withErrors(['category' => 'Forbidden access to this category.']);
            }
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            Gallery::create([
                'category' => $request->category,
                'image_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Image added successfully!');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $user = auth()->guard('admin')->user();

        $request->validate([
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($user->role !== 'super_admin') {
            $categoryMap = [
                'Sports' => 'sports',
                'Arts' => 'arts',
                'softskill' => 'elevate',
                'Algorithm' => 'tech',
                'Cultural' => 'cultural'
            ];
            $myCategory = $categoryMap[$user->category_access] ?? null;
            if ($gallery->category !== $myCategory || $request->category !== $myCategory) {
                return redirect()->back()->withErrors(['category' => 'Forbidden action.']);
            }
        }

        $gallery->category = $request->category;

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($gallery->image_path);
            // Store new image
            $path = $request->file('image')->store('gallery', 'public');
            $gallery->image_path = $path;
        }

        $gallery->save();

        return redirect()->back()->with('success', 'Image updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin') {
            $categoryMap = [
                'Sports' => 'sports',
                'Arts' => 'arts',
                'softskill' => 'elevate',
                'Algorithm' => 'tech',
                'Cultural' => 'cultural'
            ];
            $myCategory = $categoryMap[$user->category_access] ?? null;
            if ($gallery->category !== $myCategory) {
                return redirect()->back()->withErrors(['category' => 'Forbidden action.']);
            }
        }

        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
