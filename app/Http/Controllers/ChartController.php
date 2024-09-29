<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\Muxir;
use App\Models\Korzinka;
use Carbon\Carbon;

class ChartController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    function getLast12Months() {
        $months = [];
        $currentDate = Carbon::now();
        for ($i = 0; $i < 12; $i++) {
            $months['Y-m'][] = $currentDate->format('Y-m');
            $months['Y-M'][] = $currentDate->format('Y-M');
            $currentDate->subMonth();
        }
        $months['Y-m'] = array_reverse($months['Y-m']);
        $months['Y-M'] = array_reverse($months['Y-M']);    
        return $months;
    }
    function KelganMuxirlar(){
        $Monchs = $this->getLast12Months();
        $keldi = array();
        foreach ($Monchs['Y-m'] as $key => $value) {
            $Start = $value."-01 00:00:00";
            $End = $value."-31 23:59:59";
            $Muxir = Muxir::where('created_at','>=',$Start)->where('created_at','<=',$End)->get();
            $keldi[$key] = count($Muxir);
        }
        return $keldi;
    }
    function KetganMuxirlar(){
        $Monchs = $this->getLast12Months();
        $ketdi = array();
        foreach ($Monchs['Y-m'] as $key => $value) {
            $Start = $value."-01 00:00:00";
            $End = $value."-31 23:59:59";
            $Muxir = Muxir::where('updated_at','>=',$Start)->where('updated_at','<=',$End)->where('type','Send')->get();
            $ketdi[$key] = count($Muxir);
        }
        return $ketdi;
    }
    function bolimlar(){
        $bolimlar = array();
        foreach (Bolim::where('status','true')->get() as $key => $value) {
            $bolimlar[$key][0] = $value['coato'];
            $bolimlar[$key][1] = $value['name'];
        }
        return $bolimlar;
    }
    function bolimlar2(){
        $bolimlar = array();
        foreach (Bolim::where('status','true')->get() as $key => $value) {
            $bolimlar[$key] = $value['name'];
        }
        return $bolimlar;
    }
    function MavsuBoshidan(){
        $bolimlar = $this->bolimlar();
        $MavsumBoshidan = array();
        foreach ($bolimlar as $key => $value) {
            $count = 0;
            $Korzinka = Korzinka::where('coato',$value[0])->get();
            foreach ($Korzinka as $key2 => $item) {
                $count = $count + $item['count'];
            }
            $MavsumBoshidan[$key] = $count;
        }
        return $MavsumBoshidan;
    }
    function YilBoshidan(){
        $bolimlar = $this->bolimlar();
        $MavsumBoshidan = array();
        foreach ($bolimlar as $key => $value) {
            $count = 0;
            $Korzinka = Korzinka::where('coato',$value[0])->where('created_at','>=',date('Y').'-01-01 00:00:00')->get();
            foreach ($Korzinka as $key2 => $item) {
                $count = $count + $item['count'];
            }
            $MavsumBoshidan[$key] = $count;
        }
        return $MavsumBoshidan;
    }
    function OyBoshidan(){
        $bolimlar = $this->bolimlar();
        $MavsumBoshidan = array();
        foreach ($bolimlar as $key => $value) {
            $count = 0;
            $Korzinka = Korzinka::where('coato',$value[0])->where('created_at','>=',date('Y-m').'-01 00:00:00')->get();
            foreach ($Korzinka as $key2 => $item) {
                $count = $count + $item['count'];
            }
            $MavsumBoshidan[$key] = $count;
        }
        return $MavsumBoshidan;
    }
    public function index(){
        $Monchs = $this->getLast12Months();
        $keldi = $this->KelganMuxirlar();
        $ketdi = $this->KetganMuxirlar();
        $bolimlar2 = $this->bolimlar2();
        $MavsuBoshidan = $this->MavsuBoshidan();
        $YilBoshidan = $this->YilBoshidan();
        $OyBoshidan = $this->OyBoshidan();
        
        
        return view('chart',compact('Monchs','keldi','ketdi','bolimlar2','MavsuBoshidan','YilBoshidan','OyBoshidan'));
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
