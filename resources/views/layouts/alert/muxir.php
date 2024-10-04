<?php
use App\Models\Muxir;
$Muxir = count(Muxir::where('type','pedding')->get());
echo $Muxir;
?>