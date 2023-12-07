<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$audits->id}}">
    <div class="row">
        <div class="col-sm-4 col-12">
            <div class="form-group">
                <label for="first_name" class="mr-4">ឈ្មោះ <span class="text-danger">:</span></label>
                {{$audits->audit_name_kh}}
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="form-group">
                <label for="first_name" class="mr-4">ឆ្នាំសវនកម្ម​ <span class="text-danger">:</span></label>
                {{$audits->auditperiod}}
            </div>
        </div>



    </div>
</form>