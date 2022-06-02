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
                    
    <div class="col-lg-12 col-xl-6">
       <div class="row">
        

           <div class="col-lg-4">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                          
                           <div class="col-8 align-self-center">
                               <div class="ml-2">
                                   <p class="mb-1 text-muted" id="file-number-box"> </p>
                                   <h4 class="mt-0 mb-1 text-warning"> {{$file_id}} </h4>                                                         
                               </div>
                           </div>  
                           <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder text-warning"></i>
                            </div> 
                        </div>                  
                       </div>
                       
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->

           <div class="col-lg-4">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                         
                           <div class="col-8 align-self-center">
                               <div class="ml-2">
                                   <p class="mb-1 text-muted" id="case-number-box"> </p>
                                   <h4 class="mt-0 mb-1 text-primary"> {{$main_case_id}} </h4>                                                         
                               </div>
                           </div>
                           
                           <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder text-primary"></i>
                            </div> 
                        </div>
                       </div>
                       
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
           <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                      
                        <div class="col-8 align-self-center">
                            <div class="ml-2">
                                <p class="mb-1 text-muted" id="stages-number-box"></p>
                                <h4 class="mt-0 mb-1 text-success">{{$cases->count()}}</h4>                                                         
                            </div>
                        </div> 
                        
                        <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder-open text-success"></i>
                            </div> 
                        </div>
                    </div>
                   
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->


       </div><!--end row-->  
   </div> <!-- end col -->
   
   <div class="col-12 p-0">
    <div class="col-12 px-0">
    <div class="card">
        <div class="card-body pb-0">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-toggle="tab" id="details-tap" href="#details-1" role="tab"></a>
                </li>
                
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-toggle="tab" id="hearings-tap" href="#stages-1" role="tab"></a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-toggle="tab" id="tasks-tap" href="#tasks-1" role="tab"> </a>
                </li>
               
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-toggle="tab" id="docs-tap" href="#docs-1" role="tab"></a>
                </li>
               
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="details-1" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12 p-0">
                            <div class="card" style="">
                                <form class="form"  >
                                    @csrf
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            @if (Session::get('lang') == "ar")
                                            @if ($main_case_show == 1)
                                            <button disabled class="btn-lg btn-info">القضية الاساس</button>
                                            @else
                                            <button disabled class="btn-lg btn-info">دعوى مرتبطة</button>
                                            @endif

                                           
                                            <br>
                                            <button disabled class="btn btn-outline-dark mt-2">ملف الدعوى</button>
                    
                                            @else
                                            @if ($main_case_show == 1)
                                            <button disabled class="btn-lg btn-info">Main case </button>
                                            @else
                                            <button disabled class="btn-lg btn-info">Linked case</button>
                                            @endif

                                           
                                            <br>
                                            <button disabled class="btn btn-outline-dark mt-2">Case details</button>
                     
                                            @endif
                                           
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-12"> 
                                            <div class="form-group row">
                                                <div class="col-2"> 
                                                    <label id="stage-request-number"></label>
                                                    <input type="text" disabled name="request_number" value="{{$case_details->request_number}}" class="form-control" id="">
                                                </div>
                                                <div class="col-2"> 
                                                    <label id="stage-request-date"></label>
                                                    <input type="date" disabled name="request_date" value="{{$case_details->request_date}}" class="form-control" id="">
                                                </div>
                                        </div>              
                                    </div>
                                   
                                        <div class="col-12"> 
                                            <div class="form-group row">
                                                     
                                                <div class="col-4">
                                                    <label id="stage-number"></label>
                                                    <input  type="hidden" disabled value="{{$case_details->N_CASE_ID}}" name="main_case_id"  type="text" >
                    
                                                <input type="text" disabled name="case_uid" value="{{$case_details->S_CASE_UID}}" class="form-control" id="">
                                                  </div>
                                                  <div class="col-4">
                                                    <label id="stage-type"></label>
                                                    <select class="custom-select" name="case_type" >
                                                        <option value="{{$case_details->typeCode}}">{{$case_details->typeName}}</option>
                                                      
                                                    </select>                         
                                                       </div>
                                                
                                                  <div class="col-4">
                                                    <label id="stage-stage"></label>
                                                    <select class="custom-select" name="case_stage" >
                                                        <option value="{{$case_details->stageCode}}">{{$case_details->stageName}}</option>
                                                      
                                                      </select>
                                                  </div>
                                                  
                                                </div>
                                        </div> 
                                        <div class="col-12"> 
                                            <div class="form-group row">
                        
                                                <div class="col-sm-4">
                                                    <label id="stage-client-type"></label>
                                                    <select class="custom-select" name="client_type" >
                                                        <option value="{{$case_details->clientTypeCode}}">{{$case_details->clientTypeName}}</option>
                                                      
                                                        
                                                       </select>
                                                        
                                                   </div>
                                                <div class="col-sm-4">
                                                    <label id="stage-court"></label>
                                                    <select class="custom-select" name="court" >
                                                            <option value="{{$case_details->courtCode}}">{{$case_details->courtName}}</option>
                                                          
                                                            
                                                        </select>
                                                      </div>
                        
                                                 <div class="col-sm-4">
                                                    <label id="stage-dept"></label>
                                                    <select class="custom-select" name="dept" >
                                                            <option value="{{$case_details->deptCode}}">{{$case_details->deptName}}</option>
                                                          
                                                            
                                                        </select>
                                                      </div>
                                                              
                                         
                                                       
                                                      
                        
                                                  </div>
                                
                                       </div>
                    
                                        <div class="col-12"> 
                                            <div class="form-group row">
                                               <div class="col-12">
                                                <label id="stage-info"></label>
                                                <textarea class="form-control" disabled  name="subject"  id="message">
                                                        {{$case_details->S_SUMMARY}}
                                                      </textarea>             
                                             </div>
                                        </div>              
                                    </div>
                                   
                    
                                   <div class="col-12"> 
                                    <div class="form-group row">
                                             
                                        <div class="col-sm-4">
                                            <label id="stage-expert"></label>
                                            <select class="custom-select" name="expert">
                                                    <option value="{{$case_details->expertId}}">{{$case_details->expertName}}</option>
                                                    
                                                 </select>
                                              </div>
                    
                                         <div class="col-sm-4">
                                                <label id="case-cliam"> </label>
                                         <input class="form-control" placeholder="{{number_format($main_case_payment,2)}}" disabled type="text" id="example-text-input">
                                         </div>
                                         <div class="col-sm-4">
                                            <label id="stage-fees"></label>
                                            <input class="form-control" disabled name="court_fees" value="{{$case_details->S_COURT_FEES}}" type="text" id="example-text-input">
                                        </div>
                                              
                                      
                    
                                          </div>
                        
                               </div>
                    
                               <div class="col-12"> 
                                <div class="form-group row">
                                   <div class="col-6">
                                        <label style="font-weight: bold;" id="client-name"> </label>
                                   <input type="text" name="" disabled placeholder="{{$client_name}}" class="form-control" id="">
                                    </div>
                                    <div class="col-6">
                                        <label style="font-weight: bold;" id="against-name"> </label>
                                        <ul>
                                            @foreach ($againsts as $against)
                                            <li>
                                                {{$against->S_AGAINST_AR_NAME}} 
                                             
                                             </li>
                                            @endforeach
                                        </ul>
                                                </div>
                            </div>              
                        </div>
                    
                                   
                                <div class="col-12"> 
                                    <div class="form-group row">
                                       <div class="col-3">
                                            <label style="font-weight: bold;" id="main-case-id">   </label><br>
                                       <a href="javascript:void(0);">
                                                {{$first_case_details->S_CASE_UID}}
                                            </a>
                                          
                                        </div>
                                        <div class="col-9">
                                            <label style="font-weight: bold;" id="main-case-decission">  </label>
                                            <textarea class="form-control" disabled  id="message">
                                                @if ($first_case_stage)
                                                {{$first_case_stage->S_HEARING_DESIGION}}
                                                @endif
                                              </textarea> 
                                        </div>
                                </div>              
                            </div>
                    
                            
                    
                        <div class="col-12"> 
                            <div class="form-group row">
                               <div class="col-4">
                                    <label style="font-weight: bold;" id="register-date">تاريخ التسجيل</label>
                               <input type="date" disabled  value="{{$main_case_register_date}}" name="rigster_case_date" class="form-control" id="">
                                </div>
                                <div class="col-4">
                                    <label style="font-weight: bold;" id="first-stage-date">تاريخ اول جلسة</label>
                                    <input type="date" disabled  class="form-control" 
                                  @if ($first_case_stage)
                                  value="{{$first_case_stage->DT_HearingEnterDate}}"
                                  @endif
                                      id="">
                                </div>
                                <div class="col-4">
                                    <label style="font-weight: bold;" id="next-stage-date">تاريخ  الجلسة القادمة</label>
                                <input type="date"
                                @if ($last_case_stage)
                                 value="{{$last_case_stage->DT_HEARING_DATE}}"
                                 @endif
                                  disabled class="form-control" id="">
                                </div>
                        </div>              
                    </div>
                    <div class="col-12"> 
                        <div class="form-group row">
                           <div class="col-8">
                                <label style="font-weight: bold;" id="last-stage-decission">  اخر قرار علي الدعوى</label>
                                <textarea class="form-control" disabled  id="message">
                                    @if ($last_case_stage)
                                    {{$last_case_stage->S_HEARING_DESIGION}}
                                    @endif
                                  </textarea> 
                            </div>
                            <div class="col-4">
                                <label style="font-weight: bold;" id="last-decission-date">تاريخ اخر قرار</label>
                                <input type="date" disabled 
                                @if ($last_case_stage)
                                 value="{{$last_case_stage->DT_HearingEnterDate}}"
                                 @endif 
                                  class="form-control" id="">
                            </div>
                    </div>              
                    </div>
                    <div class="col-12"> 
                        <hr>
                        <div class="form-group row">
                                 
                            <div class="col-sm-4">
                                <label id="stage-admin"></label>
                                <select class="custom-select" name="lawyer_1" >
                                        <option value="{{$case_details->id_1}}">{{$case_details->name_1}}</option>
                                       
                                        
                                    </select>
                                  </div>
                    
                             <div class="col-sm-4">
                                <label id="stage-consult"></label>
                                     <select class="custom-select" name="lawyer_2" >
                                        <option value="{{$case_details->id_2}}">{{$case_details->name_2}}</option>
                                       
                                        
                                    </select>
                                  </div>
                                    <div class="col-sm-4">
                                        <label id="stage-lawyer"></label>
                                        <select class="custom-select" name="lawyer_3" >
                                        <option value="{{$case_details->id_3}}">{{$case_details->name_3}}</option>
                                      
                                        
                                    </select>       
                               </div>
                                  
                    
                              </div>
                    
                        </div>
                              
                    
                                    </div>
                                </div><!--end card-body-->
                                    </form>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div>
                </div>

                

                


                <div class="tab-pane p-3" id="stages-1" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">
             
             
                                    </li>
                                </ul>
                            </div>                            
                        </div><!--end col-->
                        @foreach ($case_stages as $case_stagee)
               
                        <div class="col-lg-4">
                            <div class="card ico-card">                                
                                <div class="card-body">
                                    <span class="badge badge-soft-success font-12" id="badge">
                                     {{$case_stagee->N_Reviewed}}
                                    </span>
                                    <div class="media">
                                     <img src="{{asset('assets/images/hammer.png')}}" class="mx-3 thumb-md" alt="...">
                                        <div class="media-body align-self-center">                                                                                                                       
                                            <h5 class="mb-4 font-16 "> {{$case_stagee->typeName}}</h5>
                                            <p class=" mb-4"> 
                                             {{$case_stagee->S_HEARING_DESIGION}}
                                            </p>
             
                                            @if (Session::get('lang') == "ar")
                                            <div class="row">
                                                
                                             <div class="col-md-5">                                                    
                                                 <p class=" mb-4 text-muted"> تاريخ الجلسة : <br>
                                                  <span>{{$case_stagee->DT_HearingEnterDate }}</span></p>
                                             </div><!--end col-->
                                             <div class="col-md-7 text-right">                                                    
                                                 <p class="mb-4 text-muted">تاريخ الجلسة القادمة : <br>
                                                  <span>{{$case_stagee->DT_HEARING_DATE}}</span></p>
                                             </div><!--end col-->
                                         </div><!--end row-->
                                         <ul class="list-inline mb-4 pr-0">
                                             <li class="list-inline-item">
                                                لدى محكمة : {{$case_stagee->courtName }}
                                             </li>
                                            
                                         </ul>
                                         <div>
             
                                         </div>
                                            @else
                                            <div class="row">
                                                
                                             <div class="col-md-5">                                                    
                                                 <p class=" mb-4 text-muted">Stage date : <br>
                                                  <span>{{$case_stagee->DT_HearingEnterDate }}</span></p>
                                             </div><!--end col-->
                                             <div class="col-md-7 text-left">                                                    
                                                 <p class="mb-4 text-muted">Next stage date : <br>
                                                  <span>{{$case_stagee->DT_HEARING_DATE}}</span></p>
                                             </div><!--end col-->
                                         </div><!--end row-->
                                         <ul class="list-inline mb-4 pl-0">
                                             <li class="list-inline-item">
                                                Court : {{$case_stagee->courtName }}
                                             </li>
                                            
                                         </ul>
                                         <div>
             
                                         </div>
                                            @endif
                                            
                                          
                                        </div><!--end media body-->
                                    </div><!--end media-->                                   
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                  @endforeach
                    </div>
                </div>

                <div class="tab-pane p-3" id="tasks-1" role="tabpanel">
                    <div class="row">
                     <div class="col-lg-12 ">
                         <div class="">
                             <ul class="list-inline pr-0">                                    
                                
                                 <li class="list-inline-item">
            
                                     <button type="button" class="btn btn-primary waves-effect waves-light  mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-task" id="new-task-btn"> اضافة مهمة </button>
             
                                 </li>
                             </ul>
                         </div>                            
                     </div><!--end col-->
                     @foreach ($case_tasks as $case_task)
             
                     <div class="col-lg-6">
                         <div class="card">
                             <div class="card-body">                                    
                                 <div class="task-box">
                                    <div class="task-priority-icon">
                                        @if ($case_task->N_Status == "اكتملت")
                                         <i class="fas fa-circle text-success"></i> 
                                        @endif
                                        @if ($case_task->N_Status == "قيد التنفيذ")
                                       <i class="fas fa-circle text-warning"></i> 
                                        @endif
                                        @if ($case_task->N_Status == "مؤجل")
                                        <i class="fas fa-circle text-danger"></i>  
                                        @endif
                                        
                                        </div>
                                        @if (Session::get('lang') == "ar")
                                        <p class=" float-left">
                                     
                                            <span class="mx-1"></span> 
                                            <span><i class="far fa-fw fa-clock"></i> تاريخ التسليم : {{$case_task->DT_WANTED}} </span>
                                        </p>
                                        <h5 class="mt-0"> - {{$case_task->S_NOTES}}</h5>
                                        <p class="text-muted mb-1">
                                           - {{$case_task->S_SUBJECT }}
                                        </p>
                                        <div class="row">
                                        <div class="col-6">
                                          <p class="text-muted text-right mb-1 mt-3">تاريخ الانشاء :  {{$case_task->DT_DOINGWORK }}</p>
                                        </div>
                                        <div class="col-6">
                                           <p class="text-muted text-left mb-1 mt-3">تاريخ التنفيذ  : {{$case_task->excute_date }}</p>
                                        </div>
                                       
                                        </div>
                                       
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="img-group">
                                                   
                                            </div><!--end img-group--> 
                                            <ul class="list-inline mb-0 align-self-center">                                                                    
                                                <li class="list-item d-inline-block mr-2">
                                                   
                                                </li>
                                               
                                              
                                                <li class="list-item d-inline-block">
                                                    <a class="" href="{{url('client-delete-task/'.$case_task->N_TASK_ID)}}">
                                                        <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                    </a>                                                                               
                                                </li>
                                            </ul>
                                        </div>
                                        @else
                                        <p class=" float-right">
                                     
                                            <span class="mx-1"></span> 
                                            <span><i class="far fa-fw fa-clock"></i>End date : {{$case_task->DT_WANTED}} </span>
                                        </p>
                                        <h5 class="mt-0"> - {{$case_task->S_NOTES}}</h5>
                                        <p class="text-muted mb-1">
                                           - {{$case_task->S_SUBJECT }}
                                        </p>
                                        <div class="row">
                                        <div class="col-6">
                                          <p class="text-muted text-left mb-1 mt-3">Created Date :  {{$case_task->DT_DOINGWORK }}</p>
                                        </div>
                                        <div class="col-6">
                                           <p class="text-muted text-right mb-1 mt-3">Excution Date : {{$case_task->excute_date }}</p>
                                        </div>
                                       
                                        </div>
                                       
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="img-group">
                                                   
                                            </div><!--end img-group--> 
                                            <ul class="list-inline mb-0 align-self-center">                                                                    
                                                <li class="list-item d-inline-block mr-2">
                                                   
                                                </li>
                                                <li class="list-item d-inline-block">
                                                                                                                               
                                                </li>
                                                <li class="list-item d-inline-block">
                                                    <a class="" href="{{url('client-delete-task/'.$case_task->N_TASK_ID)}}">
                                                        <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                    </a>                                                                               
                                                </li>
                                               
                                            </ul>
                                        </div>
                                        @endif                                 
                                 </div><!--end task-box-->
                             </div><!--end card-body-->
                         </div><!--end card-->
                 
                     </div><!--end col-->
                 @endforeach
                     
                    </div>
                 </div>
                
                <div class="tab-pane p-3" id="docs-1" role="tabpanel">
                   <div class="row">
                    <div class="col-lg-12">
 
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-doc-btn"></button>
                
                </div>
                 
                       <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3" id="docs-type"></h4>
                                <div class="files-nav">                                     
                                    <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                                        <a class="nav-link active" id="files-pdf-tab" data-toggle="pill" href="#files-pdf" aria-selected="false">
                                            <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                            <div class="d-inline-block align-self-center">
                                                <h5 class="m-0" id="stage-docs"> </h5>
                                                <small class="text-muted">{{$case_detail_docs->count()}} </small>                                                    
                                            </div>
                                        </a>
                                        <a class="nav-link " id="files-projects-tab" data-toggle="pill" href="#files-projects" aria-selected="true">
                                            <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                            <div class="d-inline-block align-self-center">
                                                <h5 class="m-0" id="all-docs">  </h5>
                                                <small class="text-muted"> {{$case_docs->count()}} </small>                                                    
                                            </div>
                                        </a>
                                       
                                  
                                   
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
            
                        <div class="card">
                            <div class="card-body">                                        
                               
                                <h6 class="mt-0" id="size"></h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                    <div class="col-lg-9">

                        <div class="">                                    
                            <div class="tab-content" id="files-tabContent">
                                <div class="tab-pane fade " id="files-projects">
                                    <h4 class="header-title mt-0 mb-3" id="all-docs-title"> </h4>                                         
                                    <div class="file-box-content">
                                        
                                        @foreach ($case_docs as $case_doc)
                                            
                                      
                                        <div class="file-box">
                                          
                                            <a href="{{asset('assets/case-documents/'.$case_doc->S_CASE_FILE_NUM.'/'.$case_doc->S_path)}}" class="download-icon-link" download>
                                              
                                                <i class="dripicons-download file-download-icon"></i>
                                            </a>
                                            <div class="text-center">
                                                <i class="far fa-file-alt text-primary"></i>
                                                <h5 class="text-truncate"> {{$case_doc->S_name}} </h5>
                                                <hr>
                                                <h6 class=" text-muted"> {{$case_doc->S_subject}} </h6>
                                                
                                                <small class="text-muted">{{$case_doc->DT_Doc_Date }} / النسخة : {{$case_doc->N_version }} </small>
                                            </div>                                                        
                                        </div>
                                       
                                        @endforeach
                                                                                       
                                    </div> 
                                    
                                  
                                    
                                </div><!--end tab-pane-->
            
                                <div class="tab-pane fade show active" id="files-pdf">
                                    <h4 class="mt-0 header-title mb-3" id="all-stage-docs-title"></h4>
                                    <div class="file-box-content">
                                        @foreach ($case_detail_docs as $case_doc)
                                            
                                      
                                        <div class="file-box">
                                          
                                            <a href="{{asset('assets/case-documents/'.$case_doc->S_CASE_FILE_NUM.'/'.$case_doc->S_path)}}" class="download-icon-link" download>
                                              
                                                <i class="dripicons-download file-download-icon"></i>
                                            </a>
                                            <div class="text-center">
                                                <i class="far fa-file-alt text-primary"></i>
                                                <h5 class="text-truncate"> {{$case_doc->S_name}} </h5>
                                                <hr>
                                                <h6 class=" text-muted"> {{$case_doc->S_subject}} </h6>
                                                
                                                <small class="text-muted">{{$case_doc->DT_Doc_Date }} / النسخة : {{$case_doc->N_version }} </small>
                                            </div>                                                        
                                        </div>
                                       
                                        @endforeach
                                        
                                                                           
                                    </div> 
                                </div><!--end tab-pane-->
            
                              
            
                                <div class="tab-pane fade" id="files-hide">
                                    <h4 class="mt-0 header-title mb-3">Hide</h4>
                                </div><!--end tab-pane-->
                            </div>  <!--end tab-content-->                                                                              
                        </div><!--end card-body-->
                    </div><!--end col-->

                   </div>
                </div>
                
            </div>    
        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->
    
   </div>


