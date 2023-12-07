<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="communes">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New commune</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="province_id">Province <span class="text-danger">*</span></label>
                            <select id="province_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District <span class="text-danger">*</span></label>
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">-----</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="village">Commune <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
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