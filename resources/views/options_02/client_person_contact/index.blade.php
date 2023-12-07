@extends('layouts.master')
@section('tab-title')
<title>{{__('t.client_person_contact')}}</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('titleTable')
<p class="titleTable">តារាងគ្រប់គ្រង{{__('t.client_person_contact')}}</p>
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
                    <td>{{__('t.client_id')}}</td>
                    <td>{{__('t.clientperson_id')}}</td>
                    <td>{{__('t.clientpersontype_id')}}</td>
                    <td>{{__('t.clientcontacttype_id')}}</td>
                    <td>{{__('t.clientcontact_name')}}</td>
                    <td>{{__('t.is_default')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

        </table>
    </div>
</div>
<!-- modal -->
@include('options_02.client_person_contact.create')
@include('options_02.client_person_contact.edit')
@endsection
@section('js')
<!-- DataTables  & Plugins -->
@include('Layouts.Link.DataTable')
<script>
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_table>a").addClass("active"); // parrent menu
    $("#menu_table").addClass("menu-open");
    $("#menu_client_person_contact").addClass("active");
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
            url: "{{route('client.person.contact.index')}}",
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
                data: 'client_name_kh',
                name: 'client_name_kh',
            },
            {
                data: 'clientperson_name_kh',
                name: 'clientperson_name_kh',
            },
            {
                data: 'clientpersontype_name_kh',
                name: 'clientpersontype_name_kh',
            },
            {
                data: 'clientcontacttype_name_kh',
                name: 'clientcontacttype_name_kh',
            },
            {
                data: 'clientcontact_name',
                name: 'clientcontact_name',
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

function setDefault(id, e) {
    var url = "{{url('')}}";
    var is_default = 0;
    if ($(e).is(':checked')) {
        is_default = 1
    }
    $.ajax({
        url: "{{route('base_action.update')}}",
        data: {
            entity: 'client_person_contacts',
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

function edit(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'client_person_contacts',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_client_id').val(data.client_id)
                $('#e_clientperson_id').val(data.clientperson_id)
                $('#e_clientpersontype_id').val(data.clientpersontype_id)
                $('#e_clientcontacttype_id').val(data.clientcontacttype_id)
                $('#e_clientcontact_name').val(data.clientcontact_name)

                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>
@endsection