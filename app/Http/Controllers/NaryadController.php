<?php

namespace App\Http\Controllers;
use App\Models\Bolim;
use Illuminate\Http\Request;

class NaryadController extends Controller
{
    public function naryad(){
        return view('naryad.naryad');
    }
    public function naryad_create(){
        $Bolim = Bolim::get();
        return view('naryad.create',compact('Bolim'));
    }
    public function naryad_create_story(Request $request){
        $validate = $request->validate([
            "coato"  => "required",
            "naryad_number"  => "required|numeric|min:5",
            "naryad_type"  => "required",
            "user_type"  => "required",
            "user_number"  => "required|numeric|min:6",
            "old_meter_number"  => "nullable|numeric|min:7",
            "new_meter_number"=> "required|numeric|min:7|max:12",
            "naryad_file" => "required|file|mimes:pdf|max:5120",
            "about" => "nullable"
        ],[
            "coato.required"  => __('Tuman nomi tanlanmadi'),
            "naryad_number"  => __('Naryad raqami noto\'g\'ri yoki 5 raqamdan kam'),
            "naryad_type"  => __('Naryad turini tanlang'),
            "user_type"  => __('Istemolchi turini tanlang'),
            "user_number"  => __('Istemolchi raqami faqat raqamlardan iborat bo\'lsin va 6 raqamdan kam bo\'lmasin'),
            "old_meter_number"  => __('Eski hisoblagich raqami 7 raqamdan kam'),
            "new_meter_number"=> __('Yangi hisoblagich raqami 7 raqamdan kam yoki 12 belgidan ko\'p'),
            "naryad_file" => __('Naryad nushasi faqad pdf va 5 mb hajmdan oshmasin'),
        ]);
        dd($request);
    }
}
