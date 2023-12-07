<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" value="auditee_organization_contacts" required>
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.auditee organization contact')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="auditee_id">{{__('t.auditee_id')}} <span class="text-danger"></span></label>
                            <select name="auditee_id" id="e_auditee_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($auditees as $c)
                                <option value="{{$c->id}}">{{$c->auditee_name_kh}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('t.auditeecontacttype_id')}} <span class="text-danger"></span></label>
                            <!-- <input type="text" name="clienttype_id" class="form-control" placeholder="clienttype_id"> -->
                            <select name="auditeecontacttype_id" id="e_auditeecontacttype_id" class="form-control"
                                required>
                                <option value="">-----</option>
                                @foreach($auditee_contact_types as $c)
                                <option value="{{$c->id}}">{{$c->auditeecontacttype_name_kh	}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="auditee_organization_name">{{__('t.auditee_organization_name')}} <span
                                    class="text-danger"></span></label>
                            <input type="text" name="auditee_organization_name" id="e_auditee_organization_name"
                                class="form-control" required>
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