<div class="content-wrapper">
    @yield('sidebar')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb">
                <div class="col-sm-12">
                    <h1 class="m-0">@yield('headerleft')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@yield('headerright')</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            @yield('content')
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title"> @yield('titleTable') </h3>
                    <div>@yield('reportsearch')</div>
                    <div class="card-tools">

                        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button> --}}
                        @yield('btnTable')

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @yield('cardBody')
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @yield('body')
</div>