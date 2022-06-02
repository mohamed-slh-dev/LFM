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
         <div class="card">
             <div class="card-body">
                 <div id='calendar'></div>
                 <div style='clear:both'></div>
             </div><!--end card-body-->
         </div><!--end card-->
     </div><!--end col-->
 </div>
@endsection

@section('page-script')

<script>
    if (lang == "ar") {
        document.body.style.direction = "rtl"; 
        document.body.style.textAlign = "right"; 
    
        document.getElementById("breadcrumb-float").classList.add('float-left');
        document.getElementById("breadcrumb-1").innerHTML = "ادارة الموظفين"; 
        document.getElementById("breadcrumb-2").innerHTML = "التقويم"; 
    
        document.getElementById("page-name").innerHTML = "التقويم";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "calendar";
    
    
        document.getElementById("page-name").innerHTML = "CALENDAR";

       
       

           }
</script>

<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/core/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/timegrid/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/list/main.js')}}'></script>
<script src='{{asset('assets/pages/jquery.calendar.js')}}'></script>
    
@endsection


@section('css-link')
<link href="{{asset('assets/plugins/fullcalendar/packages/core/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/daygrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/bootstrap/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/timegrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/list/main.css')}}" rel="stylesheet" />
    
@endsection