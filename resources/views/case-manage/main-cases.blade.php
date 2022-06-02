@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection
@section('content')

<div class="row">
                    
    <div class="col-lg-12 col-xl-6">
       <div class="row">
           <div class="col-lg-6">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                           
                           <div class="col-8 align-self-center">
                               <div class="ml-2">
                                   <p class="mb-1 text-muted" id="open-cases">عدد القضايا المفتوحة</p>
                                   <h4 class="mt-0 mb-1"> {{$open_cases->count()}} </h4>                                                         
                               </div>
                           </div>
                           <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder-open text-success"></i>
                            </div> 
                        </div>                    
                       </div>
                       <div class="progress mt-2" style="height:3px;">
                           <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->

           <div class="col-lg-6">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                          
                           <div class="col-8 align-self-center">
                               <div class="ml-2">
                                   <p class="mb-1 text-muted" id="closed-cases">عدد القضايا المغلقة</p>
                                   <h4 class="mt-0 mb-1"> {{$close_cases->count()}}</h4>                                                         
                               </div>
                           </div>  
                           <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder text-danger"></i>
                            </div> 
                        </div>                  
                       </div>
                       <div class="progress mt-2" style="height:3px;">
                           <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->


       </div><!--end row-->  
   </div> <!-- end col -->

     <div class="col-lg-12 col-xl-6">
       <div class="card">
           <div class="card-body">            
               <h4 class="mt-0 header-title" id="chart-title"></h4>
               <p class="text-muted mb-3 d-inline-block text-truncate w-100" id="chart-desc">
               </p>            
               <canvas id="" width="400" height="200"></canvas>
          </div><!--end card-body-->
       </div> <!-- end card -->  
   </div> <!-- end col -->
</div>

<div class="row">

    

  <div class="col-lg-12">

          <div class="card client-card">  
            <div class="col-lg-12 ">
                <div class="">
                    <ul class="list-inline mt-3 pr-0 mr-3 mb-0">                                    
                       
                       @if ($add_main_case == 'true')
                            <li class="list-inline-item">
       
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-case" id="add-case-btn"></button>
       
                        </li>
                       @endif
                       
                    </ul>
                </div>                            
            </div><!--end col-->
            <form class="form"  method="POST" action="{{route('search-main-cases')}}">
                @csrf                                
             <div class="card-body text-center" >
                   <div class="row">
                   <div class="col-12">
                      <div class="row">
                        <div class="col-3">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="search-case-number"></label>
                                <div class="col-sm-8">
                                    <input class="form-control font-13" name="main_case_num" id="main-cases-main-case-num" type="text" id="example-text-input">
                                </div>
                            </div> 
                        </div>
                       

                  <div class="col-3  ">
                               <div class="form-group row">
                             <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="main-cases-status"></label>
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
                             <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="main-cases-branch"></label>
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
                  
            <div class="col-3  text-center">
               <button class="btn btn-success waves-effect waves-light mx-3" id="main-cases-btn"> بحث </button>
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
         <div class="card">
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
                   <img src="../assets/images/case-img.png" alt="" height="90" class="mx-auto d-block" style="margin-top: 25px;padding-right: 15px;"> 
                    <br>
       
                      @if (Session::get('lang') == "ar")
                      <h4 class="" style=""> <span> رقم القضية </span>  : {{$mc->N_CASE_ID}}</h4>
                      <div style="display:inline-block">
                        <h4> <i class="mdi mdi-account  mr-2 text-success ml-2"></i> {{$mc->clientName}}  </h4> 
                        <h4> <i class="mdi mdi-account  mr-2 text-danger ml-2"></i>  {{$mc->againstName}}</h4>

                      </div>
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
                      <div style="display:inline-block">
                        <h4> <i class="mdi mdi-account  mr-2 text-success ml-2"></i> {{$mc->clientName}}  </h4> 
                        <h4> <i class="mdi mdi-account  mr-2 text-danger ml-2"></i>  {{$mc->againstName}}</h4>

                      </div>
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
 <div class="float-left mt-4">
    {{ $main_cases->links() }}
    
</div>
 
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
                                        @foreach ($files as $file)
                                        <option value="{{$file->file_id}}">{{$file->file_id}}</option>
                                          @endforeach
                                           
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
                                <input type="text" class="form-control fraction-commas" name="payment" 
                                     value="{{number_format($mc->N_PaymentValue,2) }}">  
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
                                <input type="text" class="form-control fraction-commas" name="payment" 
                                 value="{{number_format($mc->N_PaymentValue,2) }}">  
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

<script>
    // var ctx = document.getElementById('myChart');
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: ['غير محدد', 'فرع دبي', 'فرع ابوظبي'],
    //         datasets: [{
    //             label: '#',
    //             data: [3, 2, 0],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true
    //                 }
    //             }]
    //         }
    //     }
    // });
    // </script>
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
document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
document.getElementById("breadcrumb-2").innerHTML = "القضايا"; 

document.getElementById("page-name").innerHTML = " القضايا";

document.getElementById("open-cases").innerHTML = " عدد القضايا المفتوحة ";
document.getElementById("closed-cases").innerHTML = " عدد القضايا المغلقة ";

document.getElementById("chart-title").innerHTML = " حالات القضية ";
document.getElementById("chart-desc").innerHTML = " 'رسم توضيحي لحالات القضايا '  ";

document.getElementById("search-case-number").innerHTML = "بحث القضية";
document.getElementById("main-cases-main-case-num").placeholder = "رقم القضية ";
document.getElementById("main-cases-status").innerHTML = "حالة القضية ";
document.getElementById("main-cases-branch").innerHTML = " الفرع ";
document.getElementById("main-cases-btn").innerHTML = " بحث ";

if (document.getElementById("add-case-btn")) {
    document.getElementById("add-case-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> إضافة قضية جديدة';
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
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "main cases ";

document.getElementById("page-name").innerHTML = "MAIN CASES";

document.getElementById("open-cases").innerHTML = "Open cases  ";
document.getElementById("closed-cases").innerHTML = " Closed cases ";

document.getElementById("chart-title").innerHTML = "Cases status ";
document.getElementById("chart-desc").innerHTML = " 'Cases status diagram'  ";

document.getElementById("search-case-number").innerHTML = "Search Case";
document.getElementById("main-cases-main-case-num").placeholder = "Case number ";
document.getElementById("main-cases-status").innerHTML = "Case status ";
document.getElementById("main-cases-branch").innerHTML = "Branch ";
document.getElementById("main-cases-btn").innerHTML = " search ";

if (document.getElementById("add-case-btn")) {
document.getElementById("add-case-btn").innerHTML ='<i class="mdi mdi-plus-box mx-2"></i> Add new case';
}

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