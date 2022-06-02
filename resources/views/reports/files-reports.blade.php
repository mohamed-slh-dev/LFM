@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('css-link')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <div class="col-lg-12" id="filtter">

        <div class="card client-card"> 
                                        
           <div class="card-body text-center" >
                 <div class="row">
 
                        
                  <div class="col-4 ">
                    <form class="form"  method="POST" action="{{route('report-by-file')}}">
                        @csrf    
                         <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="file-number">رقم الملف  </label>
                            <div class="col-sm-8">
                                <select class=" select2 form-control mb-3 custom-select" name="file_number">
                                    <option value=""></option> 
                                    @foreach ($files_id as $file)
                                    <option value="{{$file->file_id}}">{{$file->file_id}} </option>
                                        
                                    @endforeach
                              
                                </select>
                                 </div>
                       </div>
                </div>

                <div class="col-2  text-center">
                    <button class="btn btn-success waves-effect waves-light mx-3 search-btn" > انشاء تقرير </button>
                </form>
                </div>
                        
          </div>

          </div>
            
       </div>      
  </div>

  @if ($report)
      
  <div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body invoice-head pt-0"> 
            <div class="row">
                <div class="col-md-12 text-center">                                                
                    <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                </div>
            </div>
                <div class="row" style="border: 1px solid #b9b9b9;">
                    <div class="col-3 ">
                        <h6> <span id="left-header">رقم الملف</span> :  {{$report->S_CASE_FILE_NUM}}</h6>
                    </div>
                    <div class="col-6 text-center">
                     
                        <h4> <span id="title-header">تقارير الملفات </span>  </h4>

                    </div>
                        <div class="col-3 " id="p-date">
                            <h6> <span id="print-date">تاريخ الطباعة</span>  : {{$print_date}}</h6>
                            </div>   
                     
                    </div>
         
        </div><!--end card-body-->
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                  <h4 style=" font-weight: bold; "> <span id="linked-number">عدد الدعاوى المرتبطة  </span> : {{$linked_cases_number}}</h4>
                </div>
                <div class="col-4 ">
              <div class=" mb-3">
                <h4 style=" font-weight: bold; "><span   style="font-weight: bold;" id="main-uid"> القضية الاساس  </span> : {{$main_case_uid}} </h4>
                      </div>    
                  </div>
                  <div class="col-4">
                    <h4 style=" font-weight: bold; "> <span id="mainCase-number">رقم القضية  </span> : {{$report->N_CASE_ID}}</h4>
                  </div>
                  <div class="col-4 ">
                    <div class=" mb-3">
                                <label for="example-number-input" > <span  style="font-weight: bold;" id="main-decision"> قرار القضية الاساس  </span> : {{$last_main_case_decision}} </label>                            
                            </div>    
                        </div>
                        <div class="col-4">
                          
                            <div class=" mb-3">
                                        <label for="example-number-input" > <span   style="font-weight: bold;" id="last-decision">  اخر قرار في الملف  </span> : {{$last_last_case_decision}} </label>                            
                                    </div>    
                                </div>
                                <div class="col-12"> <hr> </div>

                                <div class="col-3">
                                    <div class=" mb-3">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-2">اسم العميل عربي </span> : {{$report->clientName_ar}} </label>                            
                                               
                                            </div>    
                                        </div>

                                        <div class="col-3">
                                            <div class=" mb-0">
                                                        <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-3">اسم الخصم عربي </span> : {{$report->againstName_ar}} </label>                            
                                                       
                                                    </div>    
                                                </div>
                                <div class="col-3">
                                    <div class=" mb-3">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-5">اسم العميل انجليزي </span> : {{$report->clientName_eng}} </label>                            
                                               
                                            </div>    
                                        </div>
                                       
                                        <div class="col-3">
                                    <div class=" mb-3">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-4">اسم الخصم عربي </span> : {{$report->againstName_eng}} </label>                            
                                               
                                            </div>    
                                        </div>
                                        <div class="col-12"> <hr> </div>
                                    <div class="col-3">
                                    <div class=" mb-0">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-6">المطالبة المالية </span> : {{ number_format($report->N_PaymentValue,2)}} </label>                            
                                               
                                            </div>    
                                        </div>
                                         <div class="col-3">
                                    <div class=" mb-0">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-7">تاريح التسجيل </span> : {{$report->register_date}} </label>                            
                                               
                                            </div>    
                                        </div>
                                         <div class="col-3">
                                    <div class=" mb-0">
                                                <label for="example-number-input" > <span   style="font-weight: bold;" id="tbh-10"> لدى محكمة </span> : {{$report->caseCourt}} </label>                            
                                               
                                            </div>    
                                        </div>
               </div>
   
            <hr>

            <div class="row">
          
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
            
                          
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th id="th-1" style="width: 100px;">رقم الدعوى</th>
                                    <th id="th-2"  style="width: 100px;">نوع الدعوى</th>
                                    <th id="th-3"  style="width: 100px;">مرحلة الدعوى</th>
                                    <th id="th-4"  style="width: 150px;"> تاريخ التسجيل</th>
                                    <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                                    <th id="th-7" style="width: 250px;"> اخر قرار في الدعوى </th>
                            </tr>
                            </thead>
                         
                            <tbody>
                                   
                            
                                @for ($i = 0; $i < count($case_array); $i++)
                               
                        
                                <tr>
                                   
                                    <td  style="width: 100px;"> {{$case_array[$i]->S_CASE_UID}}</td>
                                        <td  style="width: 100px;"> {{$case_array[$i]->caseType}}</td>
                                        <td  style="width: 100px;"> {{$case_array[$i]->caseStage}}</td>
                                        <td  style="width: 100px;"> {{$case_array[$i]->register_date}}</td>
                                        <td  style="width: 130px;"> {{$case_array[$i]->cliam_amount}}</td>
                                        <td  style="width: 130px;"> {{$decission_array[$i]}}</td>
                                      
                                    </tr>
                                    @endfor
                            </tbody>
                            
                        </table>
                            </div>
                        </div>
                    </div>                                            
                </div>       
            </div>

            
            <hr>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                    <div class="text-center text-muted"></div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="float-right d-print-none">
                   <button onclick="printDiv()" class="btn btn-info">
                      <i class="fa fa-print"></i>
                    </button>
                      
                    </div>
                </div>
            </div>
        </div>
    </div><!--end card-->
