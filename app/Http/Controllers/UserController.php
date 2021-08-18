<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Alert;

class UserController extends Controller
{
     /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $user = User::latest()->get();
        return view('user.data_user', compact('user'));
    }

public function create()
{
    return view('user.create');
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
        'name'     => 'required',
        'email'     => 'required|email|unique:users',
        'password'     => 'required',
        'role'   => 'required'
    ]);

    //upload image
    // $image = $request->file('image');
    // $image->storeAs('public/blogs', $image->hashName());

    $user = User::create([
        'name'     => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'role'   => $request->role,
    ]);

    if($user){
        //redirect dengan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Disimpan!');
        return redirect('/akun');
    }else{
        //redirect dengan pesan error
        return redirect('/akun');
    }
}

public function show($id)
    {
        
    }

public function edit($id)
{
    $edit = User::findOrfail($id);
    return view('user.edit', compact('edit'));
}


/**
* update
*
* @param  mixed $request
* @param  mixed $blog
* @return void
*/
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name'     => 'required',
        'email'     => 'required',        
        // 'password'     => 'required',        
        'role'   => 'required',
    ]);

    //get data user by ID
    // $user = User::findOrFail($user->id);


        $user = User::where('id', $id)->update([
            'name'     => $request->name,
            'email'     => $request->email,            
            // 'password'     => $request->password,            
            'role'   => $request->role,
        ]);

    

    if($user){
        //redirect dengan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Di Update!');
        //redirect dengan pesan sukses
        return redirect('/akun');
    }else{
        //redirect dengan pesan error
        return redirect('/akun');
        }
    }
    public function hapus($id)
    {
      $user = User::destroy($id);
    //   Storage::disk('local')->delete('public/blogs/'.$blog->image);
    //   $blog->delete();
    
      if($user){
          //redirect dengan pesan hapus
        // Alert::success('Sukses', 'Data Berhasil Dihapus!');
         //redirect dengan pesan sukses
         return redirect('/akun');
      }else{
        //redirect dengan pesan error
        return redirect('/akun');
      }
    }
}

