<!-- Modal Create -->
<div class="modal fade" id="createAuditPFM" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="#" id="formSaveAuditPFM" method="post" onsubmit="saveFormAuditPfm(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_report_pfms">
        <input type="hidden" name="in_by" value="{{auth()->user()->id}}">
        <input type="hidden" name="file_path" value="/images/auditreportpfm_file/">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green" style="background-color: rgb(41, 22, 209);">
                    <h5 class="modal-title titleTable text-white" id="staticBackdropLabel">
                        បញ្ចូល{{__('t.Audit Report PFM')}}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row mb-3">
                                <label for="auditreportpfm_name_kh" class="col-sm-5">{{__('t.name kh')}}
                                    <span class="text-danger"></span>*<span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="auditreportpfm_name_kh">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row mb-3">
                                <label for="auditreportpfm_name_en" class="col-sm-5">{{__('t.name en')}}
                                    <span class="text-danger"></span><span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="auditreportpfm_name_en">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row mb-3">
                                <label for="auditreportpfm_date" class="col-sm-5">{{__('t.auditreportpfm_date')}}
                                    <span class="text-danger"></span>*<span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="date" name="auditreportpfm_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row mb-3">
                                <label for="file_km" class="col-sm-5">{{__('ឯកសារភ្ជាប់')}}
                                    <span class="text-danger"></span><span class="float-right">:</span></label>
                                <input class="form-control col-sm-7" type="file" name="file_km" id="file_km"
                                    valus="{{'pdf_km'}}" accept="application/pdf">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('ចាកចេញ')}}</button>
                    <button type="submit" class="btn btn-primary">រក្សាទុក</button>
                </div>

            </div>
        </div>
    </form>
</div>