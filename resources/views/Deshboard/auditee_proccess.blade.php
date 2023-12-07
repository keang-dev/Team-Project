<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font22"> AUDIT STATUS (.....) </h3>
                <div>@yield('reportsearch')</div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                    @yield('btnTable')

                </div>
            </div>
            <div class="card-body font18">
                <div class="col-sm-12">
                    <table class="table table-bordered bg-white">
                        <thead>
                            @php($i=1)
                            @foreach($audits as $a)
                            <tr>

                                <td>
                                    <a href="{{route('audit.edit', $a->id)}}">
                                        {{$a->audit_code}}-{{$a->auditperiod}}
                                    </a>
                                </td>

                                <!-- <td>{{$i++}}</td> -->
                                <td>
                                    <ul id="progress">
                                        @if($a->audit_code !=1)
                                        <li class=" active text-white"> <a href="/">
                                                AP
                                            </a></li>
                                        @endif
                                        @if($a->auditperiod !=1)
                                        <li class="active">Step 2</li>
                                        @endif
                                        <li class="active">Step 3</li>
                                        <li class="active">Step 4</li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach

                        </thead>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>