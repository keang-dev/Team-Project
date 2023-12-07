@extends('layouts.NewLayout.master')
@section('tab-title')
<title>កែទម្រង់ការងារសវនកម្ម</title>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<style>
.progressbar {
    height: 30px;
    background: lightgray;
    box-shadow: inset 0px -2px 5px rgba(0, 0, 0, 0.5);
    animation: change 1s linear infinite;
    margin: 5px -10px;
    clip-path: polygon(95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%, 0% 0%);
}

.progressbar:first-child {
    margin-left: 0;
    clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%);
}

.progressbar:last-child {
    margin-right: 0;
}

.bar {
    display: flex;
    gap: 20px;
    /*You can use now this property to play with the separation between the bars*/
}

.progressbar.active {
    background:
        linear-gradient(to right, red 0%, yellow 50%, green 34%) left/var(--p, 100%) fixed,
        lightgray;
    /* box-shadow: inset 0px -2px 5px rgba(0, 0, 0, 0.5); */
}




.progressbar1 {
    height: 30px;
    background: lightgray;
    box-shadow: inset 0px -2px 5px rgba(0, 0, 0, 0.5);
    animation: change 1s linear infinite;
    margin: 5px -10px;
    clip-path: polygon(95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%, 0% 0%);
}

.progressbar1:first-child {
    margin-left: 0;
    /* clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%); */
}

.progressbar1:last-child {
    margin-right: 0;
}

.bar1 {
    display: flex;
    gap: 20px;
    /*You can use now this property to play with the separation between the bars*/
}

.text-center1 {
    text-align: center;
    padding:
        : 2px, 2px, 2px, 2px;
}

.progressbar1.active {
    background:
        linear-gradient(to right, red 0%, yellow 50%, green 34%) left/var(--p, 100%) fixed,
        lightgray;
    box-shadow: inset 0px -2px 5px rgba(0, 0, 0, 0.5);
}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    /* border-color: #dee2e6 #dee2e6 #fff; */
}

