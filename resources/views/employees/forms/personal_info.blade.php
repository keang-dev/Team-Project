<form action="{{route('employee.save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="first_name">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">-----</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12 col-12">
            <div class="form-group">
                <label for="pob">Place of Birth</label>
                <input type="text" name="pob" id="pob" class="form-control" required>
            </div>
        </div>
        <div class="col-12">
            <h4>Current Address:</h4>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="province_id">Province <span class="text-danger">*</span></label>
                <select name="province_id" id="province_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($provinces as $province)
                    <option value="{{$province->id}}">{{$province->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="district_id">District <span class="text-danger">*</span></label>
                <select name="district_id" id="district_id" class="form-control" required>
                    <option value="">-----</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="commune_id">Commune <span class="text-danger">*</span></label>
                <select name="commune_id" id="commune_id" class="form-control" required>
                    <option value="">-----</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="village_id">Village <span class="text-danger">*</span></label>
                <select name="village_id" id="village_id" class="form-control" required>
                    <option value="">-----</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="marry_status">Marry Status <span class="text-danger">*</span></label>
                <select name="marry_status" id="marry_status" class="form-control" required>
                    <option value="">-----</option>
                    <option value="1">Single</option>
                    <option value="2">Married</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="marry_status">Photo <span class="text-danger"></span></label>
                <br>
                <input type="file" name="photo" onchange="previewFile(this);">
                <br>
                <img src="" alt="" id="previewImg" width="50%">
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>