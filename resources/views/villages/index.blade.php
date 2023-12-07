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
        <form class="row" id="formSearch">
            <div class="col-sm-3 col-12">
                <div class="form-group">
                    <label for="search_province_id">
                       Province
                    </label>
                    <select name="province_id" id="search_province_id" class="form-control select2bs4">
                        <option value="">-----</option>
                        @foreach($provinces as $pro)
                        <option value="{{$pro->id}}">{{$pro->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3 col-12">
                <div class="form-group">
                    <label for="search_district_id">
                       District
                    </label>
                    <select name="district_id" id="search_district_id" class="form-control">
                        <option value="">-----</option>
                      
                    </select>
                </div>
            </div>
            <div class="col-sm-3 col-12">
                <div class="form-group">
                    <label for="search_commune_id">
                       Commune
                    </label>
                    <select name="province_id" id="search_commune_id" class="form-control">
                        <option value="">-----</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="search_village_name">Name</label>
                <input type="text" name="village_name" id="search_village_name" class="form-control">
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
                            <td>No.</td>
                            <td>Village Name</td>
                            <td>Commune Name</td>
                            <td>District Name</td>
                            <td>Province Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td style="">Firefox 1.0</td>
                            <td style="">Win 98+ / OSX.2+</td>
                            <td style="">1.7</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="even">
                            <td class="dtr-control sorting_1" tabindex="0" style="">Gecko</td>
                            <td style="">Firefox 1.5</td>
                            <td style="">Win 98+ / OSX.2+</td>
                            <td style="">1.8</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td style="">Firefox 2.0</td>
                            <td style="">Win 98+ / OSX.2+</td>
                            <td style="">1.8</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="even">
                            <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                            <td style="">Firefox 3.0</td>
                            <td style="">Win 2k+ / OSX.3+</td>
                            <td style="">1.9</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Camino 1.0</td>
                            <td style="">OSX.2+</td>
                            <td style="">1.8</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Camino 1.5</td>
                            <td style="">OSX.3+</td>
                            <td style="">1.8</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Netscape 7.2</td>
                            <td style="">Win 95+ / Mac OS 8.6-9.2</td>
                            <td style="">1.7</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Netscape Browser 8</td>
                            <td style="">Win 98SE+</td>
                            <td style="">1.7</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="odd">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Netscape Navigator 9</td>
                            <td style="">Win 98+ / OSX.2+</td>
                            <td style="">1.8</td>
                            <td style="">A</td>
                        </tr>
                        <tr class="even">
                            <td class="sorting_1 dtr-control">Gecko</td>
                            <td style="">Mozilla 1.0</td>
                            <td style="">Win 95+ / OSX.1+</td>
                            <td style="">1</td>
                            <td style="">A</td>
                        </tr>
                    </tbody> -->

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal  -->

@include('villages.create')
@include('villages.edit')

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
        $("#menu_village").addClass("active");

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

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

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
                url: "{{ route('village.index') }}",
                type: 'get',
                data: function(d){
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
                    data: 'village_name',
                    name: 'villages.name'
                },
                {
                    data: 'commune_name',
                    name: 'communes.name'
                },
                {
                    data: 'district_name',
                    name: 'districts.name',
                },
                {
                    data: 'province_name',
                    name: 'provinces.name'
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
            url: "{{route('village.edit', '')}}/"+id,
            type: 'get',
            success: function(response){
                if(response.status = 200){
                    let data = response.data;
                    $('#e_id').val(data.village_id)
                    $('#e_province_id').val(data.province_id).trigger('change');
                    setTimeout(() => {
                        $('#e_district_id').val(data.district_id).trigger('change');
                    }, 500);
                    setTimeout(() => {
                        $('#e_commune_id').val(data.commune_id)
                    }, 700);

                    $('#e_village').val(data.name)

                    $('#editModal').modal('show');
                      
                }else{
                    alert("Unable to get edit data!");
                }
            }
        });
    }



</script>
@endsection