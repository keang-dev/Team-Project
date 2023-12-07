@extends('layouts.master')
@section('tab-title')
<title>Create new Employee</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection


@section('content')
<div class="card mt-3 card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                    aria-selected="false">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($work_status == 0) text-danger @endif" id="custom-tabs-three-profile-tab"
                    data-toggle="pill" href="#custom-tabs-three-profile" role="tab"
                    aria-controls="custom-tabs-three-profile" aria-selected="true">Work Experiences</a>
            </li>
            @if($employee->marry_status != 1)
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                    href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                    aria-selected="false">Family Info</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                    href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings"
                    aria-selected="false">Department</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                aria-labelledby="custom-tabs-three-home-tab">
                @include('employees.forms.edit_personal_info')
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-profile" role="tabpanel"
                aria-labelledby="custom-tabs-three-profile-tab">
                @include('employees.forms.work_experience')
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                aria-labelledby="custom-tabs-three-messages-tab">
                @include('employees.forms.family_info')
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                aria-labelledby="custom-tabs-three-settings-tab">

            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
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
    $("#menu_employee").addClass("active");

    // get district option  for crate
    getlist('province_id', 'district_id', "{{route('district.get_by_province_id')}}");
    // get commune option for crate
    getlist('district_id', 'commune_id', "{{route('commune.get_by_district_id')}}");
    // get village option for crate
    getlist('commune_id', 'village_id', "{{route('village.get_by_commune_id')}}");


    // Datatable for work experience
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": false,
        "bInfo": false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{ route('employee.work_experience') }}",
            type: 'get',
            data: function(d) {
                d.employee_id = "{{request()->id}}"
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'organization',
                name: 'employee_work_experiences.organization'
            },
            {
                data: 'position',
                name: 'employee_work_experiences.position'
            },
            {
                data: 'start_date',
                name: 'employee_work_experiences.start_date'
            },
            {
                data: 'end_date',
                name: 'employee_work_experiences.start_date'
            },

            {
                data: 'action',
                data: 'action',
            }
        ],


    });

    // Datatable for family info
    $("#exampleFamily").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": false,
        "bInfo": false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{ route('employee.family_info') }}",
            type: 'get',
            data: function(d) {
                d.employee_id = "{{request()->id}}"
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'last_name',
                name: 'last_name'
            },
            {
                data: 'sex',
                name: 'gender'
            },
            {
                data: 'dob',
                name: 'dob'
            },
            {
                data: 'relationship',
                name: 'relationships.name'
            },

            {
                data: 'action',
                data: 'action',
            }
        ],


    });

});

function edit(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'employee_work_experiences',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#EditWorkModal input[name="id"]').val(data.id)
                $('#EditWorkModal input[name="organization"]').val(data.organization)
                $('#EditWorkModal input[name="position"]').val(data.position)
                $('#EditWorkModal input[name="start_date"]').val(data.start_date)
                $('#EditWorkModal input[name="end_date"]').val(data.end_date)

                $('#EditWorkModal').modal('show');

            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}

function getlist(parent_element, child_element, url) {
    $(`#${parent_element}`).change(function() {
        var id = $(this).val();
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                var options = '<option value="">-----</option>';
                response.map((data, i) => {
                    options += `<option value="${data.id}">${data.name}</option>`;
                });

                $(`#${child_element}`).html(options);
            }
        });
    });
}
</script>
@endsection