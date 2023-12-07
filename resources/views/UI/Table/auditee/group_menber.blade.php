<form action="{{route('audit.table.save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="entity" value="audits">
    <input type="hidden" name="in_by" value="{{Auth::user()->id}}">
    <div class="row">
        <div class="col-sm-2 mr-2">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">ឈ្មោះសវនកម្ម</label>
                <input class="form-control" type="text" name="audit_name_kh" value="{{old('audit_name_kh')}}" required>
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">ប្រភេទសវនកម្ម</label>
                <select name="audittype_id" class="form-control" required>
                    <option value="">-----</option>

                </select>
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">អង្គភាពរង</label>
                <select name="auditee_id" class="form-control" required>
                    <option value="">-----</option>

                </select>
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">នាយកដ្ឋាន</label>
                <select name="unit_id" class="form-control" required>
                    <option value="">-----</option>

                </select>
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">ឆ្នាំធ្វើចុះសវនកម្ម</label>
                <!-- <input type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Example input placeholder"> -->
                <select name="auditperiod" type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Example input placeholder">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>

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
<hr>
<div class="row">
    <div class="col-12">
        <table id="Audit_Member" class="text-center table table-bordered table-striped dataTable dtr-inline"
            aria-describedby="example1_info">
            <thead>
                <tr class="listTable">
                    <td>{{__('t.N.')}}</td>
                    <td>{{__('t.delegation_id')}}</td>
                    <td>{{__('t.staff_id')}}</td>
                    <td>{{__('t.delegationrole_id')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

        </table>
    </div>
</div>