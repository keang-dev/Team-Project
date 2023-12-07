@extends('layouts.staff_layout')
@section('tab-title')
<title>{{__('t.Audit Report PFM')}}</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection

@section('titleTable')
<p class="titleTable">តារាងគ្រប់គ្រង{{__('t.Audit Report PFM')}}</p>

@endsection
@section('btnTable')

<div class="mb-1">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAuditPFM">
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
                    <td>{{__('t.name kh')}}</td>
                    <td>{{__('t.name en')}}</td>
                    <td>{{__('t.audit report pfm date')}}</td>
                    <td>{{__('t.document')}}</td>
                    <td>{{__('t.is default')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('options_01.audit_report_pfm.create')
@include('options_01.audit_report_pfm.edit')
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
    $("#menu_Audit_Report_PFM").addClass("active");


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
            url: "{{ route('audit.report.pfm.index') }}",
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
                data: 'auditreportpfm_name_kh',
                name: 'auditreportpfm_name_kh',
            },
            {
                data: 'auditreportpfm_name_en',
                name: 'auditreportpfm_name_en',
            },
            {
                data: 'auditreportpfm_date',
                name: 'auditreportpfm_date',
            },
            {
                data: 'file_km',
                data: 'file_km',
                searchable: false,
                orderable: false
            },
            {
                data: 'is_default',
                data: 'is_default',
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
            entity: 'audit_report_pfms',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_auditreportpfm_name_kh').val(data.auditreportpfm_name_kh)
                $('#e_auditreportpfm_name_en').val(data.auditreportpfm_name_en)
                $('#e_auditreportpfm_date').val(data.auditreportpfm_date)

                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
//Update
function updateFormAuditPFM(e) {
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#formUpdateAuditPFM')[0];
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

function saveFormAuditPfm(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    let form = $('#formSaveAuditPFM')[0];

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
                $('#createAuditPFM').modal('hide');
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
            entity: 'audit_report_pfms',
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