</div>

<div class="modal fade new-task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('client-assign-task')}}">
                    @csrf
                    <input type="hidden" name="case_id" value=" {{$case_id}} "> 
                    <input type="hidden" name="main_case_id" value=" {{$main_case_id}} "> 

              <div class="row">
                    
                <div class="col-12"> 
                   <div class="form-group row">
                            
                    <input type="hidden" name="status" value="قيد التنفيذ">

                               <div class="col-sm-4">
                                <label id="task-type">نوع المهمة</label>
                                   <select disabled class="custom-select" name="type">
                                 <option value="1">مهمة دعوى</option>
                                 </select>
                             </div>
                             <div class="col-sm-4">
                                <label id="task-doc">  </label>
                                <input class="form-control" name="doc" type="file" >
                            </div>
                               
                            

                         </div>
       
              </div>
              
             <div class="col-12"> 
                   <div class="form-group row">
                            
                    <div class="col-sm-4">
                        <label id="task-name">  </label>
                        <input class="form-control" name="notes" type="text" id="example-text-input">
                    </div>
                    
                        <div class="col-sm-4">
                         <label id="task-start"></label>
                           <input class="form-control" type="date" name="doing_date" id="example-text-input">
                      </div>

                       <div class="col-sm-4">
                                <label id="task-end"></label>
                                 <input class="form-control" type="date" name="wanted_date" id="example-text-input">
                             </div>


                           

                        </div>
       
              </div>
 
                
               <div class="col-12"> 
                   <div class="form-group row">
                       <div class="col-sm-6">
                           <label id="task-desc"></label>
                             <textarea class="form-control" name="desc" rows="3" id="message"></textarea>
                        </div>
                     <div class="col-sm-6">
                                <label id="task-note"> </label>
                                  <textarea class="form-control" name="comment" rows="3" id="message"></textarea>
                             </div>
                            
                             
                   </div>
                 </div>


                  <div class="col-12"> 
                 
                      <button class="btn btn-sm btn-primary mr-1 font-15 " id="task-add-btn" ></button>
              </div> 
               

                 </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


 <div class="col-12 px-0">
    

