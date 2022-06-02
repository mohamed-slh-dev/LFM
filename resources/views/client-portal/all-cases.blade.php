@extends('layouts.client-layout')

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


    <form class="form"  method="POST" action="{{route('client-search-cases')}}">
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
                        <option ></option>
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
                  <option ></option>
                  @foreach ($case_stage as $case_stage_filter)
                  <option value="{{$case_stage_filter->N_DetailedCode}}">{{$case_stage_filter->S_Desc_A}}</option>  
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
    @foreach ($stages as $stage)
    <div class="col-lg-6">
        <div class="card">
          <div class="card-body"> 
           @if (Session::get('lang') == "ar")
                 <div class="task-box ">
                     <div class="row">

                  
                     <div class="col-4 text-right">
                        <h5 class="mt-0 " style="font-weight: bold;"> - {{$stage->S_CASE_UID}} </h5>

                     </div>
                     <div class="col-4 text-center">
                        <p class="text-muted mb-2  ">
                            قيمة المطالبة : {{number_format($stage->cliam_amount,2) }}
  
                          </p>
                    </div>
                    <div class="col-4 text-left">
                        <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}" >
                            <button class="btn-sm btn-outline-dark btn-round">
                                <span>عرض القضية</span>
                               
                            </button>
                         </a>
                    </div>
                </div>
                  
                  
                 
      
                      <div style="display: block ruby;" class="text-center mt-3">
                  <p class="text-muted mb-2  ">
                 الخصم : {{$stage->againstName}}  
                   </p>
                      </div>
                   <div style="display: block ruby;" class="mt-4">
                        <p class=" text-left mb-1" style="float: left;"> مرحلة الدعوى :   {{$stage->caseStage}} </p>
                      <p class=" text-right mb-1">  نوع الدعوى :  {{$stage->caseType}} </p>
                   </div>
                     
      
                   <hr>
                   
                   <div class="d-flex justify-content-between">
                   <a href="{{url('client-case-details/'.$stage->N_CASE_DETAILS_ID)}}">
                     <button class="btn btn-outline-dark waves-effect waves-light">البيانات</button></a> 
                           
                     <a href="{{url('client-case-stages/'.$stage->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >الجلسات</button></a>
      
      
                         <a href="{{url('client-case-tasks/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المهام</button></a>
      
                       <a href="{{url('client-case-documents/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >المستندات</button></a>
                  
                   </div>                                        
               </div><!--end task-box--> 
              @else
                <div class="task-box">
                    <div class="row">
                        <div class="col-4 text-left">
                           <h5 class="mt-0 " style="font-weight: bold;"> - {{$stage->S_CASE_UID}} </h5>
   
                        </div>
                        <div class="col-4 text-center">
                           <p class="text-muted mb-2  ">
                               Cliam Amount : {{number_format($stage->cliam_amount,2) }} 
                             </p>
                       </div>
                       <div class="col-4 text-right">
                           <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}" >
                               <button class="btn-sm btn-outline-dark btn-round">
                                   <span>View Case</span>
                                   <span class="" style=" font-weight: bold; ">  {{$stage->N_CASE_ID}} </span>  
                               </button>
                            </a>
                       </div>
                   </div>
                   <div style="display: block ruby;" class="text-center mt-3">
                    <p class="text-muted mb-2  ">
                   Against : {{$stage->againstName}}  
                     </p>
                        </div>

                   <div style="display: block ruby;" class="mt-4">
                        <p class=" mb-1" style="float: right;">  Case stage :  {{$stage->caseStage}} </p>
                      <p class=" mb-1"> Case type : {{$stage->caseType}} </p>
                   </div>
                     
      
                   <hr>
                   
                   <div class="d-flex justify-content-between">
                   <a href="{{url('client-case-details/'.$stage->N_CASE_DETAILS_ID)}}">
                     <button class="btn btn-outline-dark waves-effect waves-light">DETAILS</button></a> 
      
                     
                     <a href="{{url('client-case-stages/'.$stage->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >HEARINGS</button></a>
      
      
                         <a href="{{url('client-case-tasks/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >TASKS</button></a>
      
                       <a href="{{url('client-case-documents/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >DOCUMENTS</button></a>
                  
                   </div>                                        
               </div><!--end task-box-->  
              @endif                                   
              
          </div><!--end card-body-->
      </div><!--end card-->
  </div><!--end col-->
       @endforeach

    {{-- <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

              
                <div class="table-responsive">
                    <table class="table table-bordered table-centered">
                <thead>
                    <tr>
                        <th id="th-1" style="width: 100px;">رقم الدعوى</th>
                        <th id="th-2"  style="width: 100px;">نوع الدعوى</th>
                        <th id="th-3"  style="width: 100px;">مرحلة الدعوى</th>
                        <th id="th-4"  style="width: 150px;"> تاريخ التسجيل</th>
                        <th id="th-5"  style="width: 230px;"> الخصم</th>
                        <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                        <th id="th-8"  style="width: 100px;"> اسناد مهمة</th>
                        <th id="th-7" style="width: 140px;">عرض بيانات الدعوى</th>

                </tr>
                </thead>
             
                <tbody>
                       
                    @foreach ($stages as $stage)
            
                    <tr>
                       
                        <td > {{$stage->S_CASE_UID}}</td>
                            <td  > {{$stage->caseType}}</td>
                            <td > {{$stage->caseStage}}</td>
                            <td  > {{$stage->register_date}}</td>
                            <td  > {{$stage->againstName}}</td>
                            <td  > {{$stage->cliam_amount}}</td>
                            <td class="text-center">
                                <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".assign-task-{{$stage->N_CASE_DETAILS_ID}}">
                                    <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                </a>
                             </td>
                          
                            <td class="text-center">
                                <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}">
                                    <button class="btn-sm btn-outline-dark waves-effect waves-light" > <i class="dripicons-preview"></i> </button>
                                </a>
     
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>
                
            </table>
                </div>
            </div>
        </div>                                            
    </div> --}}
    {{ $stages->links() }}
   
