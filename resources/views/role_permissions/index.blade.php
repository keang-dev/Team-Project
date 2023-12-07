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
    <div class="car-title">
        <div class="row p-3">
            <div class="col-sm">
                <h3>កំណត់សិទ្ធសម្រាប់ {{$role->name}}</h3>
                <a href="{{route('role_permission.regenerate')}}" class="btn btn-info">Re-Generate</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <form id="formSave" action="{{route('role_permission.save')}}" method="post" class="col-12">
                @csrf
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Permission Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($role_permissions as $k => $role_per)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$role_per->permission_name}}</td>
                            <td>
                                <?php 
                                    $features = DB::table('permission_features')
                                        ->where('permission_id', $role_per->permission_id)
                                        ->where('active', 1)->get();
                                    $permissions = json_decode($role_per->permisions);
                                ?>
                                <input type="hidden" name="id[]" value="{{$role_per->id}}">
                                @if(count($features))
                                <table width="100%">
                                    <tr>
                                        @foreach($features as $f)
                                        <td>
                                            <label>
                                                <input type="checkbox" name="p_{{$role_per->id}}[]" value="{{$f->id}}"
                                                    @if($permissions) @if(in_array($f->id, $permissions)) checked @endif
                                                @endif>
                                                {{$f->name}}
                                            </label>
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                                @else
                                <input type="hidden" name="p_{{$role_per->id}}[]" value="">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <!-- <button class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
$(document).ready(function() {
    // active menu 
    $(".sidebar li a").removeClass("active");
    $("#menu_setting>a").addClass("active"); // parrent menu
    $("#menu_setting").addClass("menu-open");
    $("#menu_role").addClass("active");

    $('input[type="checkbox"]').change(function(evt) {
        evt.preventDefault();
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        let form = $('#formSave')[0];
        let data = new FormData(form);
        $.ajax({
            url: "{{route('role_permission.save')}}",
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
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.sms
                    })
                }

            }
        });
    })
});
</script>

@endsection