<form action="{{route('audit.delegation.save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="entity" value="audits">
    <input type="hidden" name="in_by" value="{{Auth::user()->id}}">
    <input type="hidden" name="audit_id" value="{{request()->id}}">
    <h3>បញ្ចូល Delegation</h3>
    <div class="row mt-2 ml-5">
        <div class="col-sm-2 mr-2">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">ឈ្មោះជាអក្សរខ្មែរ</label>
                <input type="text" name="delegation_name_kh" class="form-control" required
                    placeholder="បញ្ចូលឈ្មោះជាអក្សរខ្មែរ ">
            </div>
        </div>
        <div class="col-sm-2 mr-1">
            <div class="form-group row mb-3">
                <label for="formGroupExampleInput">ឈ្មោះជាអក្សរអង់គ្លេស</label>
                <input type="text" name="delegation_name_en" class="form-control" required
                    placeholder="បញ្ចូលឈ្មោះជាអក្សរអង់គ្លេស ">
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