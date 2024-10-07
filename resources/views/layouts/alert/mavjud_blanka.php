<?php
use App\Models\NaryadB;
$Muxir = count(NaryadB::where('type','null')->get());
echo $Muxir;
?>