<div class="accordion" id="accordionExample-faq">
<div class="card shadow-none border mb-1">
    <div class="card-header" id="headingOne">
    <h5 class="my-0">
      <button class="btn btn-link mx-4" id="linked-cases-title" style="font-weight: bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        الدعاوى المرتبطة
        </button>
    </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample-faq">
    <div class="card-body">
        @foreach ($cases as $case)
   
        <div class="col-lg-12">
            <div class="card">
             
                   <div class="card-body" > 
                       <div class="table-responsive">
                    <table  class="table table-bordered mb-0 table-centered">
                        <thead>
                            <tr>
                                <th style="width: 150px" id="th1-1">رقم الدعوى</th>
                                <th style="width: 180px" id="th1-2">نوع الدعوى</th>
                                <th style="width: 180px" id="th1-3">مرحلة الدعوى</th>
                                <th class="text-center" style="width: 120px" id="th1-4">عرض الدعوى</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            <tr>
                                <td> {{$case->S_CASE_UID}}</td>
                                <td>{{$case->stageName}} </td>
                                <td> {{$case->typeName}}</td>
                                <td class="text-center">
                                    <a href="{{url('client-main-case-cases/'.$main_case_id,$case->N_CASE_DETAILS_ID)}}">
                                        <button class="btn btn-outline-dark waves-effect waves-light" ><i class="dripicons-preview "></i></button>
                                      </a> 
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>                                  
                     
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
        @endforeach
    </div>
    </div>
