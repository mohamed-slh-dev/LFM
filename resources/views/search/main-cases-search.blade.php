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

    <div class="card client-card">  
     
      <form class="form"  method="POST" action="{{route('search-main-cases')}}">
          @csrf                                
       <div class="card-body text-center" >
             <div class="row">
             <div class="col-12">
                <div class="row">

              <div class="col-2 pl-0">
                           <input class="form-control font-13" name="main_case_num" id="main-cases-main-case-num" type="number" id="example-text-input">
            </div>

            <div class="col-3  ">
                         <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="main-cases-status"></label>
                       <div class="col-sm-8">
                         <select class="custom-select text-right" name="status">
                          <option value="all"></option>
                          @foreach ($case_status as $case_status_filter)
                          <option value="{{$case_status_filter->N_DetailedCode}}">{{$case_status_filter->S_Desc_A}}</option>  
                          @endforeach
                          </select>
                       </div>
                   </div>
                          
            </div>
              <div class="col-3 ">
                      <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="main-cases-branch"></label>
                       <div class="col-sm-8">
                         <select class="custom-select text-right" name="branch">
                          <option value="all"></option>
                          @foreach ($branchs as $branch_filter)
                          <option value="{{$branch_filter->N_DetailedCode}}">{{$branch_filter->S_Desc_A}}</option>  
                          @endforeach
                            
                               
                           </select>
                       </div>
                   </div>
                          
            </div>
            
      <div class="col-1  text-right">
         <button class="btn btn-success waves-effect waves-light mr-3" id="main-cases-btn"> </button>
        </div>
            </div>
             </div>
           
                       
                      
                    
            </div>

      </div>
      </form>
   </div>      
</div>
@foreach ($main_cases as $mc)
  
