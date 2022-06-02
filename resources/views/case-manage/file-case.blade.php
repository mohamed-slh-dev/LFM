@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('css-link')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-name')
 
@endsection

@section('content')

<div class="row">
   
    @if ($case)
    <div class="col-lg-4">
        <div class="card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">
            <div class="card-body pb-0">  
                <div style="display: ruby;" class="row">  
                    <div class=" col-6">
                        @if (Session::get('lang') == "ar")
                        <h5 class="text-muted"> <span id="case-file-number">رقم الملف</span> : {{$case->S_CASE_FILE_NUM }} </h5>
                        @else
                        <h5 class="text-muted"> <span id="case-file-number">File number</span> : {{$case->S_CASE_FILE_NUM }} </h5>
                        @endif         
                   </div>                            
                <div class=" d-flex justify-content-end col-6">                                        
                    <div class="dropdown d-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none" id="dLabel3" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="dLabel3">
                            @if (Session::get('lang') == "ar")
                            <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case" class="dropdown-item" href="#">تعديل</a>
                            <a class="dropdown-item text-danger" href="{{url('close-case/'.$case->N_CASE_ID)}}">اغلاق القضية</a>
                        
                       @else 
                       <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case" class="dropdown-item" href="#">edit</a>
                       <a class="dropdown-item text-danger" href="{{url('close-case/'.$case->N_CASE_ID)}}"> close case</a>
                   
                       @endif 
                    </div>
                 </div>
                </div> 
            </div>
                <div class="text-center project-card" style="margin-top: -50px;">
                  <img src="../assets/images/case-img.png" alt="" height="90" class="mx-auto d-block" style="margin-top: 25px;padding-right: 15px;"> 
                   <br>

      
                     @if (Session::get('lang') == "ar")
               <h4 class="" style=""> <span> رقم القضية </span>  : {{$case->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> موضوع القضية</b></span> : {{$case->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>  قيمة المطالبة</b></span> : {{number_format($case->N_PaymentValue,2) }}
               </p>

               <a href="{{url('main-case-cases/'.$case->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">عرض القضية</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" > تقرير القضية</button></a>
              <br>
               <div class="row">
                   <div class="col-6">
                     <p class="text-muted ">  <span id="card-case-create">تاريخ الانشاء</span> : {{$case->DT_CASE_DATE}}   </p>

                   </div>
                   <div class="col-6">
                     <p class="text-muted "> <span id="card-case-register">تاريخ التسجيل</span>  : {{$case->register_date}}   </p>

                 </div>

               </div>
               @else
               <h4 class="" style=""> <span> Case number </span>  : {{$case->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> Case subject</b></span> : {{$case->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>Cliam amont</b></span> : {{number_format($case->N_PaymentValue,2) }}
               </p>

               <a href="{{url('main-case-cases/'.$case->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">View case</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" >Case report</button></a>
              <br>
               <div class="row">
                   <div class="col-6">
                     <p class="text-muted ">  <span id="card-case-create">Create date</span> : {{$case->DT_CASE_DATE}}   </p>

                   </div>
                   <div class="col-6">
                     <p class="text-muted "> <span id="card-case-register">Register date</span>  : {{$case->register_date}}   </p>

                 </div>

               </div>
                   
               @endif
                        
                </div>                                                                      
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col--> 
    <div class="col-6">
        <div class="card">
            <div class="card-body"> 
    @if ($add_file == 'true')
   
        <div class="">
          
            <ul class="list-inline pr-0 mb-0">                                    
             
                   <li class="list-inline-item">

                <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-against" id="add-more-against"></button>

                </li>
             </ul>
          
        </div>                            
  
    @endif
          
        <h4 id="againsts-title"></h4>
               @foreach ($against_list as $against)
               <li>
                   {{$against->S_AGAINST_AR_NAME}} - 
                   <a href="{{url('delete-against/'.$against->N_AGAINST_ID,$file_id)}}" class="text-danger" >
                    <i class="fas fa-trash-alt text-danger font-16"></i>
                </a>
                </li>
               @endforeach
                   </div>
           </div>
    </div>
    
    
    
        
    @else
   
    <div class="col-lg-12 ">
        <div class="">
            <p id="no-case"></p>
            <ul class="list-inline pr-0">                                    
               
                <li class="list-inline-item">

                <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-case" id="add-case">  </button>

                </li>
            </ul>
        </div>                            
    </div><!--end col-->
        
    @endif

    

   
</div><!--end row-->

<div class="modal fade new-case" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-main-cases')}}">
                    @csrf
              <div class="row">
                
              <div class="col-12"> 
                      <div class="form-group row">
                               
                              

                                <div class="col-sm-4">
                                    <label id="new-case-file-num"></label>
                                     <select class="custom-select" name="file_id">
                                      
                                        <option value="{{$file_id}}">{{$file_id}}</option>
                                           
                                       </select>
                                   </div>

                                   <div class="col-sm-4">
                                    <label for="noe_date" id="new-case-by"></label>
                                <input class="form-control" disabled value="{{ auth()->user()->name }}" type="text" id="example-text-input">
                              </div>
                               <div class="col-sm-4">
                                    <label for="noe_date" id="new-case-date"></label>
                             <input class="form-control " disabled type="date" id="example-text-input">
                              </div>

                               
                             

                            </div>
          
                 </div>

                 
               
                 <div class="col-12"> 
                    <div class="form-group row">
                             
                   
                      
                      <div class="col-sm-6">
                        <label id="new-case-status"></label>
                         <select class="custom-select" name="status">
                          @foreach ($case_status as $case_statuss)
                          <option value="{{$case_statuss->N_DetailedCode}}">{{$case_statuss->S_Desc_A}}</option>  
                          @endforeach
                              
                          </select>
                      </div>
                      <div class="col-sm-6">
                          <label id="new-case-amount"></label>
                          <input class="form-control fraction-commas"  type="text" name="payment" id="example-text-input">

                        </div>

                          </div>
        
               </div>
               


                <div class="col-12"> 
                      <div class="form-group row">
                               
                        <div class="col-sm-4">
                            <label for="noe_date" id="new-case-branch"></label>
                               <select class="custom-select" name="branch">
                                @foreach ($branchs as $branch)
                                <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                @endforeach
                                  
                              </select>
                          </div>
                                 <div class="col-sm-4">
                                      <label for="noe_date" id="new-case-admin"></label>
                                      <select class="custom-select" name="assignto">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} </option>
                                            
                                        @endforeach
                                  
                                    </select>
                                </div>
                                 <div class="col-sm-4">
                                      <label for="noe_date" id="new-case-consult"> </label>
                                      <select class="custom-select" name="consult">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} </option>
                                            
                                        @endforeach
                                  
                                    </select>
                                </div>

                            </div>
          
                 </div>
                  <div class="col-12"> 
                  <label for="noe_date" id="new-case-subject"></label>
                   <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                  </div>

                            <div class="col-12"> 
                              <button class="btn btn-sm btn-primary mr-1 mt-3 font-15" id="new-case-add-btn"></button>
                        </div> 
                  

                 </div> 
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  


<div class="modal fade add-against" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
            
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-against')}}">
                    @csrf
                    <input type="hidden" name="file_id" value="{{$file_id}}">
                    @if ($case)
                    <input type="hidden" name="main_case_id" value="{{$case->N_CASE_ID}}">
                    @endif
              <div class="row">
                   <div class="col-12"> 
                      
                      <div class="form-group row">
                               
                        
                                 <div class="col-sm-6">
                                  <label for="noe_date" id="against-name"> </label>
                                     <select class="js-example-basic-single form-control mb-3 custom-select" name="against_id" style="width: 100%;">
                                        @foreach ($againsts as $against)
                                        <option value="{{$against->N_AGAINST_ID}}">{{$against->S_AGAINST_AR_NAME}}</option>
                             @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                         </div>

                        <div class="col-12">
                                <button class="btn btn-sm btn-primary mr-1 font-15" id="add-against-btn">اضافة خصم</button>
                            </div> 
                  

                     </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@if ($case)

<div class="modal fade edit-main-case" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('update-main-case')}}">
                    @csrf
            <div class="row">
         
                <input type="hidden" name="from_file_case" id="" value="1">
                <input type="hidden" name="main_case_id" id="" value="{{$case->N_CASE_ID}}">

              
                @if (Session::get('lang') == "ar")
                <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-6">
                            <label id="edit-case-branch"> فرع المكتب </label>
                            <select  class="custom-select" name="branch">
                                <option value="{{$case->branchCode}}">{{$case->branchName}}</option>  

                                @foreach ($branchs as $branchh)
                                <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                @endforeach
                            </select>        
                          </div>
                          <div class="col-6">
                            <label id="edit-case-status">حالة القضية</label>
                            <select  class="custom-select" name="case_status">
                                <option value="{{$case->caseStatusCode}}">{{$case->caseStatusName}}</option>  
                                @foreach ($case_status as $cs)
                                <option value="{{$cs->N_DetailedCode}}">{{$cs->S_Desc_A}}</option>  
                                @endforeach
                            </select>        
                          </div>

                             

                            
                        </div>
                </div> 
                
                <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-6">
                            <label id="edit-case-assign"> المكلف الاداري</label>
                            <select  class="custom-select" name="assignTo">
                                <option value="{{$case->assignId}}">{{$case->assignName}}</option>  
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} </option>
                                    
                                @endforeach
                            </select>        
                          </div>
                          <div class="col-6">
                            <label id="edit-case-consult"> المستشار </label>
                            <select  class="custom-select" name="consult">
                                <option value="{{$case->consultId}}">{{$case->consultName}}</option>  
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} </option>
                                    
                                @endforeach
                            </select>        
                          </div>

                          <div class="col-12"> 
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>  قيمة المطالبة</label>
                                    <input type="text" class="form-control fraction-commas" name="payment"  value="{{number_format($case->N_PaymentValue,2) }}">  
                                  </div>
                                  
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="noe_date" id="edit-case-subject"> موضوع القضية</label>
                            <textarea class="form-control"  name="subject" rows="5" id="message"> {{$case->S_CASE_SUBJECT}}</textarea>
                           </div>
                    </div>
                </div>

             
                   
                       
                   

                  </div>
                  <button class="btn btn-primary my-4" type="submit" id="edit-case-btn">تحديث </button>
       </div>
                @else
                <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-6">
                            <label id="edit-case-branch">Office branch </label>
                            <select  class="custom-select" name="branch">
                                <option value="{{$case->branchCode}}">{{$case->branchName}}</option>  

                                @foreach ($branchs as $branchh)
                                <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                @endforeach
                            </select>        
                          </div>
                          <div class="col-6">
                            <label id="edit-case-status">Case status</label>
                            <select  class="custom-select" name="case_status">
                                <option value="{{$case->caseStatusCode}}">{{$case->caseStatusName}}</option>  
                                @foreach ($case_status as $cs)
                                <option value="{{$cs->N_DetailedCode}}">{{$cs->S_Desc_A}}</option>  
                                @endforeach
                            </select>        
                          </div>

                             

                            
                        </div>
                </div> 
                
                <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-6">
                            <label id="edit-case-assign"> Adminstrarive charge </label>
                            <select  class="custom-select" name="assignTo">
                                <option value="{{$case->assignId}}">{{$case->assignName}}</option>  
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} </option>
                                    
                                @endforeach
                            </select>        
                          </div>
                          <div class="col-6">
                            <label id="edit-case-consult">Consultant </label>
                            <select  class="custom-select" name="consult">
                                <option value="{{$case->consultId}}">{{$case->consultName}}</option>  
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} </option>
                                    
                                @endforeach
                            </select>        
                          </div>
                    </div>
                </div>
                <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-6">
                            <label>  Cliam amount</label>
                            <input type="text" class="form-control fraction-commas" name="payment"  value="{{number_format($case->N_PaymentValue,2) }}">  
                          </div>
                          
                    </div>
                </div>
                <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="noe_date" id="edit-case-subject">Case subject </label>
                            <textarea class="form-control"  name="subject" rows="5" id="message"> {{$case->S_CASE_SUBJECT}}</textarea>
                           </div>
                    </div>
                </div>

             
                   
                       
                   

                  </div>
                  <button class="btn btn-primary my-4" type="submit" id="edit-case-btn">update </button>
       </div>
                    
                @endif              
                     </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
