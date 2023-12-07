@extends('layouts.master')
@section('tab-title')
<title>Create new Employee</title>
@endsection
@section('css')

@endsection

@section('content')
<div class="card mt-3 card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home"
                    role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                    href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                    aria-selected="true">Work Experiences</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                    href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                    aria-selected="false">Family Info</a>
            </li>
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
                @include('employees.forms.personal_info')
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-profile" role="tabpanel"
                aria-labelledby="custom-tabs-three-profile-tab">
              
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                aria-labelledby="custom-tabs-three-messages-tab">
              
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                aria-labelledby="custom-tabs-three-settings-tab">
              
            </div>
        </div>
    </div>

</div>


@endsection

@section('js')

<!-- custom base action js -->
<!-- <script src="{{asset('assets/js/base_action.js')}}"></script> -->
<script>
    $(document).ready(function(){
        // active menu 
        $(".sidebar li a").removeClass("active");   
        $("#menu_employee").addClass("active");

        // get district option  for crate
        getlist('province_id', 'district_id', "{{route('district.get_by_province_id')}}");
        // get commune option for crate
        getlist('district_id', 'commune_id', "{{route('commune.get_by_district_id')}}");
        // get village option for crate
        getlist('commune_id', 'village_id', "{{route('village.get_by_commune_id')}}");

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
    })
</script>
@endsection