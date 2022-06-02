@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')
   <div class="row">

    <div class="col-lg-12">

             <div class="card client-card"> 
                <form class="form"  method="POST" action="{{route('register-reports')}}">
                    @csrf                                
                <div class="card-body text-center" >
                      <div class="row">
                      <div class="col-12">
                         <div class="row">
                       <div class="col-2">
                                    <select class="select2 form-control custom-select text-center"  name="file_id">
               
                                        @foreach ($files as $file)
                                        <option value="{{$file->file_id}}">{{$file->file_id}}</option>
                                          @endforeach
                                        
                                      </select>   
                     </div>

                    
                 <div class="col-sm-4 text-center">
                  <button class="btn btn-success waves-effect waves-light mr-3" id="search-btn"> بحث </button>
                 </div>
                     </div>
                      </div>
             
       
                     </div>

                     </div>
                </form>
            </div>      
       </div>

      

           
 <div class="col-lg-12">
   <button onclick="to_excel('tblData')" class="btn btn-info mb-3">
         export to excel <i class="fa fa-print"></i>
         </button>
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tbl-title">تقارير التسجيل</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0" 
                                    id="tblData">
                                    <thead class="thead-light">
                                        <tr class="noExl">
                                            <th id="tbh-1" style="width: 100px" >رقم الملف</th>
                                            <th id="tbh-2" style="width: 130px">رقم القضية</th>
                                            <th id="tbh-3" style="width: 120px">رقم الدعوى</th>
                                            <th  id="tbh-4" style="width: 160px">تاريخ الطلب الالكتروني</th>
                                            <th  id="tbh-11" style="width: 160px">رقم الطلب الالكتروني</th>
                                            <th id="tbh-5" style="width: 100px">نوع القضية</th>
                                            <th id="tbh-6" style="width: 150px">اسم العميل عربي</th>
                                            <th id="tbh-7" style="width: 150px">اسم العميل انجليزي</th>
                                            <th id="tbh-8" style="width: 150px">اسم الخصم عربي</th>
                                            <th id="tbh-9" style="width: 150px">اسم الخصم انجليزي</th>
                                            <th id="tbh-10" style="width: 100px">رسوم الدعوى</th>
                                            <th id="tbh-12" style="width: 100px"> المحكمة</th>
                                         
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registers as $register)
                                            
                                      
                                        <tr class="">
                                        <td>{{$register->file_num}}</td>
                                            <td>{{$register->main_case_id}}</td>
                                            <td>{{$register->S_CASE_UID}}</td>
                                            <td>{{$register->request_date}}</td>
                                            <td>{{$register->request_number}}</td>
                                            <td>{{$register->caseType}}</td>
                                            <td>{{$register->clientName_ar}}</td>
                                            <td>{{$register->clientName_eng}}</td>
                                            <td>{{$register->againstName_ar}}</td>
                                            <td>{{$register->againstName_eng}}</td>
                                            <td>{{$register->S_COURT_FEES}}</td>
                                            <td>{{$register->caseCourt}}</td>
                                            
                                        
                                        </tr>
                                        @endforeach
                                 </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->

            

            
        </div><!--end col-->
        <div class="float-left mt-4">
            {{ $registers->links() }}
            
            </div>
        
    </div><!-- row -->

  
@endsection

@section('css-link')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('page-script')

<script> 
    function to_excel(tableID, filename = '') { 
    var downloadLink;
var dataType = 'application/vnd.ms-excel';
var tableSelect = document.getElementById(tableID);
var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

// Specify file name
filename = filename?filename+'.xls':'register-reports.xls';

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

   <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
   <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
   <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
   <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
   <script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
   <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
   <script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
   <script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script>


   <script>
         if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "التقارير"; 
    document.getElementById("breadcrumb-2").innerHTML = "تقارير التسجيل"; 

    document.getElementById("page-name").innerHTML = "تقارير التسجيل";
         }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "reports";
    document.getElementById("breadcrumb-1").innerHTML = "register reports";

    document.getElementById("page-name").innerHTML = " REGISTER REPORTS";

    document.getElementById("tbl-title").innerHTML = "REGISTER REPORTS";

    document.getElementById("search-btn").innerHTML = "search";

    document.getElementById("tbh-1").innerHTML = "File number";
    document.getElementById("tbh-2").innerHTML = "Main case number";
    document.getElementById("tbh-3").innerHTML = "Case nubmer";
    document.getElementById("tbh-4").innerHTML = "Case application date";
    document.getElementById("tbh-11").innerHTML = "Case application number";
    document.getElementById("tbh-5").innerHTML = "Case type";
    document.getElementById("tbh-6").innerHTML = "Client name AR";
    document.getElementById("tbh-7").innerHTML = "Client name ENG";
    document.getElementById("tbh-8").innerHTML = "Against name AR";
    document.getElementById("tbh-9").innerHTML = "Against name ENG";
    document.getElementById("tbh-10").innerHTML = "Case fees";
    document.getElementById("tbh-12").innerHTML = "Court";

         }
   </script>
    
@endsection

