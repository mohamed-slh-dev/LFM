@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection
@section('content')
    <div class="row">  
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('assets/images/widgets/calendar.svg')}}" alt="" class="img-fluid">

                    <ul class="list-group calendar-event">
                        <li class="list-group-item align-items-center d-flex">
                            <div class="media">
                                <img src="{{asset('assets/images/widgets/project1.jpg')}}" class="mr-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center"> 
                                    <div class="event-name mr-3">                                                        
                                        <h3 class="m-0">-</h3>
                                        <p class="text-muted mb-0">-</p>
                                    </div>                                                                                              
                                </div><!--end media body-->
                            </div>
                        </li>
                      
                      
                        
                     
                  
                    </ul> 
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->                      
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                    <div style='clear:both'></div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!-- End row -->  
@endsection

@section('page-script')
    
<script>
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = 'ادارة القضايا' ;
    document.getElementById("breadcrumb-2").innerHTML = "التقويم"; 

    document.getElementById("page-name").innerHTML = "التقويم";
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-1").innerHTML = "calendar" ;


    document.getElementById("page-name").innerHTML = "CALENDAR";

     }
</script>

@endsection