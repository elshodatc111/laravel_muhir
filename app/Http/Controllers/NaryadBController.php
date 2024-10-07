<?php

namespace App\Http\Controllers;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\NaryadB;
use App\Models\NaryadBlankaFaktura;
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
    public function naryad_blanka_faktura_pdf(Request $request){
        $validate = $request->validate([
            'count' => 'required',
            'coato' => 'required',
            'hodim' => 'required',
        ]);
        $number = NaryadBlankaFaktura::max('id')+1;
        $Bolim = Bolim::where('coato',$request->coato)->first()->name;
        $MuxirFaktura = NaryadBlankaFaktura::create([
            'number'=> $number,
            'coato'=>$request->coato,
            'coato_name'=>$Bolim,
            'count'=>$request->count,
            'hodim'=>$request->hodim,
            'operator'=>auth()->user()->name,
            'scanner'=>'false',
            'scanner_url'=>'null',
        ]);
        $Muxir = NaryadB::where('type','pedding')->get();
        foreach ($Muxir as $key => $value) {
            $Muxir2 = NaryadB::find($value->id);
            $Muxir2->coato = $request->coato;
            $Muxir2->type = "Send";
            $Muxir2->status = "true";
            $Muxir2->faktura = $number;
            $Muxir2->save();
        }
        return redirect()->route('naryad_blanka_show',$number);
    }
    public function naryad_blanka_show($id){
        $MuxirFaktura = NaryadBlankaFaktura::where('number',$id)->first();
        $Hodim = Hodim::find($MuxirFaktura['hodim']);
        $i=1;
        $m=1;
        $Muxirs = array();
        foreach (NaryadB::where('faktura',$MuxirFaktura['number'])->where('type','Send')->get() as $key => $value) {
            $Muxirs[$m][$i] = $value->number;
            if($i==5){
                $i=$i/5;
                $m++;
                $i = $i-1;
            }
            $i++;
        }
        return view('naryad_blanka.naryad_blanka_show',compact('MuxirFaktura','Hodim','Muxirs'));
    }
    public function naryad_blanka_faktura_delete(Request $request){
        $validate = $request->validate([
            'number' => 'required',
        ]);
        $Muxir = NaryadB::where('type','Send')->where('faktura',$request->number)->get();
        foreach ($Muxir as $key => $value) {
            $Item = NaryadB::find($value->id);
            $Item->type = 'null';
            $Item->status = 'null';
            $Item->faktura = 'null';
            $Item->save();
        }
        $MuxirFaktura = NaryadBlankaFaktura::where('number',$request->number)->first();
        $MuxirFaktura->delete();
        return redirect()->route('naryad_blanka')->with('success', "Naryad blanka hisob fakturasi o'chirildi");
    }
    public function naryad_blanka_faktura_upload(Request $request){
        $request->validate([
            'scanner' => 'required|mimes:pdf',
            'number' => 'required',
        ]);
        $MuxirFaktura = NaryadBlankaFaktura::where('number',$request->number)->first();
        $imageName = "№-".$request->number." ".time().'.'.$request->scanner->extension();
        $request->scanner->move(public_path('blanka'), $imageName);
        $Korzinka = NaryadBlankaFaktura::where('number',$request->number)->first();
        $Korzinka->scanner_url = $imageName;
        $Korzinka->scanner = 'upload';
        $Korzinka->save();
        return redirect()->back()->with('success', "Faktura tasdiqlangan fayli yuklandi");
    }
    public function naryad_blanka_faktura_delete_pdf(Request $request){
        $request->validate([
            'number' => 'required',
        ]);
        $MuxirFaktura = NaryadBlankaFaktura::where('number',$request->number)->first();
        $Korzinka = NaryadBlankaFaktura::where('number',$request->number)->first();
        $Korzinka->scanner_url = 'null';
        $Korzinka->coato = 10400;
        $Korzinka->scanner = 'false';
        $Korzinka->save();
        return redirect()->back()->with('success', "Faktura tasdiqlangan fayli o'chirildi");
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
