@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12" id="filter">
        

              <div class="card client-card">
                <form class="form"  method="POST" action="{{route('print-tasks-reports')}}">
                    @csrf                               
                 <div class="card-body text-center" >
                       <div class="row">
                       <div class="col-12">
                          <div class="row">
                        <div class="col-2 ">

                            <select class="custom-select text-center" name="assignTo">
                                        
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} </option>
                                    
                                @endforeach
                            </select>
                      </div>
                      <div class="col-3">
                          <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-5 col-form-label text-center" id="search-status">حالة المهمة</label>
                                 <div class="col-sm-7">
                                   <select class="custom-select text-center">
                                        
                                         
                                     </select>
                                 </div>
                             </div>
                      </div>

               
                  <div class="col-1  text-center">
                   <button class="btn btn-success waves-effect waves-light mx-3" id="search-btn"> بحث </button>
                  </div>
                      </div>
                       </div>
                  

                                 
                                
                              
                      </div>

                </div>
                </form>
             </div>      
        </div>

       
        @if ($task_report)
        <div class="col-lg-10 mx-auto" id="report">
           
            <div class="card">
                <div class="card-body invoice-head"> 
                    <div class="row">
                        <div class="col-12 text-center">                                                
                            <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                        </div>
                        <div class="col-2 align-self-center">                                                
                        </div>
                        <div class="col-8 text-center">
                    
                            <h4 id="report-title">تقارير مهام الموظف - ( )</h4>
                      
                                
                          
                        </div>
                        <div class="col-2">

                        </div>
                    </div>  
                </div><!--end card-body-->
                <div class="card-body">
                
                    <div class="row">
                      <div class="col-12">
                        <h4 style=" font-weight: bold; "> <span id="emp-name"> اسم الموظف  </span> : {{$user_name}}</h4>
                      </div>
                      <div class="col-4 px-4">
                    <div class="form-group row mb-0">
                                <label for="example-number-input" class="col-form-label mx-2" 
                                 style="font-weight: bold;"> <span id="tasks-num"> عدد المهام الكلي  </span> : {{$task_report->count()}} </label>  
                                <h6 style="font-weight: bold;"> </h6>
                                
                            </div>
                            
                             
                             
                        </div>
                     </div>

                
                    <hr>

                     <div class="row">
                    <div class="col-12">
                        <h4 style="font-weight: bold;" id="tbl-title">تقرير المهام</h4>
                      </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th id="tbl-1">اسم المهمة</th>
                                            <th id="tbl-2">تاريخ المهمة</th>
                                            <th id="tbl-3">تاريخ انجاز المهمة</th>
                                            <th id="tbl-4">الحالة</th>
                                            <th id="tbl-5">وصف المهمة</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task_report as $task_report)
                                        <tr>
                                            <td>{{$task_report->S_NOTES}}</td>
                                            <td>{{$task_report->DT_DATE_STARTWORK }}</td>  
                                            <td>{{$task_report->DT_WANTED }}</td>
                                            <td>{{$task_report->N_Status  }}</td>
                                            <td>{{$task_report->S_SUBJECT  }}</td>
                                        </tr>
                                        @endforeach
                                 
                                   
                                    </tbody>
                                </table>
                            </div>                                            
                        </div>                                        
                    </div>

                    
               
                 
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-lg-12 col-xl-4 mx-auto align-self-center">
                            <div class="text-center text-muted"></div>
                        </div>
                        <div class="col-lg-12 col-xl-4">
                            <div class=" d-print-none">
                            <button onclick="printDiv()" class="btn btn-info">
                              <i class="fa fa-print"></i>
                            </button>
                              
                              
                                <a href="#" class="btn btn-danger" id="cancel-print">الغاء</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end card-->
        </div><!--end col-->
        @else
        <div class="col-lg-10 mx-auto" id="report">
           
            <div class="card">
                <div class="card-body invoice-head"> 
                    <div class="row">
                        <div class="col-md-12 text-center">                                                
                            <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                        </div>
                        <div class="col-2 align-self-center">                                                
                        </div>
                        <div class="col-8 text-center">
                    
                            <h4 id="report-title">تقارير مهام الموظف - ( )</h4>
                      
                                
                          
                        </div>
                        <div class="col-2">

                        </div>
                    </div> 
                </div><!--end card-body-->
                <div class="card-body">
                
                    <div class="row">
                      <div class="col-12">
                        <h4 style=" font-weight: bold; " id="emp-name">اسم الموظف :</h4>
                      </div>
                      <div class="col-4 pr-4">
                    <div class="form-group row mb-0">
                                <label for="example-number-input" class="col-form-label text-right ml-2" 
                                 style="font-weight: bold;" id="tasks-num">عدد المهام الكلي : </label>  
                                <h6 style="font-weight: bold;"> </h6>
                                
                            </div>
                            
                             
                             
                        </div>

                        

                                                                                                   
                    </div>

                
                    <hr>

                     <div class="row">
                    <div class="col-12">
                        <h4 style="font-weight: bold;" id="tbl-title">تقارير المهام</h4>
                      </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th id="tbl-1">اسم المهمة</th>
                                            <th id="tbl-2">تاريخ المهمة</th>
                                            <th id="tbl-3">تاريخ انجاز المهمة</th>
                                            <th id="tbl-4">الحالة</th>
                                            <th id="tbl-5">وصف المهمة</th>

                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                  
                                 
                                   
                                    </tbody>
                                </table>
                            </div>                                            
                        </div>                                        
                    </div>

                    
               
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-lg-12 col-xl-4 mx-auto align-self-center">
                            <div class="text-center text-muted"></div>
                        </div>
                        <div class="col-lg-12 col-xl-4">
                            <div class=" d-print-none">
                            <button onclick="printDiv()" class="btn btn-info">
                              <i class="fa fa-print"></i>
                            </button>
                              
                              
                                <a href="#" class="btn btn-danger" id="cancel-print">الغاء</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end card-->
        </div><!--end col-->

        @endif
        
      
    </div><!--end row-->

   
    
@endsection

@section('page-script')
<script> 
    function printDiv() { 
        document.getElementById("filter").style.display = "none";
        window.print(); 
        document.getElementById("filter").style.display = "block";
    } 
</script> 

<script>
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = 'المهام' ;
    document.getElementById("breadcrumb-2").innerHTML = "تقارير المهام"; 

    document.getElementById("page-name").innerHTML = "تقارير المهام";
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML =  " tasks"; 
    document.getElementById("breadcrumb-1").innerHTML = "tasks reports" ;


    document.getElementById("page-name").innerHTML = "TASKS REPORTS";

    document.getElementById("search-status").innerHTML = "Task status";
    document.getElementById("search-btn").innerHTML = "search";

    document.getElementById("tbl-title").innerHTML = "Task report";

    document.getElementById("tbl-1").innerHTML = "Task name";
    document.getElementById("tbl-2").innerHTML = "Create date";
    document.getElementById("tbl-3").innerHTML = "End date";
    document.getElementById("tbl-4").innerHTML = "status";
    document.getElementById("tbl-5").innerHTML = "Task desc.";

    document.getElementById("emp-name").innerHTML = "Employee name";
    document.getElementById("tasks-num").innerHTML = "Tasks number";

    document.getElementById("report-title").innerHTML = "Tasks report";

    document.getElementById("cancel-print").innerHTML = "Cancel";


     }
</script>
@endsection