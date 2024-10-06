<?php

namespace App\Http\Controllers;
use App\Models\Muxir;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\MuxirFaktura;
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
        $Bolim = Bolim::get();
        return view('muxir.muxir_korzinka',compact('Muxir','count','Bolim'));
    }
    public function korzinkaBolimCoato($coato){
        if($coato=="_"){
            $text = '<label for="hodim" class="mt-2">Bo\'limdagi masul shaxs</label>
            <select name="hodim" class="form-select mt-2" required>
            <option value="">Tanlang...</option>';
            $text .= '</select>';
            return $text;
        }
        $text = '<label for="hodim" class="mt-2">Bo\'limdagi masul shaxs</label>
        <select name="hodim" class="form-select mt-2" required>
          <option value="">Tanlang...</option>';
          foreach (Hodim::where('coato',$coato)->where('status','true')->get() as $value) {
            $text .= "<option value=".$value['id'].">".$value['name']."</option>";
          }
        $text .= '</select>';
        return $text;
    }   
    public function muxir_faktura_pdf(Request $request){
        $validate = $request->validate([
            'count' => 'required',
            'coato' => 'required',
            'hodim' => 'required',
        ]);
        $number = MuxirFaktura::max('id')+1;
        $Bolim = Bolim::where('coato',$request->coato)->first()->name;
        $MuxirFaktura = MuxirFaktura::create([
            'number'=> $number,
            'coato'=>$request->coato,
            'coato_name'=>$Bolim,
            'count'=>$request->count,
            'hodim'=>$request->hodim,
            'operator'=>auth()->user()->name,
            'scanner'=>'false',
            'scanner_url'=>'null',
        ]);
        $Muxir = Muxir::where('type','pedding')->get();
        foreach ($Muxir as $key => $value) {
            $Muxir2 = Muxir::find($value->id);
            $Muxir2->type = "Send";
            $Muxir2->status = "true";
            $Muxir2->faktura = $number;
            $Muxir2->save();
        }
        return redirect()->route('muxir_faktura_show',$number);
    }
    public function muxir_faktura_show($id){
        $MuxirFaktura = MuxirFaktura::where('number',$id)->first();
        $Hodim = Hodim::find($MuxirFaktura['hodim']);

        $i=1;
        $m=1;
        $Muxirs = array();
        foreach (Muxir::where('faktura',$MuxirFaktura['number'])->where('type','Send')->get() as $key => $value) {
            $Muxirs[$m][$i] = $value->number;
            if($i==5){
                $i=$i/5;
                $m++;
                $i = $i-1;
            }
            $i++;
        }
        return view('muxir.muxir_faktura_show',compact('MuxirFaktura','Hodim','Muxirs'));
    }
    public function faktura_upload_muxir(Request $request){
        $request->validate([
            'scanner' => 'required|mimes:pdf',
            'number' => 'required',
        ]);
        $MuxirFaktura = MuxirFaktura::where('number',$request->number)->first();
        $imageName = "№-".$request->number." ".time().'.'.$request->scanner->extension();
        $request->scanner->move(public_path('muxir'), $imageName);
        $Korzinka = MuxirFaktura::where('number',$request->number)->first();
        $Korzinka->scanner_url = $imageName;
        $Korzinka->scanner = 'upload';
        $Korzinka->save();
        return redirect()->back()->with('success', "Faktura tasdiqlangan fayli yuklandi");
    }
    public function faktura_delete_muxir(Request $request){
        $request->validate([
            'number' => 'required',
        ]);
        $MuxirFaktura = MuxirFaktura::where('number',$request->number)->first();
        $Korzinka = MuxirFaktura::where('number',$request->number)->first();
        $Korzinka->scanner_url = 'null';
        $Korzinka->scanner = 'false';
        $Korzinka->save();
        return redirect()->back()->with('success', "Faktura tasdiqlangan fayli o'chirildi");
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
