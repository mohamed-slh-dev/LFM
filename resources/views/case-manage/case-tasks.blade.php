@extends('layouts.main-layout')

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

    <div class="col-lg-12">
         
        <div class="card client-card"> 
          <form class="form"  method="POST" action="{{route('cases-tasks')}}">
              @csrf                                  
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-12">
                    <div class="row">
                      <div class="col-2  ">
                          <div class="form-group row">
                        <label for="example-text-input" class="col-4 col-form-label text-center px-0" id="search-end-date">تاريخ التسليم</label>
                        <div class="col-8">
                         <input type="date" name="end_date"  class="form-control ">
                        </div>
                    </div>
                           
             </div>
             <div class="col-3  ">
              <div class="form-group row">
            <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="search-created-by">بواسطة</label>
            <div class="col-sm-8">
              <select class="custom-select text-right" name="create_by">
                  <option value="0"></option>
                  @foreach ($users as $user)
                  <option value="{{$user->id}}">{{$user->name}} </option>
                  @endforeach
             
                </select>
            </div>
        </div>
               
 </div>

             
                  <div class="col-3 ">
                          <div class="form-group row">
                           <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="search-assign-to">القائم بالمهمة</label>
                           <div class="col-sm-8">
                             <select class="custom-select text-right" name="assignTo">
                              <option value="0"></option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}} </option>
                              @endforeach
                                   
                               </select>
                           </div>
                       </div>
                              
                </div>
                  <div class="col-3 ">
                            <div class="form-group row">
                           <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="search-status">حالة المهمة</label>
                           <div class="col-sm-8">
                             <select class="custom-select text-right" name="task_status">
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
                       </div>
                              
                </div>
        

                  

            <div class="col-1">
             <button class="btn btn-success waves-effect waves-light mx-3" id="search-btn"> بحث </button>
            </div>
                </div>
                 </div>
          

                           
                          
                        
                </div>

          </div>
          </form>
       </div>      
  </div>
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
         
     </div><!--end row-->

     <div class="modal fade new-task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
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
                                     <label id="task-status">الحالة</label>
                                          <select class="custom-select" name="status">
                                            <option value="قيد التنفيذ">
                                                قيد التنفيذ
                                            </option>
                                            
                                        </select>
                                    </div>
                                      <div class="col-sm-4">
                                       <label id="task-type">نوع المهمة</label>
                                          <select disabled class="custom-select" name="type">
                                        <option value="1">مهمة دعوى</option>
                                        </select>
                                    </div>
                                      <div class="col-sm-4">
                                       <label id="task-charge">القائم بالمهمة</label>
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
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               
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
                                <input type="text" name="review" value="{{$case_task->N_Reviewed}}" class="form-control">
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
                                        canceled 
                                     </option>
                                     
                                    
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Other Notes</label>
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

    document.getElementById("search-end-date").innerHTML = "تاريخ التسليم";
    document.getElementById("search-created-by").innerHTML = "بواسطة";
    document.getElementById("search-assign-to").innerHTML = "القائم بالمهمة";
    document.getElementById("search-status").innerHTML = "حالة المهمة";
    document.getElementById("search-btn").innerHTML = "بحث";

    



  }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('main-case-cases/'.$main_case_id)}}">case {{$main_case_id}} </a>' ;
    document.getElementById("breadcrumb-1").innerHTML = "case tasks" ;


    document.getElementById("page-name").innerHTML = "CASE TASKS";

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

    document.getElementById("search-end-date").innerHTML = "End date";
    document.getElementById("search-created-by").innerHTML = "Created by";
    document.getElementById("search-assign-to").innerHTML = "Assign to";
    document.getElementById("search-status").innerHTML = "Task status";
    document.getElementById("search-btn").innerHTML = "search";

  }
</script>

@endsection