<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="{{route('user.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h5 class="modal-title titleTable" id="createModalLabel">បញ្ចូលឈ្មោះអ្នកប្រើប្រាស់ថ្មី</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <div class="mt-2">
                                        <img for="photo" src="{{asset('/image/man.png')}}" class="avatar_user_profile"
                                            class="image" id="img" width="150">
                                    </div>
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                        onchange="preview(event)">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name">គោត្តនាម / Surname<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name">នាម / name<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name">ឈ្មោះអ្នកប្រើប្រាស់ / Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="province_id">ភេទ​ / Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" type="text" name="sex" id="sex" required>
                                        <option value="2">ស្រី</option>
                                        <option value="1">ប្រុស</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name">អង្គភាព / Unit<span class="text-danger">*</span></label>
                                    <select type="text" name="unit_id" id="unit_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($units as $u)
                                        <option value="{{$u->id}}">{{$u->unit_name_km}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name">តួនាទី / Position<span class="text-danger">*</span></label>
                                    <select type="text" name="position_id" id="position_id" class="form-control"
                                        required>
                                        <option value="">-----</option>
                                        @foreach($positions as $p)
                                        <option value="{{$p->id}}">{{$p->position_name_km}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="password">លេខសម្ងាត់ / Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="password">User Role <span class="text-danger">*</span></label>
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="email">អ៊ីមែល​ / Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="email">លេខទំនាក់ទំនង / Phone Number<span
                                            class="text-danger">*</span></label>
                                    <input type="phone_number" name="phone_number" id="phone_number"
                                        class="form-control" required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ចាកចេញ</button>
                    <button type="submit" id="btn_save" class="btn btn-primary">រក្សាទុក</button>
                </div>
            </div>
        </div>
    </form>
</div>