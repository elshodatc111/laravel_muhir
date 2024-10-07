<?php
use App\Models\Muxir;
$Muxir = count(Muxir::where('type','null')->get());
echo $Muxir;
?>