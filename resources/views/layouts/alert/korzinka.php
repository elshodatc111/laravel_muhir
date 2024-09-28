<?php
    use App\Models\Muxir;
    echo count(Muxir::where('type',auth()->user()->email)->get());
?>