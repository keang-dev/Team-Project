<!-- Modal -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_pfms">
        <!-- <input type="hidden" name="unique_col" value="auditqa_name_kh"> -->
        <input type="hidden" name="in_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="createModalLabel">បញ្ចូល
                    {{__('t.Audit PFM')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" form-group">
                            <label>{{__('t.name kh')}} <span class="text-danger">*</span></label>
                            <!-- <input type="text" name="audit_id" class="form-control" required
                                placeholder="បញ្ចូលឈ្មោះជាអក្សរខ្មែរ "> -->
                            <select name="audit_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audits as $c)
                                <option value="{{$c->id}}">{{$c->audit_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.name en')}} <span class=" text-danger"></span></label>
                            <!-- <input type="text" name="auditreportpfm_id" class="form-control"
                                placeholder="បញ្ចូលឈ្មោះជាអក្សរអង់គ្លេស "> -->
                            <select name="auditreportpfm_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audit_report_pfms as $c)
                                <option value="{{$c->id}}">{{$c->auditreportpfm_name_kh	}}</option>
                                @endforeach
                            </select>
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