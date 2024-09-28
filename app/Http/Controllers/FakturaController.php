<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\Muxir;
use App\Models\Korzinka;
class FakturaController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $Korzinka = Korzinka::get();
        return view('faktura',compact('Korzinka'));
    }
    public function faktura_show($id){
        $Korzinka = Korzinka::find($id);
        $faktura = array();
        $faktura['id'] = $Korzinka->id;
        $faktura['number'] = $Korzinka->number;
        $faktura['bolim'] = Bolim::where('coato',$Korzinka->coato)->first()->name;
        $faktura['count'] = $Korzinka->count;
        $faktura['scanner'] = $Korzinka->scanner;
        $faktura['scanner_url'] = $Korzinka->scanner_url;
        $faktura['opertor'] = $Korzinka->opertor;
        $faktura['fio'] = $Korzinka->fio;
        $faktura['created_at'] = $Korzinka->created_at;
        $i=1;
        $m=1;
        $array = array();
        foreach (Muxir::where('number_id',$faktura['number'])->where('type','Send')->get() as $key => $value) {
            $array[$m][$i] = $value->number;
            if($i==5){
                $i=$i/5;
                $m++;
                $i = $i-1;
            }
            $i++;
        }
        $faktura['muxir'] = $array;
        return view('faktura_show',compact('faktura'));
    }

    public function faktura_image(Request $request){
        $request->validate([
            'scanner' => 'required|mimes:jpg,png',
        ]);
        $imageName = time().'.'.$request->scanner->extension();
        $request->scanner->move(public_path('images'), $imageName);
        $Korzinka = Korzinka::find($request->id);
        $Korzinka->scanner_url = $imageName;
        $Korzinka->scanner = 'upload';
        $Korzinka->save();
        return redirect()->back()->with('success', "Faktura tasdiqlangan fayli yuklandi");
    }
}
