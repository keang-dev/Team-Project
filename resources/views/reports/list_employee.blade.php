@extends('layouts.master')
@section('tab-title')
<title>List of Villages</title>
@endsection
@section('css')
    <!-- print css  -->
   <style>
    @media print{
        .print_hidden{
            display: none !important;
        }
    }
   </style>
@endsection

@section('content')
<div class="print_hidden">
    <button id="btn_print" class="btn btn-primary">Print</button>
    <button onclick="exportTableToExcel('exportTable')" class="btn-success">Export to Excel</button>
</div>
<div class="card mt-3">
    <div class="card-body">
        <form class="row mb-3 print_hidden" id="formSearch">
            <div class="col">
                <label for="province_id">Province</label>
                <select name="province_id" id="province_id" class="form-control">
                    <option value="">Filter by Province </option>
                    @foreach($provinces as $pro)
                    <option value="{{$pro->id}}" @if(isset(request()->province_id) && $pro->id == request()->province_id) selected @endif>{{$pro->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="province_id">Row per Per</label>
                <select name="per_page" id="per_page" class="form-control">
                    <option value="">Number of rows </option>
                    @foreach($row_perpage as $row)
                    <option value="{{$row['value']}}" @if(request()->per_page == $row['value']) selected @endif>{{$row['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col mt-2">
                <br>
                <button id="btn_search" class="btn btn-primary">
                    <i class="fa fa-search"></i> បង្ហាញ
                </button>
            </div>
            
        </form>
        <div class="row">
            <div class="col-12">
                <div class="w-100">
                    <div class="row">
                        <div class="col-4 text-center">
                            <br><br>
                            <h4>ក្រសួងការងារ</h4>
                            <h5>អគ្គនាយកដ្ឋាន កិច្ចការសង្គម</h5>
                        </div>
                        <div class="col-4 text-center">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h5>បញ្ជីរាយនាមមន្ដ្រី</h5>
                        </div>
                        <div class="col-4 text-center">
                            <h4>ព្រះរាជាណាចក្រកម្ពុជា</h4>
                            <h5>ជាតិ សាសនា ព្រះមហាក្សត្រ</h5>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered" id="exportTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Place of Birth</th>
                                        <th>Province</th>
                                        <th>Disctrict</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $k => $emp)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>
                                                <img src="{{getImage($emp->photo)}}" alt="" class="rounded-circle" width="50" height="50">
                                            </td>
                                            <td>{{$emp->first_name}} {{$emp->last_name}}</td>
                                            <td>{{ ($emp->gender==1) ? 'Male' : 'Female' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($emp->dob)) }}</td>
                                            <td>{{ $emp->pob }}</td>
                                            <td>{{ $emp->province_name }}</td>
                                            <td>{{ $emp->district_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row print_hidden">
                        <div class="col-12">
                            {{ $employees->appends(request()->except(['page']))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    $(document).ready(function(){
        // active menu 
        $(".sidebar li a").removeClass("active");   
        $("#menu_report>a").addClass("active"); // parrent menu
        $("#menu_report").addClass("menu-open");
        $("#menu_report_list_employee").addClass("active");

        $('#btn_print').click(function(){
            window.print();
        })
    })




</script>
<script>
    function exportTableToExcel(tableID, filename = 'list_employee'){
        $("img").remove();
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            downloadLink.click();
        }
    }
</script>
@endsection