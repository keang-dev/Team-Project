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
                <!-- Button trigger modal -->
                @if(check_permission('province', 'create'))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <!-- <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending">Rendering engine
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="">Browser</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="">Platform(s)</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending" style="">Engine version
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="CSS grade: activate to sort column ascending" style="">CSS grade</th>
                        </tr> -->

                        <tr>
                            <td>English</td>
                            <td>Khmer</td>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal -->

@include('provinces.create')
@include('provinces.edit')

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
        $("#menu_province").addClass("active");

        // search clicked 
        $('#btn_search').click(function() {
            $('#example1').DataTable().draw(true);
        });

        var is_export = "{{check_permission('province', 'export')}}";

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
                url: "{{ route('language.greeting_kh') }}",
                type: 'get',
                data: function(d){
                    d.name = $('#search_name').val()
                }
            },
            columns: [
                {
                    data: 'en_word',
                    name: 'key'
                },
                {
                    data: 'value', orderable: false,
                    mRender: function(data, type, row){
                        return `<input onchange="edit('${row.key}', this)" key="${row.key}" value="${row.value}" class="form-control editvalue">`
                    }
                    
                }
                
            ],
           
            

        })
    })

    function edit(key, thischange){
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        value = $(thischange).val();
        $.ajax({
            url: "{{route('language.greeting_kh_save')}}",
            data: {
                'key': key,
                'value': value,
                '_token': "{{csrf_token()}}"
            },
            type: 'post',
            success: function(response){
                if(response.status = 200){
                    Toast.fire({
                        icon: 'success',
                        title: 'Greeting kh saved.'
                    })
                      
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to get edit data!'
                    })
                }
            }
        });
    }

</script>
@endsection