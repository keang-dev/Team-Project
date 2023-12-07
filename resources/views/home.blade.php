@extends('layouts.master')
@section('tab-title')
<title>Demo</title>
@endsection
@section('css')

<style>
.track-line {
    height: 2px !important;
    background-color: #488978;
    opacity: 1;
}

.dot {
    height: 10px;
    width: 10px;
    margin-left: 3px;
    margin-right: 3px;
    margin-top: 0px;
    background-color: red;
    border-radius: 50%;
    display: inline-block
}

.big-dot {
    height: 25px;
    width: 25px;
    margin-left: 0px;
    margin-right: 0px;
    margin-top: 0px;
    background-color: #488978;
    border-radius: 50%;
    display: inline-block;
}

.big-dot i {
    font-size: 12px;
}

.card-stepper {
    z-index: 0
}

.card-title1 {
    float: center;
}
</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')

<div class="card">
    <div class="card-header bg-green">
        <h3 class="card-title font22"><img src="{{asset('icon/Audit.svg')}}" alt="" width="30" width="28"
                class="brand-image img-circle elevation-3 mr-1 bg-white"> ពត៌មានសវនកម្ម..... </h3>
        <div>@yield('reportsearch')</div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            @yield('btnTable')

        </div>
    </div>
    <div class="card-body font18">
        <div class="col-sm-12">
            <table class="table table-bordered bg-white">
                <thead>
                    @php($i=1)
                    @foreach($audits as $a)
                    <tr>

                        <td>
                            <a href="{{route('audit.edit', $a->id)}}">
                                {{$a->audit_code}}-{{$a->auditperiod}}
                            </a>
                        </td>

                        <!-- <td>{{$i++}}</td> -->
                        <td>
                            <ul id="progress">
                                @if($a->audit_code !=1)
                                <li class=" active text-white"> <a href="/">
                                        AP
                                    </a></li>
                                @endif
                                @if($a->auditperiod !=1)
                                <li class="active">Step 2</li>
                                @endif
                                <li class="active">Step 3</li>
                                <li class="active">Step 4</li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach

                </thead>

            </table>
        </div>

    </div>
</div>


@endsection
@section('js')
<!-- <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script> -->
<!-- <script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard3.js"></script> -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/dist/js/pages/dashboard3.js')}}"></script>
@include('Layouts.Link.DataTable')
<script>
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_dashboard>a").addClass("active"); // parrent menu
    $("#menu_dashboard").addClass("menu-open");
    $("#menu_dashboard").addClass("active");
    <?php 
            if(check_permission('province', 'export')){
                $exports = 'Bfrtip';
            }else{
                $exports = 'none';
            }
        ?>
    var export_buttons = "{{$exports}}";
    // Datatable 

})
</script>
@endsection