.nav-link {
    display: block;
    padding: 0;
}
</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('cardBody')
<div class=" card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item row">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                    aria-selected="false">
                    <div class="">
                        <div class="bar">
                            <div class="progressbar text-center" style="width: 200px; height: 40px;">
                                <div class="mt-2">
                                    <b class="mt-1">ពត៌មានសវនកម្ម</b>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

                <a class="nav-link @if($one_delegation == 0 ) text-danger @endif" id=" custom-tabs-three-01-tab"
                    data-toggle="pill" href="#custom-tabs-three-01" role="tab" aria-controls="custom-tabs-three-01"
                    aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b>Delegation </b>
                            </div>
                        </div>

                    </div>
                </a>
                @if($one_delegation == 1 )
                <a class="nav-link  " id=" custom-tabs-three-02-tab" data-toggle="pill" href="#custom-tabs-three-02"
                    role="tab" aria-controls="custom-tabs-three-02" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">ក្រុមប្រតិភូ</b>
                            </div>
                        </div>

                    </div>
                </a>
                @endif
                @if($one_delegation_teams == 1 )
                <a class="nav-link  " id=" custom-tabs-three-03-tab" data-toggle="pill" href="#custom-tabs-three-03"
                    role="tab" aria-controls="custom-tabs-three-03" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">ផែនការសវនកម្ម</b>
                            </div>
                        </div>

                    </div>
                </a>
                @endif
                <a class="nav-link  " id=" custom-tabs-three-04-tab" data-toggle="pill" href="#custom-tabs-three-04"
                    role="tab" aria-controls="custom-tabs-three-04" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">ដដដ</b>
                            </div>
                        </div>

                    </div>
                </a>
                <!-- <a class="nav-link  " id=" custom-tabs-three-05-tab" data-toggle="pill" href="#custom-tabs-three-05"
                    role="tab" aria-controls="custom-tabs-three-04" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 220px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">របាយការណ៍លទ្ធផលសវនកម្ម</b>
                            </div>
                        </div>

                    </div>
                </a> -->
                <!-- <a class="nav-link  " id=" custom-tabs-three-06-tab" data-toggle="pill" href="#custom-tabs-three-06"
                    role="tab" aria-controls="custom-tabs-three-06" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">ការបិទវគ្គសវនកម្ម</b>
                            </div>
                        </div>

                    </div>
                </a> -->
                <!-- <a class="nav-link  " id=" custom-tabs-three-07-tab" data-toggle="pill" href="#custom-tabs-three-07"
                    role="tab" aria-controls="custom-tabs-three-07" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">របាយការណ៍សវនកម្មបឋម</b>
                            </div>
                        </div>

                    </div>
                </a> -->
                <!-- <a class="nav-link  " id=" custom-tabs-three-08-tab" data-toggle="pill" href="#custom-tabs-three-08"
                    role="tab" aria-controls="custom-tabs-three-08" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">របាយការណ៍ឆ្លើយបំភ្លឺ២៨ថ្ងៃ</b>
                            </div>
                        </div>

                    </div>
                </a> -->
                <!-- <a class="nav-link  " id=" custom-tabs-three-09-tab" data-toggle="pill" href="#custom-tabs-three-09"
                    role="tab" aria-controls="custom-tabs-three-09e" aria-selected="true">
                    <div class="bar1 text-center">
                        <div class="progressbar1" style="width: 200px; height: 40px;">
                            <div class="mt-2">
                                <b class="mt-1">របាយការណ៍សវនកម្មចុងក្រោយ</b>
                            </div>
                        </div>

                    </div>
                </a> -->

            </li>

            <!-- <td>
                <ul id="progress">

                    <ProgressText>
                        <a href="http://">
                            Audit
                        </a>
                    </ProgressText>

                    <li class="active">Step 1</li>
                    <li class="active">Step 2</li>
                    <li class="active">Step 3</li>
                    <li class="active">Step 4</li>
                </ul>

            </td> -->
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-auditee">

            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                aria-labelledby="custom-tabs-three-home-tab">
                @include('UI.Table.audit.edit')

            </div>

            <div class="tab-pane fade " id="custom-tabs-three-01" role="tabpanel"
                aria-labelledby="custom-tabs-three-01-tab">
                @include('UI.Table.delegation.index')

            </div>
            <div class="tab-pane fade " id="custom-tabs-three-02" role="tabpanel"
                aria-labelledby="custom-tabs-three-02-tab">
                @include('UI.Table.create_team.index')
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-03" role="tabpanel"
                aria-labelledby="custom-tabs-three-03-tab">
                ការបើកវគ្គសវនកម្ម
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-04" role="tabpanel"
                aria-labelledby="custom-tabs-three-04-tab">
                ថដថាថ
            </div>
            <div class="tab-pane fade " id="custom-tabs-three-05" role="tabpanel"
                aria-labelledby="custom-tabs-three-05-tab">
                របាយការណ៍លទ្ធផលសវនកម្ម
            </div>


        </div>
    </div>
</div>

@endsection

@section('js')

<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- custom base action js -->
<script src="{{asset('assets/js/base_action.js')}}"></script>

