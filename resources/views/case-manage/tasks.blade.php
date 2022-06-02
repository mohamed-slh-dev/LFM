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
                    <select class="custom-select text-center" name="create_by">
                        <option value="all"></option>
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
                                   <select class="custom-select text-center" name="assignTo">
                                    <option value="all"></option>

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
                                   <select class="custom-select text-center" name="task_status">
                                       <option value="all"></option>

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
              

                        

                  <div class="col-1 ">
                    <button class="btn btn-success waves-effect waves-light mx-3" id="search-btn"> بحث </button>
                </div>
                      </div>
                       </div>
                

                                 
                                
                              
                      </div>

                </div>
                </form>
             </div>      
        </div>
        @foreach ($tasks as $task)
            
         <div class="col-lg-6">
             <div class="card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">
                 <div class="card-body">                                    
                     <div class="task-box">
                        <div class="task-priority-icon">
                            @if ($task->N_Status == "اكتملت")
                             <i class="fas fa-circle text-success"></i> 
                            @endif
                            @if ($task->N_Status == "قيد التنفيذ")
                           <i class="fas fa-circle text-warning"></i> 
                            @endif
                            @if ($task->N_Status == "مؤجل")
                            <i class="fas fa-circle text-danger"></i>  
                            @endif
                            
                            </div>    
                            @if (Session::get('lang') == "ar")
                            <p class=" float-left">
                                <span><i class="far fa-fw fa-clock mx-1"></i> تاريخ الاسناد : {{$task->DT_DATE_STARTWORK}} </span>
                                /
                                <span><i class="far fa-fw fa-clock mx-1"></i> تاريخ التسليم : {{$task->DT_WANTED}} </span>
                            </p>
                            <h5 class="mt-0"> - {{$task->S_NOTES}}</h5>
                            <p class="text-muted mb-1">
                               - {{$task->S_SUBJECT }}
                            </p>
                            <p class="text-muted mb-1">
                                - ملاحظات عند التحديث : {{$task->N_Reviewed }}
                             </p>
                            <div class="row">
                            <div class="col-6">
                              <p class="text-muted text-right mb-1 mt-3">بواسطة :  {{$task->createBy }}</p>
                            </div>
                            <div class="col-6">
                               <p class="text-muted text-left mb-1 mt-3">القائم بالمهمة : {{$task->assignTo }}</p>
                            </div>
                           
                            </div>
                           
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div class="img-group">
                                    <a href="{{url('main-case-cases/'.$task->N_CASE_ID.'/'.$task->N_CASE_DETAILS_ID)}}"  >
                                        <button class="btn-sm btn-outline-dark btn-round">
                                            <span>عرض الدعوى :   </span>
                                            <span class="" style=" font-weight: bold; ">  {{$task->case_uid}} </span>  
                                        </button>
                                     </a> 
                                       
                                </div><!--end img-group--> 
                                <ul class="list-inline mb-0 align-self-center">                                                                    
                                    <li class="list-item d-inline-block mr-2">
                                       
                                    </li>
                                    <li class="list-item d-inline-block float-right">
                                                                                                                
                                    </li>
                                    <li class="list-item d-inline-block">
   
                                    <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".status_{{$task->N_TASK_ID}}">
                                            <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                        </a>                                                                               
                                    </li>
                                    <li class="list-item d-inline-block">
                                        <a class="" href="{{url('delete-task/'.$task->N_TASK_ID)}}">
                                            <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                        </a>                                                                               
                                    </li>
                                </ul>
                            </div>
                            @else
                            <p class=" float-right">
                                <span><i class="far fa-fw fa-clock mx-1"></i>Start date : {{$task->DT_DATE_STARTWORK}} </span>
                                /
                                <span><i class="far fa-fw fa-clock mx-1"></i>End date : {{$task->DT_WANTED}} </span>
                            </p>
                            <h5 class="mt-0"> - {{$task->S_NOTES}}</h5>
                            <p class="text-muted mb-1">
                               - {{$task->S_SUBJECT }}
                            </p>

                            <p class="text-muted mb-1">
                                - Status Notes : {{$task->N_Reviewed }}
                             </p>
                            <div class="row">
                            <div class="col-6">
                              <p class="text-muted text-left mb-1 mt-3">Created by :  {{$task->createBy }}</p>
                            </div>
                            <div class="col-6">
                               <p class="text-muted text-right mb-1 mt-3">Assign to : {{$task->assignTo }}</p>
                            </div>
                           
                            </div>
                           
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div class="img-group">
                                    <a href="{{url('main-case-cases/'.$task->N_CASE_ID.'/'.$task->N_CASE_DETAILS_ID)}}"  >
                                        <button class="btn-sm btn-outline-dark btn-round">
                                            <span>View case :   </span>
                                            <span class="" style=" font-weight: bold; ">  {{$task->case_uid}} </span>  
                                        </button>
                                     </a> 
                                </div><!--end img-group--> 
                                <ul class="list-inline mb-0 align-self-center">                                                                    
                                    <li class="list-item d-inline-block mr-2">
                                       
                                    </li>
                                    <li class="list-item d-inline-block">
                                                                                                                   
                                    </li>
                                    <li class="list-item d-inline-block">
   
                                    <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".status_{{$task->N_TASK_ID}}">
                                            <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                        </a>                                                                               
                                    </li>
                                    <li class="list-item d-inline-block">
                                        <a class="" href="{{url('delete-task/'.$task->N_TASK_ID)}}">
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
     <div class="float-left mt-4">
        {{ $tasks->links() }}
        
        </div>

     @foreach ($tasks as $task)
    
     <div class="modal fade status_{{$task->N_TASK_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header" style=" display: block; ">
                     
                     <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                 </div>
                 <div class="modal-body">
                     <form class="form"  method="POST" action="{{route('update-task-status')}}">
                         @csrf
                         <input type="hidden" name="task_id" value="{{$task->N_TASK_ID}}">
                   <div class="row">
                      
                                   
                    @if (Session::get('lang') == "ar")
                    <div class="col-12"> 
                        <div class="form-group row">
                    <div class="col-sm-6">
                        <label > <span id="update-task-label">حالة المهمة الحالية - </span> ({{$task->N_Status}})</label>
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
                        <input type="text" name="review"  value="{{$task->N_Reviewed}}" class="form-control">
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
                        <label > <span id="update-task-label">Current task status - </span> ({{$task->N_Status}})</label>
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
                        <label for="">Other Notes</label>
                        <input type="text" name="review" value="{{$task->N_Reviewed}}"  class="form-control">
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
    document.getElementById("breadcrumb-1").innerHTML = 'ادارة القضايا' ;
    document.getElementById("breadcrumb-2").innerHTML = "مهام الدعوى"; 

    document.getElementById("page-name").innerHTML = "مهام الدعوى";


    document.getElementById("search-end-date").innerHTML = "تاريخ التسليم";
    document.getElementById("search-created-by").innerHTML = "بواسطة";
    document.getElementById("search-assign-to").innerHTML = "القائم بالمهمة";
    document.getElementById("search-status").innerHTML = "حالة المهمة";
    document.getElementById("search-btn").innerHTML = "بحث";


  }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-1").innerHTML = "case tasks" ;


    document.getElementById("page-name").innerHTML = "CASE TASKS";


    document.getElementById("search-end-date").innerHTML = "End date";
    document.getElementById("search-created-by").innerHTML = "Created by";
    document.getElementById("search-assign-to").innerHTML = "Assign to";
    document.getElementById("search-status").innerHTML = "Task status";
    document.getElementById("search-btn").innerHTML = "search";

  }
</script>

@endsection