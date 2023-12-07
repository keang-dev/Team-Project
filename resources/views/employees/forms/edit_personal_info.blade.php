<form action="{{route('employee.update')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$employee->id}}">
    <div class="row">
        <div class="col-sm-4 col-12">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{$employee->first_name}}" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{$employee->last_name}}" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-4">
            <h5>Text QR-Code</h5>
            {!! QrCode::size(100)->generate("Hello"); !!} 
            <br><br><br><br>
            <h5>Google Mape QR-code</h5>
            <?php $url_map = 'https://maps.google.com/?daddr=11.5640375,104.8933178'; ?>
            {!! QrCode::size(100)->generate($url_map); !!} 
            <br>
            <br>
            <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->merge(('/public/images/user.png'))->generate('Hello')) }}">
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="first_name">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">-----</option>
                    <option value="1" @if($employee->gender == 1) selected @endif>Male</option>
                    <option value="2" @if($employee->gender == 2) selected @endif>Female</option>
                    <option value="3" @if($employee->gender == 3) selected @endif>Other</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="{{$employee->dob}}" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12 col-12">
            <div class="form-group">
                <label for="pob">Place of Birth</label>
                <input type="text" name="pob" id="pob" value="{{$employee->pob}}" class="form-control" required>
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
                    <option value="{{$province->id}}" @if($employee->province_id == $province->id) selected @endif>{{$province->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="district_id">District <span class="text-danger">*</span></label>
                <select name="district_id" id="district_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($districts as $dis)
                    <option value="{{$dis->id}}" @if($employee->district_id == $dis->id) selected @endif>{{$dis->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="commune_id">Commune <span class="text-danger">*</span></label>
                <select name="commune_id" id="commune_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($communes as $com)
                    <option value="{{$com->id}}" @if($employee->commune_id == $com->id) selected @endif>{{$com->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="village_id">Village <span class="text-danger">*</span></label>
                <select name="village_id" id="village_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($villages as $vil)
                    <option value="{{$vil->id}}" @if($employee->village_id == $vil->id) selected @endif>{{$vil->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="marry_status">Marry Status <span class="text-danger">*</span></label>
                <select name="marry_status" id="marry_status" class="form-control" required>
                    <option value="">-----</option>
                    <option value="1" @if($employee->marry_status == 1) selected @endif>Single</option>
                    <option value="2" @if($employee->marry_status == 2) selected @endif>Married</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="form-group">
                <label for="marry_status">Photo <span class="text-danger"></span></label>
                <br>
                <input type="file" name="photo" onchange="previewFile(this);">
                <br>
                <img src="{{getImage($employee->photo)}}" alt="" id="previewImg" width="50%">
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