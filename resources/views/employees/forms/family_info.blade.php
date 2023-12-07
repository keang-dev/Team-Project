<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFamilyModal">
            Add More
        </button>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
    <table id="exampleFamily" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="exampleFamily_info">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Relationship</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createFamilyModal" tabindex="-1" aria-labelledby="createFamilyModal" aria-hidden="true">
    <form action="#" id="saveFormFamily" class="modal-dialog" method="post" onsubmit="saveFormFamily(event, 'createFamilyModal')" >
        @csrf
        <input type="hidden" name="entity" value="employee_families">
        <input type="hidden" name="per" value="employee">
        <input type="hidden" name="employee_id" value="{{request()->id}}">
        <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">First Nmae <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">-----</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="gender">Relationship <span class="text-danger">*</span></label>
                            <select name="relationship_id" id="relationship_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($relationships as $relation)
                                <option value="{{$relation->id}}">{{$relation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal edit -->
<div class="modal fade" id="editFamilyModal" tabindex="-1" aria-labelledby="editFamilyModal" aria-hidden="true">
    <form action="#" id="updateFormFamily" class="modal-dialog" method="post" onsubmit="updateFormFamily(event)" >
        @csrf
        <input type="hidden" name="entity" value="employee_families">
        <input type="hidden" name="per" value="employee">
        <input type="hidden" name="id" value="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">First Nmae <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="e_gender">Gender <span class="text-danger">*</span></label>
                            <select name="gender" id="e_gender" class="form-control" required>
                                <option value="">-----</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="e_relationship_id">Relationship <span class="text-danger">*</span></label>
                            <select name="relationship_id" id="e_relationship_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($relationships as $relation)
                                <option value="{{$relation->id}}">{{$relation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    function saveFormFamily(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    let form = $('#saveFormFamily')[0];
    
    let data = new FormData(form);
    $.ajax({
        url: "/base-action/save",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status == 200) {
                $('#createFamilyModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })
                $('#exampleFamily').DataTable().ajax.reload();

            }else{
                Toast.fire({
                    icon: 'error',
                    title: response.sms
                })
            }
        
        }
    });
}

// update 
function updateFormFamily(e){
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#updateFormFamily')[0];
    let data = new FormData(form);
    $.ajax({
        url: "/base-action/update",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status == 200) {
                $('#editFamilyModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })
                $('#exampleFamily').DataTable().ajax.reload();

            }
            if (response.status == 500) {
                alert(response.sms)
            }
        }
    });
}

function getEditFamily(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'employee_families',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#editFamilyModal').modal('show');
                $('#editFamilyModal input[name="id"]').val(data.id)
                $('#editFamilyModal input[name="first_name"]').val(data.first_name)
                $('#editFamilyModal input[name="last_name"]').val(data.last_name)
                // $('#editFamilyModal input[name="gender"]').val(data.gender)
                $('#e_gender').val(data.gender);
                $('#editFamilyModal input[name="dob"]').val(data.dob)
                $('#e_relationship_id').val(data.relationship_id);

                

            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>

