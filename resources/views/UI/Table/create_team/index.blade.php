@include('UI.Table.create_team.create')
<div class="row">
    <div class="col-12">
        <!-- <table id="audit_delegation" class="table table-bordered table-striped dataTable dtr-inline"
            aria-describedby="audit_delegation_info">
            <thead>

                <tr class="listTable">
                    <td>{{__('t.N.')}}</td>
                    <td>{{__('t.delegation_code')}}</td>
                    <td>{{__('t.audit_id')}}</td>


                    <td>{{__('t.actions')}}</td>
                </tr>
            </thead>

        </table> -->

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-striped dtr-inline">
            <thead>
                <tr>
                    <th>ល.រ</th>
                    <th>ឈ្មោះ</th>
                    <th>តួនាទី</th>
                    <td>សកម្មភាព</td>
                </tr>
            </thead>

            <body>
                @php($i=1)
                @foreach($delegation_teams as $d)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$d->full_name}}</td>
                    <td>{{$d->delegationrole_name_kh}}</td>

                </tr>
                @endforeach
            </body>
        </table>
    </div>
</div>