<?php

namespace App\Http\Controllers;
use App\Models\Muxir;
use Illuminate\Http\Request;

class MuxirController extends Controller{
    public function muxir(){
        $Muxir = Muxir::where('coato','10400')->where('type','null')->get();
        return view('muxir.muxir',compact('Muxir'));
    }
    public function muxir_korzinka(){
        return view('muxir.muxir_korzinka');
    }
    public function muxir_new(){
        return view('muxir.muxir_new');
    }
    public function muxir_new_create(Request $request){
        $validate = $request->validate([
            'number' => 'required|unique:muxirs',
        ]);
        Muxir::create([
            'coato'=>10400,
            'number'=>$request->number,
            'type'=>'null',
            'status'=>'null',
            'faktura'=>'null',
            'meneger'=>auth()->user()->name,
        ]);
        return redirect()->back()->with('success', "Yangi muxir kiritildi");
    }
    public function muxir_new_two(){
        return view('muxir.muxir_new_two');
    }
    public function muxir_new_create_two(Request $request){
        $validate = $request->validate([
            'number1' => 'required',
            'number2' => 'required',
        ]);
        $count = 0;
        for($i=$request['number1'];$i<=$request['number2'];$i++){
            $Muxir = Muxir::create([
                'coato'=>10400,
                'number'=>$i,
                'type'=>'null',
                'status'=>'null',
                'faktura'=>'null',
                'meneger'=>auth()->user()->name,
            ]);
            if($Muxir){
                $count = $count + 1;
            }
        }
        return redirect()->back()->with('success', $count." ta muxir kiritildi");
    }
}
