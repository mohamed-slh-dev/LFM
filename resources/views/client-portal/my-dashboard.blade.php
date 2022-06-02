@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">                                        
                    <h5 class="mt-0" style=" font-weight: bold; " id="d-title">تقارير القضايا</h5>
                    <div class="row">
                       
                         <div class="col-md-3">
                            <div class="text-center">
                                <h3> {{$cases->count()}} <i class="fas fa-file-alt  text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="all-cases">مجموع الدعاوى</p>
                            </div>
                        </div><!--end col-->

                         <div class="col-md-3">
                            <div class="text-center">
                                <h3> {{$cases_not_registerd->count()}} <i class="fas fa-folder-open    text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="not-registred">الدعاوى قيد التسجيل</p>
                            </div>
                        </div><!--end col-->

                        

                        <div class="col-md-3">
                            <div class="text-center">
                                <h3> {{$cases_startup->count()}} <i class="fas fa-spinner text-success ml-1"></i></h3>
                                <p class="text-muted" id="proccessing">الدعاوى قيد التنفيذ</p>
                            </div>
                        </div><!--end col-->

                        <div class="col-md-3">
                            <div class="text-center">
                                <h3> {{$decisions->count()}} <i class="fas fa-hammer text-danger ml-1"></i></h3>
                                <p class="text-muted" id="p-judges">الأحكام</p>
                            </div>
                        </div><!--end col-->
                        
                    </div><!--end row-->
                    <div class="apexchart-wrapper chart-demo m-0">
                        <div id="task_report" class="chart-gutters"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

              
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered">
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
                            <td  >  {{number_format($stage->cliam_amount,2) }} </td>
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
    {{ $stages->links() }}                                         
    </div> 
 </div><!--end row-->

 
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
                             
                                   
                             <div class="col-sm-4">
                                <label class="task-doc">  </label>
                                <input class="form-control" name="doc" type="file" >
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
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.crm_leads.init.js')}}"></script> 
<script src="{{asset('assets/pages/jquery.projects_task.init.js')}}"></script>

<script>
           if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
document.getElementById("breadcrumb-2").innerHTML = " لوحة القضايا الرئيسية"; 

document.getElementById("page-name").innerHTML = " لوحة القضايا الرئيسية";


var timestampArray = document.getElementsByClassName("task-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'مستندات';
  
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
document.getElementById("breadcrumb-1").innerHTML = "cases dashboard";

document.getElementById("page-name").innerHTML = "CASES DASHBOARD";

document.getElementById("d-title").innerHTML = "Cases report";
document.getElementById("all-cases").innerHTML = "Cases";
document.getElementById("not-registred").innerHTML = "Under Registration ";
document.getElementById("proccessing").innerHTML = "Under Proccessing";
document.getElementById("p-judges").innerHTML = "Judgments";



document.getElementById("th-1").innerHTML = "Case Number";
   document.getElementById("th-2").innerHTML = "Case Type";
   document.getElementById("th-3").innerHTML = "Case Stage";
   document.getElementById("th-4").innerHTML = "Registration date";
   document.getElementById("th-5").innerHTML = "Against";
   document.getElementById("th-6").innerHTML = "Cliam Amount";
   document.getElementById("th-7").innerHTML = "View Case Details";
   document.getElementById("th-8").innerHTML = "Assign Task";


   var timestampArray = document.getElementsByClassName("task-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Documents';
  
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