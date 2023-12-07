<!-- Modal -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="#" id="formSave" class="modal-dialog" method="post" onsubmit="saveForm(event)">
        @csrf
        <input type="hidden" name="entity" value="client_organization_contacts">
        <input type="hidden" name="unique_col" value="client_organization_name">
        <input type="hidden" name="in_by" value="{{auth()->user()->id}}">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title titleTable text-white" id="createModalLabel">បញ្ចូល
                    {{__('t.client organization contact')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{__('t.client_id')}} <span class="text-danger"></span></label>
                            <!-- <input type="text" name="clienttype_id" class="form-control" placeholder="clienttype_id"> -->
                            <select name="client_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($clients as $c)
                                <option value="{{$c->id}}">{{$c->client_name_kh}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('t.clientcontacttype_id')}} <span class="text-danger"></span></label>
                            <!-- <input type="text" name="clienttype_id" class="form-control" placeholder="clienttype_id"> -->
                            <select name="clientcontacttype_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach($client_contact_types as $c)
                                <option value="{{$c->id}}">{{$c->clientcontacttype_name_kh	}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="client_organization_name">{{__('t.clientcontclient_organization_name')}} <span
                                    class="text-danger"></span></label>
                            <input type="text" name="client_organization_name" class="form-control" required>
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