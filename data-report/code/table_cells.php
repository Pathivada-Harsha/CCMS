<?php

$r['date_time']=date("H:i:s d-m-Y", strtotime($r['date_time']));

$f1 = $r['device_id'];
$f2 = $r['date_time'];
$f3 = $r['voltage_ph1'];
$f4 = $r['voltage_ph2'];
$f5 = $r['voltage_ph3'];
$f6 = $r['current_ph1'];
$f7 = $r['current_ph2'];
$f8 = $r['current_ph3'];



$f11 = $r['powerfactor_ph1'];
$f12 = $r['powerfactor_ph2'];
$f13 = $r['powerfactor_ph3'];
$f18 = $r['frequency_ph1'];
$f19 = $r['frequency_ph2'];
$f20 = $r['frequency_ph3'];



$ff2 = $r['signal_level'];
$ff3 = $r['location'];

$kw_1 = $r['kw_5_avg'];
$kw_2 = $r['kw_10_avg'];
$kw_3 = $r['kw_15_avg'];
$kw_total = $r['kw_1_avg'];
$kva_1 = $r['kva_5_avg'];
$kva_2 = $r['kva_10_avg'];
$kva_3 = $r['kva_15_avg'];
$kva_total = $r['kva_1_avg'];


$energy_kwh_total = $r['energy_kwh_total'];
$energy_kvah_total = $r['energy_kvah_total'];


//////  VOLTAGE COLOR Coding////////////
if($f3<=$v_min_r || $f3>=$v_max_r ){$class_r=$red;}else if($f3>$v_max_lr && $f3<$v_max_r ){$class_r=$orange;}else{$class_r=$normal;}
if($f4<=$v_min_y || $f4>=$v_max_y ){$class_y=$red;}else if($f4>$v_max_ly && $f4<$v_max_y ){$class_y=$orange;}else{$class_y=$normal;}
if($f5<=$v_min_b || $f5>=$v_max_b ){$class_b=$red;}else if($f5>$v_max_lb && $f5<$v_max_b ){$class_b=$orange;}else{$class_b=$normal;}
////////// Current Color Code  //////////////
if($f6>=$c_max_r ){$class_ir=$red;}else{$class_ir=$normal;}
if($f7>=$c_max_y ){$class_iy=$red;}else{$class_iy=$normal;}
if($f8>=$c_max_y ){$class_ib=$red;}else{$class_ib=$normal;}




$data.= "<tr >
<td > $f1
</td>
<td > $f2 </td>

<td  $class_r > $f3 </td>
<td  $class_y > $f4 </td>
<td  $class_b > $f5 </td>
<td  $class_ir > $f6 </td>
<td  $class_iy > $f7 </td>
<td  $class_ib > $f8 </td>

<td > $kw_1 </td>
<td > $kw_2 </td>
<td > $kw_3 </td>
<td > $kw_total </td>


<td > $kva_1 </td>
<td > $kva_2 </td>
<td > $kva_3 </td>
<td > $kva_total </td>

<td > $energy_kwh_total </td>
<td > $energy_kvah_total </td>

<td > $f11 </td>
<td > $f12 </td>
<td > $f13 </td>


<td > $f18 </td>
<td > $f19 </td>
<td > $f20 </td>


<td > $ff2  </td>
<td >";


if($ff3!='' && $ff3!=',' )
{					
	$data.=  '<a href="#" onclick=show_location("' . $ff3 . '") style="color:#0066FF">Track Location</a>';
}
else
{
	echo "Null";
} 

$data.= "</td></tr>";
?>