<?php

namespace App\Http\Controllers;
use App\Models\Muxir;
use Illuminate\Http\Request;

class MuxirController extends Controller{ 
    public function muxir(){
        $Muxir = Muxir::where('coato','10400')->where('type','null')->orderby('number','asc')->get();
        return view('muxir.muxir',compact('Muxir'));
    }
    public function muxir_delete(Request $request){
        $Muxir = Muxir::find($request->id);
        $Muxir->delete();
        return redirect()->back()->with('success', "Muxir o'chirildi");
    }
    public function muxir_add_korzinka(Request $request){
        $Muxir = Muxir::find($request->id);
        $Muxir->type = 'pedding';
        $Muxir->save();
        return redirect()->back()->with('success', "Muxir korzinkaga qo'shildi.");
    }
    public function muxir_korzinka(){
        $Muxir = Muxir::where('type','pedding')->get();
        $count = count($Muxir);
        return view('muxir.muxir_korzinka',compact('Muxir','count'));
    }
    public function muxir_korzinka_muxir_del(Request $request){
        $Muxir = Muxir::find($request->id);
        $Muxir->type = 'null';
        $Muxir->save();
        return redirect()->back()->with('success', "Muxir olib tashlandi.");
    }
    public function muxir_korzinka_muxir_del_all(){
        $Muxir = Muxir::where('type','pedding')->get();
        $i=0;
        foreach ($Muxir as $key => $value) {
            $muxir2 = Muxir::find($value->id);
            $muxir2->type = 'null';
            $muxir2->save();
            $i++;
        }
        return redirect()->back()->with('success', $i." ta muxir olib tashlandi.");
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
