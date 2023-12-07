@extends('layouts.staff_layout')
@section('tab-title')
<title>{{__('t.Audit Tracking')}}</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection

@section('titleTable')
<p class="titleTable">តារាងគ្រប់គ្រង{{__('t.Audit Tracking')}}</p>

@endsection
@section('btnTable')

<div class="mb-1">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAudittracking">
        {{__('t.Add New')}}
    </button>
</div>

@endsection
@section('cardBody')

<div class="row">
    <div class="col-12">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
            aria-describedby="example1">
            <thead>
                <tr class="listTable text-center">
                    <td>{{__('t.N.')}}</td>
                    <td>{{__('t.audit_id')}}</td>
                    <td>{{__('t.auditstep_id')}}</td>
                    <td>{{__('t.auditstep_plan_date')}}</td>
                    <td>{{__('t.auditstep_complete_date')}}</td>
                    <td>{{__('t.auditprocessstatus_id')}}</td>
                    <td>{{__('t.audit_file')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('options_02.audit_tracking.create')
@include('options_02.audit_tracking.edit')

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
    $("#menu_audit_tracking").addClass("active");


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
            url: "{{ route('audit.tracking.index') }}",
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
            {
                data: 'auditstep_name_kh',
                name: 'auditstep_name_kh',
            },
            {
                data: 'auditstep_plan_date',
                name: 'auditstep_plan_date',
            },
            {
                data: 'auditstep_complete_date',
                name: 'auditstep_complete_date',
            },
            {
                data: 'auditprocessstatus_name_kh',
                name: 'auditprocessstatus_name_kh',
            },
            {
                data: 'file_km',
                data: 'file_km',
                searchable: false,
                orderable: false
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
            entity: 'audit_trackings',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_audit_id').val(data.audit_id)

                $('#e_auditstep_id').val(data.auditstep_id)
                $('#e_auditstep_plan_date').val(data.auditstep_plan_date)
                $('#e_auditstep_complete_date').val(data.auditstep_complete_date)
                $('#e_auditprocessstatus_id').val(data.auditprocessstatus_id)
                $('#e_file_km').val(data.file_km)


                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
//Update
function updateFormAudittrackings(e) {
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#formUpdateAudittrackings')[0];
    let data = new FormData(form);
    $.ajax({
        url: "/base-action/file/update",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status == 200) {
                $('#editModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: 'តំណែទំរង់ជោគជ័យ.',
                })
                $('#example1').DataTable().ajax.reload();

            } else if (response.status == 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'សូមពិនិត្យម្ដងទៀត !!!',
                    text: 'តំណែទំរង់មិនបានជោគជ័យ.',
                    cancelButtonText: 'ចាកចេញ',
                    confirmButtonText: 'យល់ព្រម'
                });
                return
            }
        }
    });
}

function saveFormAudittrackings(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    let form = $('#formSaveAudittrackings')[0];

    let data = new FormData(form);
    $.ajax({
        url: "/base-action/file/save",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status == 200) {
                $('#createAudittracking').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })
                $('#example1').DataTable().ajax.reload();

            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.sms
                })
            }

        }
    });
}

function setDefault(id, e) {
    var url = "{{url('')}}";
    var is_default = 0;
    if ($(e).is(':checked')) {
        is_default = 1
    }
    $.ajax({
        url: "{{route('base_action.update')}}",
        data: {
            entity: 'audit_trackings',
            id: id,
            is_default: is_default,
            '_token': "{{csrf_token()}}"
        },
        type: 'post',
        success: function(response) {
            if (response.status = 200) {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    icon: 'success',
                    title: "{{session()->get('success')}}"
                })
                $('#example1').DataTable().ajax.reload();
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>
@endsection