</div>
<div class="card shadow-none border mb-1">
    <div class="card-header" id="headingTwo">
    <h5 class="my-0">
      <button class="btn btn-link collapsed mx-4 align-self-center" id="excutes-title" style="font-weight: bold" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        التنفيذات
        </button>
    </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample-faq">
    <div class="card-body">
      <div class="row">
         
    @foreach ($excutes as $excute)
   
    <div class="col-lg-12">
        <div class="card" style="background-color: #fff;">
            <div class="card-body">

                </p>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered">
                <thead>
                    <tr>
                        <th id="th-1" style="width: 140px;">رقم التنفيذ</th>
                        <th id="th-2" style="width: 130px;">نوع التنقيذ</th>
                        <th id="th-3" style="width: 130px;"> المبلغ المستحق</th>
                        <th id="th-4" style="width: 150px;"> المبلغ المتحصل</th>
                        <th id="th-5" style="width: 130px;"> تاريخ التنفيذ</th>
                        <th id="th-6"style="width: 130px;"> رسوم التنفيذ</th>
                        <th id="th-7"style="width: 130px;">رسوم المكتب</th>
                        <th id="th-8" style="width: 130px;">رسوم القضية</th>
                        <th id="th-9"style="width: 200px;"> موضوع التنفيذ</th>
                        <th id="th-10"style="width: 150px;">  عرض الاجراءات التنفيذية</th>
                </tr>
                </thead>
             
                <tbody>
                       
                @foreach($excutes as $excute )
               
                <tr>
                   
                    <td  style="width: 100px;"> {{$excute->excute_uid}}</td>
                        <td  style="width: 100px;"> {{$excute->typeName}}</td>
                        <td  style="width: 100px;"> {{$excute->cliam_amount }}</td>
                        <td  style="width: 130px;"> {{$excute->collected_amount}}</td>
                        <td  style="width: 100px;"> {{$excute->excute_date}}</td>
                        <td  style="width: 100px;"> {{$excute->excute_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->case_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->office_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->subject}}</td>
                      
                        <td class="text-center" style="width: 180px;">
                           
                            <a href="{{url('client-excute-actions/'.$excute->excute_stage_id)}} ">
                                <button class="btn-sm btn-outline-dark waves-effect waves-light"><i class="dripicons-preview "></i></button>
                            </a>

                        </td>
                    </tr>
              
                    @endforeach
                </tbody>
                
            </table>
                </div>
            </div>
        </div>                                            
    </div>
    @endforeach
