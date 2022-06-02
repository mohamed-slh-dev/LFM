@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@if (Session::get('lang') == "ar")
@if ( $main_case->N_IsClosed == 0)
<button class="btn-sm btn-outline-primary mx-4" disabled>مفتوحة</button>
                @else
                <button class="btn-sm btn-danger mx-4" disabled>مغلقة</button>
@endif
@else
@if ( $main_case->N_IsClosed == 0)
<button class="btn-sm btn-outline-primary mx-4" disabled>Open</button>
                @else
                <button class="btn-sm btn-danger mx-4" disabled>Closed</button>
@endif
@endif


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
                    <a class="nav-link " data-toggle="tab" id="memoir-tap" href="#memoir-1" role="tab"></a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-toggle="tab" id="hearings-tap" href="#stages-1" role="tab"></a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-toggle="tab" id="tasks-tap" href="#tasks-1" role="tab"></a>
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
                                <form class="form" action=" {{ url('update-case-details/'.$case_details->N_CASE_DETAILS_ID) }}"method="POST" >
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
                                                    <input type="text" name="request_number" value="{{$case_details->request_number}}" class="form-control" id="">
                                                </div>
                                                <div class="col-2"> 
                                                    <label id="stage-request-date"></label>
                                                    <input type="date" name="request_date" value="{{$case_details->request_date}}" class="form-control" id="">
                                                </div>
                                        </div>              
                                    </div>
                                   
                                        <div class="col-12"> 
                                            <div class="form-group row">
                                                     
                                                <div class="col-4">
                                                    <label id="stage-number"></label>
                                                    <input  type="hidden" value="{{$case_details->N_CASE_ID}}" name="main_case_id"  type="text" >
                    
                                                <input type="text" name="case_uid" value="{{$case_details->S_CASE_UID}}" class="form-control" id="">
                                                  </div>
                                                  <div class="col-4">
                                                    <label id="stage-type"></label>
                                                    <select class="custom-select" name="case_type" >
                                                        <option value="{{$case_details->typeCode}}">{{$case_details->typeName}}</option>
                                                        @foreach ($case_type as $case_typee)
                                                        <option value="{{$case_typee->N_DetailedCode}}">{{$case_typee->S_Desc_A}}</option>  
                                                        @endforeach  
                                                    </select>                         
                                                       </div>
                                                
                                                  <div class="col-4">
                                                    <label id="stage-stage"></label>
                                                    <select class="custom-select" name="case_stage" >
                                                        <option value="{{$case_details->stageCode}}">{{$case_details->stageName}}</option>
                                                        @foreach ($case_stage as $case_stagee)
                                                        <option value="{{$case_stagee->N_DetailedCode}}">{{$case_stagee->S_Desc_A}}</option>  
                                                        @endforeach 
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
                                                        @foreach ($client_type as $c_type)
                                                        <option value="{{$c_type->N_DetailedCode}}">{{$c_type->S_Desc_A}}</option>  
                                                        @endforeach
                                                        
                                                       </select>
                                                        
                                                   </div>
                                                <div class="col-sm-4">
                                                    <label id="stage-court"></label>
                                                    <select class="custom-select" name="court" >
                                                            <option value="{{$case_details->courtCode}}">{{$case_details->courtName}}</option>
                                                            @foreach ($court as $courtt)
                                                            <option value="{{$courtt->N_DetailedCode}}">{{$courtt->S_Desc_A}}</option>  
                                                            @endforeach 
                                                            
                                                        </select>
                                                      </div>
                        
                                                 <div class="col-sm-4">
                                                    <label id="stage-dept"></label>
                                                    <select class="custom-select" name="dept" >
                                                            <option value="{{$case_details->deptCode}}">{{$case_details->deptName}}</option>
                                                            @foreach ($depts as $dept)
                                                            <option value="{{$dept->N_DetailedCode}}">{{$dept->S_Desc_A}}</option>  
                                                            @endforeach 
                                                            
                                                        </select>
                                                      </div>
                                                              
                                         
                                                       
                                                      
                        
                                                  </div>
                                
                                       </div>
                    
                                        <div class="col-12"> 
                                            <div class="form-group row">
                                               <div class="col-12">
                                                <label id="stage-info"></label>
                                                <textarea class="form-control"  name="subject"  id="message">
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
                                                     @foreach ($experts as $expert)
                                                     <option value="{{$expert->N_Expert_ID}}">{{$expert->S_Expert_AR_NAME}}</option>   
                                                     @endforeach
                                                 </select>
                                              </div>
                    
                                         <div class="col-sm-4">
                                                <label id="case-cliam"> </label>
                                         <input class="form-control" placeholder="{{number_format($main_case_payment,2)}}" disabled type="text" id="example-text-input">
                                         </div>
                                         <div class="col-sm-4">
                                            <label id="stage-fees"></label>
                                            <input class="form-control" name="court_fees" value="{{$case_details->S_COURT_FEES}}" type="text" id="example-text-input">
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
                                       <a href="{{url('main-case-cases/'.$first_case_details->N_CASE_ID)}}">
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
                               <input type="date"  value="{{$main_case_register_date}}" name="rigster_case_date" class="form-control" id="">
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
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                  </div>
                    
                             <div class="col-sm-4">
                                <label id="stage-consult"></label>
                                     <select class="custom-select" name="lawyer_2" >
                                        <option value="{{$case_details->id_2}}">{{$case_details->name_2}}</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                  </div>
                                    <div class="col-sm-4">
                                        <label id="stage-lawyer"></label>
                                        <select class="custom-select" name="lawyer_3" >
                                        <option value="{{$case_details->id_3}}">{{$case_details->name_3}}</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>  
                                        @endforeach 
                                        
                                    </select>       
                               </div>
                                  
                    
                              </div>
                    
                        </div>
                                <div class="col-12">
                                    <hr>
                                    <div class=" justify-content-between">
                                        <a href="">
                                        <button class="btn btn-outline-dark waves-effect waves-light" id="update-details">تحديث</button></a> 
                                        
                                        
                                        
                                        </div> 
                                </div>
                    
                                    </div>
                                </div><!--end card-body-->
                                    </form>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div>
                </div>

                <div class="tab-pane p-3" id="memoir-1" role="tabpanel">
                    <div class="row">

                        <div class="col-lg-12 ">
                            <div class="">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">
                    
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-memoir" id="new-memoir"></button>
                    
                                <!--  <button type="button" class="btn btn-secondary mr-5"><i class="mdi mdi-file ml-2"></i>عرض التقريرالتفصيلي للملف</button> -->
                                    </li>
                                </ul>
                            </div>                            
                        </div><!--end col-->

                        @foreach ($memoir as $task)
            
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">                                    
                                    <div class="task-box">
                                       <div class="task-priority-icon">
                                           @if ($task->status == "اكتملت")
                                            <i class="fas fa-circle text-success"></i> 
                                           @endif
                                           @if ($task->status == "قيد التنفيذ")
                                          <i class="fas fa-circle text-warning"></i> 
                                           @endif
                                           @if ($task->status == "الغيت")
                                           <i class="fas fa-circle text-danger"></i>  
                                           @endif
                                           
                                           </div> 
                                           @if (Session::get('lang') == "ar")
                                           <div style="display: block ruby">
                                               <p class="float-left">
                                        
                                                   <span class="mx-1"></span> 
                                                   <span><i class="far fa-fw fa-clock"></i> تاريخ التنفيذ : {{$task->excute_date}} </span>
                                               </p>
                                               <p class="float-right"> - طلب مذكرة</p>
                                           </div>
                                           <br>
                                           <div>
                                               <p class="text-muted mt-1">
                                                   - {{$task->excute_Name }}
                                                </p>
                                           </div>
                                           <div class="row">
                                           <div class="col-6">
                                             <p class="text-muted text-right mb-1 mt-3">بواسطة :  {{$task->createBy }}</p>
                                           </div>
                                           <div class="col-6">
                                              <p class="text-muted text-left mb-1 mt-3">المستشار : {{$task->assignTo }}</p>
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
                                                      <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".memoir_status_{{$task->id}}">
                                                              <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                                          </a>                                                                               
                                                      </li>
                                                      <li class="list-item d-inline-block">
                                                          <a class="" href="{{url('delete-memoir/'.$task->id)}}">
                                                              <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                          </a>                                                                               
                                                      </li>
                                               </ul>
                                           </div> 
                                           @else
                                           <div style="display: block ruby">
                                               <p class="float-right">
                                        
                                                   <span class="mx-1"></span> 
                                                   <span><i class="far fa-fw fa-clock"></i> excute date : {{$task->excute_date}} </span>
                                               </p>
                                               <p class="float-left"> - case memoir</p>
                                           </div>
                                          <br>
                                           <div>
                                               <p class="text-muted mt-1">
                                                   - {{$task->excute_Name }}
                                                </p>
                                           </div>
                                           
                                           <div class="row">
                                           <div class="col-6">
                                             <p class="text-muted text-left mb-1 mt-3">created by :  {{$task->createBy }}</p>
                                           </div>
                                           <div class="col-6">
                                              <p class="text-muted text-right mb-1 mt-3">consultant : {{$task->assignTo }}</p>
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
                                                      <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".memoir_status_{{$task->id}}">
                                                              <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                                          </a>                                                                               
                                                      </li>
                                                      <li class="list-item d-inline-block">
                                                          <a class="" href="{{url('delete-memoir/'.$task->id)}}">
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

                <div class="modal fade new-memoir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('add-case-memoir')}}">
                                    @csrf
                                    <input type="hidden" name="case_id" value=" {{$case_id}} "> 
                                    <input type="hidden" name="main_case_id" value=" {{$main_case_id}} "> 
            
                              <div class="row">
                                
                                   <div class="col-12"> 
                                      <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label id="memoir-need">   </label>
                                            <select class="custom-select" name="excute_need">
                                              @foreach ($memoir_type as $t)
                                              <option value="{{$t->N_DetailedCode}}">{{$t->S_Desc_A}} </option>
                                                  
                                              @endforeach
                                              
                                          </select>                   
                                         </div>
        
                                         <div class="col-sm-4">
                                            <label id="consult"> </label>
                                            <select class="custom-select" name="assignTo">
                                                 @foreach ($users as $user)
                                                 <option value="{{$user->id}}">{{$user->name}} </option>
                                                     
                                                 @endforeach
                                                 
                                             </select>
                                         </div>
                                                
                                         <div class="col-sm-4">
                                            <label id="memoir-date"></label>
                                            <input class="form-control" name="excute_date" type="date"  id="example-text-input">
                                         </div> 
                                                 
                                                  
                                               
            
                                            </div>
                          
                                 </div>
                                 
                                       <div class="col-12"> 
                                      <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label id="status"></label>
                                            <select class="custom-select" name="status">
                                                   <option value="قيد التنفيذ">
                                                       قيد التنفيذ
                                                   </option>
                                                   
                                               </select>
                                           </div>
                                           
                                       <div class="col-sm-4">
                                        <label id="created-by"></label>
                                        <input class="form-control" disabled value=" {{ auth()->user()->name }} " type="text" id="example-text-input">
            
                                     </div>
                                         
            
                                           </div>
                          
                                 </div>
                                
            
                                     <div class="col-12"> 
                                    
                                        <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn"></button>
                                    </div> 
                                  
            
                                    </div>
                                </form> 
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                @foreach ($memoir as $task)
    
                <div class="modal fade memoir_status_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style=" display: block; ">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('update-memoir-status')}}">
                                    @csrf
                                    <input type="hidden" name="memoir_id" value="{{$task->id}}">
                              <div class="row">
                      
                                @if (Session::get('lang') == "ar")
                                <div class="col-12"> 
                                    <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="noe_date">  حالة المذكرة الحالية - ({{$task->status}})</label>
                                       <select class="custom-select" name="task_status">
                                          <option value="قيد التنفيذ">
                                              قيد التنفيذ
                                          </option>
                                          
                                          <option value="اكتملت">
                                               اكتلمت
                                          </option>
                                          <option value="الغيت">
                                             الغاء 
                                          </option>
                                          
                                      </select>
                                  </div>
                                </div>
                            </div>

                           <div class="col-12">
                                   <button class="btn btn-sm btn-primary mr-1 font-15">تحديث</button>
                               </div> 
                                @else
                                <div class="col-12"> 
                                    <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="noe_date"> Current status - ({{$task->status}})</label>
                                       <select class="custom-select" name="task_status">
                                          <option value="قيد التنفيذ">
                                            Ongoing
                                          </option>
                                          
                                          <option value="اكتملت">
                                               Completed
                                          </option>
                                          <option value="الغيت">
                                             Canceld 
                                          </option>
                                          
                                      </select>
                                  </div>
                                </div>
                            </div>

                           <div class="col-12">
                                   <button class="btn btn-sm btn-primary mr-1 font-15">Update</button>
                               </div> 
                                @endif
                             
                                     
                              
                       
 
                          </div>
                                </form> 
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
                @endforeach

                <div class="tab-pane p-3" id="stages-1" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">
             
                                        <button type="button" class="btn btn-primary waves-effect waves-light  mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-stage" id="new-stage"></button>
             
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
                                             <a href="{{url('delete-stage/'.$case_stagee->N_HEARING_ID)}}"   class="btn btn-sm btn-outline-danger d-sm-inline-block float-left mr-3"> حذف </a>                                            
                                         <a  data-toggle="modal" data-animation="bounce" data-target=".edit-stage-{{$case_stagee->N_HEARING_ID}}" class="btn btn-sm btn-outline-info d-sm-inline-block float-left"> تعديل </a>                                            
             
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
                                         <a href="{{url('delete-stage/'.$case_stagee->N_HEARING_ID)}}"   class="btn btn-sm btn-outline-danger d-sm-inline-block float-right ml-3">DELETE</a>                                            
                                         <a  data-toggle="modal" data-animation="bounce" data-target=".edit-stage-{{$case_stagee->N_HEARING_ID}}" class="btn btn-sm btn-outline-info d-sm-inline-block float-right">Edit</a>                                            
             
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
           
                                    <button type="button" class="btn btn-primary waves-effect waves-light  mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-task" id="new-task-btn"></button>
            
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
                                    
                                        <span><i class="far fa-fw fa-clock mx-1"></i> تاريخ الاسناد : {{$case_task->DT_DATE_STARTWORK}} </span>
                                        /
                                        <span><i class="far fa-fw fa-clock mx-1"></i> تاريخ التسليم : {{$case_task->DT_WANTED}} </span>
                                     </p>
                                       <h5 class="mt-0"> - {{$case_task->S_NOTES}}</h5>
                                       <p class="text-muted mb-1">
                                          - {{$case_task->S_SUBJECT }}
                                       </p>

                                       <p class="text-muted mb-1">
                                        - ملاحظات عند التحديث : {{$case_task->N_Reviewed }}
                                     </p>

                                       <div class="row">
                                       <div class="col-6">
                                         <p class="text-muted text-right mb-1 mt-3">بواسطة :  {{$case_task->createBy }}</p>
                                       </div>
                                       <div class="col-6">
                                          <p class="text-muted text-left mb-1 mt-3">القائم بالمهمة : {{$case_task->assignTo }}</p>
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
              
                                               <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".status_{{$case_task->N_TASK_ID}}">
                                                       <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                                   </a>                                                                               
                                               </li>
                                               <li class="list-item d-inline-block">
                                                   <a class="" href="{{url('delete-task/'.$case_task->N_TASK_ID)}}">
                                                       <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                   </a>                                                                               
                                               </li>
                                           </ul>
                                       </div>
                                       @else
                                       <p class=" float-right">
                                        <span><i class="far fa-fw fa-clock mx-1"></i>Start date : {{$case_task->DT_DATE_STARTWORK}} </span>
                                        /
                                        <span><i class="far fa-fw fa-clock mx-1"></i>End date : {{$case_task->DT_WANTED}} </span>
                                      </p>
                                       <h5 class="mt-0"> - {{$case_task->S_NOTES}}</h5>
                                       <p class="text-muted mb-1">
                                          - {{$case_task->S_SUBJECT }}
                                       </p>

                                       <p class="text-muted mb-1">
                                        - Status Notes : {{$case_task->N_Reviewed }}
                                     </p>
                                       <div class="row">
                                       <div class="col-6">
                                         <p class="text-muted text-left mb-1 mt-3">Created by :  {{$case_task->createBy }}</p>
                                       </div>
                                       <div class="col-6">
                                          <p class="text-muted text-right mb-1 mt-3">Assign to : {{$case_task->assignTo }}</p>
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
              
                                               <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".status_{{$case_task->N_TASK_ID}}">
                                                       <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                                   </a>                                                                               
                                               </li>
                                               <li class="list-item d-inline-block">
                                                   <a class="" href="{{url('delete-task/'.$case_task->N_TASK_ID)}}">
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
                 
                                <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-doc" id="add-doc-btn"></button>
                       
                    </div>
                   
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0 mb-3" id="docs-type"></h4>
                                    <div class="files-nav">                                     
                                        <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                                            <a class="nav-link active" id="files-projects-tab" data-toggle="pill" href="#files-projects" aria-selected="true">
                                                <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                                <div class="d-inline-block align-self-center">
                                                    <h5 class="m-0" id="stage-docs"> </h5>
                                                    <small class="text-muted">{{$case_detail_docs->count()}}  </small>                                                    
                                                </div>
                                            </a>
                
                                            <a class="nav-link " id="client-projects-tab" data-toggle="pill" href="#files-pdf" aria-selected="true">
                                                <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                                <div class="d-inline-block align-self-center">
                                                    <h5 class="m-0" id="client-docs">  </h5>
                                                    <small class="text-muted"> {{$client_case_docs->count()}} </small>                                                    
                                                </div>
                                            </a>
                
                                            <a class="nav-link " id="files-pdf-tab" data-toggle="pill" href="#files-word" aria-selected="false">
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
                                    <div class="tab-pane fade " id="files-word" >
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
                
                                    <div class="tab-pane fade show active"  id="files-projects">
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
                
                                    <div class="tab-pane fade" id="files-pdf">
                                        <h4 class="mt-0 header-title mb-3" id="all-client-docs-title"></h4>
                                        <div class="file-box-content">
                                            @foreach ($client_case_docs as $case_doc)
                                                
                                          
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
                    </div><!--end row-->
                </div>
                
            </div>    
        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->
    
   </div>


