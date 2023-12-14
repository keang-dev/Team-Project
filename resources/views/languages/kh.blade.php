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
        <div class="card-header mt-0">
            <div class="titleTable">
                <img src="{{asset('icon/kh2.png')}}" alt="" width="27" width="25">
                {{__('t.Translate to khmer')}}

            </div>
        </div>
        <div class="row mb-3 mt-3 ml-3">
            <div class="col-12">
                <!-- Button trigger modal -->

                <h4>{{__('t.create new key translate')}}</h4>
                @if(check_permission('province', 'create'))
                <form id="formSave" action="" method="post" onsubmit="saveFormGreeting(event)">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2 mr-2">
                            <div class="form-group row mb-3">
                                <label for="">Text</label>
                                <input oninput="return $('#key').val($(this).val())" type="text" name="text" id="text"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-2 mr-1">
                            <div class="form-group row mb-3">
                                <label for="">Key</label>
                                <input type="text" name="key" id="key" class="form-control" required>

                            </div>
                        </div>
                        <div class="col mt-2">
                            <br>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>{{__('t.Save')}}
                            </button>
                        </div>

                    </div>

                </form>

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
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_translate>a").addClass("active"); // parrent menu
    $("#menu_translate").addClass("menu-open");
    $("#menu_greeting_en").addClass("active");

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
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{ route('language.greeting_kh') }}",
            type: 'get',
            data: function(d) {
                d.name = $('#search_name').val()
            }
        },
        columns: [{
                data: 'en_word',
                name: 'key'
            },
            {
                data: 'value',
                orderable: false,
                mRender: function(data, type, row) {
                    return `<input onchange="edit('${row.key}', this)" key="${row.key}" value="${row.value}" class="form-control editvalue">`
                }

            }

        ],



    })
})

function saveFormGreeting(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    let form = $('#formSave')[0];

    let data = new FormData(form);
    console.log(data);
    $.ajax({
        url: "{{route('language.greeting_en')}}",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status == 200) {
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

function edit(key, thischange) {
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
        success: function(response) {
            if (response.status = 200) {
                Toast.fire({
                    icon: 'success',
                    title: 'Greeting kh saved.'
                })

            } else {
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