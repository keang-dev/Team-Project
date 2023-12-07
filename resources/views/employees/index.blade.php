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
        <form class="row mb-3" id="formSearch">
            <div class="col">
                <label for="search_village_name">Name</label>
                <input type="text" name="name" id="search_name" class="form-control">
            </div>
            <div class="col mt-2">
                <br>
                <button type="button" id="btn_search" class="btn btn-primary">
                    <i class="fa fa-search"></i> បង្ហាញ
                </button>
            </div>
            
        </form>
        <div class="row mb-3">
            <div class="col-12">
                @if(check_permission('employee', 'create'))
                <a href="{{route('employee.create')}}" type="button" class="btn btn-primary" >
                    Create
                </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Gender</td>
                            <td>Data Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

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
    $(document).ready(function(){
        // active menu 
        $(".sidebar li a").removeClass("active");   
        // $("#menu_setting>a").addClass("active"); // parrent menu
        // $("#menu_setting").addClass("menu-open");
        $("#menu_employee").addClass("active");

        // get district for search
        getlist('search_province_id', 'search_district_id', "{{route('district.get_by_province_id')}}");
         // get district for search
        getlist('search_district_id', 'search_commune_id', "{{route('commune.get_by_district_id')}}");
        
        // get district option  for crate
        getlist('province_id', 'district_id', "{{route('district.get_by_province_id')}}");
        // get commune option for crate
        getlist('district_id', 'commune_id', "{{route('commune.get_by_district_id')}}");
        // get district option  for crate
        getlist('e_province_id', 'e_district_id', "{{route('district.get_by_province_id')}}");
        // get commune option for crate
        getlist('e_district_id', 'e_commune_id', "{{route('commune.get_by_district_id')}}");
        

        // search clicked 
        $('#btn_search').click(function() {
            $('#example1').DataTable().draw(true);
        });

        // permission for export buttons
        <?php 
            if(check_permission('employee', 'export')){
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
            "lengthMenu": [[10, 100, -1], [ 10, 100, "ទាំងអស់",]],
            // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            ajax:{
                url: "{{ route('employee.index') }}",
                type: 'get',
                data: function(d){
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
                    data: 'first_name',
                    name: 'employees.first_name'
                },
                {
                    data: 'last_name',
                    name: 'employees.last_name'
                },
                {
                    data: 'gender',
                    name: 'employees.gender',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'data_status',
                    name: 'employees.last_name',
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
            buttons: ["excel","copy", "csv",  "pdf", "print", "colvis", "pageLength"],
            columnDefs:[
                { targets: [0, 1], visible: true},
            ]
            

        })

        
    })

    function getlist(parent_element, child_element, url){
        $(`#${parent_element}`).change(function(){
            var id = $(this).val();
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response){
                    var options = '<option value="">-----</option>';
                    response.map((data, i) => {
                        options += `<option value="${data.id}">${data.name}</option>`;
                    });

                    $(`#${child_element}`).html(options);
                }
            });
        });
    }

    function edit(id){
        $.ajax({
            url: "{{route('base_action.edit')}}",
            data: {
                entity: 'provinces',
                id: id,
            },
            type: 'get',
            success: function(response){
                if(response.status = 200){
                    let data = response.data;
                    $('#e_id').val(data.id)
                    $('#e_name').val(data.name)

                    $('#editModal').modal('show');
                      
                }else{
                    alert("Unable to get edit data!");
                }
            }
        });
    }

</script>
@endsection