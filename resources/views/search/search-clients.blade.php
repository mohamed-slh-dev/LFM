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
                                <h5 class="" id="clients-num"></h5>
                                <p class="text-muted mb-0" > <span id="total-num"></span>{{$clients_num}} </p>
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
                                <p class="text-muted mb-0"> - </p>
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
                                <h5 class="" id="increase"></h5>
                                <p class="text-muted mb-0"> - </p>
                            </div><!--end col-->
                            <div class="col-4 text-right">
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
                <form class="form"  method="POST" action="{{route('search-clients')}}">
                    @csrf                                
                <div class="card-body text-center" >
                      <div class="row">
                      <div class="col-8">
                         <div class="row">
                       <div class="col-sm-3">
                                    <input class="form-control " name="client_name"  id="clients-search-input" type="text">
                                   
                     </div>
                 <div class="col-sm-4">
                  <button class="btn btn-success waves-effect waves-light mx-3" type="submit"  id="clients-search-btn">  </button>
                 </div>
                     </div>
                      </div>
                    
                             
                     </div>

               </div>
                </form>
            </div>      
       </div>

       
          @foreach ($clients as $client)
         <div class="col-lg-4">
            <div class="card client-card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">                               
                <div class="card-body text-center">                                   
                    <img src="../assets/images/clients-imgs/{{$client->client_logo}}" alt="client"  class="rounded-circle thumb-xl" width="120" height="120" >
                    @if (Session::get('lang') == "ar")
                    <h5 class=" client-name">{{ $client->S_CLIENT_AR_NAME}}</h5> 
                    @else
                    <h5 class=" client-name">{{ $client->S_CLIENT_EG_NAME}}</h5>   
                    @endif                         
                     <i class="dripicons-location mr-2 text-info mx-2"></i>  <span class="text-muted"> {{ $client->S_ADDRESS}} </span>

                     <i class="dripicons-phone mx-2 text-info ml-2"></i>   <span  class="text-muted">{{ $client->phone}} </span>

                    <p class="text-muted text-center mt-3">{{ $client->client_info}}</p>
                    
                    @if (Session::get('lang') == "ar")
                    <a href="{{url('client-profile/1/'.$client->N_CLIENT_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-success" id="files-btn">الملفات</button>
                    </a>

                    <a href="{{url('client-profile/2/'.$client->N_CLIENT_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-primary" id="details-btn">التفاصيل</button>
                    </a>
                    @else
                    <a href="{{url('client-profile/1/'.$client->N_CLIENT_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-success" id="files-btn">files</button>
                    </a>

                    <a href="{{url('client-profile/2/'.$client->N_CLIENT_ID)}}">
                        <button type="button" class="btn btn-sm btn-soft-primary" id="details-btn">details</button>
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
    document.getElementById("breadcrumb-1").innerHTML = "البحث"; 
    document.getElementById("breadcrumb-2").innerHTML = "بحث العملاء"; 

    document.getElementById("page-name").innerHTML = "بحث العملاء";

    document.getElementById("clients-num").innerHTML = "الموكلين";
 document.getElementById("total-num").innerHTML = "العدد الكلي : ";
 document.getElementById("new-clients").innerHTML = "العملاء الجدد";
 document.getElementById("increase").innerHTML = "معدل الزيادة";

 document.getElementById("clients-search-input").placeholder = "اسم العميل";
    document.getElementById("clients-search-btn").innerHTML = "بحث ";
       }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "search";
    document.getElementById("breadcrumb-1").innerHTML = "clients search";


    document.getElementById("page-name").innerHTML = "CLIENTS SEARCH";

    document.getElementById("clients-num").innerHTML = "clients";
 document.getElementById("total-num").innerHTML = "Total clients : ";
 document.getElementById("new-clients").innerHTML = "New clients";
 document.getElementById("increase").innerHTML = "Increase precent";

 document.getElementById("clients-search-input").placeholder = "Client name";
    document.getElementById("clients-search-btn").innerHTML = "search ";
       }
</script>
    
@endsection