</div>

<div class="row">
                     
   
    <div class="col-lg-12">
        <div class="card client-card"> 
            <div class="col-lg-12 ">
                <div class=" row">
                    <div class="col-9">
                        <ul class="list-inline  mt-3 pr-0 mr-1">                                    
                            
                            @if ($add_case == 'true')
                            <li class="list-inline-item">
            
                                <button type="button" class="btn btn-primary waves-effect waves-light   mx-3" data-toggle="modal" data-animation="bounce" data-target=".case-require" id="add-require"></button>
                                </li>
                            <li class="list-inline-item mr-3">
            
                                <button type="button" class="btn btn-primary waves-effect waves-light mx-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-stage-btn"></button>
                            </li>
            
                                <li class="list-inline-item mr-4 ">
            
                                    <button type="button" class="btn btn-primary waves-effect waves-light mx-3" data-toggle="modal" data-animation="bounce" data-target=".excute-stage" id="add-excute"></button>
                                </li>
                         </ul>

                    </div>
                    <div class="col-3">
                        <ul class="list-inline  mt-3  ">    
                            @endif
                                @if ( $main_case->N_IsClosed == 0)
                                 <li class="list-inline-item ">
                                    <a href="{{url('close-case/'.$main_case->N_CASE_ID)}}">
                                        <button type="button" class="btn btn-danger waves-effect waves-light   mx-5" data-toggle="modal" data-animation="bounce" id="close-case"></button>
                                    </a>
                                    </li>
                                 @else
                                 <li class="list-inline-item">
                                    <a href="{{url('open-case/'.$main_case->N_CASE_ID)}}">
                                        
                                        <button type="button" class="btn btn-outline-primary waves-effect waves-light   mx-5" data-toggle="modal" data-animation="bounce" id="open-case"><i class=""></i>  فتح القضية</button>
                                    </a>
                                    </li> 
                                 @endif
                              </ul>
                    </div>
                  
                        
                </div>                            
            </div><!--end col-->
        </div>
    </div>

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
                             <option value="all">الكل</option>
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
                       <option value="all">الكل</option>
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
                       <option value="all">الكل</option>
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
                                <th style="width: 180px" id="th1-2"> مرحلة الدعوى</th>
                                <th style="width: 180px" id="th1-3"> نوع الدعوى</th>
                                <th class="text-center" style="width: 120px" id="th1-4">عرض الدعوى</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            <tr>
                                <td> {{$case->S_CASE_UID}}</td>
                                <td>{{$case->stageName}} </td>
                                <td> {{$case->typeName}}</td>
                                <td class="text-center">
                                    <a href="{{url('main-case-cases/'.$main_case_id,$case->N_CASE_DETAILS_ID)}}">
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
   
    <div class="col-lg-6">
        <div class="card" style="border: 1px solid #c6c6c6;">
               <div class="card-body"> 
                @if (Session::get('lang') == "ar")
                      <div class="task-box">
                        <a href="{{url('main-case-cases/'.$excute->main_case_id)}}"  class=" float-left">
                            <button class="btn-sm btn-outline-dark btn-round">
                                <span>عرض القضية :   </span>
                                <span class="" style=" font-weight: bold; ">  {{$excute->main_case_id}} </span>  
                            </button>
                         </a>
                           <h5 class="mt-0" style="font-weight: bold;"> - {{$excute->excute_uid}} </h5>
                          <p class="text-muted mb-1">
                          -  {{$excute->subject}}  
                           </p>
                           <div style="display: block ruby;" class="mt-4">
                              <p class=" text-right mb-1">  نوع التنفيذ : {{$excute->typeName}} </p>4

                              <p class=" float-left mb-1">  تاريخ التنفيذ : {{$excute->excute_date}} </p>

                           </div>
                             
       
                           <hr>
                           
                           <div class="d-flex justify-content-between">
                           <a href="{{url('excute-details/'.$excute->excute_stage_id)}}">
                             <button class="btn btn-outline-dark waves-effect waves-light" >البيانات</button>
                           </a> 
                             
                             
                             <a href="{{url('excute-actions/'.$excute->excute_stage_id)}} ">
                               <button class="btn btn-outline-dark waves-effect waves-light">الاجراءات التنفيذية</button>
                           </a>
                           
                          

                     
                        <a
                         href="{{url('excute-tasks/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المهام</button>
                        </a>

                        <a href="{{url('excute-documents/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >المستندات</button></a>

                        
                        <a href="{{url('delete-excute/'.$excute->excute_stage_id)}} ">
                            <button class="btn btn-outline-danger waves-effect waves-light">حذف</button>
                        </a>
                          
                           </div>                                        
                       </div><!--end task-box--> 
                   @else
                      <div class="task-box">
                        <a href="{{url('main-case-cases/'.$excute->main_case_id)}}"  class=" float-right">
                            <button class="btn-sm btn-outline-dark btn-round">
                                <span>view case :   </span>
                                <span class="" style=" font-weight: bold; ">  {{$excute->main_case_id}} </span>  
                            </button>
                         </a>
                           <h5 class="mt-0" style="font-weight: bold;"> - {{$excute->excute_uid}} </h5>
                          <p class="text-muted mb-1">
                          -  {{$excute->subject}}  
                           </p>
                           <div style="display: block ruby;" class="mt-4">
                              <p class=" text-right mb-1">  Excute type : {{$excute->typeName}} </p>

                              <p class=" float-right mb-1 "> Excute date : {{$excute->excute_date}} </p>

                           </div>
                             
       
                           <hr>
                           
                           <div class="d-flex justify-content-between">
                           <a href="{{url('excute-details/'.$excute->excute_stage_id)}}">
                             <button class="btn btn-outline-dark waves-effect waves-light" >Details</button>
                           </a> 
                             
                             
                             <a href="{{url('excute-actions/'.$excute->excute_stage_id)}} ">
                               <button class="btn btn-outline-dark waves-effect waves-light">Excute actions</button>
                           </a>
                           
                          

                     
                        <a
                         href="{{url('excute-tasks/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-dark waves-effect waves-light" >Tasks</button>
                        </a>

                        <a href="{{url('excute-documents/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >Documents</button></a>

                        
                        <a href="{{url('delete-excute/'.$excute->excute_stage_id)}} ">
                            <button class="btn btn-outline-danger waves-effect waves-light">DELETE</button>
                        </a>
                          
                           </div>                                        
                       </div><!--end task-box--> 
                   @endif                                   
                   
               </div><!--end card-body-->
           </div><!--end card-->
       </div><!--end col-->
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
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-case-details')}}">
                    @csrf
              <div class="row">
                
        
                  <div class="col-12"> 
                      <div class="form-group row">
                               
                                 <div class="col-sm-4">
                                    <label id="add-stage-number"></label>
                                    <input class="form-control" name="case_uid" type="text" id="example-text-input">
                                </div>
                                
                                <div class="col-sm-4">
                                    <label id="add-stage-file-number"></label>
                                   <input class="form-control" name="file_id" value="{{$file_id}}" type="hidden"  id="example-text-input">
                                   <input class="form-control" disabled value="{{$file_id}}" type="text" id="example-text-input">

                                </div>

                                 <div class="col-sm-4">
                                    <label id="add-stage-case-number"></label>
                                   <input class="form-control" name="main_case_id" type="hidden" value="{{$main_case_id}} "  id="example-text-input">
                                   <input class="form-control" disabled value="{{$main_case_id}} " type="text" id="example-text-input">

                                                          
                                  </div>
                               
                             

                            </div>
          
                 </div>
                 <div class="col-12 mb-2"> 
                    <div class="form-group row">
                             
                               <div class="col-sm-4">
                                <label id="add-stage-request-number"></label>
                                <input class="form-control" name="request_number" type="text" id="example-text-input">
                              </div>
                              
                              <div class="col-sm-4">
                                <label id="add-stage-request-date"></label>
                                <input class="form-control" name="request_date"  type="date"  id="example-text-input">

                              </div>
                      </div>
        
               </div>
                   <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-4">
                          <label id="add-stage-client-type"></label>
                          <select class="custom-select" name="client_type">
                               @foreach ($client_type as $c_type)
                               <option value="{{$c_type->N_DetailedCode}}">{{$c_type->S_Desc_A}}</option>  
                               @endforeach
                               
                           </select>
                       </div>

                              <div class="col-sm-4">
                                  <label id="add-stage-stage"></label>
                                    <select class="custom-select" name="case_stage">
                                      @foreach ($case_stage as $case_stage)
                                      <option value="{{$case_stage->N_DetailedCode}}">{{$case_stage->S_Desc_A}}</option>  
                                      @endforeach 
                                      
                                  </select>
                              </div>
                                <div class="col-sm-4">
                                  <label id="add-stage-type"></label>
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
                            <label id="add-stage-admin"></label>
                            <select class="custom-select" name="lawyer_1">
                                      @foreach ($users as $user)
                                      <option value="{{$user->id}}">{{$user->name}}</option>  
                                      @endforeach 
                                      
                                  </select>
                              </div>

                         

                              <div class="col-sm-4">
                                <label id="add-stage-consult"></label>
                                <select class="custom-select" name="lawyer_2">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                    
                                </select>                               </div>
                               <div class="col-sm-4">
                                <label id="add-stage-lawyer"></label>
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
                      <label id="add-stage-court"></label>
                      <select class="custom-select" name="court">
                                  @foreach ($court as $courtt)
                                  <option value="{{$courtt->N_DetailedCode}}">{{$courtt->S_Desc_A}}</option>  
                                  @endforeach 
                              </select>
                          </div>

                     <div class="col-sm-6">
                      <label id="add-stage-dept"></label>
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
                          <label id="add-stage-expert"></label>
                          <select class="custom-select" name="expert_office">
                                      @foreach ($experts as $expert)
                                      <option value="{{$expert->N_Expert_ID}}">{{$expert->S_Expert_AR_NAME}}</option>  
                                      @endforeach 
                                      
                                  </select>
                              </div>

                         

                              <div class="col-sm-6">
                                  <label id="add-stage-fees"></label>
                                     <input class="form-control fraction-commas" name="fee" type="text">
                               </div>
                     </div>
                              
                              

                          </div>
          
                 </div>
                 <div class="col-12"> 
                    <label id="add-stage-info"></label>
                    <textarea class="form-control" name="more_info" rows="5" id="message"></textarea>
                    </div>

                     <div class="col-12 mt-3"> 
                      <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="add-add-new-stage-btn"></button>
                     </div> 
                  
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<div class="modal fade excute-stage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-excute-stage')}}" enctype="multipart/form-data">
                    @csrf
              <div class="row">
                <div class="col-12"> 
                    <div class="form-group row">
                             
                               <div class="col-sm-4">
                                  <label id="excute-client">اسم الموكل</label>
                                  <input class="form-control" disabled placeholder=" {{$client_name}} " type="text" id="example-text-input">
                              </div>
                              
                              <div class="col-sm-8">
                                 <label id="excute-against">الخصوم</label>
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
                               
                                 <div class="col-sm-4">
                                    <label id="excute-number"></label>
                                    <input class="form-control" name="excute_uid" type="text" id="example-text-input">
                                </div>
                                
                                <div class="col-sm-4">
                                    <label id="excute-file-number"></label>
                                    <input class="form-control" name="file_id" value="{{$file_id}}" type="hidden" type="text" id="example-text-input">
                                   <input class="form-control" disabled value="{{$file_id}}" type="text" id="example-text-input">

                                </div>

                                 <div class="col-sm-4">
                                    <label id="excute-case-number"></label>
                                    <input class="form-control" name="main_case_id" type="hidden" value="{{$main_case_id}} " type="text" id="example-text-input">
                                   <input class="form-control" disabled value="{{$main_case_id}} " type="text" id="example-text-input">

                                                          
                                  </div>
                               
                             

                            </div>
          
                 </div>
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-sm-4">
                                    <label id="excute-type"></label>
                                    <select class="custom-select" name="excute_type"> 
                                    @foreach ($excute_type as $excute)
                                    <option value="{{$excute->N_DetailedCode}}">{{$excute->S_Desc_A}}</option>  
                                    @endforeach 
                                    
                                </select>
                                </div>
                                  <div class="col-sm-4">
                                    <label id="excute-cliam"></label>
                                    <input class="form-control fraction-commas" name="cliam_amount" type="text" id="example-text-input">
                                </div>

                                <div class="col-sm-4">
                                    <label id="excute-date"></label>
                                    <input class="form-control" type="date" name="register_date"  id="example-text-input">
                                </div>
                               
                               

                            </div>
          
                 </div>

                 <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-sm-4">
                            <label id="excute-fees"></label>
                            <input class="form-control fraction-commas" name="excute_fee" type="text" id="example-text-input">

                              </div>
                              
                     </div>
                  </div>
             

               

                 <div class="col-12"> 
                      <div class="form-group row">
                               
                          <div class="col-sm-4">
                            <label id="excute-collected"></label>
                            <input class="form-control fraction-commas" name="collected_amount" type="text" id="example-text-input">
                                </div>

                           <div class="col-sm-4">
                            <label id="excute-expenss"></label>
                            <input class="form-control fraction-commas" name="case_cost" type="text" id="example-text-input">
                                </div>

                                <div class="col-sm-4">
                                    <label id="excute-office-fees"></label>
                                    <input class="form-control fraction-commas" name="office_cost" type="text" id="example-text-input">
                                 </div>
                       </div>
                                
                                

                            </div>
          
                 </div>
                 <div class="col-12"> 
                    <label for="noe_date" id="excute-subject"></label>
                    <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                    </div>

                     <div class="col-12 mt-3"> 
                        <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="excute-add-btn"></button>
                    </div> 
                  
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<div class="modal fade add-stage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-case-stage')}}">
                    @csrf
            <div class="row">
                <div class="col-md-6">
                      
                        
                       <div class="form-group">
                          

                           <div class="form-group">
                               <label id="hearing-count"></label>
                               <input disabled type="text" class="form-control" value=" {{$case_stages->count()}} " >
                               
                              
                           </div>

                      
                       </div>


                   </div>
                   <input type="hidden" class="form-control" name="case_id" value=" {{$case_id}} " >

                   <div class="col-md-6">
                   <div class="form-group">
                         
                       <div class="form-group">
                           <label id="hearing-type"></label>
                           <select class="custom-select" name="type">
                               @foreach ($stage_type as $type)
                               <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                               @endforeach 
                             </select>
                         
                       </div>

                          
                       </div>
                      

                   </div>
                   

           

           
     <div class="col-12"> <hr></div>
          <div class="col-lg-6">

           
           
           <div class="form-group">
               <label  id="hearing-now-date"></label>
               <input class="form-control" name="stage_date" type="date" id="now_date" required="">
          
           </div>
           
                  

                         <div class="form-group">
                           <label id="hearing-consult"></label>
                             <select class="custom-select" name="consult">
                               @foreach ($users as $user)
                               <option value="{{$user->id}}">{{$user->name}}</option>  
                               @endforeach 
                                   
                               </select>
                      
                       </div>
                         

                       <div class="form-group">
                           <label id="hearing-court"> </label>
                           <select class="custom-select" name="court">
                               @foreach ($court as $courtt)
                               <option value="{{$courtt->N_DetailedCode}}">{{$courtt->S_Desc_A}}</option>  
                               @endforeach 
                           </select>                               
                       </div>

                     <div class="form-group">
                           <label id="hearing-hall"></label>
                           <input type="text" class="form-control" id="now_date" name="hall">
                      
                       </div>

             </div>
             
             <div class="col-lg-6">

                 

                     <div class="form-group">
                           <label id="hearing-next-date"></label>
                           <input type="date" class="form-control"  name="next_date">
                      
                       </div>


                          <div class="form-group">
                           <label id="hearing-lawyer"></label>
                             <select class="custom-select"  name="lawyer">
                               @foreach ($users as $user)
                               <option value="{{$user->id}}">{{$user->name}}</option>  
                               @endforeach 
                               </select>
                      
                       </div>

                          <div class="form-group">
                           <label id="hearing-by"></label>
                             <input type="text"  class="form-control" disabled placeholder="المستخدم الحالي">
                      
                       </div>

                       <div class="form-group">
                           <label id="hearing-session"></label>
                             <select class="custom-select" name="session_type">
                                <option selected="اونلاين">
                                    اونلاين</option>
                                   <option value="حضوري">
                                       حضوري</option>
                                  
                               </select>
                      
                       </div>
             </div>

             <div class="col-lg-12">

                  <div class="form-group">
                           <label id="hearing-decission"></label>
                           <textarea class="form-control" name="decision_ar" rows="5" id="message"></textarea>
                      
                       </div>

                          <div class="form-group">
                           <label id="hearing-decission-eng"> </label>
                           <textarea class="form-control" name="decision_eng" rows="5" id="message"></textarea>
                      
                       </div>

                          <div class="form-group">
                           <label id="hearing-note"></label>
                           <textarea class="form-control" rows="5" name="notes" id="message"></textarea>
                      
                       </div>

                   

                        <button class="btn btn-primary my-4" type="submit" id="hearing-add-btn"> </button>
                        </div>

                                           
                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  

