@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('content')
<div class="row">

    @if ($cases_count > 0)
      
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
                          <h6> <span id="stages-count">  عدد الجلسات : </span> {{$cases_count}}</h6>
                      </div>
                      <div class="col-6 text-center">
                       
                              <h4   style="" id="case-stages">  جلسات القضية </h4>
  
                      </div>
                          <div class="col-3">
                              <h6> <span id="print-date"> تاريخ الطباعة :</span> {{$print_date}}</h6>
                              </div>   
                       
                      </div>
           
          </div><!--end card-body-->
          <div class="card-body">
     
              <hr>
  
              <div class="row">
            
                  <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th id="th-1" style="width: 80px;">رقم الدعوى</th>
                            <th id="th-2" style="width: 80px;">نوع الدعوى</th>
                            <th id="th-3" style="width: 80px;">مرحلة الدعوى</th>
                            <th id="th-4" style="width: 130px;"> تاريخ التسجيل</th>
                            <th id="th-5" style="width: 240px;"> الخصم</th>
                            <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                            <th id="th-7" style="width: 90px;"> اخر قرار في الدعوى</th>
                    </tr>
                    </thead>
                 
                    <tbody>
                           
                      
                        @for ($i = 0; $i < count($case_array); $i++)
                       
                
                        <tr>
                           
                            <td  style="width: 100px;"> {{$case_array[$i]->S_CASE_UID}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->caseType}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->caseStage}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->register_date}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->againstName}}</td>
                                <td  style="width: 130px;"> {{$case_array[$i]->cliam_amount}}</td>
                                <td  style="width: 130px;"> {{$decission_array[$i]}}</td>
                            
                            </tr>
                            @endfor
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
                        
                          <a href="#" class="btn btn-danger">الغاء</a>
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
                 
                
                  <div class="col-2 text-right">
                      <h6><span id="stages-count">  عدد الجلسات : </span>  </h6>
                  </div>
                  <div class="col-8 text-center">
                          
                    <h4 style="" id="case-stages">  جلسات القضية </h4>
                
                  </div>
                  <div class="col-2 text-left">
                      <h6> <span id="print-date"> تاريخ الطباعة :</span> </h6>
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
                        <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th id="th-1" style="width: 80px;">رقم الدعوى</th>
                            <th id="th-2" style="width: 80px;">نوع الدعوى</th>
                            <th id="th-3" style="width: 80px;">مرحلة الدعوى</th>
                            <th id="th-4" style="width: 130px;"> تاريخ التسجيل</th>
                            <th id="th-5" style="width: 240px;"> الخصم</th>
                            <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                            <th id="th-7" style="width: 90px;"> اخر قرار في الدعوى</th>
                    </tr>
                    </thead>
                 
                    <tbody>
                           
                      
                        @for ($i = 0; $i < count($case_array); $i++)
                       
                
                        <tr>
                           
                            <td  style="width: 100px;"> {{$case_array[$i]->S_CASE_UID}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->caseType}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->caseStage}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->register_date}}</td>
                                <td  style="width: 100px;"> {{$case_array[$i]->againstName}}</td>
                                <td  style="width: 130px;"> {{$case_array[$i]->cliam_amount}}</td>
                                <td  style="width: 130px;"> {{$decission_array[$i]}}</td>
                                <td style="width: 130px;">
                                    <a href="{{url('client-case-documents/'.$case_array[$i]->N_CASE_DETAILS_ID,$case_array[$i]->N_CASE_ID)}}">
                                        <button class="btn-sm btn-outline-dark waves-effect waves-light" >عرض مستندات الدعوى</button>
                                    </a>
        
                                </td>
                            </tr>
                            @endfor
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
                        
                          <a href="#" class="btn btn-danger">الغاء</a>
                      </div>
                  </div>
              </div>
          </div>
      </div><!--end card-->
  </div><!--end col-->
  @endif
  
  <script> 
      function printDiv() {    
          window.print(); 
      } 
  </script>

</div>
    
@endsection


@section('page-script')

<script>
    if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = 'الملفات' ;
    document.getElementById("breadcrumb-3").innerHTML = "مستندات الدعوى"; 

    document.getElementById("page-name").innerHTML = "مستندات الدعوى";
    


    document.getElementById("print-date").classList.add('text-left');





    }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'files' ;
    document.getElementById("breadcrumb-1").innerHTML = "case documents" ;

    document.getElementById("page-name").innerHTML = "CASE DOCUMENTS";

    document.getElementById("stages-count").innerHTML = "Hearings Number";
    document.getElementById("case-stages").innerHTML = "Case hearings";
    document.getElementById("print-date").innerHTML = "Print Date";
    document.getElementById("print-date").classList.add('text-right');

    document.getElementById("th-1").innerHTML = "Case Number";
    document.getElementById("th-2").innerHTML = "Case Type ";
    document.getElementById("th-3").innerHTML = "Case Stage ";
    document.getElementById("th-4").innerHTML = "Registration Date ";
    document.getElementById("th-5").innerHTML = "Against ";
    document.getElementById("th-6").innerHTML = "Cliam Amount ";
    document.getElementById("th-7").innerHTML = "Last Case Decision ";

    
 

    }
</script>
    
@endsection