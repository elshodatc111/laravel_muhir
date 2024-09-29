<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\Muxir;
use App\Models\Korzinka;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
    public function tarqatildi(){
        $Muxir = Muxir::where('type','Send')->get();
        $tarqatildi = array();
        foreach ($Muxir as $key => $value) {
            $Korzinka = Korzinka::where('number',$value->number_id)->first();
            $Bolim = Bolim::where('coato',$Korzinka->coato)->first()->name;
            $tarqatildi[$key]['number'] = $value->number;
            $tarqatildi[$key]['bolim'] = $Bolim;
            $tarqatildi[$key]['muxirchi'] = $Korzinka->fio;
            $tarqatildi[$key]['operator'] = $Korzinka->opertor;
            $tarqatildi[$key]['faktura'] = $Korzinka->number ;
            $tarqatildi[$key]['data'] = $Korzinka->updated_at;
        }
        return view('tarqatildi',compact('tarqatildi'));
    }
    public function updatePassword(){
        return view('updatePassword');
    }
    public function updatePasswordStory(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with(['current_password' => 'Hozirgi parol noto\'g\'ri']);
        }
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('status', 'Parol muvaffaqiyatli yangilandi!');
    }


    public function Hodimlar(){
        $User = User::where('email','!=','elshodatc1116@gmail.com')->get();
        return view('Hodimlar',compact('User'));
    }
    public function HodimlarCreate(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('12345678'),
        ]);
        return back()->with('success', 'Yangi hodim qo\'shildi');
    }
    public function HodimlarDelete(Request $request){
        $request->validate([
            'id' => ['required'],
        ]);
        $User = User::find($request->id);
        $User->delete();
        return back()->with('success', 'Hodim o\'chirildi');
    }
    public function HodimRessetPassword(Request $request){
        $request->validate([
            'id' => ['required'],
        ]);
        $User = User::find($request->id);
        $User->password = Hash::make('12345678');
        $User->save();
        return back()->with('success', 'Hodimning paroli yangilandi!');
    }
    public function RetsertKorzinka(){
        $Korzinka = Muxir::where('number_id','null')->where('type','!=','new')->get();
        foreach ($Korzinka as $key => $value) {
            $Korzinka2 = Muxir::find($value->id);
            $Korzinka2->type = 'new';
            $Korzinka2->save();
        }
        return back();
    }


}