</div> 
    </div>
</div>

</div>                                                
</div><!--end accordion-->
     
</div><!--end row-->

  

</div><!--end row-->


 
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{ route('client-add-case-document') }}" enctype="multipart/form-data">
                    @csrf
              <div class="row">

                  <div class="col-12"> 
                      <div class="form-group row">
                        <input class="form-control col-sm-6" value=" {{$case_id}} " name="case_id" type="hidden" id="example-text-input">

                                <div class="col-sm-4">
                                <label id="doc-main-case-number"></label>
                                <input class="form-control col-sm-6" value=" {{$main_case_id}} " name="main_case_id" type="hidden" id="example-text-input">

                                    <input disabled class="form-control col-sm-6" value=" {{$main_case_id}} " type="text" id="example-text-input">
                                </div>
                                 <div class="col-sm-4">
                                  <label id="doc-number"></label>
                                   <input class="form-control col-sm-6" disabled value="  {{$case_docs->count()+1}} "  type="text" id="example-text-input">
                                </div>
                                <div class="col-sm-4">
                                  <label id="doc-attach"></label>
                                   <input class="form-control col-sm-12" required type="file" name="doc" id="example-text-input">
                                </div>
                          </div>
                 </div>
                 <div class="col-12"> <hr>  </div>
               

                  <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-sm-4">
                                 <label id="doc-name-ar"></label>
                                    <input class="form-control" placeholder="" name="name" type="text" id="example-text-input">
                                </div>

                                <div class="col-sm-4">
                                    <label id="doc-name-eng"></label>
                                    <input class="form-control" placeholder="" name="name_eng" type="text" id="example-text-input">

                                  </div>

                                 <div class="col-sm-4">
                                  <label id="doc-v"></label>
                                    <input class="form-control"  type="text" name="v_num" id="example-text-input">
                                </div>
                                
                             

                            </div>
          
                 </div>
                      <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-sm-4">
                                  <label id="doc-date"></label>
                                <input type="date" disabled class="form-control" id="now_date" value="5" >
                                </div>
                                 <div class="col-sm-12 mt-3">
                                      <label id="doc-subject"></label>
                                 <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                                </div>

                            </div>
          
                 </div>
              
                     <div class="col-12">                         
                        <button type="submit" class="btn btn-sm btn-success mr-1 font-16" id="doc-add-btn"></button>
                     </div> 
     
                     </div> 
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
    
  
@endsection


