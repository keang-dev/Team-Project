@extends('layouts.master')
@section('tab-title')
<title>{{__('t.Audit')}}</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('titleTable')
<p class="titleTable">តារាងគ្រប់គ្រង{{__('t.Audit')}}</p>
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
                    <td>{{__('t.audit_code')}}</td>
                    <td>{{__('t.audit_name_kh')}}</td>
                    <td>{{__('t.audittype_id')}}</td>
                    <td>{{__('auditee_id')}}</td>
                    <td>{{__('auditperiod')}}</td>
                    <td>{{__('auditstd_id')}}</td>
                    <td>{{__('auditcategory_id')}}</td>
                    <td>{{__('audittime_id')}}</td>
                    <!-- <td>{{__('audit_qrcode')}}</td> -->
                    <td>{{__('unit_id')}}</td>
                    <td>{{__('delegation_id')}}</td>
                    <td>{{__('audit_file')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

        </table>
    </div>
</div>
<!-- modal -->
@include('options_02.audit.create')
@include('options_02.audit.edit')
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
    $("#menu_setting>a").addClass("active"); // parrent menu
    $("#menu_setting").addClass("menu-open");
    $("#menu_audit").addClass("active");
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
            url: "{{route('audit.index')}}",
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
                data: 'audit_name_kh',
                name: 'audit_name_kh',
            },
            {
                data: 'audittype_name_kh',
                name: 'audittype_name_kh',
            },
            {
                data: 'auditee_name_kh',
                name: 'auditee_name_kh',
            },
            {
                data: 'auditperiod',
                name: 'auditperiod',
            },
            {
                data: 'auditstd_name_kh',
                name: 'auditstd_name_kh',
            },
            {
                data: 'auditcategory_name_kh',
                name: 'auditcategory_name_kh',
            },
            {
                data: 'audittime_name_kh',
                name: 'audittime_name_kh',
            },
            {
                data: 'unit_name_km',
                name: 'unit_name_km',
            },
            {
                data: 'delegation_code',
                name: 'delegation_code',
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
//Update
function updateFormAudits(e) {
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#formUpdateAudits')[0];
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

function edit(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'audits',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_audit_code').val(data.audit_code)
                $('#e_audit_name_kh').val(data.audit_name_kh)
                $('#e_audittype_id').val(data.audittype_id)
                $('#e_auditee_id').val(data.auditee_id)
                $('#e_auditperiod').val(data.auditperiod)
                $('#e_auditstd_id').val(data.auditstd_id)
                $('#e_auditcategory_id').val(data.auditcategory_id)
                $('#e_unit_id').val(data.unit_id)
                $('#e_audittime_id').val(data.audittime_id)
                $('#e_delegation_id').val(data.delegation_id)
                // $('#e_file_km').val(data.file_km)
                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}

function saveFormAudit(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    let form = $('#formSaveAudit')[0];

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
                $('#createAudit').modal('hide');
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
</script>
<!-- <td>{{__('t.N.')}}</td>
<td>{{__('t.audit_code')}}</td>
<td>{{__('t.audit_name_kh')}}</td>
<td>{{__('t.audittype_id')}}</td>
<td>{{__('auditee_id')}}</td>
<td>{{__('auditperiod')}}</td>
<td>{{__('auditstd_id')}}</td>
<td>{{__('auditcategory_id')}}</td>
<td>{{__('audittime_id')}}</td> -->
<!-- <td>{{__('audit_qrcode')}}</td> -->
<!-- <td>{{__('unit_id')}}</td>
<td>{{__('delegation_id')}}</td> -->
@endsection