<script>
jQuery(document).ready(function() {

    var back = jQuery(".prev");
    var next = jQuery(".next");
    var steps = jQuery(".step");

    next.bind("click", function() {
        jQuery.each(steps, function(i) {
            if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done')) {
                jQuery(steps[i]).addClass('current');
                jQuery(steps[i - 1]).removeClass('current').addClass('done');
                return false;
            }
        })
    });
    back.bind("click", function() {
        jQuery.each(steps, function(i) {
            if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
                jQuery(steps[i + 1]).removeClass('current');
                jQuery(steps[i]).removeClass('done').addClass('current');
                return false;
            }
        })
    });

})
</script>
<script>
$(document).ready(function() {
    // active menu 
    // $(".sidebar li a").removeClass("active");
    // $("#menu_table>a").addClass("active"); // parrent menu
    // $("#menu_table").addClass("menu-open");
    // $("#menu_audit").addClass("active");
    <?php 
            if(check_permission('province', 'export')){
                $exports = 'Bfrtip';
            }else{
                $exports = 'none';
            }
        ?>
    var export_buttons = "{{$exports}}";
    $("#audit_delegation").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
        // "bInfo": false,
        // "pageLength": 50,
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{ route('audit.delegation') }}",
            type: 'get',
            data: function(d) {
                d.name = $('#search_name').val()
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'delegation_code',
                data: 'delegation_code',
            },
            {
                data: 'audit_id',
                data: 'audit_id',
            },

        ],

        "dom": export_buttons,
        buttons: ["excel", "print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]
    })
    // Datatable 
    $("#Team_Member").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
        // "bInfo": false,
        // "pageLength": 50,
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{route('audit.delegation')}}",
            type: 'get',
            data: function(d) {
                d.name = $('#search_name').val()
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },

            {
                data: 'audit_id',
                name: 'audit_id',
            },

            {
                data: 'action',
                data: 'action',
                searchable: false,
                orderable: false
            }
        ],

        "dom": export_buttons,
        buttons: ["excel", "print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]
    })
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthChange": true,
        // "bInfo": false,
        // "pageLength": 50,
        "lengthMenu": [
            [10, 100, -1],
            [10, 100, "ទាំងអស់", ]
        ],
        // "lengthMenu": [[-1, 10, 100], ["ទាំងអAllស់", 10, 100]],
        "processing": true,
        "serverSide": true,
        "searching": false,
        ajax: {
            url: "{{route('ChengeLayout')}}",
            type: 'get',
            data: function(d) {
                d.name = $('#search_name').val()
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },

            {
                data: 'audit_code',
                name: 'audit_code',
            },
            {
                data: 'audit_name_kh',
                name: 'audit_name_kh',
            },
            {
                data: 'audittype_name_kh',
                name: 'audits.audittype_name_kh',
            },
            {
                data: 'auditee_name_kh',
                name: 'audits.auditee_name_kh',
            },
            {
                data: 'auditperiod',
                name: 'auditperiod',
            },


            {
                data: 'action',
                data: 'action',
                searchable: false,
                orderable: false
            }
        ],

        "dom": export_buttons,
        buttons: ["excel", "print", "pageLength"],
        columnDefs: [{
            targets: [0, 1],
            visible: true
        }, ]
    })
})
//Update
function updateFormAudits(e) {
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#formUpdateAudits')[0];
    let data = new FormData(form);
    $.ajax({
        url: "/base-action/file/update",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status == 200) {
                $('#editModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: 'តំណែទំរង់ជោគជ័យ.',
                })
                $('#example1').DataTable().ajax.reload();

            } else if (response.status == 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'សូមពិនិត្យម្ដងទៀត !!!',
                    text: 'តំណែទំរង់មិនបានជោគជ័យ.',
                    cancelButtonText: 'ចាកចេញ',
                    confirmButtonText: 'យល់ព្រម'
                });
                return
            }
        }
    });
}

function edit(id) {
    $.ajax({
        url: "{{route('base_action.edit')}}",
        data: {
            entity: 'audits',
            id: id,
        },
        type: 'get',
        success: function(response) {
            if (response.status = 200) {
                let data = response.data;
                $('#id').val(data.id)
                $('#e_audit_code').val(data.audit_code)
                $('#e_audit_name_kh').val(data.audit_name_kh)
                $('#e_audittype_id').val(data.audittype_id)
                $('#e_auditee_id').val(data.auditee_id)
                $('#e_auditperiod').val(data.auditperiod)
                $('#e_auditstd_id').val(data.auditstd_id)
                $('#e_auditcategory_id').val(data.auditcategory_id)
                $('#e_unit_id').val(data.unit_id)
                $('#e_audittime_id').val(data.audittime_id)
                $('#e_delegation_id').val(data.delegation_id)
                // $('#e_file_km').val(data.file_km)
                $('#editModal').modal('show');
            } else {
                alert("Unable to get edit data!");
            }
        }
    });
}

function saveFormAudit(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    let form = $('#formSaveAudit')[0];

    let data = new FormData(form);
    $.ajax({
        url: "/base-action/file/save",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status == 200) {
                $('#createAudit').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })
                $('#example1').DataTable().ajax.reload();

            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.sms
                })
            }

        }
    });
}
</script>
@endsection