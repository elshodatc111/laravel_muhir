<?php

namespace App\Http\Controllers;
use App\Models\Muxir;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\MuxirFaktura;
use App\Models\NaryadBlankaFaktura;

use Illuminate\Http\Request;

class ArxivController extends Controller{
    public function arxiv_muxir(){
        $MuxirFaktura = MuxirFaktura::get();
        $Faktura = array();
        foreach ($MuxirFaktura as $key => $value) {
            $Faktura[$key]['number'] = $value->number;
            $Faktura[$key]['coato_name'] = $value->coato_name;
            $Faktura[$key]['hodim'] = Hodim::find($value->hodim)->name;
            $Faktura[$key]['count'] = $value->count;
            $Faktura[$key]['operator'] = $value->operator;
            $Faktura[$key]['created_at'] = $value->created_at;
            if($value->scanner=='false'){
                $text = "Tasdiqlanmagan";
            }else{
                $text = "Tasdiqlangan";
            }
            $Faktura[$key]['scanner'] = $value->scanner;
            $Faktura[$key]['status'] = $text;
        }
        return view('arxiv.muxir',compact('Faktura'));
    }
    public function arxiv_naryad_blanka(){
        $MuxirFaktura = NaryadBlankaFaktura::get();
        $Faktura = array();
        foreach ($MuxirFaktura as $key => $value) {
            $Faktura[$key]['number'] = $value->number;
            $Faktura[$key]['coato_name'] = $value->coato_name;
            $Faktura[$key]['hodim'] = Hodim::find($value->hodim)->name;
            $Faktura[$key]['count'] = $value->count;
            $Faktura[$key]['operator'] = $value->operator;
            $Faktura[$key]['created_at'] = $value->created_at;
            if($value->scanner=='false'){
                $text = "Tasdiqlanmagan";
            }else{
                $text = "Tasdiqlangan";
            }
            $Faktura[$key]['scanner'] = $value->scanner;
            $Faktura[$key]['status'] = $text;
        }
        return view('arxiv.naryad_blanka',compact('Faktura'));
    }
    public function arxiv_simkarta(){
        return "arxiv_simkarta";
    }
    public function arxiv_naryadlar(){
        return "arxiv_naryadlar";
    }
}
