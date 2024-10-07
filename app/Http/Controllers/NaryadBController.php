<?php

namespace App\Http\Controllers;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\NaryadB;
use Illuminate\Http\Request;

class NaryadBController extends Controller{
    public function naryad_blanka(){
        $NaryadB = NaryadB::where('coato','10400')->where('type','null')->orderby('number','asc')->get();
        return view('naryad_blanka.naryad',compact('NaryadB'));
    }
    public function naryad_blanka_korzinka(){
        return 'naryad_blanka_NEW';
    }
    public function naryad_blanka_NEW(){
        return view('naryad_blanka.naryad_new');
    }
    public function naryad_blanka_NEW_story(Request $request){
        $validate = $request->validate([
            'number' => 'required|unique:naryad_b_s',
        ]);
        NaryadB::create([
            'coato'=>10400,
            'number'=>$request->number,
            'type'=>'null',
            'status'=>'null',
            'faktura'=>'null',
            'meneger'=>auth()->user()->name,
        ]);
        return redirect()->back()->with('success', "Yangi naryad blanka kiritildi");
    }
    public function naryad_blanka_NEW_TWO(){
        return 'naryad_blanka_NEW_TWO';
    }
}
