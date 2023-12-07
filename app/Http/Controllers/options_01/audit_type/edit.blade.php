<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_types" required>
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់ {{__('t.audit_type')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="auditcategory_name_kh">ឈ្មោះជាអក្សរខ្មែរ <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="audittype_name_kh" id="e_audittype_name_kh" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="auditcategory_name_en">ឈ្មោះជាអក្សរអង់គ្លេស <span
                                    class="text-danger"></span></label>
                            <input type="text" name="audittype_name_en" id="e_audittype_name_en" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>audittype_code <span class="text-danger">*</span></label>
                            <input type="text" name="audittype_code" id="e_audittype_code" class="form-control" required
                                placeholder="audittype_code">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('ចាកចេញ')}}</button>
                <button id="btn_update" class="btn btn-primary">{{__('តំណែទំរង់')}}</button>
            </div>
        </div>
    </form>
</div>