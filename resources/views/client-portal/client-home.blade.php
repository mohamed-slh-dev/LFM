@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-1" class="breadcrumb-item active">الرئيسية</li>
@endsection

@section('page-name')
    
@endsection

@section('page-css')

<style>
    .text-js{
  opacity: 0;
}
.cursor{
  display: block;
  position: absolute;
  height: 100%;
  top: 0;
  right: -5px;
  width: 2px;
  /* Change colour of Cursor Here */
  background-color: white;
  z-index: 1;
  animation: flash 0.5s none infinite alternate;
}
@keyframes flash{
  0%{
    opacity: 1;
  }
  100%{
    opacity: 0;
  }
}





// Rest of CSS (Purely for this pen)
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400');


// Text Can be styled just like normal
.headline{
  margin: 20px;
  color: white;
  font-size: 32px;
  text-align: center;
  h1{
    letter-spacing: 1.6px;
    font-weight: 300;
  }
}

#card-typing{
    height: 30vh; 
    background-position: center;
    background-size: cover;
    opacity: 0.5;
    background-color: black;
    
}


</style>
    
@endsection

@section('content')

<div class="row m-0" >
    <div class="col-12 text-center p-0 mb-4 " style="background-color: black;">
        <div class="card m-0" id="card-typing" style=" background-image: url({{asset('assets/images/hammer-bg.jpg')}});">
        <div class="type-js headline mt-5">
            <h2 class="subheading" style="font-weight : bold;  opacity: 1;
            background-color: #ffffff; right: 35%;
            position: absolute;">Welcome To Al Shamsi Law Firm</h2><br>
            <h1 class="text-js" style=" opacity: 1;
            background-color: #ffffff;
            position: absolute; right: 35%; top: 182%;">.We Claim For Your Rights</h1>
        </div>
    </div>
 </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="wrap">
                    <div class="jctkr-label">
                        <span id="last-activity"> </span>
                    </div>
                    <div class="js-conveyor-example">
                        <ul>
                            @foreach ($activities as $activity)
                            <li>
                                <img src="../assets/images/coins/qub.png" alt="" class="thumb-xs rounded">
                                <span class="usd-rate font-14"> {{$activity->description}} </span>
                              
                            </li>
                            @endforeach
                           
                      
                          
                        </ul>
                    </div>
                </div>    
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>  <!--end row-->

<div class="row">
  
    <div class="col-lg-12 mt-4">
    <div class="row">
                    {{-- <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="all-cases"> اجمالي القضايا</p>
                                            <h4 class="mt-0 mb-1"></h4>                   
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-multiple text-primary"></i>
                                        </div> 
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col--> --}}

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                   
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="all-against">الخصوم</p>
                                            <h4 class="mt-0 mb-1"></h4>                                                                                                                                           
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-account-multiple text-info"></i>
                                        </div> 
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="all-cliam">المطالبات الماليه</p>
                                            <h4 class="mt-0 mb-1"></h4>
                                                                                                                                                                              
                                        </div>
                                    </div> 
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-coin text-primary"></i>
                                        </div> 
                                    </div>                   
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="all-judges">الاحكام</p>
                                            <h4 class="mt-0 mb-1 "></h4>
                                                                                                                                                                              
                                        </div>
                                    </div>  
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-hammer text-danger"></i>
                                        </div> 
                                    </div>
                                                     
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
{{-- 
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  
                                    <div class="col-6 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted"></p>
                                            <h4 class="mt-0 mb-1 "></h4>
                                                                                                                                                                              
                                        </div>
                                    </div>  
                                    <div class="col-6 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-chart-timeline text-success"></i>
                                        </div> 
                                    </div>                  
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col--> --}}

                    {{-- <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" ></p>
                                            <h4 class="mt-0 mb-1"></h4>
                                                                                                                                                                              
                                        </div>
                                    </div>   
                                    <div class="col-6 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-chart-timeline text-success"></i>
                                        </div> 
                                    </div>
                                                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col--> --}}

                 </div>
                  
             </div>
 
    </div><!--end row--> 
    <div class="row">
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
            <div class=" mt-4">
            {{ $stages->links() }}
            </div>                                  
        </div> 
     
    </div>

    @foreach ($stages as $stage_task)
    
    <div class="modal fade assign-task-{{$stage_task->N_CASE_DETAILS_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style=" display: block; ">
                    
                    <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('client-assign-task')}}" enctype="multipart/form-data">
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
    <div class="card">                                
        <div class="card-body">
            <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb2-title"></h4>           
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 100px;" id="tb2-1"></th>
                                    <th style="width: 150px;" id="tb2-2"></th>
                                    <th style="width: 120px;" id="tb2-3"></th>
                                    <th style="width: 180px;" id="tb2-4"></th>
                                    <th  style="width: 140px;" id="tb2-5">  </th>
                                    <th style="width: 140px;" id="tb2-6"> </th>
                                   
                                    <th style="width: 100px;" id="tb2-9"></th>
                                 

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stages_noti as $stage_noti)
                                    
                               
                                <tr class='clickable-row' >
                                    
                                    <td>{{$stage_noti->S_CASE_FILE_NUM}}</td>
                                <td>{{$stage_noti->N_CASE_ID}}</td>
                                      <td>
                                          {{$stage_noti->S_CASE_UID}}
                                      </td>
                                      <td> {{$stage_noti->S_HEARING_DESIGION}}</td>
                                      <td>{{$stage_noti->DT_HearingEnterDate}}</td>
                                     
                                      <td>{{$stage_noti->DT_HEARING_DATE}}</td>
                                   <td>
                                   <span class="badge badge-boxed  badge-soft-primary">{{$stage_noti->S_Desc_A}}</span>
                                   </td>
                                
                                

                                  
                                  </tr>
                                  @endforeach
                                                                                                                             
                            </tbody>
                        </table>
                    </div><!--end table-responsive-->                                            
                </div><!--end col-->
            </div> <!--end row-->
            <div class=" mt-4">
                {{ $stages_noti->links() }}
                
                </div>
        </div><!--end card-body-->                                                                                                        
    </div><!--end card-->
    
