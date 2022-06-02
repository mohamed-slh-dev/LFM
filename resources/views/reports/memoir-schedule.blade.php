@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('css-link')

<style type="text/css" media="print">
    @page { size: landscape; }
  </style>
    
@endsection

@section('content')

    <div class="col-lg-12" id="filtter">

        <div class="card client-card"> 
            <form class="form"  method="POST" action="{{route('memoir-schedule')}}">
                @csrf                                
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-12">
                    <div class="row">
                  <div class="col-2 ">
                         <div class="form-group row">
                            <label for="example-text-input" class="col-sm-6 col-form-label text-center px-0" id="number"> رقم الدعوى</label>
                           <div class="col-sm-6">
                             <input class="form-control" name="case_uid"  type="text" id="example-text-input">
                           </div>
                       </div>
                </div>
                <div class="col-3 ">

                    <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="from"> تاريخ التنفيذ من</label>
                             <div class="col-sm-8">
                                <input class="form-control" name="date_from"  type="date" id="example-text-input">

                                 </div>
                         </div>
  
                  </div>
                  <div class="col-3 ">

                    <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="to"> تاريخ التنفيذ الى</label>
                             <div class="col-sm-8">
                                <input class="form-control" name="date_to"  type="date" id="example-text-input">

                                 </div>
                         </div>
  
                  </div>

                <div class="col-3 ">

                  <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="type"> نوع المذكرة</label>
                           <div class="col-sm-8">
                            <select class="custom-select" name="type">
                                <option value=" "></option>  
                                @foreach ($type as $t)
                                <option value="{{$t->N_DetailedCode}}">{{$t->S_Desc_A}}</option>  
                                @endforeach 
                            </select>
                         </div>
                       </div>

                </div>

             

            <div class="col-1  text-right">
             <button class="btn btn-success waves-effect waves-light mx-3" id="search-btn"> بحث </button>
            </div>
                </div>
                 </div>
          
                           
                          
                        
                </div>

          </div>
            </form>
       </div>      
  </div>

  @if ($memoir)
      
  <div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body invoice-head pt-0"> 
            <div class="row">
                <div class="col-md-12 text-center">                                                
                    <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                </div>
            </div>
                <div class="row" style="border: 1px solid #b9b9b9;">
                    <div class="col-3">
                        <h6><span id="memoir-number"> عدد المذكرات</span> : {{$memoir->count()}}</h6>
                    </div>
                    <div class="col-6 text-center">
                     
                           

                    </div>
                        <div class="col-3" id="p-date">
                            <h6><span id="print-date">تاريخ الطباعة</span>: {{$print_date}}</h6>
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
                                   
                                   
                              
                                  <th id="tbh-1" style="width: 130px;">رقم الملف</th>
                                        <th id="tbh-2" style="width: 130px;">رقم الدعوى</th>
    
                                        <th id="tbh-3"  style="width: 100px;">نوع الدعوى</th>
                                        <th id="tbh-4" style="width: 100px;">اسم الموكل</th>
                                      
                                        <th id="tbh-5" style="width: 130px;"> صفة الموكل</th>
                                        <th id="tbh-6" style="width: 100px;">اسم الخصم</th>
                                        <th id="tbh-7" style="width: 160px;"> الاجراء المطلوب</th>
                                        <th id="tbh-8"style="width: 180px;">تاريخ تنفيذه</th>
                                        <th id="tbh-9"style="width: 180px;"> المستشار</th>

                            </tr>
                            </thead>
                         
                            
                     
                     

                          
                            <tbody>
                                   
                            @foreach($memoir as $memo )
                           
                            <tr>
                                    <td  style="width: 100px;"> {{$memo->file_num}}</td>
                                    <td  style="width: 100px;"> {{$memo->case_uid}}</td>
                                    <td  style="width: 160px;"> {{$memo->case_type}}</td>
                                    <td  style="width: 160px;"> {{$memo->clientName}}</td>
                                    <td  style="width: 100px;"> {{$memo->clientType}}</td>
                                    <td  style="width: 180px;"> {{$memo->againstName}}</td>
                                    <td  style="width: 100px;"> {{$memo->excute_Name}}</td>
                                    <td  style="width: 100px;"> {{$memo->excute_date}}</td>
                                    <td  style="width: 120px;"> {{$memo->assignTo}}</td>
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
               
              
                <div class="col-2 ">
                    <span id="memoir-number"> عدد الجلسات</span>
                </div>
                <div class="col-8 text-center">
                        
                    <h4 > جدول الجلسات ليوم - 00/0/0000  </h4>
              
                </div>
                <div class="col-2" id="p-date">
                    <h6> <span id="print-date">تاريخ الطباعة</span> : </h6>
                </div>
            </div> 
          
        </div><!--end card-body-->
        <div class="card-body">
   
            <hr>

            <div class="row">
            <div class="col-12">
                
              </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            
                                   
                                    <tr>
                                        <th id="tbh-1" style="width: 130px;">رقم الملف</th>
                                        <th id="tbh-2" style="width: 130px;">رقم الدعوى</th>
    
                                        <th id="tbh-3"  style="width: 100px;">نوع الدعوى</th>
                                        <th id="tbh-4" style="width: 100px;">اسم الموكل</th>
                                      
                                        <th id="tbh-5" style="width: 130px;"> صفة الموكل</th>
                                        <th id="tbh-6" style="width: 100px;">اسم الخصم</th>
                                        <th id="tbh-7" style="width: 160px;"> الاجراء المطلوب</th>
                                        <th id="tbh-8"style="width: 180px;">تاريخ تنفيذه</th>
                                        <th id="tbh-9"style="width: 180px;"> المستشار</th>
                                    </tr>
                                
                            </thead>
                            <tbody>
                                <tr>
                                  
                               
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                          
                         
                           
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
@endif


@endsection


@section('page-script')

<script> 
    function printDiv() { 
        document.getElementById("filtter").style.display = "none";
        window.print(); 
        document.getElementById("filtter").style.display = "block";
    } 
</script>

<script> 
  
    if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "التقارير"; 
document.getElementById("breadcrumb-2").innerHTML = "جدول المذكرات"; 

document.getElementById("page-name").innerHTML = "جدول المذكرات";
document.getElementById("p-date").classList.add('text-left');

    }else{
       document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 
document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "reports";
document.getElementById("breadcrumb-1").innerHTML = "memoir schedule";

document.getElementById("page-name").innerHTML = "MEMOIR SCHEDULE";

document.getElementById("from").innerHTML = "From";
document.getElementById("to").innerHTML = "To";
document.getElementById("number").innerHTML = "Case number";
document.getElementById("type").innerHTML = "Memoir type";

document.getElementById("search-btn").innerHTML = "search";

document.getElementById("tbh-1").innerHTML = "File number";
document.getElementById("tbh-2").innerHTML = "Case number";
document.getElementById("tbh-3").innerHTML = "Case type";
document.getElementById("tbh-4").innerHTML = "Client name";
document.getElementById("tbh-5").innerHTML = "Client adj.";
document.getElementById("tbh-6").innerHTML = "Against name";
document.getElementById("tbh-7").innerHTML = "Action needed";
document.getElementById("tbh-8").innerHTML = "Excute date ";
document.getElementById("tbh-9").innerHTML = "Consultant";


    document.getElementById("memoir-number").innerHTML = "Stages count";

document.getElementById("print-date").innerHTML = "Print date";

document.getElementById("p-date").classList.add('text-right');





    }
</script>

@endsection