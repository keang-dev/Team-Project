<div class="row">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createWorkModal">
        Add More
    </button>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-striped dtr-inline">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Organization</th>
                    <th>Position</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <body>
                @foreach($work_experiences as $n => $work)
                <tr>
                    <td>{{$work->organization}}</td>
                    <td>{{$work->organization}}</td>
                    <td>{{$work->organization}}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <label><input onchange="changeActive({{$work->id}} ,this)" type="checkbox" @if($work->active == 1) checked @endif> Active</label>
                        <!-- <label><input type="checkbox"> Inactive</label> -->
                    </td>
                    <td>
                        <button onclick="editWork({{$work->id}})">Edit</button>
                    </td>
                </tr>
                @endforeach
            </body>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createWorkModal" tabindex="-1" aria-labelledby="createWorkModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWorkModal">Create Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="EditWorkModal" tabindex="-1" aria-labelledby="EditWorkModal" aria-hidden="true">
    <form action="" class="modal-dialog" method="post">
        @csrf
        <input type="hidde" name="edit_work_id" id="edit_work_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditWorkModal">Create Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="organization">Organization <span class="text-danger">*</span></label>
                            <input type="text" name="organization" id="organization" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="position">Position <span class="text-danger">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="end_date">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </form>
</div>

<script>
function editWork(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'employee_work_experiences',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#EditWorkModal input[name="id"]').val(data.id)
                $('#EditWorkModal input[name="organization"]').val(data.organization)
                $('#EditWorkModal input[name="position"]').val(data.position)
                $('#EditWorkModal input[name="start_date"]').val(data.start_date)
                $('#EditWorkModal input[name="end_date"]').val(data.end_date)

                $('#EditWorkModal').modal('show');


            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}

function changeActive(id, e) {
    var token = "{{ csrf_token() }}";
    var active = 0;
    if($(e).is(':checked')){
        active = 1;
    }
    $.ajax({
        url: "{{route('base_action.update')}}",
        data: {
            entity: 'employee_work_experiences',
            id: id,
            active: active,
            "_token": token,
        },
        type: 'post',
        success: function(response) {
            if (response.status = 200) {
                alert("Success", active);

            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}
</script>