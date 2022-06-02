@extends('layouts.main-layout')

@section('path')
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
         
     </div><!--end row-->
     {{-- <div class="float-left mt-4">
        {{ $memoir->links() }}
        
        </div> --}}

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
                                    <label id="excute-need">   </label>
                                    <select class="custom-select" name="excute_need">
                                      @foreach ($type as $t)
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
                                    <label id="excute-date"></label>
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
                            
                                 <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn">إضافة مذكرة</button>
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
  
@endsection

@section('page-script')

<script>
      if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = "مذكرات الدعوى"; 

    document.getElementById("page-name").innerHTML = "مذكرات الدعوى";

    document.getElementById("new-memoir").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> إضافة طلب مذكرة';

    document.getElementById("excute-need").innerHTML = 'الاجراء المطلوب';
    document.getElementById("excute-date").innerHTML = 'تاريخ التنفيذ';
    document.getElementById("consult").innerHTML = 'المستشار';
    document.getElementById("status").innerHTML = 'الحالة';
    document.getElementById("created-by").innerHTML = 'بواسطة';
    document.getElementById("add-btn").innerHTML = 'اضافة مذكرة';


      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-1").innerHTML = "case memoir" ;


    document.getElementById("page-name").innerHTML = "CASE MEMOIR";

    document.getElementById("new-memoir").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> Add new memoir';

    document.getElementById("excute-need").innerHTML = 'Memoir type';
    document.getElementById("excute-date").innerHTML = 'Needed date';
    document.getElementById("consult").innerHTML = 'Consultant';
    document.getElementById("status").innerHTML = 'Status';
    document.getElementById("created-by").innerHTML = 'Created by';
    document.getElementById("add-btn").innerHTML = 'Add';
      }
</script>
    
@endsection