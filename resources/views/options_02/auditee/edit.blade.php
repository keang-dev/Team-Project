<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" value="auditees" required>
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.Auditee')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="auditee_name_kh">{{__('t.name kh')}} <span class="text-danger"></span></label>
                            <input type="text" name="auditee_name_kh" id="e_auditee_name_kh" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="auditee_name_en">{{__('t.name en')}} <span class="text-danger"></span></label>
                            <input type="text" name="auditee_name_en" id="e_auditee_name_en" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="clientperson_name_en">{{__('t.auditeetype_id')}} <span
                                    class="text-danger"></span></label>
                            <!-- <input type="text" name="clienttype_id" id="e_clienttype_id" class="form-control"> -->
                            <select name="auditeetype_id" id="e_auditeetype_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($auditee_types as $c)
                                <option value="{{$c->id}}">{{$c->audittype_name_kh}}</option>
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