<!-- Modal -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_qcreviws">
        <!-- <input type="hidden" name="unique_col" value="client_name_kh"> -->
        <input type="hidden" name="in_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="createModalLabel">បញ្ចូល
                    {{__('t.Audit QC Review')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{__('t.audit_id')}} <span class="text-danger"></span></label>
                            <select name="audit_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audits as $c)
                                <option value="{{$c->id}}">{{$c->audit_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.auditstep_id')}} <span class="text-danger"></span></label>
                            <select name="auditstep_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audit_steps as $c)
                                <option value="{{$c->id}}">{{$c->auditstep_name_kh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.auditqc_id')}} <span class="text-danger"></span></label>
                            <select name="auditqc_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audit_qcs as $c)
                                <option value="{{$c->id}}">{{$c->auditqc_name_kh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.audit_qcreview_by')}} <span class="text-danger"></span></label>
                            <!-- <input type="text" name="audit_qareview_by" class="form-control" placeholder="note Number"> -->
                            <select name="audit_qcreview_by" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($staffs as $c)
                                <option value="{{$c->id}}">{{$c->staff_first_name_km}} {{$c->staff_last_name_km}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.audit_qcreview_date')}} <span class="text-danger"></span></label>
                            <input type="date" name="audit_qcreview_date" class="form-control"
                                placeholder="note Number">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ចាកចេញ</button>
                <button type="submit" id="btn_save" class="btn btn-primary">រក្សាទុក</button>
            </div>
        </div>
    </form>
</div>
<!-- ----------------------End Modal Create Office-------------------------- -->