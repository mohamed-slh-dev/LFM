@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
   
@endsection

@section('content')
    <div class="row">
        {{-- <div class="col-lg-12">
                 <div class="card" >                                       
                     <div class="card-body"> 
                         <h4 class="header-title mt-0 mb-3" id="title">النشاطات</h4>
                         <div class="slimscroll crypto-dash-activity">
                            <div class="activity">
                                @foreach ($activities as $activity)
                                <a href="{{url(''.$activity->url.'')}}">
                                    <div class="time-item ">
                                        <div class="item-info">
                                            <div class="text-muted text-right font-10"> {{$activity->date_time}}   - بواسطة ( {{$activity->user_create}} ) </div>
                                            <h5 class="mt-0">{{$activity->short_name}}</h5>
                                            <p class="text-muted font-13">{{$activity->description}}
                                               
                                            </p>
                                        </div>   
                                    </div>
                                    <i class="mdi mdi-check text-success"></i>
                                </a>
                               
                             @endforeach
                             </div><!--end activity-->
                         </div><!--end project-dash-activity-->
                     </div><!--end card-body-->                                                                                                        
                 </div><!--end card-->
             </div><!--end col--> --}}

             <div class="col-lg-12">
             <div class="card">
                <div class="card-body">

                  
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                            <tr>
                        
                                <th id="th1-1"> النشاط</th>
                                <th id="th1-2">الوصف</th>
                                <th id="th1-3">التاريخ</th>
                                <th id="th1-4">بواسطة</th>
                                <th id="th1-5">عرض</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                                    <tr>
                                                      
                                                    <td>{{$activity->short_name}}</td>
                                                    <td>{{$activity->description}}</td>
                                                    <td>{{$activity->date_time}}</td>
                                                    <td>{{$activity->user_create}}</td>
                                                    <td class="text-center">
                                                        <a href="{{url(''.$activity->url.'')}}">
                                                            <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>  
                                                        </a>
                                                        
                                                    </td>
                                                 
                                                       
                                                        
                                                    </tr>
                                                    @endforeach
                         </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class=" mt-4">
            {{ $activities->links() }}
            
            </div>
        </div>

        <script src="{{asset('assets/pages/jquery.crypto-dashboard.init.js')}}"></script>

@endsection

@section('page-script')

<script>
    if (lang == "ar") {
        document.body.style.direction = "rtl"; 
        document.body.style.textAlign = "right"; 
    
        document.getElementById("breadcrumb-float").classList.add('float-left');
        document.getElementById("breadcrumb-1").innerHTML = "ادارة الموظفين"; 
        document.getElementById("breadcrumb-2").innerHTML = "النشاطات"; 
    
        document.getElementById("page-name").innerHTML = "النشاطات";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "activities";
    
    
        document.getElementById("page-name").innerHTML = "ACTIVITIES";

        document.getElementById("title").innerHTML = "All activities";

        document.getElementById("th1-1").innerHTML = "Activity";
        document.getElementById("th1-2").innerHTML = "Description";
        document.getElementById("th1-3").innerHTML = "DateTime";
        document.getElementById("th1-4").innerHTML = "Activity By";
        document.getElementById("th1-5").innerHTML = "View";


           }
</script>
    
@endsection