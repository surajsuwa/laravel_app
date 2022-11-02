<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view("pages.blog.index", compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);

        $request['slug'] =  Str::slug($request->title);

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images');
            $desImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $desImage);
            $request['featured_image'] = "$desImage";
        }

        Blog::create($request->all());

        return redirect()->route('blogs.index')->with('message', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view("pages.blog.edit", compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);

        $blog = Blog::find($id);

        if ($request->title) {
            $request['slug'] =  Str::slug($request->title);
        }

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images' . $blog->featured_image);
            if (file_exists($destinationPath)) {
                @unlink($destinationPath);
            }

            $destinationPath = public_path('images');
            $desImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $desImage);
            $request['featured_image'] = "$desImage";
        }

        $blog->update($request->all());

        return redirect()->route('blogs.index')->with('message', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $destinationPath = public_path('images/' . $blog->featured_image);
        if (file_exists($destinationPath)) {
            @unlink($destinationPath);
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('message', 'Blog Deleted successfully.');
    }
}
