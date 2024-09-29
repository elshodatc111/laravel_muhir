<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\Muxir;
use App\Models\Korzinka;

class ChartController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('chart');
    }

    public function xisobot(){
        $Muxir = Muxir::where('type','Send')->get();
        $tarqatildi = array();
        foreach ($Muxir as $key => $value) {
            $Korzinka = Korzinka::where('number',$value->number_id)->first();
            $Bolim = Bolim::where('coato',$Korzinka->coato)->first()->name;
            $tarqatildi[$key]['number'] = $value->number;
            $tarqatildi[$key]['omborda'] = $value->created_at;
            $tarqatildi[$key]['omborda_operator'] = $value->operator;
            $tarqatildi[$key]['faktura'] = $Korzinka->number ;
            $tarqatildi[$key]['bolim_kod'] = $Korzinka->coato;
            $tarqatildi[$key]['bolim'] = $Bolim;
            $tarqatildi[$key]['muxirchi'] = $Korzinka->fio;
            $tarqatildi[$key]['operator'] = $Korzinka->opertor;
            $tarqatildi[$key]['data'] = $Korzinka->updated_at;
            $tarqatildi[$key]['scanner'] = $Korzinka->scanner;
        }
        return view('xisobot',compact('tarqatildi'));
    }
}
