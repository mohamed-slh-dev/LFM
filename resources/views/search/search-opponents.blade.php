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
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="icon-contain">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <h5 class="" id="clients-num">الخصوم</h5>
                                <p class="text-muted mb-0">  <span id="total-num"></span> {{$opp_num}} </p>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="icon-info text-center">
                                    <i class="mdi mdi-account-group text-success"></i>
                                </div> 
                            </div><!--end col-->
                        </div>  <!--end row-->                                                      
                    </div><!--end icon-contain-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->   
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="icon-contain">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <h5 class="" id="new-clients"></h5>
                                <p class="text-muted mb-0">-</p>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="icon-info text-center">
                                    <i class="mdi mdi-account-multiple-plus  text-primary"></i>
                                </div>
                            </div><!--end col-->
                        </div>  <!--end row-->                                                      
                    </div><!--end icon-contain-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->  
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="icon-contain">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <h5 class=""  id="increase"></h5>
                                <p class="text-muted mb-0">  - </p>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="icon-info text-center">
                                    <i class="mdi mdi-google-analytics text-info"></i>
                                </div> 
                            </div><!--end col-->
                        </div>  <!--end row-->                                                      
                    </div><!--end icon-contain-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->                                         
    </div><!--end row-->

         </div>
         <div class="col-lg-12">

             <div class="card client-card">  
                <form class="form"  method="POST" action="{{route('search-againsts')}}">
                    @csrf                                
                <div class="card-body text-center" >
                      <div class="row">
                      <div class="col-8">
                         <div class="row">
                       <div class="col-sm-3">
                                    <input class="form-control " id="search-input" name="against_name" type="text">
                                   
                     </div>
                 <div class="col-sm-4 text-right">
                  <button class="btn btn-success waves-effect waves-light mr-3" id="search-btn"> </button>
                 </div>
                     </div>
                      </div>
                       
                             
                     </div>

               </div>
                </form>
            </div>      
       </div>

       
@foreach ($opponents as $opp)
 
<div class="col-lg-4">
    
            <div class="card client-card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">                               
                <div class="card-body text-center">                                    
                    <img src="assets/images/opponents-imgs/{{$opp->against_logo}}" alt="opponent" class="rounded-circle thumb-xl" width="120" height="120"  >
                   @if (Session::get('lang') == "ar")
                    <h5 class=" client-name">{{ $opp->S_AGAINST_AR_NAME}}</h5> 
                    @else
                    <h5 class=" client-name">{{ $opp->S_AGAINST_EG_NAME}}</h5>   
                    @endif   
                    <i class="dripicons-location mr-2 text-info ml-2"></i> <span class="text-muted">{{$opp->S_ADDRESS}}</span>

                    <i class="dripicons-phone mr-2 text-info ml-2"></i>  <span  class="text-muted">{{$opp->phone}}</span>
                    
                    <p class="text-muted text-center mt-3">{{$opp->more_info}}</p>

                    @if (Session::get('lang') == "ar")
                    <a href="{{url('opponent-profile/1/'.$opp->N_AGAINST_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-success">الملفات</button>
                    </a>

                    <a href="{{url('opponent-profile/2/'.$opp->N_AGAINST_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-primary">التفاصيل</button>
                    </a>
                    @else
                    <a href="{{url('opponent-profile/1/'.$opp->N_AGAINST_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-success">files</button>
                    </a>

                    <a href="{{url('opponent-profile/2/'.$opp->N_AGAINST_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-primary">details</button>
                    </a>

                    @endif
                </div><!--end card-body-->                                                                     
            </div><!--end card-->
        </div><!--end col-->
        @endforeach    
                         

    </div><!--end row-->
  
   
    
@endsection

@section('page-script')
    
    <script>
if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML ="العملاء"; 
document.getElementById("breadcrumb-2").innerHTML ="الخصوم"; 

document.getElementById("page-name").innerHTML ="الخصوم";

document.getElementById("clients-num").innerHTML = "الخصوم";
document.getElementById("total-num").innerHTML = "العدد الكلي : ";
document.getElementById("new-clients").innerHTML = "الخصوم الجدد";
document.getElementById("increase").innerHTML = "معدل الزيادة";

document.getElementById("search-btn").innerHTML = "بحث"; 
document.getElementById("search-input").placeholder = "اسم الخصم";
}else{
    document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 
document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-1").innerHTML = "againsts";
document.getElementById("breadcrumb-2").innerHTML ="clients"; 

document.getElementById("page-name").innerHTML = "AGAINSTS";

document.getElementById("clients-num").innerHTML = "Againsts";
document.getElementById("total-num").innerHTML = "Total againsts : ";
document.getElementById("new-clients").innerHTML = "New againsts";
document.getElementById("increase").innerHTML = "Increase precent";

document.getElementById("search-btn").innerHTML = "search";
document.getElementById("search-input").placeholder = "Against name ";
}
    </script>
@endsection