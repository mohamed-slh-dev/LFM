@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')

    <div class="col-lg-12" id="filtter">

        <div class="card client-card"> 
            <form class="form"  method="POST" action="{{route('experts-stages')}}">
                @csrf                                
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-12">
                    <div class="row">
                  <div class="col-3 ">
                         <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="from-date"> من التاريخ </label>
                           <div class="col-sm-8">
                             <input class="form-control" name="from_date"  type="date" id="example-text-input">
                           </div>
                       </div>
                </div>
                <div class="col-3 ">
                    <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="to-date"> الى التاريخ </label>
                      <div class="col-sm-8">
                        <input class="form-control" name="to_date"  type="date" id="example-text-input">
                      </div>
                  </div>
           </div>


            <div class="col-1  text-center">
             <button class="btn btn-success waves-effect waves-light mx-3" id="search-btn"> بحث </button>
            </div>
                </div>
                 </div>
          
                           
                          
                        
                </div>

          </div>
            </form>
       </div>      
  </div>
      
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
                        <h6> <span id="stages-number"> عدد الجلسات</span> : {{$stages->count()}}</h6>
                    </div>
                    <div class="col-6 text-center">
                     
                            <h4   style="" > <span id="from"> جدول الجلسات من تاريخ  </span> -  {{$from_date}} <br>
                                 <span id="to"> الى تاريخ  </span> - {{$to_date}}  </h4>

                    </div>
                        <div class="col-3 " id="p-date">
                            <h6> <span id="print-date">تاريخ الطباعة</span>  : {{$print_date}}</h6>
                            </div>   
                     
                    </div>
         
        </div><!--end card-body-->
        <div class="card-body">
   
            <hr>

            <div class="row">
          
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" >
                            <thead>
                                <tr>
                                    
                                    <th id="tbh-1" style="width: 125px;">رقم الملف</th>
                                    <th id="tbh-2" style="width: 135px;">رقم القضية</th>
                                    <th id="tbh-3" style="width: 95px;">نوع الدعوى</th>
                                    <th id="tbh-4" style="width: 135px;">رقم الدعوى</th>
                                    <th id="tbh-5"  style="width: 100px;">اسم الموكل</th>
                                  
                                    <th  id="tbh-5" style="width: 130px;"> صفة الموكل</th>
                                    <th  id="tbh-6" style="width: 130px;">اسم الخصم</th>
                                    <th id="tbh-7"  style="width: 150px;"> تاريخ   الجلسة</th>
                                    <th id="tbh-9"  style="width: 150px;"> تاريخ   الجلسة القادمة</th>
                                    <th id="tbh-8" style="width: 180px;"> قرار  الجلسة</th>
                            </tr>
                            </thead>
                         

                        <tbody>
                                   
                            @foreach($stages as $stage )
                           
                            <tr>
                               
                                    <td  style="width: 130px;"> {{$stage->file_num}}</td>
                                    <td  style="width: 140px;"> {{$stage->main_case_id}}</td>
                                    <td  style="width: 100px;"> {{$stage->caseType}}</td>
                                    <td  style="width: 140px;"> {{$stage->case_id}}</td>
                                    <td  style="width: 100px;"> {{$stage->clientName}}</td>
                                    <td  style="width: 130px;"> {{$stage->clientType}}</td>
                                    <td  style="width: 130px;"> {{$stage->againstName}}</td>
                                    <td  style="width: 150px;"> {{$stage->DT_HearingEnterDate}}</td>
                                    <td  style="width: 150px;"> {{$stage->DT_HEARING_DATE}}</td>
                                    <td  style="width: 180px;"> {{$stage->S_HEARING_DESIGION}}</td>
                                </tr>
                          
                                @endforeach
                            </tbody>
                        </table>
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



@endsection


@section('page-script')
    
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
document.getElementById("breadcrumb-2").innerHTML = "جدول جلسات الخبرة"; 

document.getElementById("page-name").innerHTML = "جدول جلسات الخبرة";
document.getElementById("p-date").classList.add('text-left');

    }else{
       document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 
document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "reports";
document.getElementById("breadcrumb-1").innerHTML = "expert hearings report";

document.getElementById("page-name").innerHTML = "EXPERT HEARING REPORT";

document.getElementById("from-date").innerHTML = "From Date";
document.getElementById("to-date").innerHTML = "To Date";


document.getElementById("search-btn").innerHTML = "search";

document.getElementById("tbh-1").innerHTML = "File number";
document.getElementById("tbh-2").innerHTML = "Main case number";
document.getElementById("tbh-3").innerHTML = "Case type";
document.getElementById("tbh-4").innerHTML = "Case number";
document.getElementById("tbh-5").innerHTML = "Client adj.";
document.getElementById("tbh-6").innerHTML = "Against name";
document.getElementById("tbh-7").innerHTML = "Last hearing date";
document.getElementById("tbh-8").innerHTML = "Last hearing decission";
document.getElementById("tbh-9").innerHTML = "Neax hearing date";


    document.getElementById("stages-number").innerHTML = "Stages count";
document.getElementById("from").innerHTML = "Stages schedule from date";
document.getElementById("to").innerHTML = "to";
document.getElementById("print-date").innerHTML = "Print date";

document.getElementById("p-date").classList.add('text-right');




    }
</script>

@endsection