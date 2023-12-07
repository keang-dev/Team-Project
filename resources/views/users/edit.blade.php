<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="{{route('user.update')}}" id="formUpdate" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="e_id" required>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
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

                                        <img src="" id="show_img" alt="" class="avatar_user_profile" class="image"
                                            id="img" width="150">
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
                                    <select class="form-control" type="text" name="sex" id="e_gender" required>
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
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label for="password">User Role <span class="text-danger">*</span></label>
                                    <select name="role_id" id="role_id" class="form-control">
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
                <!-- <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="province_id">Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Passoword <span class="text-danger"></span></label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo <span class="text-danger"></span></label>
                            <input type="file" name="photo" id="photo" class="form-control">
                            <img src="" id="show_img" alt="" width="200px">
                        </div>
                    </div>
                </div>
            </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_update" class="btn btn-primary">Save</button>
                </div>
            </div>
            < </form>
        </div>
</div>