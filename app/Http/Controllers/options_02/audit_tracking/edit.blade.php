<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdateAudittrackings" class="modal-dialog" method="post"
        onsubmit="updateFormAudittrackings(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_trackings">
        <input type="hidden" name="file_path" value="/images/audit_trackings/">
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.Audit Tracking')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="audit_id" class="col-sm-5">{{__('t.audit_id')}}
                                <span class="text-danger"></span>*<span class="float-right">:</span></label>
                            <div class="col-sm-7">
                                <select name="audit_id" id="e_audit_id" class="form-control" required>
                                    <option value="">-----</option>
                                    @foreach($audits as $c)
                                    <option value="{{$c->id}}">{{$c->audit_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="auditstep_id" class="col-sm-5">{{__('t.auditstep_id')}}
                                <span class="text-danger"></span>*<span class="float-right">:</span></label>
                            <div class="col-sm-7">
                                <select name="auditstep_id" id="e_auditstep_id" class="form-control" required>
                                    <option value="">-----</option>
                                    @foreach($audit_steps as $c)
                                    <option value="{{$c->id}}">{{$c->auditstep_name_kh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="auditstep_plan_date" class="col-sm-5">{{__('t.auditstep_plan_date')}}
                                <span class="text-danger"></span><span class="float-right">:</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" name="auditstep_plan_date"
                                    id="e_auditstep_plan_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="auditstep_complete_date" class="col-sm-5">{{__('t.auditstep_complete_date')}}
                                <span class="text-danger"></span>*<span class="float-right">:</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" name="auditstep_complete_date"
                                    id="e_auditstep_complete_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="auditprocessstatus_id" class="col-sm-5">{{__('t.auditprocessstatus_id')}}
                                <span class="text-danger"></span>*<span class="float-right">:</span></label>
                            <div class="col-sm-7">
                                <!-- <input class="form-control" type="text" name="auditprocessstatus_id"> -->
                                <select name="auditprocessstatus_id" id="e_auditprocessstatus_id" class="form-control"
                                    required>
                                    <option value="">-----</option>
                                    @foreach($audit_process_status as $c)
                                    <option value="{{$c->id}}">{{$c->auditprocessstatus_name_kh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-3">
                            <label for="file_km" class="col-sm-5">{{__('ឯកសារភ្ជាប់')}}
                                <span class="text-danger"></span><span class="float-right">:</span></label>
                            <input class="form-control col-sm-7" type="file" name="file_km" id="e_file_km"
                                valus="{{'pdf_km'}}" accept="application/pdf">
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