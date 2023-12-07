@extends('layouts.master')
@section('tab-title')
<title>List of Villages</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="card mt-3">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline text-center"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <td>ល.រ</td>
                            <td>រូបភាព</td>
                            <td>គោត្តនាម និងនាម</td>
                            <td>ឈ្មោះអ្នកប្រើប្រាស់</td>
                            <td>ភេទ</td>
                            <td>អង្គភាព</td>
                            <td>តួនាទី</td>
                            <td>អ៊ីម៉ែល</td>
                            <td>លេខទំនាក់ទំនង់</td>
                            <td>សកម្មភាព</td>
                        </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal  -->
<!-- modal -->

@include('users.create')
@include('users.edit')

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
function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function() {
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_setting>a").addClass("active"); // parrent menu
    $("#menu_setting").addClass("menu-open");
    $("#menu_user").addClass("active");

    // search clicked 
    $('#btn_search').click(function() {
        $('#example1').DataTable().draw(true);
    });
    // Datatable 
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
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
            url: "{{ route('user.list') }}",
            type: 'get',
            data: function(d) {
                d.province_id = $('#search_province_id').val()
                d.district_id = $('#search_district_id').val()
                d.commune_id = $('#search_commune_id').val()
                d.village_name = $('#search_village_name').val()
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'photo',
                name: 'users.photo',
                searchable: false,
                orderable: false
            },
            {
                data: 'full_name',
                name: 'full_name'
            },

            {
                data: 'name',
                name: 'users.name'
            },
            {
                data: 'gender',
                name: 'users.sex'
            },
            {
                data: 'unit_name',
                name: 'users.unit_id'

            },
            {
                data: 'position_name',
                name: 'users.position_id'
            },

            {
                data: 'email',
                name: 'users.email'
            },
            {
                data: 'phone_number',
                name: 'users.phone_number'
            },
            // {
            //     data: 'role_name',
            //     name: 'roles.name'
            // },
            // {
            //     data: 'is_default',
            //     name: 'is_default',
            //     searchable: false,
            //     orderable: false
            // },
            {
                data: 'action',
                data: 'action',
                searchable: false,
                orderable: false
            }
        ],

        "dom": 'Bfrtip',
        buttons: ["print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]

    })

})

function edit(id) {
    var url = "{{url('')}}";
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'users',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#e_id').val(data.id)
                $('input[name="name"]').val(data.name);
                $('select[name="role_id"]').val(data.role_id);
                $('select[name="unit_id"]').val(data.unit_id);
                $('select[name="position_id"]').val(data.position_id);
                $('input[name="email"]').val(data.email);
                $('#e_gender').val(data.sex);
                $('input[name="phone_number"]').val(data.phone_number);
                $('input[name="first_name"]').val(data.first_name);
                $('input[name="last_name"]').val(data.last_name);



                $('#show_img').attr('src', url + '/images/' + data.photo)
                $('#editModal').modal('show');

            } else {
                alert("Unable to get edit data!");
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
            entity: 'users',
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

            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>
@endsection