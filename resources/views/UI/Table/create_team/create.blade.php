<form action="{{route('audit.delegation.team.save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="entity" value="audits">
    <input type="hidden" name="in_by" value="{{Auth::user()->id}}">
    <input type="hidden" name="audit_id" value="{{request()->id}}">
    <h3>បញ្ចូល Delegation Team</h3>
    <div class="row mt-2 ml-5">
        <div class="col-sm-2 mr-2">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">បញ្ចូលសមាជិក</label>
                <select name="staff_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($staffs as $c)
                    <option value="{{$c->id}}">{{$c->staff_first_name_km}} {{$c->staff_last_name_km}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">តួនាទី</label>
                <select name="delegationrole_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($delegation_roles as $c)
                    <option value="{{$c->id}}">{{$c->delegationrole_name_kh}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col mt-2">
            <br>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> បញ្ចូល
            </button>
        </div>

    </div>
</form>