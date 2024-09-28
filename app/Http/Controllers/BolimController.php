<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;

class BolimController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $Bolims = Bolim::get();
        $Bolim = array();
        foreach ($Bolims as $key => $value) {
            $Bolim[$key]['id'] = $value->id;
            $Bolim[$key]['coato'] = $value->coato;
            $Bolim[$key]['name'] = $value->name;
            $Bolim[$key]['status'] = $value->status;
            $Bolim[$key]['count'] = count(Hodim::where('coato',$value->coato)->where('status','true')->get());
            
        }
        return view('bolim',compact('Bolim'));
    }
    public function create(){
        return view('create_bolim');
    }
    public function story(Request $request){
        $validate = $request->validate([
            'coato' => 'required|max:5|min:5|unique:bolims',
            'name' => 'required|unique:bolims',
        ]);
        Bolim::create([
            'coato' => $request->coato,
            'name' => $request->name,
            'status' => 'true',
        ]);
        return redirect()->route('bolim')->with('success', "Yangi bo'lim qo'shildi");
    }
    public function show($id){
        $Bolim = Bolim::find($id);
        $Hodim = Hodim::where('coato',$Bolim['coato'])->get();
        return view('bolim_show',compact('Bolim','Hodim'));
    }
    public function update(Request $request){
        $validate = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        $Bolim = Bolim::find($request->id);
        $Bolim->name = $request->name;
        $Bolim->status = $request->status;
        $Bolim->save();
        return redirect()->back()->with('success', "Bo'lim malumotlari yangilandi");
    }
    public function hodimStory(Request $request){
        $validate = $request->validate([
            'coato' => 'required',
            'fio' => 'required',
            'phone' => 'required',
            'lavozim' => 'required',
        ]);
        Hodim::create([
            'coato' => $request->coato,
            'fio' => $request->fio,
            'phone' => $request->phone,
            'lavozim' => $request->lavozim,
            'status' => 'true',
        ]);
        return redirect()->back()->with('success', "Yangi hodim qo'shildi");
    }
    public function hodimDelete(Request $request){
        $validate = $request->validate([
            'id' => 'required',
        ]);
        $Hodim = Hodim::find($request->id);
        $Hodim->status = 'deleted';
        $Hodim->save();
        return redirect()->back()->with('success', "Hodim o'chirildi");
    }
}
