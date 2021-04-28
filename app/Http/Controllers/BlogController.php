<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['blogs'] = Blog::where('title',$request->search)->orwhere('author','LIKE', "%".$request->search."%")->get();
        return view('work.home',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guest()){
            return redirect()->route('login');
        }
        return view('work.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::guest()){
            return redirect()->route('login');
        }
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'body'=>'required',
            'image'=>'required|mimes:jpg,png',
        ]);

        $filename = time(). "." .$request->image->extension();
        $request->image->move(public_path('images'),$filename);

        Blog::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'body'=>$request->body,
            'image'=>$filename,
            'user_id'=>Auth::id()
        ]);

        $request->session()->flash('msg',"<div class='alert alert-success'>Data inserted successfully</div>");

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $data['blogs'] = $blog;
        return view('work.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data['blogs'] = $blog;
        return view('work.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'body'=>'required',
            'image'=>'required|mimes:jpg,png',
        ]);


        $filename = time(). "." .$request->image->extension();
        $request->image->move(public_path('images'),$filename);

        Blog::find($blog->id)->update([
            'title'=>$request->title,
            'author'=>$request->author,
            'body'=>$request->body,
            'image'=>$filename,
            'user_id'=>Auth::id()
        ]);
       return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Request $request)
    {
        $blog->delete();
        $request->session()->flash("msg","<div class='alert alert-danger'>Delete Data successfully</div>");
        return redirect()->back();
    }
}
