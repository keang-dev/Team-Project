<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="#" id="formUpdate" class="modal-dialog" method="post" onsubmit="updateForm(event)">
        @csrf
        <input type="hidden" name="entity" value="delegation_teams" required>
        <input type="hidden" name="id" id="id" required>
        <input type="hidden" name="up_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="editModalLabel">តំណែទំរង់
                    {{__('t.Delegation Team')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" form-group">
                            <label>{{__('t.delegation_id')}} <span class="text-danger">*</span></label>
                            <select name="delegation_id" id="e_delegation_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($delegations as $c)
                                <option value="{{$c->id}}">{{$c->delegation_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.staff_id')}} <span class=" text-danger"></span></label>
                            <select name="staff_id" id="e_staff_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($staffs as $c)
                                <option value="{{$c->id}}">{{$c->staff_first_name_km}} {{$c->staff_last_name_km}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.delegationrole_id')}} <span class=" text-danger"></span></label>
                            <select name="delegationrole_id" id="e_delegationrole_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($delegation_roles as $c)
                                <option value="{{$c->id}}">{{$c->delegationrole_name_kh}}
                                </option>
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