@endif
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>   

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<script>

    $('.fraction-commas').keyup(function() {


    //get the id number of button || remove all non=numeric things
    var value = $(this).val();
    value = value.replace(/\D/g,'');

    // put commas back again
    var commas = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    //copy the new val
    $(this).val(commas);

    });

</script>

<script>

       if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = "الملفات"; 
    document.getElementById("breadcrumb-3").innerHTML = "قضية الملف"; 

    document.getElementById("page-name").innerHTML = "قضية الملف";

    if ( document.getElementById("add-more-against") != null) {
    document.getElementById("add-more-against").innerHTML = " <i class='mdi mdi-plus-box mx-2'></i>اضافة خصم";
    document.getElementById("againsts-title").innerHTML = "الخصوم : ";
    }

    if (document.getElementById("add-case")) {
        document.getElementById("add-case").innerHTML = " <i class='mdi mdi-plus-box mx-2'></i>اضاقة قضية ";
        document.getElementById("add-against-btn").innerHTML = "اضافة خصم ";

    }
    document.getElementById("against-name").innerHTML = "اسم الخصم";

if ( document.getElementById("no-case")) {
    document.getElementById("no-case").innerHTML = "لا توجد قضية في هذا الملف ";

}


    document.getElementById("new-case-file-num").innerHTML = "رقم الملف";
    document.getElementById("new-case-by").innerHTML = "بواسطة";
    document.getElementById("new-case-date").innerHTML = "تاريخ الاستلام";
    document.getElementById("new-case-branch").innerHTML = "فرع المكتب";
    document.getElementById("new-case-status").innerHTML = "حالة القضية";
    document.getElementById("new-case-amount").innerHTML = "قيمة المطالبة";
    document.getElementById("new-case-admin").innerHTML = "المكلف الاداري";
    document.getElementById("new-case-consult").innerHTML = "المستشار";
    document.getElementById("new-case-subject").innerHTML = "موضوع القضية";
    document.getElementById("new-case-add-btn").innerHTML = "اضافة قضية";

       }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = "files" ;
    document.getElementById("breadcrumb-1").innerHTML = "file case" ;


    document.getElementById("page-name").innerHTML = "FILE CASE";

    if ( document.getElementById("add-more-against") != null) {
        document.getElementById("add-more-against").innerHTML = "<i class='mdi mdi-plus-box mx-2'></i>Add against";
    document.getElementById("againsts-title").innerHTML = "Againsts list : ";

    }
    if (document.getElementById("no-case")) {
        document.getElementById("no-case").innerHTML = "There is no case in this file yet";
        document.getElementById("add-case").innerHTML = " <i class='mdi mdi-plus-box mx-2'></i>Add case ";

    }

   
    
    document.getElementById("against-name").innerHTML = "Against name";
    document.getElementById("add-against-btn").innerHTML = "Add against ";

   
    document.getElementById("new-case-file-num").innerHTML = "File No.";
    document.getElementById("new-case-by").innerHTML = "Created by";
    document.getElementById("new-case-date").innerHTML = "Created date";
    document.getElementById("new-case-branch").innerHTML = "Branch";
    document.getElementById("new-case-status").innerHTML = "Case status";
    document.getElementById("new-case-amount").innerHTML = "Cliam amount";
    document.getElementById("new-case-admin").innerHTML = "Adminstrative charge";
    document.getElementById("new-case-consult").innerHTML = "Consultant";
    document.getElementById("new-case-subject").innerHTML = "Case subject";
    document.getElementById("new-case-add-btn").innerHTML = "Add case";
       }
</script>
    
@endsection