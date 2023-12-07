<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdateAuditPFM" class="modal-dialog" method="post" onsubmit="updateFormAuditPFM(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_report_pfms">
        <input type="hidden" name="file_path" value="/images/auditreportpfm_file/">
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.Audit Report PFM')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="auditreportpfm_name_kh">{{__('t.name kh')}} <span
                                    class="text-danger"></span></label>
                            <input type="text" name="auditreportpfm_name_kh" id="e_auditreportpfm_name_kh"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="auditreportpfm_name_en">{{__('t.name en')}} <span
                                    class="text-danger"></span></label>
                            <input type="text" name="auditreportpfm_name_en" id="e_auditreportpfm_name_en"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="auditreportpfm_date">{{__('t.auditreportpfm_date')}} <span
                                    class="text-danger"></span></label>
                            <input type="date" name="auditreportpfm_date" id="e_auditreportpfm_date"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file_km">{{__('t.document')}} <span class="text-danger"></span></label>
                            <input type="file" name="file_km" id="e_file_km" class="form-control"
                                accept="application/pdf">
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