<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    public function admin_user(){
        if(auth()->user()->role!=1){
            return redirect()->route('home');
        }
        $User = User::where('id','!=',1)->get();
        return view('admin.admin_user',compact('User'));
    }
    public function admin_create(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('12345678'),
        ]);
        return redirect()->back()->with('success', "Yangi foydalanuvchi qo'shildi");
    }
    public function admin_user_show($id){
        if(auth()->user()->role!=1){
            return redirect()->route('home');
        }
        $User = User::find($id);
        return view('admin.admin_user_show',compact('User'));
    }
    public function admin_update(Request $request){
        $validate = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);
        $User = User::find($request->id);
        $User->name=$request->name;
        $User->role=$request->role;
        $User->save();
        return redirect()->back()->with('success', "Foydalanuvchi malumotlari yangilandi");
    }
    public function admin_update_password(Request $request){
        $validate = $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
        $User = User::find($request->id);
        $User->password=Hash::make($request->password);
        $User->save();
        return redirect()->back()->with('success', "Foydalanuvchi paroli yangilandi");
    }
    public function admin_profel(){
        return view('admin.update_password');
    }

    public function admin_profel_update_password(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with(['current_password' => 'Hozirgi parol noto\'g\'ri']);
        }
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('status', 'Parol muvaffaqiyatli yangilandi!');
    }
}