@endsection

@section('page-script')

<script>
   function autoType(elementClass, typingSpeed){
  var thhis = $(elementClass);
  thhis.css({
    "position": "relative",
    "display": "inline-block"
  });
  thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
  thhis = thhis.find(".text-js");
  var text = thhis.text().trim().split('');
  var amntOfChars = text.length;
  var newString = "";
  thhis.text("|");
  setTimeout(function(){
    thhis.css("opacity",1);
    thhis.prev().removeAttr("style");
    thhis.text("");
    for(var i = 0; i < amntOfChars; i++){
      (function(i,char){
        setTimeout(function() {        
          newString += char;
          thhis.text(newString);
        },i*typingSpeed);
      })(i+1,text[i]);
    }
  },1500);
}

$(document).ready(function(){
  // Now to start autoTyping just call the autoType function with the 
  // class of outer div
  // The second paramter is the speed between each letter is typed.   
  autoType(".type-js",200);
});
</script>

<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/ticker/jquery.jConveyorTicker.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.crypto-news.init.js')}}"></script>


<script>
      if (lang == "ar") {
   document.body.style.direction = "rtl"; 
   document.body.style.textAlign = "right"; 

   document.getElementById("breadcrumb-float").classList.add('float-left');
   document.getElementById("breadcrumb-1").innerHTML = "الرئيسية";

   document.getElementById("page-name").innerHTML = "الرئيسية";

   document.getElementById("last-activity").innerHTML = "النشاطات الأخيرة &nbsp  <i class='fas fa-exchange-alt mr-2'></i>";

   document.getElementById("tb2-title").innerHTML = "تنبيهات الجلسات";

   document.getElementById("tb2-1").innerHTML = "رقم الملف";
   document.getElementById("tb2-2").innerHTML = "رقم القضية";
   document.getElementById("tb2-3").innerHTML = "رقم الدعوى";
   document.getElementById("tb2-4").innerHTML = "قرار الجلسة";
   document.getElementById("tb2-5").innerHTML = "تاريخ الجلسة الحالية";
   document.getElementById("tb2-6").innerHTML = "تاريخ الجلسة القادمة";

   document.getElementById("tb2-9").innerHTML = "نوع الجلسة";


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
   document.getElementById("breadcrumb-1").innerHTML = "Home";

   document.getElementById("page-name").innerHTML = "HOME";

   document.getElementById("last-activity").innerHTML = "Last activity &nbsp  <i class='fas fa-exchange-alt mr-2'></i>";


   document.getElementById("all-against").innerHTML = "Against";
   document.getElementById("all-cliam").innerHTML = "Cliams Amount";
   document.getElementById("all-judges").innerHTML = "Judgments";

   document.getElementById("th-1").innerHTML = "Case Number";
   document.getElementById("th-2").innerHTML = "Case Type";
   document.getElementById("th-3").innerHTML = "Case Stage";
   document.getElementById("th-4").innerHTML = "Registration date";
   document.getElementById("th-5").innerHTML = "Against";
   document.getElementById("th-6").innerHTML = "Cliam Amount";
   document.getElementById("th-7").innerHTML = "View Case Details";
   document.getElementById("th-8").innerHTML = "Assign Task";


   document.getElementById("tb2-title").innerHTML = "Hearing alert";


document.getElementById("tb2-1").innerHTML = "File number";
document.getElementById("tb2-2").innerHTML = "Main Case number";
document.getElementById("tb2-3").innerHTML = "Case number";
document.getElementById("tb2-4").innerHTML = "Decision";
document.getElementById("tb2-5").innerHTML = "Date of hearing ";
document.getElementById("tb2-6").innerHTML = "Next date of hearing";
document.getElementById("tb2-9").innerHTML = "Case type";




   

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