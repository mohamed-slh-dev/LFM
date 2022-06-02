@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')
    <div class="row">
      
        <div class="col-lg-12 ">
            <div class="card client-card">  
                <div class="mt-3 mx-3">
                    <ul class="list-inline pr-0">                                    
                       
                        <li class="list-inline-item">

                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg"><i class="mdi mdi-plus-box mx-2"></i> <span id="add-expert"></span> </button>

                        </li>
                    </ul>
                </div>                            
            </div>
        </div><!--end col-->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                      
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered">
                                <thead>
                                <tr>
                                <th id="th-1"></th>
                                    <th id="th-2"></th>
                                    <th id="th-3"></th>
                                    <th id="th-4"></th>
                                    <th id="th-5"></th>
                                    <th id="th-6"></th>

                                    <th></th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($experts as $expert)
                                   
                                <tr>
                                    <td> {{$expert->S_Expert_AR_NAME}} </td>
                                    <td> {{$expert->S_Expert_EG_NAME}}</td>
                                    <td> {{$expert->S_REFRANCE}}</td>
                                    <td>{{$expert->mobile_number}}</td>
                                    <td>{{$expert->S_OFFICE}}</td>
                                    <td>{{$expert->S_ADDRESS}}</td>
                                   
                                    <td class="text-center">
                                       <a href="#" class="ml-3"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="{{url('delete-expert/'.$expert->N_Expert_ID)}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                    </td>
                                    
                                  
                                </tr>
                                @endforeach
                               </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
       </div><!-- end row -->


       <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{ route('add-expert') }}">
                        @csrf
                  <div class="row">
                    
            
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-6">
                                       <label id="name-ar"> </label>
                                        <input class="form-control" name="name_ar" type="text" >
                                    </div>

                                     <div class="col-sm-6">
                                       <label id="name-eng"></label>
                                        <input class="form-control" name="name_eng" type="text" >
                                    </div>
                                 
                                 

                           </div>
              
                     </div>
                       <div class="col-12"> 
                        <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                       <label id="c-person"></label>
                                        <input class="form-control" name="contact_person" type="text" >
                                    </div>

                                     <div class="col-sm-4">
                                       <label id="mobile"></label>
                                        <input class="form-control" name="mobile"  type="text" >
                                    </div>
                                    <div class="col-sm-4">
                                        <label id="phone"></label>
                                     <input class="form-control"  name="phone" type="text" >
                                    </div>
                                 

                           </div>
              
                     </div>

                     <div class="col-12"> 
                        <div class="form-group row">
                                   
                                    <div class="col-sm-12">
                                       <label id="address"></label>
                                        <input class="form-control" name="address" type="text" >
                                    </div>

                           </div>
              
                     </div>

                         <div class="col-12"> 
                          <button class="btn btn-sm btn-primary mx-1 font-15" id="add"></button>
                         </div> 
                      

                   </div> 
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
    @section('page-script')
    <script>
      
  if (lang == "ar") {
 document.body.style.direction = "rtl"; 
 document.body.style.textAlign = "right"; 

 document.getElementById("breadcrumb-float").classList.add('float-left');
 document.getElementById("breadcrumb-1").innerHTML ="مكاتب الخبراء"; 
 document.getElementById("breadcrumb-2").innerHTML ="العملاء"; 

 document.getElementById("page-name").innerHTML ="مكاتب الخبراء";

 document.getElementById("add-expert").innerHTML = "اضافة مكتب";

 document.getElementById("th-1").innerHTML = "الاسم عربي";
 document.getElementById("th-2").innerHTML = "الاسم انجليزي";
 document.getElementById("th-3").innerHTML = "شخص الاتصال";
 document.getElementById("th-4").innerHTML = "رقم المحمول";
 document.getElementById("th-5").innerHTML = "التلفون";
 document.getElementById("th-6").innerHTML = "العنوان";

 document.getElementById("add").innerHTML = "اضافة مكتب";

 document.getElementById("name-ar").innerHTML = "الاسم عربي";
 document.getElementById("name-eng").innerHTML = "الاسم انجليزي";
 document.getElementById("c-person").innerHTML = " شخص الاتصال";
 document.getElementById("mobile").innerHTML = "رقم الجوال";
 document.getElementById("phone").innerHTML = "رقم الهاتف";
 document.getElementById("address").innerHTML = "العنوان";


  }else{
     document.body.style.direction = "ltr"; 
 document.body.style.textAlign = "left"; 
 document.getElementById("breadcrumb-float").classList.add('float-right');
 document.getElementById("breadcrumb-1").innerHTML = "experts offices";
 document.getElementById("breadcrumb-2").innerHTML ="clients"; 

 document.getElementById("page-name").innerHTML = "EXPERTS OFFICES";

 document.getElementById("add-expert").innerHTML = "Add office";

 
 document.getElementById("th-1").innerHTML = "Name arabic";
 document.getElementById("th-2").innerHTML = "Name english";
 document.getElementById("th-3").innerHTML = "Contact person";
 document.getElementById("th-4").innerHTML = "Mobile number";
 document.getElementById("th-5").innerHTML = "Phone number";
 document.getElementById("th-6").innerHTML = "Address";

 document.getElementById("add").innerHTML = "add office";

 document.getElementById("name-ar").innerHTML = "Name arabic";
 document.getElementById("name-eng").innerHTML = "Name english";
 document.getElementById("c-person").innerHTML = "Contact person";
 document.getElementById("mobile").innerHTML = "Mobile number";
 document.getElementById("phone").innerHTML = "Phone number";
 document.getElementById("address").innerHTML = "Address";



  }
 </script>
    @endsection

   
@endsection