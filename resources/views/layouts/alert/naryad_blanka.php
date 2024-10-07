<?php
use App\Models\NaryadB;
$Muxir = count(NaryadB::where('type','pedding')->get());
echo $Muxir;
?>