<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="roles">
        <input type="hidden" name="unique_col" value="name">
        <input type="hidden" name="file_path" value="roles/">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>


                    </div>
                    <div class="col-sm-12">
                        
                        <div class="form-group">
                            <label>Photo <span class="text-danger"></span></label>
                            <input type="file" name="photo" class="form-control">
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