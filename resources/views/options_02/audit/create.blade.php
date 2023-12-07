<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <form action="#" id="formSaveAudit" method="post" onsubmit="saveFormAudit(event)"> -->
    <form action="{{route('audit.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="entity" value="audits">
        <input type="hidden" name="in_by" value="{{Auth::user()->id}}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-green" style="background-color: rgb(41, 22, 209);">
                    <h5 class="modal-title titleTable text-white" id="editModalLabel">
                        {{__('t.Audit')}}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row mb-3">
                                <label for="audit_name_kh" class="col-sm-4">{{__('t.audit_name_kh')}}
                                    <span class="text-danger">*</span><span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="audit_name_kh"
                                        value="{{old('audit_name_kh')}}" required>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="educationlevel_id" class="col-sm-4">
                                    {{__('t.audittype_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="audittype_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($audit_types as $c)
                                        <option value="{{$c->id}}">{{$c->audittype_name_kh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="educationlevel_id" class="col-sm-4">
                                    {{__('t.auditee_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="auditee_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($auditees as $c)
                                        <option value="{{$c->id}}">{{$c->auditee_name_kh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="auditperiod" class="col-sm-4">{{__('t.auditperiod')}}
                                    <span class="text-danger">*</span><span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="number" name="auditperiod"
                                        value="{{old('auditperiod')}}" required>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="auditstd_id" class="col-sm-4">
                                    {{__('t.auditstd_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="auditstd_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($audit_stds as $c)
                                        <option value="{{$c->id}}">{{$c->auditstd_name_kh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-grou row mb-3">
                                <label for="auditcategory_id" class="col-sm-4">
                                    {{__('t.auditcategory_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="auditcategory_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($audit_categorys as $c)
                                        <option value="{{$c->id}}">{{$c->auditcategory_name_kh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="audittime_id" class="col-sm-4">
                                    {{__('t.audittime_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="audittime_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($audit_times as $c)
                                        <option value="{{$c->id}}">{{$c->audittime_name_kh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="unit_id" class="col-sm-4">
                                    {{__('t.unit_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="unit_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($units as $c)
                                        <option value="{{$c->id}}">{{$c->unit_name_km}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-grou row mb-3">
                                <label for="delegation_id" class="col-sm-4">
                                    {{__('t.delegation_id')}} <span class="text-danger">*</span>
                                    <span class="float-right">:</span>
                                </label>
                                <div class="col-sm-7">
                                    <select name="delegation_id" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach($delegations as $c)
                                        <option value="{{$c->id}}">{{$c->delegation_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="file_km" class="col-sm-4">{{__('t.audit_file')}}
                                    <span class="text-danger">*</span><span class="float-right">:</span></label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="file" name="file_km" value="{{old('audit_file')}}"
                                        required>
                                </div>
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