</div><!--end col-->
@else
 
  <div class="col-lg-10 mx-auto">
    <div class="card ">
        <div class="card-body invoice-head pt-0"> 
            <div class="row">
                <div class="col-12 text-center">                                                
                    <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                </div>
            </div>
            <div class="row" style="border: 1px solid #b9b9b9;" >
               
              
                <div class="col-2">
                    <span id="left-header">رقم الملف</span>
                </div>
                <div class="col-8 text-center">
                        
                    <h4> <span id="title-header">تقارير الملفات </span>  </h4>
              
                </div>
                <div class="col-2" id="p-date">
                    <span id="print-date">تاريخ الطباعة</span>
                </div>
            </div> 
          
        </div><!--end card-body-->
        <div class="card-body">
   
            <hr>

            <div class="row">
                
                
                
            </div>

            
            <hr>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                    <div class="text-center text-muted"></div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="float-right d-print-none">
                   <button onclick="printDiv()" class="btn btn-info">
                      <i class="fa fa-print"></i>
                    </button>
                      
                    </div>
                </div>
            </div>
        </div>
    </div><!--end card-->
</div><!--end col-->
@endif


@endsection


@section('page-script')
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script>
    
<script> 
    function printDiv() { 
        document.getElementById("filtter").style.display = "none";
        window.print(); 
        document.getElementById("filtter").style.display = "block";
    } 


    if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "التقارير"; 
document.getElementById("breadcrumb-2").innerHTML = "جدول الجلسات"; 

document.getElementById("page-name").innerHTML = "جدول الجلسات";
document.getElementById("p-date").classList.add('text-left');

    }else{
       document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 
document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "reports";
document.getElementById("breadcrumb-1").innerHTML = "stages schedule";

document.getElementById("page-name").innerHTML = "STAGES SCHEDULE";

document.getElementById("file-number").innerHTML = "File No.";



    document.getElementById("left-header").innerHTML = "File No.";
   
    document.getElementById("title-header").innerHTML = "Files reports";

document.getElementById("print-date").innerHTML = "Print date";
document.getElementById("p-date").classList.add('text-right');

if (document.getElementById("mainCase-number")) {
    document.getElementById("mainCase-number").innerHTML = "Main Case No.";

    
document.getElementById("tbh-2").innerHTML = "Client Name AR";
document.getElementById("tbh-3").innerHTML = "Client Name ENG";

document.getElementById("tbh-4").innerHTML = "Against Name AR";
document.getElementById("tbh-5").innerHTML = "Against Name ENG";
document.getElementById("tbh-6").innerHTML = "Cliam Amount";
document.getElementById("tbh-7").innerHTML = "Register Date";

document.getElementById("tbh-10").innerHTML = "Court";

    document.getElementById("linked-number").innerHTML = "File Cases";
document.getElementById("main-uid").innerHTML = "First Case Number";
document.getElementById("main-decision").innerHTML = "First Case Decision";
document.getElementById("last-decision").innerHTML = "Final Decision"; 

document.getElementById("th-1").innerHTML = "Case Number";
   document.getElementById("th-2").innerHTML = "Case Type";
   document.getElementById("th-3").innerHTML = "Case Stage";
   document.getElementById("th-4").innerHTML = "Registration date";
   document.getElementById("th-6").innerHTML = "Cliam Amount";
   document.getElementById("th-7").innerHTML = "Last Decision";
}



var timestampArray = document.getElementsByClassName("search-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Create Report';
  
}


    }
</script>

@endsection