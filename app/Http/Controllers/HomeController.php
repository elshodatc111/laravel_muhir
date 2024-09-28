<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\Muxir;
use App\Models\Korzinka;

class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $Muxir = Muxir::where('type','new')->get();
        return view('home',compact('Muxir'));
    }
    public function create(){
        return view('create_home');
    }
    public function story(Request $request){
        $validate = $request->validate([
            'number' => 'required|unique:muxirs',
        ]);
        Muxir::create([
            'number'=>$request->number,
            'operator'=>auth()->user()->email,
            'type'=>'new',
            'number_id'=>'null',
        ]);
        return redirect()->back()->with('success', "Yangi muxir qo'shildi");
    }
    public function story_pedding(Request $request){
        $validate = $request->validate([
            'id' => 'required',
        ]);
        $Muxir = Muxir::find($request->id);
        $Muxir->type = auth()->user()->email;
        $Muxir->save();
        return redirect()->back()->with('success', "Muxir korzinkaga saqlandi");
    }
    public function korzinka(){
        $Muxir = Muxir::where('type',auth()->user()->email)->get();
        $count = count($Muxir);
        $Bolim = Bolim::where('status','true')->get();
        return view('korzinka',compact('Muxir','count','Bolim'));
    }
    public function korzinka_delete(Request $request){
        $validate = $request->validate([
            'id' => 'required',
        ]);
        $Muxir = Muxir::find($request->id);
        $Muxir->type = 'new';
        $Muxir->save();
        return redirect()->back()->with('success', "Korzinkadan muxir o'chirildi");
    }
    public function korzinkaBolimCoato($coato){
        $Hodim = Hodim::where('coato',$coato)->where('status','true')->get();
        $text = '<label for="fio" class="my-2">Bo\'limdagi masul shaxs</label>
        <select name="fio" class="form-select" required>
          <option value="">Tanlang...</option>';
          foreach ($Hodim as $key => $value) {
            $text .= '<option value="'.$value['fio'].'">'.$value['fio'].'</option>';
          }
        $text .= '</select>';
        return $text;
    }
    public function korzinka_faktura(Request $request){
        $validate = $request->validate([
            'count' => 'required',
            'coato' => 'required',
            'fio' => 'required',
        ]);
        $number = Korzinka::max('id')+1;
        $coato = $request->coato;
        $count = $request->count;
        $fio = $request->fio;
        $opertor = auth()->user()->name;
        $scanner = 'new';
        $scanner_url = 'null';
        $Korzinka = Korzinka::create([
            'number' => $number,
            'coato' => $coato,
            'fio' => $fio,
            'opertor' => $opertor,
            'count' => $count,
            'scanner' => $scanner,
            'scanner_url' => $scanner_url,
        ]);
        $Muxir = Muxir::where('type',auth()->user()->email)->get();
        foreach ($Muxir as $key => $value) {
            $Muxirs = Muxir::find($value->id);
            $Muxirs->number_id = $number;
            $Muxirs->type = "Send";
            $Muxirs->save();
        }
        return redirect()->route('korzinka_show',$Korzinka->id);
    }
    public function korzinka_show($id){
        $Korzinka = Korzinka::find($id);
        $faktura = array();
        $faktura['id'] = $Korzinka->id;
        $faktura['number'] = $Korzinka->number;
        $faktura['bolim'] = Bolim::where('coato',$Korzinka->coato)->first()->name;
        $faktura['count'] = $Korzinka->count;
        $faktura['opertor'] = $Korzinka->opertor;
        $faktura['fio'] = $Korzinka->fio;
        $faktura['created_at'] = $Korzinka->created_at;
        $i=1;
        $m=1;
        $array = array();
        foreach (Muxir::where('number_id',$id)->where('type','Send')->get() as $key => $value) {
            $array[$m][$i] = $value->number;
            if($i==5){
                $i=$i/5;
                $m++;
                $i = $i-1;
            }
            $i++;
        }
        $faktura['muxir'] = $array;
        return view('korzinka_faktura',compact('faktura'));
    }
    public function korzinka_faktura_image(Request $request){
        $request->validate([
            'scanner' => 'required|mimes:jpg,png',
        ]);
        $imageName = time().'.'.$request->scanner->extension();
        $request->scanner->move(public_path('images'), $imageName);
        $Korzinka = Korzinka::find($request->id);
        $Korzinka->scanner_url = $imageName;
        $Korzinka->scanner = 'upload';
        $Korzinka->save();
        return redirect()->route('home')->with('success', "Faktura tasdiqlangan fayli yuklandi");
    }
}