@section('page-script')

<script>
      if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = 'القضايا' ;
    document.getElementById("breadcrumb-3").innerHTML = "دعاوى القضية"; 

    document.getElementById("page-name").innerHTML = "دعاوى القضية";

    document.getElementById("file-number-box").innerHTML = "رقم الملف";
    document.getElementById("case-number-box").innerHTML = "رقم القضية";
    document.getElementById("stages-number-box").innerHTML = "عدد الدعاوى";

    document.getElementById("details-tap").innerHTML = "البيانات";
    document.getElementById("hearings-tap").innerHTML = "الجلسات";
    document.getElementById("docs-tap").innerHTML = "المستندات";
    document.getElementById("tasks-tap").innerHTML = "المهام";



    document.getElementById("stage-number").innerHTML = "رقم الدعوى ";
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
    document.getElementById("stage-fees").innerHTML = "رسوم المحكمة ";
    document.getElementById("stage-info").innerHTML = "معلومات الدعوى ";

    document.getElementById("case-cliam").innerHTML = "قيمة المطالبة في القضية";
    document.getElementById("client-name").innerHTML = "الموكل";
    document.getElementById("against-name").innerHTML = "الخصم";
    document.getElementById("main-case-id").innerHTML = "القضية الاساس";
    document.getElementById("main-case-decission").innerHTML = "قرار القضية الاساس";
    document.getElementById("register-date").innerHTML = "تاريخ التسجيل";
    document.getElementById("first-stage-date").innerHTML = "تاريخ اول جلسة";
    document.getElementById("next-stage-date").innerHTML = "تاريخ الجلسة القادمة";
    document.getElementById("last-stage-decission").innerHTML = "اخر قرار علي الدعوى";
    document.getElementById("last-decission-date").innerHTML = "تاريخ اخر قرار علي الدعوى";

    document.getElementById("task-doc").innerHTML = "مستندات";