<div class="col-lg-4">
    <div class="card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">
        <div class="card-body pb-0">  
        <div style="display: ruby;" class="row">  
                <div class=" col-6">
                    @if (Session::get('lang') == "ar")
                    <h5 class="text-muted"> <span id="case-file-number">رقم الملف</span> : {{$mc->S_CASE_FILE_NUM }} </h5>
                    @else
                    <h5 class="text-muted"> <span id="case-file-number">File number</span> : {{$mc->S_CASE_FILE_NUM }} </h5>
                    @endif         
               </div>                            
            <div class=" d-flex justify-content-end col-6">                                        
                <div class="dropdown d-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel3" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="dLabel3">
                        @if (Session::get('lang') == "ar")
                        <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case-{{$mc->N_CASE_ID}}" class="dropdown-item" href="#">تعديل</a>
                        <a class="dropdown-item text-danger" href="{{url('close-case/'.$mc->N_CASE_ID)}}">اغلاق القضية</a>
                    
                   @else 
                   <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case-{{$mc->N_CASE_ID}}" class="dropdown-item" href="#">edit</a>
                   <a class="dropdown-item text-danger" href="{{url('close-case/'.$mc->N_CASE_ID)}}"> close case</a>
               
                   @endif 
                </div>
             </div>
            </div> 
        </div>
            <div class="text-center project-card" style="margin-top: -50px;">
              <img src="{{asset('assets/images/case-img.png')}}" alt="" height="90" class="mx-auto d-block" style="margin-top: 25px;padding-right: 15px;"> 
               <br>
  
              
               <div style="display:inline-block">
                   <h4> <i class="mdi mdi-account  mr-2 text-success mx-2"></i> {{$mc->clientName}}  </h4> 
                   <h4> <i class="mdi mdi-account  mr-2 text-danger mx-2"></i>  {{$mc->againstName}}</h4>

                 </div>
                 <br>
                 @if (Session::get('lang') == "ar")
               <h4 class="" style=""> <span> رقم القضية </span>  : {{$mc->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> موضوع القضية</b></span> : {{$mc->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>  قيمة المطالبة</b></span> : {{number_format($mc->N_PaymentValue,2) }}
               </p>

               <a href="{{url('main-case-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">عرض القضية</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" > تقرير القضية</button></a>
              <br>
               <div class="row">
                   <div class="col-6">
                     <p class="text-muted ">  <span id="card-case-create">تاريخ الانشاء</span> : {{$mc->DT_CASE_DATE}}   </p>

                   </div>
                   <div class="col-6">
                     <p class="text-muted "> <span id="card-case-register">تاريخ التسجيل</span>  : {{$mc->register_date}}   </p>

                 </div>

               </div>
               @else
               <h4 class="" style=""> <span> Case number </span>  : {{$mc->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> Case subject</b></span> : {{$mc->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>Cliam amont</b></span> : {{number_format($mc->N_PaymentValue,2) }}
               </p>

               <a href="{{url('main-case-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">View case</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" >Case report</button></a>
              <br>
               <div class="row">
                   <div class="col-6">
                     <p class="text-muted ">  <span id="card-case-create">Create date</span> : {{$mc->DT_CASE_DATE}}   </p>

                   </div>
                   <div class="col-6">
                     <p class="text-muted "> <span id="card-case-register">Register date</span>  : {{$mc->register_date}}   </p>

                 </div>

               </div>
                   
               @endif
                    
            </div>                                                                      
        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->    
@endforeach

</div><!--end row-->



@foreach ($main_cases as $mc)
<div class="modal fade edit-main-case-{{$mc->N_CASE_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-main-case')}}">
                        @csrf
                <div class="row">
                    

          
               

                    <input type="hidden" name="main_case_id" id="" value="{{$mc->N_CASE_ID}}">

                
                    
                 
                    @if (Session::get('lang') == "ar")
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-6">
                                <label id="edit-case-branch"> فرع المكتب </label>
                                <select  class="custom-select" name="branch">
                                    <option value="{{$mc->branchCode}}">{{$mc->branchName}}</option>  

                                    @foreach ($branchs as $branchh)
                                    <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-status">حالة القضية</label>
                                <select  class="custom-select" name="case_status">
                                    <option value="{{$mc->caseStatusCode}}">{{$mc->caseStatusName}}</option>  
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
                                    <option value="{{$mc->assignId}}">{{$mc->assignName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-consult"> المستشار </label>
                                <select  class="custom-select" name="consult">
                                    <option value="{{$mc->consultId}}">{{$mc->consultName}}</option>  
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
                                <label>  قيمة المطالبة</label>
                                <input type="text" class="form-control fraction-commas" name="payment"  value="{{number_format($mc->N_PaymentValue,2) }}">  
                              </div>
                              
                        </div>
                    </div>
                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="noe_date" id="edit-case-subject"> موضوع القضية</label>
                                <textarea class="form-control"  name="subject" rows="5" id="message"> {{$mc->S_CASE_SUBJECT}}</textarea>
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
                                    <option value="{{$mc->branchCode}}">{{$mc->branchName}}</option>  

                                    @foreach ($branchs as $branchh)
                                    <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-status">Case status</label>
                                <select  class="custom-select" name="case_status">
                                    <option value="{{$mc->caseStatusCode}}">{{$mc->caseStatusName}}</option>  
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
                                    <option value="{{$mc->assignId}}">{{$mc->assignName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-consult">Consultant </label>
                                <select  class="custom-select" name="consult">
                                    <option value="{{$mc->consultId}}">{{$mc->consultName}}</option>  
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
                                <input type="text" class="form-control fraction-commas" name="payment"  value="{{number_format($mc->N_PaymentValue,2) }}">  
                              </div>
                              
                        </div>
                    </div>

                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="noe_date" id="edit-case-subject">Case subject </label>
                                <textarea class="form-control"  name="subject" rows="5" id="message"> {{$mc->S_CASE_SUBJECT}}</textarea>
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
        
    @endforeach
@endsection

@section('page-script')

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
    document.getElementById("breadcrumb-1").innerHTML = "البحث"; 
    document.getElementById("breadcrumb-2").innerHTML = "بحث القضايا"; 

    document.getElementById("page-name").innerHTML = "بحث القضايا";

    document.getElementById("main-cases-main-case-num").placeholder = "رقم القضية ";
    document.getElementById("main-cases-status").innerHTML = "حالة القضية ";
    document.getElementById("main-cases-branch").innerHTML = " الفرع ";
    document.getElementById("main-cases-btn").innerHTML = " بحث ";
  



         }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "search";
    document.getElementById("breadcrumb-1").innerHTML = "main cases search";

    document.getElementById("page-name").innerHTML = "MAIN CASES SEARCH";

    document.getElementById("main-cases-main-case-num").placeholder = "Case number ";
    document.getElementById("main-cases-status").innerHTML = "Case status ";
    document.getElementById("main-cases-branch").innerHTML = "Branch ";
    document.getElementById("main-cases-btn").innerHTML = " search ";

         }
</script>
    
@endsection