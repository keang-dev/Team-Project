@extends('layouts.master')
@section('tab-title')
<title>Create new Greeting</title>
@endsection
@section('css')

@endsection

@section('content')

    <form id="formSave" action="" method="post" onsubmit="saveFormGreeting(event)">
        @csrf
       <div class="form-group col-sm-12">
        <label for="">Text</label>
            <input oninput="return $('#key').val($(this).val())" type="text" name="text" id="text" class="form-control" required>
       </div>
       <div class="form-group col-sm-12">
        <label for="">Key</label>
            <input type="text" name="key" id="key" class="form-control" required>
       </div>
       <button>Save</button>
    </form>

@endsection

@section('js')

<!-- custom base action js -->
<!-- <script src="{{asset('assets/js/base_action.js')}}"></script> -->
<script>
    $(document).ready(function(){
        // active menu 
        $(".sidebar li a").removeClass("active");   
        $("#menu_employee").addClass("active");

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
        success: function (response) {
            if (response.status == 200) {
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })

            }else{
                Toast.fire({
                    icon: 'error',
                    title: response.sms
                })
            }
        
        }
    });
}


</script>
@endsection