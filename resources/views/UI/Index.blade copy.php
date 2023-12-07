@extends('layouts.NewLayout.master')
@section('tab-title')
<title>Edit Staff</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('cardBody')
<div class=" card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                    aria-selected="false">ផែនការសវនកម្មប្រចាំឆ្នាំ</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id=" custom-tabs-three-profile-tab" data-toggle="pill"
                    href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                    aria-selected="true">ប្រធានប្រតិភូ</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                aria-labelledby="custom-tabs-three-home-tab">
                @include('UI.Table.audit_plan.Audit_plan')
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-profile" role="tabpanel"
                aria-labelledby="custom-tabs-three-profile-tab">

            </div>

        </div>
    </div>
</div>


@endsection

@section('js')
@include('Layouts.Link.DataTable')

<script>
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_table>a").addClass("active"); // parrent menu
    $("#menu_table").addClass("menu-open");
    $("#menu_audit").addClass("active");

    // Datatable 
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{route('ChengeLayout')}}",
            type: 'get',
            data: function(d) {
                d.name = $('#search_name').val()
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },

            {
                data: 'audit_code',
                name: 'audit_code',
            },

        ],

        "dom": export_buttons,
        buttons: ["excel", "print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]
    })
})
</script>
@endsection