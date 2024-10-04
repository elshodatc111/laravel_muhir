<?php

namespace App\Http\Controllers;
use App\Models\Bolim;
use App\Models\Hodim;
use Illuminate\Http\Request;

class BolimController extends Controller{
    public function bolim(){
        $Bolim = Bolim::get();
        return view('bolim.bolim',compact('Bolim'));
    }
    public function bolim_create(Request $request){
        $validate = $request->validate([
            'coato' => 'required|unique:bolims',
            'name' => 'required',
            'about' => 'required',
        ]);
        Bolim::create([
           'coato' => $request->coato, 
           'name' => $request->name, 
           'about' => $request->about, 
        ]);
        return redirect()->back()->with('success', "Yangi bo'lim qo'shildi");
    }
    public function bolim_show($id){
        $Bolim = Bolim::find($id);
        $Hodim = Hodim::where('coato',$Bolim->coato)->get();
        return view('bolim.bolim_show',compact('Bolim','Hodim'));
    }
    public function bolim_update(Request $request){
        $validate = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'about' => 'required',
        ]);
        $Bolim = Bolim::find($request->id);
        $Bolim->name = $request->name;
        $Bolim->about = $request->about;
        $Bolim->save();
        return redirect()->back()->with('success', "Bo'lim ma'lumotlari yangilandi.");
    }
    public function bolim_hodim_create(Request $request){
        $validate = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'about' => 'required',
        ]);
        $Bolim = Bolim::find($request->id);
        $coato = $Bolim->coato;
        Hodim::create([
            'coato' => $coato,
            'name' => $request->name,
            'phone' => $request->phone,
            'about' => $request->about,
            'status' => 'true',
        ]);
        return redirect()->back()->with('success', "Yangi hodim qo'shildi.");
    }
    public function bolim_hodim_lock(Request $request){
        $id = $request->id;
        $Hodim = Hodim::find($id);
        $Status = $Hodim->status;
        if($Status=='true'){
            $Hodim->status = 'false';
            $Text = "Hodim bloklandi";
        }else{
            $Hodim->status = 'true';
            $Text = "Hodim aktivlashtirildi";
        }
        $Hodim->save();
        return redirect()->back()->with('success', $Text);
    }
}
