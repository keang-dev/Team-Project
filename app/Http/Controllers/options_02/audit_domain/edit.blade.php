<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" value="audit_domains" required>
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.Audit Domain')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="auditqa_name_kh">{{__('t.audit_code')}} <span
                                    class="text-danger"></span></label>
                            <select name="audit_id" id="e_audit_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($audits as $c)
                                <option value="{{$c->id}}">{{$c->audit_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="domain_id">{{__('t.domain_id')}} <span class="text-danger"></span></label>
                            <select name="domain_id" id="e_domain_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($domains as $c)
                                <option value="{{$c->id}}">{{$c->domain_name_kh	}}</option>
                                @endforeach
                            </select>
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