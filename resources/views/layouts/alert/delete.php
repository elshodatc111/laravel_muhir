<?php
    use App\Models\Muxir;
    echo count(Muxir::where('number_id','null')->where('type','!=','new')->get());
?>