@foreach ($case_stages as $stage)
<div class="modal fade edit-stage-{{$stage->N_HEARING_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('edit-case-stage')}}">
                        @csrf
                        @if (Session::get('lang') == "ar")
                        <div class="row">
                    

                            <div class="col-lg-12">
                                <div class="col-sm-4 px-0">
                                    <label id="edit-stage-type"> نوع الجلسة</label>
                                    <select class="custom-select" name="type">
                                        <option value="{{$stage->typeCode}}">{{$stage->typeName}}</option>  
                                        @foreach ($stage_type as $type)
                                        <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                        @endforeach 
                                      </select>
                                 </div>
                                 <hr>
                            </div>
                           <div class="col-lg-6">
        
                            <input type="hidden" name="stage_id" id="" value="{{$stage->N_HEARING_ID}}">
                            
                            <div class="form-group">
                                <label id="edit-stage-now-date">تاريخ الجلسة </label>
                            <input  class="form-control" type="date" value="{{$stage->DT_HearingEnterDate}}" name="enter_date" id="now_date" >
                           
                            </div>
                            <div class="form-group">
                                <label id="edit-stage-consult">المستشار</label>
                                  <select class="custom-select" name="consult">
                                    <option value="{{$stage->consultId}}">{{$stage->consultName}}</option>  
        
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                        
                                    </select>
                           
                            </div>
                            
                            <div class="form-group">
                                <label id="edit-stage-court"> لدى محكمة</label>
                                <select class="custom-select" name="court">
                                    <option value="{{$stage->courtId}}">{{$stage->courtName}}</option>  
        
                                    @foreach ($court as $stage_court)
                                    <option value="{{$stage_court->N_DetailedCode}}">{{$stage_court->S_Desc_A}}</option>  
                                    @endforeach 
                                </select>                               
                            </div>
                                      <div class="form-group">
                                            <label id="edit-stage-hall"> القاعة</label>
                                            <input type="text" class="form-control" value="{{$stage->S_Hall}}"  name="hall" >
                                       
                                        </div>
        
                              </div>
                              
                              <div class="col-lg-6">
        
                                  
        
                                      <div class="form-group">
                                            <label id="edit-stage-next-date">تاريخ الجلسة القادمة</label>
                                            <input type="date" class="form-control" value="{{$stage->DT_HEARING_DATE}}" name="next_date" >
                                       
                                        </div>
                                        <div class="form-group">
                                            <label id="edit-stage-lawyer">المحامي المترافع</label>
                                              <select class="custom-select"  name="lawyer">
                                                <option value="{{$stage->lawyerId}}">{{$stage->lawyerName}}</option>  
        
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>  
                                                @endforeach 
                                                </select>
                                       
                                        </div>
                                        
                                    <div class="form-group">
                                        <label id="edit-stage-session">نوع الحضور</label>
                                          <select class="custom-select" name="session_type">
                                            <option selected value="{{$stage->sessiontype}}">
                                                {{$stage->sessiontype}}</option>
        
                                             <option value="اونلاين">
        
                                                 اونلاين</option>
                                                <option value="حضوري">
                                                    حضوري</option>
                                               
                                            </select>
                                   
                                    </div>
        
                              </div>
        
                              <div class="col-lg-12">
        
                                   <div class="form-group">
                                            <label id="edit-stage-decission">القرار الصادر</label>
                                            <textarea class="form-control" name="decision_ar"  rows="5" id="message">{{$stage->S_HEARING_DESIGION}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-decission-eng">القرار الصادر EG</label>
                                            <textarea class="form-control" name="decision_eng" rows="5" id="message">{{$stage->decision_eng}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-note">ملاحظات</label>
                                            <textarea class="form-control" rows="5" name="notes" id="message">{{$stage->S_Notes}}</textarea>
                                       
                                        </div>
        
                                    
        
                                         <button class="btn btn-primary my-4" type="submit" id="edit-stage-btn"> تعديل الجلسة </button>
                                         </div>
        
                                                            
                                 </div>  
                        @else
                           <div class="row">
                    

                            <div class="col-lg-12">
                                <div class="col-sm-4 px-0">
                                    <label id="edit-stage-type">Stage type</label>
                                    <select class="custom-select" name="type">
                                        <option value="{{$stage->typeCode}}">{{$stage->typeName}}</option>  
                                        @foreach ($stage_type as $type)
                                        <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                        @endforeach 
                                      </select>
                                 </div>
                                 <hr>
                            </div>
                           <div class="col-lg-6">
        
                            <input type="hidden" name="stage_id" id="" value="{{$stage->N_HEARING_ID}}">
                            
                            <div class="form-group">
                                <label id="edit-stage-now-date">Stage date </label>
                            <input  class="form-control" type="date" value="{{$stage->DT_HearingEnterDate}}" name="enter_date" id="now_date" >
                           
                            </div>
                            <div class="form-group">
                                <label id="edit-stage-consult">Consultant</label>
                                  <select class="custom-select" name="consult">
                                    <option value="{{$stage->consultId}}">{{$stage->consultName}}</option>  
        
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                        
                                    </select>
                           
                            </div>
                            
                            <div class="form-group">
                                <label id="edit-stage-court"> Court</label>
                                <select class="custom-select" name="court">
                                    <option value="{{$stage->courtId}}">{{$stage->courtName}}</option>  
        
                                    @foreach ($court as $stage_court)
                                    <option value="{{$stage_court->N_DetailedCode}}">{{$stage_court->S_Desc_A}}</option>  
                                    @endforeach 
                                </select>                               
                            </div>
                                      <div class="form-group">
                                            <label id="edit-stage-hall"> Hall</label>
                                            <input type="text" class="form-control" value="{{$stage->S_Hall}}"  name="hall" >
                                       
                                        </div>
        
                              </div>
                              
                              <div class="col-lg-6">
        
                                  
        
                                      <div class="form-group">
                                            <label id="edit-stage-next-date">Next stage date</label>
                                            <input type="date" class="form-control" value="{{$stage->DT_HEARING_DATE}}" name="next_date" >
                                       
                                        </div>
                                        <div class="form-group">
                                            <label id="edit-stage-lawyer">Lawyer</label>
                                              <select class="custom-select"  name="lawyer">
                                                <option value="{{$stage->lawyerId}}">{{$stage->lawyerName}}</option>  
        
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>  
                                                @endforeach 
                                                </select>
                                       
                                        </div>
                                        
                                    <div class="form-group">
                                        <label id="edit-stage-session">Atendance type</label>
                                          <select class="custom-select" name="session_type">
                                            <option selected value="{{$stage->sessiontype}}">
                                                {{$stage->sessiontype}}</option>
        
                                             <option value="اونلاين">
        
                                                 اونلاين</option>
                                                <option value="حضوري">
                                                    حضوري</option>
                                               
                                            </select>
                                   
                                    </div>
        
                              </div>
        
                              <div class="col-lg-12">
        
                                   <div class="form-group">
                                            <label id="edit-stage-decission">Decission AR</label>
                                            <textarea class="form-control" name="decision_ar"  rows="5" id="message">{{$stage->S_HEARING_DESIGION}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-decission-eng"> Decission ENG</label>
                                            <textarea class="form-control" name="decision_eng" rows="5" id="message">{{$stage->decision_eng}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-note">Notes</label>
                                            <textarea class="form-control" rows="5" name="notes" id="message">{{$stage->S_Notes}}</textarea>
                                       
                                        </div>
        
                                    
        
                                         <button class="btn btn-primary my-4" type="submit" id="edit-stage-btn">Update </button>
                                         </div>
        
                                                            
                                 </div> 
                        @endif
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
        
    @endforeach

    <div class="modal fade new-task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('add-case-task')}}">
                        @csrf
                        <input type="hidden" name="case_id" value=" {{$case_id}} "> 
                        <input type="hidden" name="main_case_id" value=" {{$main_case_id}} "> 

                  <div class="row">
                    
                    <div class="col-12"> 
                       <div class="form-group row">
                                
                                 <div class="col-sm-4">
                                  <label id="task-status"></label>
                                       <select class="custom-select" name="status">
                                         <option value="قيد التنفيذ">
                                             قيد التنفيذ
                                         </option>
                                         
                                     </select>
                                 </div>
                                   <div class="col-sm-4">
                                    <label id="task-type"></label>
                                       <select disabled class="custom-select" name="type">
                                     <option value="1">مهمة دعوى</option>
                                     </select>
                                 </div>
                                   <div class="col-sm-4">
                                    <label id="task-charge"></label>
                                       <select class="custom-select" name="assignTo">
                                         @foreach ($users as $user)
                                         <option value="{{$user->id}}">{{$user->name}} </option>
                                             
                                         @endforeach
                                         
                                     </select>
                                 </div>
                                   
                                

                             </div>
           
                  </div>
                  
                        <div class="col-12"> 
                       <div class="form-group row">
                                
                            <div class="col-sm-4">
                             <label id="task-start"></label>
                               <input class="form-control" type="date" name="doing_date" id="example-text-input">
                          </div>

                           <div class="col-sm-4">
                                    <label id="task-end"></label>
                                     <input class="form-control" type="date" name="wanted_date" id="example-text-input">
                                 </div>


                                 <div class="col-sm-4">
                                     <label id="task-excute"></label>
                                       <input class="form-control" name="excute_date" type="date"  id="example-text-input">
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
                           <label id="task-follow"></label>
                           <select class="custom-select" name="follower">
                             @foreach ($users as $user)
                             <option value="{{$user->id}}">{{$user->name}} </option>
                                 
                             @endforeach
                             
                         </select>
                        </div>

                        <div class="col-sm-4">
                         <label id="task-by"></label>
                         <input class="form-control" disabled value=" {{ auth()->user()->name }} " type="text" id="example-text-input">

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
                     
                          <button class="btn btn-sm btn-primary mr-1 font-15" id="task-add-btn"></button>
                  </div> 
                   

                     </div>
                    </form> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    @foreach ($case_tasks as $case_task)
    
    <div class="modal fade status_{{$case_task->N_TASK_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style=" display: block; ">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-task-status')}}">
                        @csrf
                        <input type="hidden" name="task_id" value="{{$case_task->N_TASK_ID}}">
                        <input type="hidden" name="follower" value="{{$case_task->follower}}">

                  <div class="row">
                      
                                   
                    @if (Session::get('lang') == "ar")
                    <div class="col-12"> 
                        <div class="form-group row">
                    <div class="col-sm-6">
                        <label > <span id="update-task-label">حالة المهمة الحالية - </span> ({{$case_task->N_Status}})</label>
                         <select class="custom-select" name="task_status">
                            <option value="قيد التنفيذ">
                                قيد التنفيذ
                            </option>
                            
                            <option value="اكتملت">
                                 اكتلمت
                            </option>
                            <option value="مؤجل">
                                مؤجل 
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="">ملاحظات اخرى</label>
                        <input type="text" name="review" value="{{$case_task->N_Reviewed}}"  class="form-control">
                    </div>
                </div>
             </div>

            <div class="col-12">
                    <button class="btn btn-sm btn-primary mr-1 font-15" id="update-task-btn">تحديث</button>
                </div>

                    @else
                    <div class="col-12"> 
                        <div class="form-group row">
                    <div class="col-sm-6">
                        <label > <span id="update-task-label">Current task status - </span> ({{$case_task->N_Status}})</label>
                         <select class="custom-select" name="task_status">
                            

                            <option value="قيد التنفيذ">
                                on going
                             </option>
                             
                             <option value="اكتملت">
                                  complete
                             </option>

                             <option value="مؤجل">
                                 canceld 
                             </option>
                             
                            
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="">ملاحظات اخرى</label>
                        <input type="text" name="review" value="{{$case_task->N_Reviewed}}"  class="form-control">
                    </div>
                </div>
             </div>

            <div class="col-12">
                    <button class="btn btn-sm btn-primary mr-1 font-15" id="update-task-btn">update</button>
                </div> 
                    @endif
                           
              

                 </div>
                    </form> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
    @endforeach

    <div class="modal fade add-doc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{ route('add-case-document') }}" enctype="multipart/form-data">
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

    <div class="modal fade case-require" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title" id="prepair-title">متطلبات القضية</h4>

                                <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                    <tr>
                                    <th  style="width: 180px;" id="th-1">المتطلبات</th>
                                        <th  style="width: 180px;" id="th-2">التاريخ</th>
                                        <th style="width: 250px;" id="th-3">التوضيح</th>
                                        <th  style="width: 150px;" id="th-4">المكلف</th>
                                        <th  style="width: 190px;" id="th-5">المستند</th>
                                        <th  style="width: 120px;" id="th-6">الحالة</th>
                                        <th style="width: 100px;" id="th-7">تحديث</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($case_requires as $require)
                                    <form class="form"  method="POST" action="{{route('update-require')}}" enctype="multipart/form-data">
                                        @csrf
                                
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="name" value=" {{$require->require_name}} " id="">
                                            </td>
                                        <td>
                                            <input type="date"  class="form-control" name="date" value="{{$require->wanted_date}}"> 
                                             </td>
                                        <td> 
                                            <input type="text"  class="form-control" name="desc" value="{{$require->description}}">
                                           
                                         </td>
                                        <td>

                                            <select class="custom-select" name="assign">
                                                <option value="{{$require->assignID}}">{{$require->assignName}} </option>
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} </option>
                                                    
                                                @endforeach
                                                
                                            </select>    
                                        </td>
                                        <td>
                                            @if ($require->file)
                                            <a href="../../../assets/case-requires/{{$require->main_case_id}}/{{$require->file}}" class="download-icon-link" download>
                                                <i class="dripicons-download file-download-icon ml-2"></i> تحميل
                                            </a>
                                            @else
                                            <input type="file"  class="form-control" name="file" value="{{$require->file}}" id="">

                                            @endif

                                            
                                             </td>
                                        <td></td>
                                        <td class="text-center">
                                           <a type="submit" class="ml-3">
                                        <button type="submit" class="btn-sm btn-light">
                                            <i class="fas fa-edit text-info "></i>
                                        </button>
                                    </a>
                                        </td>
                                        <input type="hidden" name="require_id" value="{{$require->require_id}}" id="">
                                        <input type="hidden" name="main_case_id" value="{{$require->main_case_id}}" id="">

                                    </tr>
                                    </form>
                                    @endforeach
                                    
                                </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div> <!-- end row -->
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
    document.getElementById("breadcrumb-2").innerHTML = 'القضايا' ;
    document.getElementById("breadcrumb-3").innerHTML = "دعاوى القضية"; 

    document.getElementById("page-name").innerHTML = "دعاوى القضية";

    document.getElementById("file-number-box").innerHTML = "رقم الملف";
    document.getElementById("case-number-box").innerHTML = "رقم القضية";
    document.getElementById("stages-number-box").innerHTML = "عدد الدعاوى";

    document.getElementById("details-tap").innerHTML = "البيانات";
    document.getElementById("memoir-tap").innerHTML = "المذكرات";
    document.getElementById("hearings-tap").innerHTML = "الجلسات";
    document.getElementById("tasks-tap").innerHTML = "المهام";
    document.getElementById("docs-tap").innerHTML = "المستندات";


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
    document.getElementById("update-details").innerHTML = "تحديث ";

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

    document.getElementById("new-memoir").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> إضافة طلب مذكرة';


    document.getElementById("memoir-need").innerHTML = 'الاجراء المطلوب';
    document.getElementById("memoir-date").innerHTML = 'تاريخ التنفيذ';
    document.getElementById("consult").innerHTML = 'المستشار';
    document.getElementById("status").innerHTML = 'الحالة';
    document.getElementById("created-by").innerHTML = 'بواسطة';
    document.getElementById("add-btn").innerHTML = 'اضافة مذكرة';

    document.getElementById("new-stage").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة جلسة'; 
    if ( document.getElementById("badge")) {
        document.getElementById("badge").classList.add("float-left"); 
    }
  

    document.getElementById("hearing-count").innerHTML = "عدد الجلسات الحالي"; 
    document.getElementById("hearing-type").innerHTML = "نوع الجلسة"; 
    document.getElementById("hearing-now-date").innerHTML = "تاريخ الجلسة الحالي"; 
    document.getElementById("hearing-consult").innerHTML = "المستشار"; 
    document.getElementById("hearing-next-date").innerHTML = "تاريخ الجلسة القادمة"; 
    document.getElementById("hearing-lawyer").innerHTML = "المحامي المترافع"; 
    document.getElementById("hearing-court").innerHTML = "المحكمة"; 
    document.getElementById("hearing-by").innerHTML = "بواسطة"; 
    document.getElementById("hearing-hall").innerHTML = "القاعة"; 
    document.getElementById("hearing-session").innerHTML = "نوع الحضور"; 
    document.getElementById("hearing-decission").innerHTML = "القرار الصادر عربي"; 
    document.getElementById("hearing-decission-eng").innerHTML = "القرار الصادر انجليزي"; 
    document.getElementById("hearing-note").innerHTML = "ملاحظات"; 
    document.getElementById("hearing-add-btn").innerHTML = "<span class='mdi mdi-plus-box mx-2'></span>اضافة جلسة"; 





    document.getElementById("new-task-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> إضافة مهمة جديدة';

document.getElementById("task-status").innerHTML = "حالة المهمة";
document.getElementById("task-type").innerHTML = "نوع المهمة";
document.getElementById("task-charge").innerHTML = "القائم بالمهمة";
document.getElementById("task-start").innerHTML = "تاريخ البداية";
document.getElementById("task-end").innerHTML = "تاريخ التسليم";
document.getElementById("task-excute").innerHTML = "تاريخ التنفيذ";
document.getElementById("task-name").innerHTML = "اسم المهمة";
document.getElementById("task-follow").innerHTML = "المتابع";
document.getElementById("task-by").innerHTML = "بواسطة";
document.getElementById("task-desc").innerHTML = "وصف المهمة";
document.getElementById("task-note").innerHTML = "ملاحظات";
document.getElementById("task-add-btn").innerHTML = "اضافة";


    document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة مستند';

    document.getElementById("docs-type").innerHTML = "انواع المستندات";
    document.getElementById("stage-docs").innerHTML = "مستندات الدعوى";
    document.getElementById("all-docs").innerHTML = "كل المستندات";
    document.getElementById("size").innerHTML = "حجم الملفات الكلي : 22.86 GB";
    document.getElementById("all-docs-title").innerHTML = "كل المستندات";
    document.getElementById("all-stage-docs-title").innerHTML = "مستندات الدعوى";

    document.getElementById("doc-main-case-number").innerHTML = "رقم القضية";
    document.getElementById("doc-number").innerHTML = "رقم المستند";
    document.getElementById("doc-attach").innerHTML = "تحميل المستند";
    document.getElementById("doc-name-ar").innerHTML = "اسم المستند عربي";
    document.getElementById("doc-name-eng").innerHTML = "اسم المستند انجليزي";
    document.getElementById("doc-v").innerHTML = "رقم النسخة";
    document.getElementById("doc-date").innerHTML = "تاريخ المستند";
    document.getElementById("doc-subject").innerHTML = "موضوع المستند";
    document.getElementById("doc-add-btn").innerHTML = "اضافة مستند";

    document.getElementById("client-docs").innerHTML = "مستندات العميل";
    document.getElementById("all-client-docs-title").innerHTML = "مستندات العميل";


    if ( document.getElementById("add-stage-btn")) {
    document.getElementById("add-stage-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة مرحلة';
}
    document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-court").innerHTML = "المحكمة ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";

    document.getElementById("add-stage-number").innerHTML = "رقم الدعوى ";
    document.getElementById("add-stage-file-number").innerHTML = "رقم الملف ";
    document.getElementById("add-stage-case-number").innerHTML = "رقم القضية ";
    document.getElementById("add-stage-request-number").innerHTML = "رقم الطلب الالكتروني ";
    document.getElementById("add-stage-request-date").innerHTML = "تاريخ الطلب الالكتروني ";
    document.getElementById("add-stage-client-type").innerHTML = "صفة الموكل ";
    document.getElementById("add-stage-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("add-stage-type").innerHTML = "نوع الدعوى ";
    document.getElementById("add-stage-admin").innerHTML = "المكلف الاداري ";
    document.getElementById("add-stage-consult").innerHTML = "المستشار ";
    document.getElementById("add-stage-lawyer").innerHTML = "المحامي المترافع ";
    document.getElementById("add-stage-court").innerHTML = "المحكمة ";
    document.getElementById("add-stage-dept").innerHTML = "الدائرة ";
    document.getElementById("add-stage-expert").innerHTML = "مكتب الخبراء ";
    document.getElementById("add-stage-fees").innerHTML = "رسوم الدعوى ";
    document.getElementById("add-stage-info").innerHTML = "معلومات الدعوى ";
    document.getElementById("add-add-new-stage-btn").innerHTML = "اضافة دعوى ";


    if ( document.getElementById("add-excute")) {
    document.getElementById("add-excute").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة تنفيذ';
}

document.getElementById("excute-client").innerHTML = "الموكل";
document.getElementById("excute-against").innerHTML = "الخصوم";

    document.getElementById("excute-number").innerHTML = "رقم التنفيذ";
document.getElementById("excute-file-number").innerHTML = "رقم الملف";
document.getElementById("excute-case-number").innerHTML = "رقم القضية";
document.getElementById("excute-type").innerHTML = "نوع الخدمة";
document.getElementById("excute-cliam").innerHTML = "مبلغ التنفيذ (مبلغ المطالبة)";
document.getElementById("excute-date").innerHTML = "تاريخ تسجيل التنفيذ";
document.getElementById("excute-fees").innerHTML = "رسوم التنفيذ";
document.getElementById("excute-collected").innerHTML = "المبالغ المحصلة";
document.getElementById("excute-expenss").innerHTML = "مصروفات القضية";
document.getElementById("excute-office-fees").innerHTML = "اتعاب المكتب";
document.getElementById("excute-subject").innerHTML = "موضوع التنفيذ";
document.getElementById("excute-add-btn").innerHTML = "اضافة تنفيذ";

if ( document.getElementById("add-require")) {
document.getElementById("add-require").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> اعداد القضية';
}
if (document.getElementById("close-case")) {
    document.getElementById("close-case").innerHTML = '<i class=""></i>  اغلاق القضية';
}

if (document.getElementById("open-case")) {
    document.getElementById("open-case").innerHTML = '<i class=""></i>  فتح القضية';
}


document.getElementById("prepair-title").innerHTML = "متطلبات القضية";

document.getElementById("th-1").innerHTML = "المتطلبات";
document.getElementById("th-2").innerHTML = "التاريخ ";
document.getElementById("th-3").innerHTML = "التوضيح ";
document.getElementById("th-4").innerHTML = "المكلف ";
document.getElementById("th-5").innerHTML = "المستند ";
document.getElementById("th-6").innerHTML = "الحالة ";
document.getElementById("th-7").innerHTML = "تحديث ";


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
    document.getElementById("memoir-tap").innerHTML = "Memoir";
    document.getElementById("hearings-tap").innerHTML = "Hearings";
    document.getElementById("tasks-tap").innerHTML = "Tasks";
    document.getElementById("docs-tap").innerHTML = "Documents";

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
    document.getElementById("update-details").innerHTML = "Update ";

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

    document.getElementById("new-memoir").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> Add new memoir';

    document.getElementById("memoir-need").innerHTML = 'Memoir type';
    document.getElementById("memoir-date").innerHTML = 'Excute date';
    document.getElementById("consult").innerHTML = 'Consultant';
    document.getElementById("status").innerHTML = 'Status';
    document.getElementById("created-by").innerHTML = 'Created by';
    document.getElementById("add-btn").innerHTML = 'Add';

    document.getElementById("new-stage").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add new stage'; 
    if ( document.getElementById("badge")) {
    document.getElementById("badge").classList.add("float-right"); 
    }

    document.getElementById("hearing-count").innerHTML = "Number of stages"; 
    document.getElementById("hearing-type").innerHTML = "Stage type"; 
    document.getElementById("hearing-now-date").innerHTML = "Stage date"; 
    document.getElementById("hearing-consult").innerHTML = "Consultant"; 
    document.getElementById("hearing-next-date").innerHTML = "Next stage date"; 
    document.getElementById("hearing-lawyer").innerHTML = "Lawyer"; 
    document.getElementById("hearing-court").innerHTML = "Court"; 
    document.getElementById("hearing-by").innerHTML = "Created by"; 
    document.getElementById("hearing-hall").innerHTML = "Hall"; 
    document.getElementById("hearing-session").innerHTML = "Session type"; 
    document.getElementById("hearing-decission").innerHTML = "Decission ar"; 
    document.getElementById("hearing-decission-eng").innerHTML = "Decission eng"; 
    document.getElementById("hearing-note").innerHTML = "Notes"; 
    document.getElementById("hearing-add-btn").innerHTML = "<span class='mdi mdi-plus-box mx-2'></span>Add stage";



    document.getElementById("new-task-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> Add new task';

document.getElementById("task-status").innerHTML = "Task status";
document.getElementById("task-type").innerHTML = "Task type";
document.getElementById("task-charge").innerHTML = "Assign to";
document.getElementById("task-start").innerHTML = "Start date";
document.getElementById("task-end").innerHTML = "End date";
document.getElementById("task-excute").innerHTML = "Excute date";
document.getElementById("task-name").innerHTML = "Task name";
document.getElementById("task-follow").innerHTML = "Following person";
document.getElementById("task-by").innerHTML = "Created by";
document.getElementById("task-desc").innerHTML = "Description";
document.getElementById("task-note").innerHTML = "Notes";
document.getElementById("task-add-btn").innerHTML = "Add";


 document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add document';

document.getElementById("docs-type").innerHTML = "Documents type";
document.getElementById("stage-docs").innerHTML = "Stage documents";
document.getElementById("all-docs").innerHTML = "All documents";
document.getElementById("size").innerHTML = "Documents size : 22.86 GB";
document.getElementById("all-docs-title").innerHTML = "All documents";
document.getElementById("all-stage-docs-title").innerHTML = "Stage documents";

    document.getElementById("client-docs").innerHTML = "Client Documents";
    document.getElementById("all-client-docs-title").innerHTML = "Client Documents";

document.getElementById("doc-main-case-number").innerHTML = "Main case number";
document.getElementById("doc-number").innerHTML = "Doc number";
document.getElementById("doc-attach").innerHTML = "Attach doc";
document.getElementById("doc-name-ar").innerHTML = "Doc name AR";
document.getElementById("doc-name-eng").innerHTML = "Doc name ENG";
document.getElementById("doc-v").innerHTML = "Doc version";
document.getElementById("doc-date").innerHTML = "Doc date";
document.getElementById("doc-subject").innerHTML = "Doc subject";
document.getElementById("doc-add-btn").innerHTML = "Add doc";


if ( document.getElementById("add-stage-btn")) {
    document.getElementById("add-stage-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add stage';
}
    document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-court").innerHTML = "Case court ";
    document.getElementById("cases-search-btn").innerHTML = "search ";

    document.getElementById("add-stage-number").innerHTML = "Stage number ";
    document.getElementById("add-stage-file-number").innerHTML = "File number";
    document.getElementById("add-stage-case-number").innerHTML = "Case number ";
    document.getElementById("add-stage-request-number").innerHTML = "Online request number ";
    document.getElementById("add-stage-request-date").innerHTML = "Online request date ";
    document.getElementById("add-stage-client-type").innerHTML = "Client adjective ";
    document.getElementById("add-stage-stage").innerHTML = "Stage level ";
    document.getElementById("add-stage-type").innerHTML = "Stage type ";
    document.getElementById("add-stage-admin").innerHTML = "Adminstrative charge ";
    document.getElementById("add-stage-consult").innerHTML = "Consultant ";
    document.getElementById("add-stage-lawyer").innerHTML = "Lawyer ";
    document.getElementById("add-stage-court").innerHTML = "Court ";
    document.getElementById("add-stage-dept").innerHTML = "Departments of jurisdiction  ";
    document.getElementById("add-stage-expert").innerHTML = "Expert office";
    document.getElementById("add-stage-fees").innerHTML = "Stage fees ";
    document.getElementById("add-stage-info").innerHTML = "Stage info. ";
    document.getElementById("add-add-new-stage-btn").innerHTML = "Add stage ";


    if ( document.getElementById("add-excute")) {
    document.getElementById("add-excute").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i>  Add excute';
    }
  
document.getElementById("excute-client").innerHTML = "Client";
document.getElementById("excute-against").innerHTML = "Againsts";
document.getElementById("excute-number").innerHTML = "Excute number";
document.getElementById("excute-file-number").innerHTML = "File number";
document.getElementById("excute-case-number").innerHTML = "Main case number";
document.getElementById("excute-type").innerHTML = "Excute type";
document.getElementById("excute-cliam").innerHTML = "Cliam amount";
document.getElementById("excute-date").innerHTML = "Excute date";
document.getElementById("excute-fees").innerHTML = "Excute fees";
document.getElementById("excute-collected").innerHTML = "Collected amount";
document.getElementById("excute-expenss").innerHTML = "Case fees";
document.getElementById("excute-office-fees").innerHTML = "Office fees";
document.getElementById("excute-subject").innerHTML = "Subject";
document.getElementById("excute-add-btn").innerHTML = "Add excute";

if ( document.getElementById("add-require")) {
document.getElementById("add-require").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> case prepair';
}
if (document.getElementById("close-case")) {
    document.getElementById("close-case").innerHTML = '<i class=""></i>  CLOSE case';
}

if (document.getElementById("open-case")) {
    document.getElementById("open-case").innerHTML = '<i class=""></i>  OPEN case';
}
document.getElementById("prepair-title").innerHTML = "CASE PREPAIR";

document.getElementById("th-1").innerHTML = "Name";
document.getElementById("th-2").innerHTML = "Date ";
document.getElementById("th-3").innerHTML = "Description ";
document.getElementById("th-4").innerHTML = "Assign to ";
document.getElementById("th-5").innerHTML = "Document ";
document.getElementById("th-6").innerHTML = "Status ";
document.getElementById("th-7").innerHTML = "Update ";

document.getElementById("th1-1").innerHTML = "stage number ";
document.getElementById("th1-2").innerHTML = "stage type ";
document.getElementById("th1-3").innerHTML = "stage level ";
document.getElementById("th1-4").innerHTML = "view case ";

document.getElementById("linked-cases-title").innerHTML = "Linked cases ";
document.getElementById("excutes-title").innerHTML = "Excutes ";
      }
</script>
    
@endsection