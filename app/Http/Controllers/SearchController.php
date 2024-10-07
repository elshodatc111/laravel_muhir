<?php

namespace App\Http\Controllers;
use App\Models\Muxir;
use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\MuxirFaktura;
use App\Models\NaryadB;
use App\Models\NaryadBlankaFaktura;
use Illuminate\Http\Request;

class SearchController extends Controller{
    public function qidruv_muxir(){
        $Muxir = Muxir::where('muxirs.status','true')
            ->join('muxir_fakturas','muxir_fakturas.number','=','muxirs.faktura')
            ->join('hodims','muxir_fakturas.hodim','=','hodims.id')
            ->select('muxirs.number','muxirs.faktura','muxir_fakturas.coato','muxir_fakturas.coato_name','hodims.name','muxir_fakturas.operator','muxir_fakturas.created_at')
            ->get();
        return view('search.muxir',compact('Muxir'));
    }
    public function qidruv_naryad_blanka(){
        $Muxir = NaryadB::where('naryad_b_s.status','true')
            ->join('naryad_blanka_fakturas','naryad_blanka_fakturas.number','=','naryad_b_s.faktura')
            ->join('hodims','naryad_blanka_fakturas.hodim','=','hodims.id')
            ->select('naryad_b_s.number','naryad_b_s.faktura','naryad_blanka_fakturas.coato','naryad_blanka_fakturas.coato_name','hodims.name','naryad_blanka_fakturas.operator','naryad_blanka_fakturas.created_at')
            ->get();
        return view('search.naryad_blanka',compact('Muxir'));
    }
    public function qidruv_simkarta(){
        return "qidruv_simkarta";
    }
    public function qidruv_naryadlar(){
        return "qidruv_naryadlar";
    }
}