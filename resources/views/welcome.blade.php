
<!-- {{get_full_date_kh(date('Y-m-d'))}} -->
{{translateDate('kh')}}
<?php 
    $provinces = DB::table('provinces')->get();
?>
@foreach($provinces as $k => $pro)
    {{$k+1}}. {{tran($pro->name_en, $pro->name,)}}<br>
@endforeach