document.getElementById("task-type").innerHTML = "نوع المهمة";
document.getElementById("task-start").innerHTML = "تاريخ البداية";
document.getElementById("task-end").innerHTML = "تاريخ التسليم";
document.getElementById("task-name").innerHTML = "اسم المهمة";
document.getElementById("task-desc").innerHTML = "وصف المهمة";
document.getElementById("task-note").innerHTML = "ملاحظات";
document.getElementById("task-add-btn").innerHTML = "اضافة";


    document.getElementById("docs-type").innerHTML = "انواع المستندات";
    document.getElementById("stage-docs").innerHTML = "مستندات الدعوى";
    document.getElementById("all-docs").innerHTML = "كل المستندات";
    document.getElementById("size").innerHTML = "حجم الملفات الكلي : 22.86 GB";
    document.getElementById("all-docs-title").innerHTML = "كل المستندات";
    document.getElementById("all-stage-docs-title").innerHTML = "مستندات الدعوى";

    document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة مستند';

document.getElementById("doc-main-case-number").innerHTML = "رقم القضية";
   document.getElementById("doc-number").innerHTML = "رقم المستند";
   document.getElementById("doc-attach").innerHTML = "تحميل المستند";
   document.getElementById("doc-name-ar").innerHTML = "اسم المستند عربي";
   document.getElementById("doc-name-eng").innerHTML = "اسم المستند انجليزي";
   document.getElementById("doc-v").innerHTML = "رقم النسخة";
   document.getElementById("doc-date").innerHTML = "تاريخ المستند";
   document.getElementById("doc-subject").innerHTML = "موضوع المستند";
   document.getElementById("doc-add-btn").innerHTML = "اضافة مستند";
   document.getElementById("docs-type").innerHTML = "انواع المستندات";
   document.getElementById("stage-docs").innerHTML = "مستندات الدعوى";
   document.getElementById("all-docs").innerHTML = "كل المستندات";
   document.getElementById("size").innerHTML = "حجم الملفات الكلي : 22.86 GB";
   document.getElementById("all-docs-title").innerHTML = "كل المستندات";
   document.getElementById("all-stage-docs-title").innerHTML = "مستندات الدعوى";




    document.getElementById("linked-cases-title").innerHTML = "الدعاوى المرتبطة ";
    document.getElementById("excutes-title").innerHTML = "التنفيذات ";



      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'cases' ;
    document.getElementById("breadcrumb-1").innerHTML = "main case cases" ;

    document.getElementById("page-name").innerHTML = "MAIN CASE CASES";

    document.getElementById("file-number-box").innerHTML = "File number";
    document.getElementById("case-number-box").innerHTML = "Case number";
    document.getElementById("stages-number-box").innerHTML = "Stgaes";

    document.getElementById("details-tap").innerHTML = "Details";
    document.getElementById("hearings-tap").innerHTML = "Hearings";
    document.getElementById("docs-tap").innerHTML = "Documents";
    document.getElementById("tasks-tap").innerHTML = "Tasks";

    document.getElementById("new-task-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> Add new task';

    document.getElementById("stage-number").innerHTML = "Stage number ";
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
    document.getElementById("stage-fees").innerHTML = "Court fees ";
    document.getElementById("stage-info").innerHTML = "Stage info. ";

    document.getElementById("case-cliam").innerHTML = "Case cliam amount";
    document.getElementById("client-name").innerHTML = "Client name";
    document.getElementById("against-name").innerHTML = "Against name";
    document.getElementById("main-case-id").innerHTML = "Main case";
    document.getElementById("main-case-decission").innerHTML = "Main case decission";
    document.getElementById("register-date").innerHTML = "Case register date";
    document.getElementById("first-stage-date").innerHTML = "First stage date";
    document.getElementById("next-stage-date").innerHTML = "Next stage date";
    document.getElementById("last-stage-decission").innerHTML = "Last case decission";
    document.getElementById("last-decission-date").innerHTML = "Last case date";

    document.getElementById("task-doc").innerHTML = "Documents";
document.getElementById("task-type").innerHTML = "Task type";
document.getElementById("task-start").innerHTML = "Start date";
document.getElementById("task-end").innerHTML = "End date";
document.getElementById("task-name").innerHTML = "Task name";
document.getElementById("task-desc").innerHTML = "Description";
document.getElementById("task-note").innerHTML = "Notes";
document.getElementById("task-add-btn").innerHTML = "Add";


document.getElementById("docs-type").innerHTML = "Documents type";
document.getElementById("stage-docs").innerHTML = "Stage documents";
document.getElementById("all-docs").innerHTML = "All documents";
document.getElementById("size").innerHTML = "Documents size : 22.86 GB";
document.getElementById("all-docs-title").innerHTML = "All documents";
document.getElementById("all-stage-docs-title").innerHTML = "Stage documents";

document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add document';

document.getElementById("doc-main-case-number").innerHTML = "Main case number";
document.getElementById("doc-number").innerHTML = "Doc number";
document.getElementById("doc-attach").innerHTML = "Attach doc";
document.getElementById("doc-name-ar").innerHTML = "Doc name AR";
document.getElementById("doc-name-eng").innerHTML = "Doc name ENG";
document.getElementById("doc-v").innerHTML = "Doc version";
document.getElementById("doc-date").innerHTML = "Doc date";
document.getElementById("doc-subject").innerHTML = "Doc subject";
document.getElementById("doc-add-btn").innerHTML = "Add doc";


document.getElementById("th1-1").innerHTML = "stage number ";
document.getElementById("th1-2").innerHTML = "stage type ";
document.getElementById("th1-3").innerHTML = "stage level ";
document.getElementById("th1-4").innerHTML = "view case ";

document.getElementById("linked-cases-title").innerHTML = "Linked cases ";
document.getElementById("excutes-title").innerHTML = "Excutes ";
      }
</script>
    
@endsection