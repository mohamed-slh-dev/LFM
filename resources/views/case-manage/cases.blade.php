@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')
<div class="row">
                    
    <div class="col-lg-12 col-xl-6">
       <div class="row">
           <div class="col-lg-4">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                          
                           <div class="col-8 align-self-center">
                               <div class="ml-2">
                                   <p class="mb-1 text-muted" id="all-cases"> </p>
                                   <h4 class="mt-0 mb-1 text-success">{{$cases_count}}</h4>                                                         
                               </div>
                           </div> 
                           <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder-open text-success"></i>
                            </div> 
                        </div>                   
                       </div>
                       <div class="progress mt-2" style="height:3px;">
                           <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->

           

           


       </div><!--end row-->  
   </div> <!-- end col -->


    <div class="col-lg-6">
       <div class="card">
           <div class="card-body">        
               <h4 class="mt-0 header-title" id="chart-title"></h4>
            <p class="text-muted mb-3 d-inline-block text-truncate w-100" id="chart-desc">
               </p>
               {{-- <div id="donut-chart">
                   <div id="donut-chart-container" class="flot-chart" style="height: 320px">
                   </div>
               </div> --}}
           </div><!--end card-body-->
       </div><!--end card-->
   </div> <!-- end col -->
</div>

<div class="row">
                     
   


     <div class="col-lg-12">
        <div class="card client-card">
            <div class="col-lg-12 ">
                <div class="">
                    <ul class="list-inline mt-3 pr-0 mr-1 mb-0">                                    
                       
                       @if ($add_case == 'true')
                           <li class="list-inline-item">
       
                        <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-stage-btn"></button>
                        </li>
                      
                       @endif
                        
                    </ul>
                </div>                            
            </div><!--end col-->  
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
 </div><!--end row-->
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
 <div class="float-left mt-4">
    {{ $cases->links() }}
    
    </div>   


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-case-details')}}">
                    @csrf
              <div class="row">
                
        
                  <div class="col-12"> 
                      <div class="form-group row">
                               
                                 <div class="col-sm-4">
                                    <label id="stage-number"></label>
                                    <input class="form-control" name="case_uid" type="text" id="example-text-input">
                                </div>
                                
                                <div class="col-sm-4">
                                    <label id="stage-file-number"></label>
                                   <select class="custom-select" name="file_id">
                                    @foreach ($files as $file)
                                    <option value="{{$file->file_id}}">{{$file->file_id}}</option>
                                      @endforeach
                                       
                                   </select>
                                </div>

                                 <div class="col-sm-4">
                                    <label id="stage-case-number"></label>
                                   <select class="custom-select" name="main_case_id">
                                    @foreach ($main_cases as $mc)
                                    <option value="{{$mc->N_CASE_ID}}">{{$mc->N_CASE_ID}}</option>
                                      @endforeach  
                                   </select>
                                                          
                                  </div>
                               
                             

                            </div>
          
                 </div>

                 <div class="col-12 mb-2"> 
                    <div class="form-group row">
                             
                               <div class="col-sm-4">
                                <label id="stage-request-number"></label>
                                <input class="form-control" name="request_number" type="text" id="example-text-input">
                              </div>
                              
                              <div class="col-sm-4">
                                <label id="stage-request-date"></label>
                                <input class="form-control" name="request_date"  type="date"  id="example-text-input">

                              </div>
                      </div>
        
               </div>
                   <div class="col-12"> 
                      <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="stage-client-type"></label>
                            <select class="custom-select" name="client_type">
                                 @foreach ($client_type as $c_type)
                                 <option value="{{$c_type->N_DetailedCode}}">{{$c_type->S_Desc_A}}</option>  
                                 @endforeach
                                 
                             </select>
                         </div>

                                <div class="col-sm-4">
                                    <label id="stage-stage"></label>
                                      <select class="custom-select" name="case_stage">
                                        @foreach ($case_stage as $case_stage)
                                        <option value="{{$case_stage->N_DetailedCode}}">{{$case_stage->S_Desc_A}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                </div>
                                  <div class="col-sm-4">
                                    <label id="stage-type"></label>
                                      <select class="custom-select" name="case_type">
                                        @foreach ($case_type as $case_type)
                                        <option value="{{$case_type->N_DetailedCode}}">{{$case_type->S_Desc_A}}</option>  
                                        @endforeach
                                        
                                    </select>
                                </div>

                              
                               
                               

                            </div>
          
                 </div>

                 <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-sm-4">
                            <label id="stage-admin"></label>
                            <select class="custom-select" name="lawyer_1">
                                      @foreach ($users as $user)
                                      <option value="{{$user->id}}">{{$user->name}}</option>  
                                      @endforeach 
                                      
                                  </select>
                              </div>

                         

                              <div class="col-sm-4">
                                <label id="stage-consult"></label>
                                <select class="custom-select" name="lawyer_2">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                    
                                </select>                               </div>
                               <div class="col-sm-4">
                                <label id="stage-lawyer"></label>
                                <select class="custom-select" name="lawyer_3">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                    
                                </select>
                            </div>
                     </div>
                  </div>
                 
              <div class="col-12"> 
                      <div class="form-group row">
                               
                          <div class="col-sm-6">
                            <label id="stage-court"></label>
                            <select class="custom-select" name="court">
                                        @foreach ($court as $court)
                                        <option value="{{$court->N_DetailedCode}}">{{$court->S_Desc_A}}</option>  
                                        @endforeach 
                                    </select>
                                </div>

                           <div class="col-sm-6">
                            <label id="stage-dept"></label>
                            <select class="custom-select" name="dept">
                                        @foreach ($depts as $dept)
                                        <option value="{{$dept->N_DetailedCode}}">{{$dept->S_Desc_A}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                </div>
                                
                            </div>
          
                 </div>
                 
                
                   

                 <div class="col-12"> 
                      <div class="form-group row">
                               
                          <div class="col-sm-6">
                            <label id="stage-expert"></label>
                            <select class="custom-select" name="expert_office">
                                        @foreach ($experts as $expert)
                                        <option value="{{$expert->N_Expert_ID}}">{{$expert->S_Expert_AR_NAME}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                </div>

                           

                                <div class="col-sm-6">
                                    <label id="stage-fees"></label>
                                       <input class="form-control fraction-commas" name="fee" type="text">
                                 </div>
                       </div>
                                
                                

                            </div>
          
                 </div>
                 <div class="col-12"> 
                    <label id="stage-info"></label>
                    <textarea class="form-control" name="more_info" rows="5" id="message"></textarea>
                    </div>

                     <div class="col-12 mt-3"> 
                      <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="add-new-stage-btn"></button>
                     </div> 
                  
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


@endsection


@section('page-script')

<script>
    $('.fraction-commas').keyup(function() {
    
    
    //get the id number of button || remove all non=numeric things
    var value = $(this).val();
    value = value.replace(/\D/g,'');
    
    // put commas back again
    var commas = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    
    //copy the new val
    $(this).val(commas);
    
    });
    </script>

<script>
        if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = " الدعاوى"; 

    document.getElementById("page-name").innerHTML = " الدعاوى";

    document.getElementById("all-cases").innerHTML = "عدد الدعاوى الكلي ";
 
    
    document.getElementById("chart-title").innerHTML = "أنواع الدعاوى ";
    document.getElementById("chart-desc").innerHTML = "رسم توضيحي لانواع الدعاوى ";

if ( document.getElementById("add-stage-btn")) {
    document.getElementById("add-stage-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة مرحلة';
}


    document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-court").innerHTML = "المحكمة ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";

    document.getElementById("stage-number").innerHTML = "رقم الدعوى ";
    document.getElementById("stage-file-number").innerHTML = "رقم الملف ";
    document.getElementById("stage-case-number").innerHTML = "رقم القضية ";
    document.getElementById("stage-request-number").innerHTML = "رقم الطلب الالكتروني ";
    document.getElementById("stage-request-date").innerHTML = "تاريخ الطلب الالكتروني ";
    document.getElementById("stage-client-type").innerHTML = "صفة الموكل ";
    document.getElementById("stage-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("stage-type").innerHTML = "نوع الدعوى ";
    document.getElementById("stage-admin").innerHTML = "المكلف الاداري ";
    document.getElementById("stage-consult").innerHTML = "المستشار ";
    document.getElementById("stage-lawyer").innerHTML = "المحامي المترافع ";
    document.getElementById("stage-court").innerHTML = "المحكمة ";
    document.getElementById("stage-dept").innerHTML = "الدائرة ";
    document.getElementById("stage-expert").innerHTML = "مكتب الخبراء ";
    document.getElementById("stage-fees").innerHTML = "رسوم الدعوى ";
    document.getElementById("stage-info").innerHTML = "معلومات الدعوى ";
    document.getElementById("add-new-stage-btn").innerHTML = "اضافة دعوى ";

 

        }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "cases manage";
    document.getElementById("breadcrumb-1").innerHTML = " cases ";

    document.getElementById("page-name").innerHTML = " CASES";

    
    document.getElementById("all-cases").innerHTML = "All cases ";
 

    document.getElementById("chart-title").innerHTML = "Cases type";
    document.getElementById("chart-desc").innerHTML = "Cases type diagram ";

    if ( document.getElementById("add-stage-btn")) {
    document.getElementById("add-stage-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add stage';
}
    document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-court").innerHTML = "Case court ";
    document.getElementById("cases-search-btn").innerHTML = "search ";

    document.getElementById("stage-number").innerHTML = "Stage number ";
    document.getElementById("stage-file-number").innerHTML = "File number";
    document.getElementById("stage-case-number").innerHTML = "Case number ";
    document.getElementById("stage-request-number").innerHTML = "Online request number ";
    document.getElementById("stage-request-date").innerHTML = "Online request date ";
    document.getElementById("stage-client-type").innerHTML = "Client adjective ";
    document.getElementById("stage-stage").innerHTML = "Stage level ";
    document.getElementById("stage-type").innerHTML = "Stage type ";
    document.getElementById("stage-admin").innerHTML = "Adminstrative charge ";
    document.getElementById("stage-consult").innerHTML = "Consultant ";
    document.getElementById("stage-lawyer").innerHTML = "Lawyer ";
    document.getElementById("stage-court").innerHTML = "Court ";
    document.getElementById("stage-dept").innerHTML = "Departments of jurisdiction  ";
    document.getElementById("stage-expert").innerHTML = "Expert office";
    document.getElementById("stage-fees").innerHTML = "Stage fees ";
    document.getElementById("stage-info").innerHTML = "Stage info. ";
    document.getElementById("add-new-stage-btn").innerHTML = "Add stage ";
    
        }
</script>
    
@endsection