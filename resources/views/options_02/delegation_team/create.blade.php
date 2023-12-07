<!-- Modal -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="delegation_teams">
        <!-- <input type="hidden" name="unique_col" value="client_id"> -->
        <input type="hidden" name="in_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="createModalLabel">បញ្ចូល
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
                            <select name="delegation_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($delegations as $c)
                                <option value="{{$c->id}}">{{$c->delegation_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.staff_id')}} <span class=" text-danger"></span></label>
                            <select name="staff_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($staffs as $c)
                                <option value="{{$c->id}}">{{$c->staff_first_name_km}} {{$c->staff_last_name_km}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('t.delegationrole_id')}} <span class=" text-danger"></span></label>
                            <select name="delegationrole_id" class="form-control" required>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ចាកចេញ</button>
                <button type="submit" id="btn_save" class="btn btn-primary">រក្សាទុក</button>
            </div>
        </div>
    </form>
</div>
<!-- ----------------------End Modal Create Office-------------------------- -->