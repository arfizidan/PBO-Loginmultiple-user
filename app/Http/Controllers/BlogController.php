<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Alert;

class BlogController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function dashboard()
     {
         $totalblog = Blog::count();
         $totaluser = User::count();
         return view('blog.dashboard', compact('totalblog', 'totaluser'));
     }


    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index', compact('blogs'));
    }

public function create()
{
    return view('blog.create');
}


/**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
    $this->validate($request, [
        'image'     => 'required|image|mimes:png,jpg,jpeg',
        'title'     => 'required',
        'konten'   => 'required'
    ]);

    //upload image
    $nm = $request->image;
    $namefile = date('YmdHis').'.'.$nm->GetClientOriginalExtension();
    $nm->move(public_path().'/img/foto_blog/',$namefile);

    $blog = Blog::create([
        'image'     => $namefile,
        'title'     => $request->title,
        'content'   => $request->konten
    ]);

    if($blog){
        //redirect dengan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Disimpan!');
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('blog.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

public function show($id)
    {
        $detail = Blog::find($id);        
        return view('blog.detail', compact('detail'));
    }

public function edit(Blog $blog)
{
    return view('blog.edit', compact('blog'));
}


/**
* update
*
* @param  mixed $request
* @param  mixed $blog
* @return void
*/
public function update(Request $request, Blog $blog)
{
    $this->validate($request, [
        'title'     => 'required',
        'konten'   => 'required'
    ]);

    //get data Blog by ID
    $blog = Blog::findOrFail($blog->id);

    if($request->file('image') == "") {

        $blog->update([
            'title'     => $request->title,
            'content'   => $request->konten
        ]);

    } else {

        //hapus old image
        // Storage::disk('local')->delete('public/blogs/'.$blog->image);
        unlink(public_path() . '/img/foto_blog/' . $blog->image);
        //upload new image
        $nm = $request->image;
        $namefile = date('YmdHis').'.'.$nm->GetClientOriginalExtension();
        $nm->move(public_path().'/img/foto_blog/',$namefile);

        $blog->update([
            'image'     => $namefile,
            'title'     => $request->title,
            'content'   => $request->konten
        ]);

    }

    if($blog){
        //redirect dengan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Di Update!');
        //redirect dengan pesan sukses
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('blog.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    public function delete($id)
    {
      $blog = Blog::findOrFail($id);
      unlink(public_path() . '/img/foto_blog/' . $blog->image);
      $blog->delete();
    
      if($blog){
          //redirect dengan pesan hapus
        // Alert::success('Sukses', 'Data Berhasil Dihapus!');
         //redirect dengan pesan sukses
         return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus!']);
      }else{
        //redirect dengan pesan error
        return redirect()->route('blog.index')->with(['error' => 'Data Gagal Dihapus!']);
      }
    }
}