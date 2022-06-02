@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
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
                <div class="col-lg-12  mt-3 mx-3">
                    <div class="">
                        <ul class="list-inline pr-0">                                    
                           
                            <li class="list-inline-item">
        
                            <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg"><i class="mdi mdi-plus-box mx-2"></i> <span id="add-client"></span></button>
        
                            </li>
                        </ul>
                    </div>                            
                </div><!--end col-->

                <form class="form"  method="POST" action="{{route('search-againsts')}}">
                    @csrf                                
                <div class="card-body text-center" >
                      <div class="row">
                      <div class="col-8">
                         <div class="row">
                       <div class="col-sm-3">
                                    <input class="form-control " id="search-input" name="against_name" type="text" >
                                   
                     </div>
                 <div class="col-sm-4">
                  <button class="btn btn-success waves-effect waves-light mr-3" id="search-btn">  </button>
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
                    @if ($lang == "ar")
                    <h5 class=" client-name">{{ $opp->S_AGAINST_AR_NAME}}</h5> 
                    @else
                    <h5 class=" client-name">{{ $opp->S_AGAINST_EG_NAME}}</h5>   
                    @endif          
                    <i class="dripicons-location mr-2 text-info ml-2"></i> <span class="text-muted">{{$opp->S_ADDRESS}}</span>

                    <i class="dripicons-phone mr-2 text-info ml-2"></i>  <span  class="text-muted">{{$opp->phone}}</span>
                    
                    <p class="text-muted text-center mt-3">{{$opp->more_info}}</p>
                    @if ($lang == "ar")
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
    <div class="float-left mt-4">
        {{ $opponents->links() }}
        
        </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
          <div class="modal-body">
            <form class="form"  method="POST" action="{{ route('add-opponents') }}" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                    <div class="col-lg-8">
                 
                    </div>
                  
                    <div class="col-lg-4">
                           <input type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="../assets/images/users/user-4.jpg"/>
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
                                        <input class="form-control" name="name_eng" type="text" id="name-eng">
                                    </div>
                                </div>
                        
                    </div>
                     <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                        <input class="form-control" name="email"  type="mail" id="p-mail">
                                    </div>
                                     <div class="col-sm-4">
                                        <input class="form-control" name="phone" type="text" id="phone">
                                    </div>
                                     <div class="col-sm-4">
                                        <input class="form-control" name="fax"  type="text" id="fax">
                                    </div>

                                </div>
              
                     </div>
                        
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-6">
                                        <input class="form-control" name="account_num"  type="test" id="account-number">
                                    </div>
                                     <div class="col-sm-6">
                                           <select class="custom-select" name="branch">
                                            <option value="" disabled selected>الفرع</option>
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
                                        <select class="custom-select" name="nation">
                                            <option value="" disabled selected>الجنسية</option>
                                           
                                            @foreach ($nationality as $nation)
                                            <option value="{{$nation->N_DetailedCode}}">{{$nation->S_Desc_A}}</option>  
                                            @endforeach
                                                
                                            </select>
                                        </div>
                                     <div class="col-sm-4">
                                        <input class="form-control" name="passport_num"  type="text" id="ssn">
                                    </div>
                                     <div class="col-sm-4">
                                        <input class="form-control" name="address"  type="text" id="address">
                                    </div>

                                </div>
              
                     </div>
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-12">
                                         <textarea rows="5" name="more_info" id="more-info" class="form-control"></textarea>
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
document.getElementById("breadcrumb-2").innerHTML ="الخصوم"; 

document.getElementById("page-name").innerHTML ="الخصوم";

document.getElementById("clients-num").innerHTML = "الخصوم";
document.getElementById("total-num").innerHTML = "العدد الكلي : ";
document.getElementById("new-clients").innerHTML = "الخصوم الجدد";
document.getElementById("increase").innerHTML = "معدل الزيادة";

document.getElementById("add-client").innerHTML = "اضافة خصم";
document.getElementById("search-btn").innerHTML = "بحث"; 
document.getElementById("search-input").placeholder = "اسم الخصم";

document.getElementById("name-ar").placeholder = "اسم العميل عربي";
document.getElementById("name-eng").placeholder = " اسم العميل انجليزي";
document.getElementById("p-mail").placeholder = "البريد الالكتروني";
document.getElementById("phone").placeholder = "رقم الهاتف";
document.getElementById("fax").placeholder = "فاكس";
document.getElementById("account-number").placeholder = "رقم الحساب";
document.getElementById("ssn").placeholder = "رقم الإثبات - رقم الرخصة";
document.getElementById("address").placeholder = "العنوان";
document.getElementById("more-info").placeholder = "بيانات اضافية";

document.getElementById("add-btn").innerHTML = "اضافة خصم"; 

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


document.getElementById("add-client").innerHTML = "Add against";
document.getElementById("search-btn").innerHTML = "search";
document.getElementById("search-input").placeholder = "Against name ";

document.getElementById("name-ar").placeholder = "Against name arabic";
document.getElementById("name-eng").placeholder = "Against name english";
document.getElementById("p-mail").placeholder = "E-mail";
document.getElementById("phone").placeholder = "Phone";
document.getElementById("fax").placeholder = "Fax";
document.getElementById("account-number").placeholder = "Bank account number";
document.getElementById("ssn").placeholder = "SSN / license number";
document.getElementById("address").placeholder = "Address";
document.getElementById("more-info").placeholder = "More info..";

document.getElementById("add-btn").innerHTML = "add against"; 

}
</script>
     @endsection

  
    
@endsection