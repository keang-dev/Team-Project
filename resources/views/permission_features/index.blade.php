@extends('layouts.master')
@section('tab-title')
<title>List of Role</title>
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
        <h3>Feature for {{$permission->name}} Module</h3>
        <form class="row mb-3" id="formSearch">
            <div class="col">
                <label for="search_name">Name</label>
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Feature Name</td>
                            <td>Aleas</td>
                            <td>Actions</td>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

@include('permission_features.create')
@include('permission_features.edit')

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
        $("#menu_setting>a").addClass("active"); // parrent menu
        $("#menu_setting").addClass("menu-open");
        $("#menu_permission").addClass("active");

        $("input[name='name']").keyup(function(){
            var v = $(this).val();
            v = v.toLowerCase();
            v = v.replace(/\s+/g, '');
            $("input[name='aleas']").val(v);
        })


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
            "lengthMenu": [[10, 100, -1], [ 10, 100, "ទាំងអស់",]],
            // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            ajax:{
                url: "{{ route('permission_feature.index', base64_encode($permission->id)) }}",
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
                    data: 'name',
                    name: 'permission_features.name'
                },
                {
                    data: 'aleas',
                    name: 'permission_features.aleas'
                },
                
                {
                    data: 'action',
                    data: 'action',
                }
            ],

            "dom": 'Bfrtip',
            buttons: ["excel","copy", "csv",  "pdf", "print", "colvis", "pageLength"],
            columnDefs:[
                { targets: [0, 1], visible: true},
            ]

        })



        
    })



    function edit(id){
        $.ajax({
            url: "{{route('base_action.edit')}}",
            data: {
                entity: 'permission_features',
                id: id,
            },
            type: 'get',
            success: function(response){
                if(response.status = 200){
                    let data = response.data;
                    $('#e_id').val(data.id)
                    $('#e_name').val(data.name)
                    $('#e_aleas').val(data.aleas)

                    $('#editModal').modal('show');
                      
                }else{
                    alert("Unable to get edit data!");
                }
            }
        });
    }

</script>
@endsection