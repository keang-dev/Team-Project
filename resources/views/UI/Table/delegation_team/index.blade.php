<div class="row">
    <div class="col-12">

        <table class="table table-bordered table-striped dtr-inline">
            <thead>
                <tr class="listTable">
                    <td>{{__('t.N.')}}</td>
                    <td>{{__('t.staff_id')}}</td>
                    <td>{{__('t.audit_id')}}</td>
                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

            <body>
                @php($i=1)
                @foreach($delegation_teams as $d)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$d->full_name}}</td>
                    <td>{{$d->audit_id}}</td>
                    <td>{{$d->delegationrole_name_kh}}</td>



                </tr>
                @endforeach
            </body>
        </table>
    </div>
</div>