@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card client-card">  
          <form class="form"  method="POST" action="{{route('search-cases')}}">
              @csrf                               
           <div class="card-body text-center" >
            <div class="row">
            <div class="col-12">
               <div class="row">
              
               <div class="col-2 pl-0">
                  <div class="form-group row">
                   <label for="example-text-input" class="col-6 col-form-label text-center" id="cases-search-num"></label>
                   <div class="col-6">
                       <input class="form-control pl-0 font-11"  name="case_num" type="text" id="example-text-input">
                   </div>
                  </div>
                   
                         
           </div>
           
             <div class="col-3 ">
                       <div class="form-group row">
                           <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="cases-search-type"> </label>
                           <div class="col-sm-8">
                        <select class="custom-select text-right" name="type">
                         <option value="all"></option>
                         @foreach ($case_type as $case_type_filter)
                         <option value="{{$case_type_filter->N_DetailedCode}}">{{$case_type_filter->S_Desc_A}}</option>  
                         @endforeach
                              
                          </select>
                      </div>
                  </div>
                         
           </div>

           
           <div class="col-3 ">
               <div class="form-group row">
                   <label for="example-text-input" class="col-sm-5 col-form-label text-center" id="cases-search-stage"></label>
                   <div class="col-sm-7">
                  <select class="custom-select text-right" name="stage">
                   <option value="all"></option>
                   @foreach ($case_stage as $case_stage_filter)
                   <option value="{{$case_stage_filter->N_DetailedCode}}">{{$case_stage_filter->S_Desc_A}}</option>  
                   @endforeach
                        
                    </select>
                </div>
            </div>
                   
     </div>
     
           <div class="col-3 ">
               <div class="form-group row">
                   <label for="example-text-input" class="col-sm-5 col-form-label text-center" id="cases-search-court"></label>
                   <div class="col-sm-7">
                  <select class="custom-select text-right" name="court">
                   <option value="all"></option>
                   @foreach ($court as $court_filter)
                   <option value="{{$court_filter->N_DetailedCode}}">{{$court_filter->S_Desc_A}}</option>  
                   @endforeach
                        
                    </select>
                </div>
            </div>
                   
     </div>

       <div class="col-1  text-center">
           <button class="btn btn-success waves-effect waves-light mr-3" id="cases-search-btn"> </button>
       </div>
           </div>
            </div>
            
                     
                   
           </div>

     </div>
          </form>
       </div>      
  </div>   
</div>

<div class="row">

  
    @foreach ($cases as $case)
   
    <div class="col-lg-6">
        <div class="card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">
               <div class="card-body"> 
                @if (Session::get('lang') == "ar")
                      <div class="task-box">
                        <a href="{{url('main-case-cases/'.$case->N_CASE_ID)}}"  class=" float-left">
                           <button class="btn-sm btn-outline-dark btn-round">
                               <span>عرض القضية :   </span>
                               <span class="" style=" font-weight: bold; ">  {{$case->N_CASE_ID}} </span>  
                           </button>
                        </a>
                       
                       
                      
                           <h5 class="mt-0" style="font-weight: bold;"> - {{$case->S_CASE_UID}} </h5>
       
                      
                       <p class="text-muted mb-1">
                       -  {{$case->S_SUMMARY}}  
                        </p>
                        <div style="display: block ruby;" class="mt-4">
                             <p class=" text-left mb-1" style="float: left;"> مرحلة الدعوى :  {{$case->stageName}} </p>
                           <p class=" text-right mb-1">  نوع الدعوى : {{$case->typeName}} </p>
                        </div>
                          
       
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                        <a href="{{url('case-details/'.$case->N_CASE_DETAILS_ID)}}">
                          <button class="btn btn-outline-dark waves-effect waves-light">البيانات</button></a> 
                          
                          <a href="{{url('case-memoir/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المذكرات</button></a>

                          <a href="{{url('case-stages/'.$case->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >الجلسات</button></a>
       
       
                              <a href="{{url('case-tasks/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المهام</button></a>
       
                            <a href="{{url('case-documents/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >المستندات</button></a>
                       
                        </div>                                        
                    </div><!--end task-box--> 
                   @else
                     <div class="task-box">
                        <a href="{{url('main-case-cases/'.$case->N_CASE_ID)}}"  class=" float-right">
                           <button class="btn-sm btn-outline-dark btn-round">
                               <span>view case :   </span>
                               <span class="" style=" font-weight: bold; ">  {{$case->N_CASE_ID}} </span>  
                           </button>
                        </a>
                       
                       
                      
                           <h5 class="mt-0" style="font-weight: bold;"> - {{$case->S_CASE_UID}} </h5>
       
                      
                       <p class="text-muted mb-1">
                       -  {{$case->S_SUMMARY}}  
                        </p>
                        <div style="display: block ruby;" class="mt-4">
                             <p class=" mb-1" style="float: right;">  Case stage :  {{$case->stageName}} </p>
                           <p class=" mb-1"> Case type : {{$case->typeName}} </p>
                        </div>
                          
       
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                        <a href="{{url('case-details/'.$case->N_CASE_DETAILS_ID)}}">
                          <button class="btn btn-outline-dark waves-effect waves-light">DETAILS</button></a> 
                          <a href="{{url('case-memoir/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >MEMOIR</button></a>

                          
                          <a href="{{url('case-stages/'.$case->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >HEARINGS</button></a>
       
       
                              <a href="{{url('case-tasks/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >TASKS</button></a>
       
                            <a href="{{url('case-documents/'.$case->N_CASE_DETAILS_ID,$case->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >DOCUMENTS</button></a>
                       
                        </div>                                        
                    </div><!--end task-box-->  
                   @endif                                   
                   
               </div><!--end card-body-->
           </div><!--end card-->
       </div><!--end col-->
    @endforeach
</div><!--end row-->
    
@endsection

@section('page-script')
<script>
        if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "البحث"; 
    document.getElementById("breadcrumb-2").innerHTML = "بحث الدعاوى"; 

    document.getElementById("page-name").innerHTML = "بحث الدعاوى";

    document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-court").innerHTML = "المحكمة ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";

        }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "search";
    document.getElementById("breadcrumb-1").innerHTML = " cases search";

    document.getElementById("page-name").innerHTML = " CASES SEARCH";

    
    document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-court").innerHTML = "Case court ";
    document.getElementById("cases-search-btn").innerHTML = "search ";
        }
</script>
    
@endsection