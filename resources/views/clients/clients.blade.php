@extends('layouts.main-layout')

@section('path')
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
                <div class="col-lg-12 mt-3 mx-3">
                    <div class="">
                        <ul class="list-inline pr-0">                                    
                           
                            @if ($add_client == 'true')
                            <li class="list-inline-item">
        
                                <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg"><i class="mdi mdi-plus-box ml-2"></i> <span id="add-client"> </span> </button>
            
                                </li>
                            @endif
                           
                        </ul>
                    </div>                            
                </div><!--end col-->
                <form class="form"  method="POST" action="{{route('search-clients')}}">
                    @csrf                                
                <div class="card-body text-center" >
                      <div class="row">
                      <div class="col-8">
                         <div class="row">
                       <div class="col-sm-3">
                                    <input class="form-control " id="search-input" name="client_name"  type="text" >
                                   
                     </div>
                 <div class="col-sm-4 ">
                  <button class="btn btn-success waves-effect waves-light mr-3" type="submit" id="search-btn"> </button>
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
                    <img src="{{asset('assets/images/clients-imgs/'.$client->client_logo)}}" alt="client" class="rounded-circle thumb-xl"  width="120" height="120">
                    @if ($lang == "ar")
                    <h5 class=" client-name">{{ $client->S_CLIENT_AR_NAME}}</h5> 
                    @else
                    <h5 class=" client-name">{{ $client->S_CLIENT_EG_NAME}}</h5>   
                    @endif                    
                    <i class="dripicons-location mr-2 text-info mx-2"></i>  <span class="text-muted"> {{ $client->S_ADDRESS}} </span>

                     <i class="dripicons-phone mx-2 text-info ml-2"></i>   <span  class="text-muted">{{ $client->phone}} </span>

                    <p class="text-muted text-center mt-3">{{ $client->client_info}}</p>
                    @if ($lang == "ar")
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
    <div class=" mt-4">
        {{ $clients->links() }}
        
        </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{ route('add-client') }}" enctype="multipart/form-data">

                              <div class="row">
                                    @csrf
                                    <div class="col-lg-8">
                             
                                </div>
                              
                                <div class="col-lg-4">
                                       <input type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('assets/images/users/user-4.jpg')}}"/>
                                </div>

                                <div class="col-12"> <hr></div>

                                 <div class="col-lg-12">
                                  <div class="form-group row">
                                               
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="name_ar"  type="text" id="name-ar">
                                                </div>
                                            </div>
                                              <div class="form-group row">
                                               
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="name_eng"  type="text" id="name-eng">
                                                </div>
                                            </div>
                                    
                                </div>
                                 <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="email1"  type="text" id="p-mail">
                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="email2"  type="text" id="s-mail" >
                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="password"  type="password" id="pass">
                                                </div>

                                            </div>
                          
                                 </div>
                                     <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                                <div class="col-sm-4">
                                                    <select class="select2 form-control mb-3 custom-select" name="type">
                                                        <option value="">نوع العميل</option>
                                                     @foreach ($client_type as $type)
                                                     <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                                     @endforeach

                                                    
                                                 </select>                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="phone"  type="text" id="phone">
                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="fax"  type="text" id="fax">
                                                </div>

                                            </div>
                          
                                 </div>
                                  <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="mb"  type="text" id="mail-box">
                                                </div>
                                                 <div class="col-sm-6">
                                                       <select class="select2 form-control mb-3 custom-select" name="branch">
                                                           <option value="">الفرع</option>
                                                        @foreach ($branch as $branch)
                                                        <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                                        @endforeach

                                                       
                                                    </select>
                                                </div>
                                             

                                            </div>
                          
                                 </div>

                                      <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                                <div class="col-sm-4">
                                                    <select class="select2 custom-select" name="nation">
                                                        <option value="">الجنسية</option>
                                                        @foreach ($nationality as $nation)
                                                        <option value="{{$nation->N_DetailedCode}}">{{$nation->S_Desc_A}}</option>  
                                                        @endforeach
                                                      
                                                            
                                                        </select>
                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="ssn"  type="text" id="ssn">
                                                </div>
                                                 <div class="col-sm-4">
                                                    <input class="form-control" name="address"  type="text" id="address">
                                                </div>

                                            </div>
                          
                                 </div>
                                  <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                                <div class="col-sm-12">
                                                     <textarea rows="5" name="more_info"  id="more-info" class="form-control"></textarea>
                                                </div>
                                             

                                            </div>
                          
                                 </div> 
                                     <div class="col-12"> 
                                    
                          <button class="btn btn-sm btn-primary mr-1" id="add-btn"></button>
                                 </div> 
                                  
                               
                                 </div> 
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  

                @section('page-script')
         <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.profile.init.js')}}"></script>

        <script src="{{asset('assets/plugins/filter/isotope.pkgd.min.js')}}"></script>

       <script src="{{asset('assets/plugins/filter/masonry.pkgd.min.js')}}"></script>
       <script src="{{asset('assets/plugins/filter/jquery.magnific-popup.min.js')}}"></script>
       <script src="{{asset('assets/pages/jquery.gallery.inity.js')}}"></script>

       
 <script>
  
  if (lang == "ar") {
 document.body.style.direction = "rtl"; 
 document.body.style.textAlign = "right"; 

 document.getElementById("breadcrumb-float").classList.add('float-left');
 document.getElementById("breadcrumb-1").innerHTML ="العملاء"; 

 document.getElementById("page-name").innerHTML ="العملاء";

 document.getElementById("clients-num").innerHTML = "الموكلين";
 document.getElementById("total-num").innerHTML = "العدد الكلي : ";
 document.getElementById("new-clients").innerHTML = "العملاء الجدد";
 document.getElementById("increase").innerHTML = "معدل الزيادة";

 if (document.getElementById("add-client")) {

 document.getElementById("add-client").innerHTML = "اضافة عميل";
 }
 document.getElementById("search-btn").innerHTML = "بحث"; 
 document.getElementById("search-input").placeholder = "اسم العميل";

 document.getElementById("name-ar").placeholder = "اسم العميل عربي";
 document.getElementById("name-eng").placeholder = " اسم العميل انجليزي";
 document.getElementById("p-mail").placeholder = "البريد الالكتروني";
 document.getElementById("s-mail").placeholder = "بريد النظام";
 document.getElementById("pass").placeholder = "كلمة المرور";
 document.getElementById("phone").placeholder = "رقم الهاتف";
 document.getElementById("fax").placeholder = "فاكس";
 document.getElementById("mail-box").placeholder = "صندوق البريد";
 document.getElementById("ssn").placeholder = "رقم الإثبات - رقم الرخصة";
 document.getElementById("address").placeholder = "العنوان";
 document.getElementById("more-info").placeholder = "بيانات اضافية";

 document.getElementById("add-btn").innerHTML = "اضافة عميل"; 




  }else{
     document.body.style.direction = "ltr"; 
 document.body.style.textAlign = "left"; 
 document.getElementById("breadcrumb-float").classList.add('float-right');
 document.getElementById("breadcrumb-1").innerHTML = "Clients";

 document.getElementById("page-name").innerHTML = "CLIENTS";

 document.getElementById("clients-num").innerHTML = "clients";
 document.getElementById("total-num").innerHTML = "Total clients : ";
 document.getElementById("new-clients").innerHTML = "New clients";
 document.getElementById("increase").innerHTML = "Increase precent";

if (document.getElementById("add-client")) {
    document.getElementById("add-client").innerHTML = "Add cLient";
}
 document.getElementById("search-btn").innerHTML = "search";
 document.getElementById("search-input").placeholder = "Client name ";

 document.getElementById("name-ar").placeholder = "Client name arabic";
 document.getElementById("name-eng").placeholder = " Client name english";
 document.getElementById("p-mail").placeholder = "E-mail";
 document.getElementById("s-mail").placeholder = "System E-mail";
 document.getElementById("pass").placeholder = "Password";
 document.getElementById("phone").placeholder = "Phone";
 document.getElementById("fax").placeholder = "Fax";
 document.getElementById("mail-box").placeholder = "Mail box";
 document.getElementById("ssn").placeholder = "SSN / license number";
 document.getElementById("address").placeholder = "Address";
 document.getElementById("more-info").placeholder = "More info..";

 document.getElementById("add-btn").innerHTML = "Add client"; 



  }

</script>
          @endsection

    
@endsection