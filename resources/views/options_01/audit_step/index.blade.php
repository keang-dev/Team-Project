@extends('layouts.master')
@section('tab-title')
<title>{{__('t.Audit Step')}}</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('titleTable')
<p class="titleTable">តារាងគ្រប់គ្រង{{__('t.Audit Step')}}</p>
@endsection
@section('btnTable')
<div class="mb-1">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        {{__('t.add new')}}
    </button>
</div>
@endsection
@section('cardBody') <div class="row">
    <div class="col-12">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
            aria-describedby="example1_info">
            <thead>
                <tr class="listTable">
                    <td>{{__('t.N.')}}</td>
                    <td>{{__('t.name kh')}}</td>
                    <td>{{__('t.name en')}}</td>
                    <td>{{__('t.auditstep_color')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

        </table>
    </div>
</div>
<!-- modal -->
@include('options_01.audit_step.create')
@include('options_01.audit_step.edit')
@endsection
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}">
</script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">
</script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">
</script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}">
</script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}">
</script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- custom base action js -->
<script src="{{asset('assets/js/base_action.js')}}"></script>
<script>
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_table>a").addClass("active"); // parrent menu
    $("#menu_table").addClass("menu-open");
    $("#menu_audit_step").addClass("active");
    <?php 
            if(check_permission('province', 'export')){
                $exports = 'Bfrtip';
            }else{
                $exports = 'none';
            }
        ?>
    var export_buttons = "{{$exports}}";
    // Datatable 
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
        // "bInfo": false,
        // "pageLength": 50,
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{ route('audit_step.index') }}",
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
                data: 'auditstep_name_kh',
                name: 'auditstep_name_kh',
            },
            {
                data: 'auditstep_name_en',
                name: 'auditstep_name_en',
            },
            {
                data: 'auditstep_color',
                name: 'auditstep_color',
            },
            {
                data: 'action',
                data: 'action',
                searchable: false,
                orderable: false
            }
        ],

        "dom": export_buttons,
        buttons: ["excel", "print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]
    })


})

function edit(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'audit_steps',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_auditstep_name_kh').val(data.auditstep_name_kh)
                $('#e_auditstep_name_en').val(data.auditstep_name_en)
                $('#e_auditstep_color').val(data.auditstep_color)
                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>
@endsection