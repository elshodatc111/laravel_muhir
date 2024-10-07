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
    public function naryad_blanka_delete(Request $request){
        $Muxir = NaryadB::find($request->id);
        $Muxir->delete();
        return redirect()->back()->with('success', "Naryad blankasi o'chirildi");
    }
    public function naryad_blanka_korzinka_add(Request $request){
        $Muxir = NaryadB::find($request->id);
        $Muxir->type = 'pedding';
        $Muxir->save();
        return redirect()->back()->with('success', "Naryad blankas korzinkaga qo'shildi.");
    }
    public function naryad_blanka_korzinka(){
        $Muxir = NaryadB::where('type','pedding')->get();
        $count = count($Muxir);
        $Bolim = Bolim::get();
        return view('naryad_blanka.naryad_blanka_korzinka',compact('Muxir','count','Bolim'));
    }
    public function naryad_blanka_korzinka_delete(Request $request){
        $Muxir = NaryadB::find($request->id);
        $Muxir->type = 'null';
        $Muxir->save();
        return redirect()->back()->with('success', "Naryad blanka olib tashlandi.");
    }
    public function naryad_blanka_korzinka_delete_all(Request $request){
        $Muxir = NaryadB::where('type','pedding')->get();
        $i=0;
        foreach ($Muxir as $key => $value) {
            $muxir2 = NaryadB::find($value->id);
            $muxir2->type = 'null';
            $muxir2->save();
            $i++;
        }
        return redirect()->back()->with('success', $i." ta naryad blanka olib tashlandi.");
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
        return view('naryad_blanka.naryad_blanka_NEW_TWO');
    }
    public function naryad_blanka_NEW_TWO_story(Request $request){
        $validate = $request->validate([
            'number1' => 'required',
            'number2' => 'required',
        ]);
        $count = 0;
        for($i=$request['number1'];$i<=$request['number2'];$i++){
            $Muxir = NaryadB::create([
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