</div>


 
@foreach ($stages as $stage_task)
    
<div class="modal fade assign-task-{{$stage_task->N_CASE_DETAILS_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('client-assign-task')}}">
                    @csrf
                    <input type="hidden" name="case_id" value="{{$stage_task->N_CASE_DETAILS_ID}}">
                    <input type="hidden" name="main_case_id" value="{{$stage_task->N_CASE_ID}}">

              <div class="row">
                    
                <div class="col-12"> 
                   <div class="form-group row">
                            
                    <input type="hidden" name="status" value="قيد التنفيذ">

                               <div class="col-sm-4">
                                <label class="task-type">نوع المهمة</label>
                                   <select disabled class="custom-select" name="type">
                                 <option value="1">مهمة دعوى</option>
                                 </select>
                             </div>
                             
                               
                            

                         </div>
       
              </div>
              
             <div class="col-12"> 
                   <div class="form-group row">
                            
                    <div class="col-sm-4">
                        <label class="task-name">  </label>
                        <input class="form-control" name="notes" type="text" id="example-text-input">
                    </div>
                    
                        <div class="col-sm-4">
                         <label class="task-start"></label>
                           <input class="form-control" type="date" name="doing_date" id="example-text-input">
                      </div>

                       <div class="col-sm-4">
                                <label class="task-end"></label>
                                 <input class="form-control" type="date" name="wanted_date" id="example-text-input">
                             </div>


                           

                        </div>
       
              </div>
 
                
               <div class="col-12"> 
                   <div class="form-group row">
                       <div class="col-sm-6">
                           <label class="task-desc"></label>
                             <textarea class="form-control" name="desc" rows="3" id="message"></textarea>
                        </div>
                     <div class="col-sm-6">
                                <label class="task-note"> </label>
                                  <textarea class="form-control" name="comment" rows="3" id="message"></textarea>
                             </div>
                            
                             
                   </div>
                 </div>


                  <div class="col-12"> 
                 
                      <button class="btn btn-sm btn-primary mr-1 font-15 task-add-btn" ></button>
              </div> 
               

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
document.getElementById("breadcrumb-2").innerHTML = " الدعاوى"; 

document.getElementById("page-name").innerHTML = " الدعاوى";

document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";

var timestampArray = document.getElementsByClassName("task-status");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'حالة المهمة';
  
}
    var timestampArray = document.getElementsByClassName("task-type");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'نوع المهمة';
  
}
    var timestampArray = document.getElementsByClassName("task-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ البداية';
  
}
    var timestampArray = document.getElementsByClassName("task-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ التسليم';
  
}
    var timestampArray = document.getElementsByClassName("task-excute");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ التنفيذ';
  
}
    var timestampArray = document.getElementsByClassName("task-name");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'اسم المهمة';
  
}
    var timestampArray = document.getElementsByClassName("task-desc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'وصف المهمة';
  
}
    var timestampArray = document.getElementsByClassName("task-note");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'ملاحظات';
  
}
    var timestampArray = document.getElementsByClassName("task-add-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'اضافة';
  
}

           }else{
            document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "cases";

document.getElementById("page-name").innerHTML = "CASES";

document.getElementById("th-1").innerHTML = "Case Number";
   document.getElementById("th-2").innerHTML = "Case Type";
   document.getElementById("th-3").innerHTML = "Case Stage";
   document.getElementById("th-4").innerHTML = "Registration date";
   document.getElementById("th-5").innerHTML = "Against";
   document.getElementById("th-6").innerHTML = "Cliam Amount";
   document.getElementById("th-7").innerHTML = "View Case Details";
   document.getElementById("th-8").innerHTML = "Assign Task";

   document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-btn").innerHTML = "search ";
     
var timestampArray = document.getElementsByClassName("task-status");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Task Status';
  
}
    var timestampArray = document.getElementsByClassName("task-type");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Task type';
  
}
    var timestampArray = document.getElementsByClassName("task-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Start Date';
  
}
    var timestampArray = document.getElementsByClassName("task-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Deliverd Date';
  
}
    var timestampArray = document.getElementsByClassName("task-excute");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Excution Date';
  
}
    var timestampArray = document.getElementsByClassName("task-name");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Task Name';
  
}
    var timestampArray = document.getElementsByClassName("task-desc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Task Description';
  
}
    var timestampArray = document.getElementsByClassName("task-note");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Notes';
  
}
    var timestampArray = document.getElementsByClassName("task-add-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Add';
  
}


           }
</script>
    
@endsection