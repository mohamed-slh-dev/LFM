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
         
     </div><!--end row-->

     <div class="modal fade new-task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('client-assign-task')}}">
                        @csrf
                        <input type="hidden" name="case_id" value="{{$case_id}}">
                        <input type="hidden" name="main_case_id" value="{{$main_case_id}}">

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
   
@endsection

@section('page-script')
    
<script>
  if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('main-case-cases/'.$main_case_id)}}">القضية {{$main_case_id}} </a>' ;
    document.getElementById("breadcrumb-3").innerHTML = "مهام الدعوى"; 

    document.getElementById("page-name").innerHTML = "مهام الدعوى";

    document.getElementById("new-task-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> إضافة مهمة جديدة';

 document.getElementById("task-doc").innerHTML = "مستندات";
document.getElementById("task-start").innerHTML = "تاريخ البداية";
document.getElementById("task-end").innerHTML = "تاريخ التسليم";
document.getElementById("task-name").innerHTML = "اسم المهمة";
document.getElementById("task-desc").innerHTML = "وصف المهمة";
document.getElementById("task-note").innerHTML = "ملاحظات";
document.getElementById("task-add-btn").innerHTML = "اضافة";

 

    



  }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('main-case-cases/'.$main_case_id)}}">case {{$main_case_id}} </a>' ;
    document.getElementById("breadcrumb-1").innerHTML = "case tasks" ;


    document.getElementById("page-name").innerHTML = "CASE TASKS";

    document.getElementById("new-task-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> Add new task';

    document.getElementById("task-doc").innerHTML = "Documents";
document.getElementById("task-start").innerHTML = "Start date";
document.getElementById("task-end").innerHTML = "End date";
document.getElementById("task-name").innerHTML = "Task name";
document.getElementById("task-desc").innerHTML = "Description";
document.getElementById("task-note").innerHTML = "Notes";
document.getElementById("task-add-btn").innerHTML = "Add";

  }
</script>

@endsection