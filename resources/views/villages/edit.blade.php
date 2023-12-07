<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="{{route('village.update')}}" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" id="eentity" value="villages">
        <input type="hidden" name="id" id="e_id" required>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Create New Village</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="province_id">Province <span class="text-danger">*</span></label>
                            <select id="e_province_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District <span class="text-danger">*</span></label>
                            <select id="e_district_id" class="form-control" required>
                                <option value="">-----</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="commune_id">Commune <span class="text-danger">*</span></label>
                            <select name="commune_id" id="e_commune_id" class="form-control" required>
                                <option value="">-----</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="village">Village <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="e_village" class="form-control" required>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_update" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>