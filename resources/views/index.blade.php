@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-1" class="breadcrumb-item active">الرئيسية</li>
@endsection

@section('page-name')

@endsection

@section('css-link')
<link href="{{asset('assets/plugins/fullcalendar/packages/core/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/daygrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/bootstrap/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/timegrid/main.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fullcalendar/packages/list/main.css')}}" rel="stylesheet" />
    
@endsection

@section('content')
@if ($user_type === 'admin')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="wrap">
                    <div class="jctkr-label">
                        <span id="last-activity"> </span>
                    </div>
                    <div class="js-conveyor-example">
                        <ul>
                            @foreach ($activities as $activity)
                            <li>
                                <img src="../assets/images/coins/qub.png" alt="" class="thumb-xs rounded">
                                <span class="usd-rate font-14"> {{$activity->description}} </span>
                              
                            </li>
                            @endforeach
                           
                      
                          
                        </ul>
                    </div>
                </div>    
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>  <!--end row-->

<div class="row">
    <div class="col-lg-9">
    <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="clients-box"></p>
                                            <h4 class="mt-0 mb-1">{{$clients->count()}}</h4>                   
                                        </div>
                                    </div>  
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-account-multiple text-primary"></i>
                                        </div> 
                                    </div>
                                                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="files-box"></p>
                                            <h4 class="mt-0 mb-1">{{$files->count()}}</h4>                                                                                                                                           
                                        </div>
                                    </div> 
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-multiple  text-purple"></i>
                                        </div> 
                                    </div>
                                                      
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                   
                                    <div class="col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted" id="cases-box"></p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{$main_cases->count()}}</h4>
                                                                                                                                                                              
                                        </div>
                                    </div>
                                    
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-open text-success"></i>
                                        </div> 
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                   
                                    <div class="col-sm-8 col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="payments-box"></p>
                                            <h4 class="mt-0 mb-1">AED 0</h4>                                                                                                                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4 col-4 align-self-center ">
                                        <div class="icon-info">
                                            <i class="mdi mdi-coin text-primary"></i>
                                        </div> 
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->  
                     </div>                                  
                  </div><!--end col-->
                  <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="stages-box"></p>
                                            <h4 class="mt-0 mb-1">{{$cases->count()}}</h4>                   
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder  text-success"></i>
                                        </div> 
                                    </div>
                                                       
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="notRegistred-box">  </p>
                                            <h4 class="mt-0 mb-1">{{$cases_not_registerd->count()}}</h4>                                                                                                                                           
                                        </div>
                                    </div>  
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-open  text-purple"></i>
                                        </div> 
                                    </div>
                                                     
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted" id="startStages-box"> </p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{$cases_startup->count()}}</h4>
                                                                                                                                                                              
                                        </div>
                                    </div>  
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder text-warning"></i>
                                        </div> 
                                    </div>
                                                     
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8 col-8 align-self-center ">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="judeges-box"></p>
                                            <h4 class="mt-0 mb-1">658</h4>                                                                                                                                           
                                        </div>
                                    </div>  
                                    <div class="col-sm-4 col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-hammer text-danger"></i>
                                        </div> 
                                    </div>
                                                      
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->  
                     </div>                                  
                  </div><!--end col-->
             </div>
         <div class="col-lg-3">
                <div class="card">
                    <div class="card-body dash-info-carousel mb-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">                                            
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title" id="dubai-court">محاكم دبي</h4>
                                                <div class="my-3 ">
                                                   <img src="../assets/images/widgets/Dubai.png" alt="" height="103" class="">
                                                </div>
                                                <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                                <a href="https://www.dc.gov.ae/PublicServices" target="_blank"  class="btn btn-primary btn-square"> <i class="mdi mdi-earth "></i> </a>
                                            </div>
                                        </div><!--end col-->                                                        
                                    </div><!--end row-->                                                    
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">                                            
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title" id="abudabi-court">محاكم ابوظبي</h4>
                                                <div class="my-3">
                                                    <img src="../assets/images/widgets/Abudhabi.png" alt="" height="103" class="">
                                                </div>
                                                <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                                <a href="https://www.adjd.gov.ae/Ar/Pages/Home.aspx" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                            </div>
                                        </div><!--end col-->                                                        
                                    </div><!--end row-->                                                
                                </div><!--end carousel-item-->

                                <div class="carousel-item">
                                    <div class="row">                                            
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title" id="united-court">المحاكم الاتحادية</h4>
                                                <div class="my-3">
                                                    <img src="../assets/images/widgets/Etihadia.png" alt="" height="103" class="">
                                                </div>
                                                <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                                <a href="https://www.moj.gov.ae/" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                            </div>
                                        </div><!--end col-->                                                        
                                    </div><!--end row-->                                              
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">                                            
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title" id="alsharga-court">محاكم الشارقة</h4>
                                                <div class="my-3">
                                                    <img src="../assets/images/widgets/Sharja.png" alt="" height="103" class="">
                                                </div>
                                                <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                                <a href="https://www.moj.gov.ae/" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                            </div>
                                        </div><!--end col-->                                                        
                                    </div><!--end row-->                                                
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">                                            
                                        <div class="col-12 align-self-center text-center ">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title " id="rass-al5ima-court">محاكم راس الخيمة</h4>
                                                <div class="my-3 text-center">
                                                    <img src="../assets/images/widgets/Rasalkhima.png" alt="" height="103" class="">
                                                </div>
                                                <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                                <a href="http://www.courts.rak.ae/ar/Pages/default.aspx" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                            </div>
                                        </div><!--end col-->                                                        
                                    </div><!--end row-->                                                
                                </div><!--end carousel-item-->
                                
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--end card-body-->                                                                                                        
                </div><!--end card-->
            </div><!--end col-->

    </div><!--end row--> 
    <div class="row">
                  
        <div class="col-lg-12">
              <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                        <div style='clear:both'></div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!-- End row -->
     </div>
</div><!--end row-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb1-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                   
                                       <tr>
                                        <th style="width: 100px;" id="tb1-1"></th>
                                        <th style="width: 100px;" id="tb1-2"></th>
                                        <th  style="width: 120px;" id="tb1-3"></th>
                                        <th id="tb1-4"></th>
                                        <th  style="width: 120px;" id="tb1-5"></th>
                                        <th style="width: 140px;" id="tb1-6"></th>
                                        <th style="width: 100px;" id="tb1-7"></th>
                                        <th style="width: 100px;" id="tb1-8"></th>
                                        <th id="tb1-9"></th>
                                        <th style="width: 100px;" id="tb1-10"></th>
                                        <th id="tb1-11"></th>
                                    </tr>


                                </thead>
                                <tbody>
                                    @foreach ($decisions_noti as $decision_noti)
                                        
                                   
                                  <tr class='clickable-row' >
                                    
                                    <td>{{$decision_noti->S_CASE_FILE_NUM}}</td>
                                  <td>{{$decision_noti->N_CASE_ID}}</td>
                                        <td>
                                            {{$decision_noti->S_CASE_UID}}
                                        </td>
                                        <td> {{$decision_noti->S_HEARING_DESIGION}}</td>
                                        <td>{{$decision_noti->DT_HearingEnterDate}}</td>
                                       
                                        <td>{{ \Carbon\Carbon::parse($decision_noti->DT_HearingEnterDate)->addDays($decision_noti->N_Period)->format('Y-m-d') }}</td>
                                        <td>{{ ($today_date)->diffInDays( \Carbon\Carbon::parse($decision_noti->DT_HearingEnterDate)->addDays($decision_noti->N_Period), false )}}</td>
                                        <td>{{$decision_noti->N_Period}}</td>
                                     <td>
                                     <span class="badge badge-boxed  badge-soft-primary">{{$decision_noti->S_Desc_A}}</span>
                                     </td>
                                     <td class="text-center">
                                        <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".decision-update-{{$decision_noti->N_HEARING_ID}}">
                                            <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                        </a>
                                     </td>
                                     <td class="text-center">
                                          <a href="{{url('main-case-cases/'.$decision_noti->N_CASE_ID)}}">
                                        <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                    </a>
                                    </td>
                                    
                                    </tr>
                                    @endforeach                                                                                          
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $decisions_noti->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->
        @foreach ($decisions_noti as $decision_noti)
    
        <div class="modal fade decision-update-{{$decision_noti->N_HEARING_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style=" display: block; ">
                        
                        <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form"  method="POST" action="{{route('update-decision')}}">
                            @csrf
                            <input type="hidden" name="stage_id" value="{{$decision_noti->N_HEARING_ID}}">
                            @if (Session::get('lang') == "ar")
                            <div class="row">
                                <div class="col-12"> 
                                   <div class="form-group row">
                                            
                                     
                                              <div class="col-sm-6">
                                               <label for="noe_date" id="update-judgment-status">تحديث حالة الحكم </label>
                                                  <select class="custom-select" name="status">
                                                     <option value="تم">
                                                       تم
                                                     </option>
                                                     
                                                     <option value="لم يتم">
                                                         لم يتم
                                                     </option>
                                                  
                                                 </select>
                                             </div>
                                         </div>
                                      </div>
          
                                     <div class="col-12">
                                             <button class="btn btn-sm btn-primary mr-1 font-15" id="update-j-btn">تحديث</button>
                                         </div> 
                               
         
                                  </div>
                            @else
                            <div class="row">
                                <div class="col-12"> 
                                   <div class="form-group row">
                                            
                                     
                                              <div class="col-sm-6">
                                               <label for="noe_date" id="update-judgment-status">Update Decision </label>
                                                  <select class="custom-select" name="status">
                                                     <option value="تم">
                                                       Done
                                                     </option>
                                                     
                                                     <option value="لم يتم">
                                                        Not Done
                                                     </option>
                                                  
                                                 </select>
                                             </div>
                                         </div>
                                      </div>
          
                                     <div class="col-12">
                                             <button class="btn btn-sm btn-primary mr-1 font-15" id="update-j-btn">Update</button>
                                         </div> 
                               
         
                                  </div> 
                            @endif
                    
                        </form> 
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        @endforeach
        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb3-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 100px;" id="tb2-1"></th>
                                        <th style="width: 100px;" id="tb2-2"></th>
                                        <th style="width: 120px;" id="tb2-3"></th>
                                        <th style="width: 180px;" id="tb2-4"></th>
                                        <th  style="width: 140px;" id="tb2-5">  </th>
                                        <th style="width: 140px;" id="tb2-6"> </th>
                                       
                                        <th style="width: 100px;" id="tb2-9"></th>
                                        <th class="text-center" style="width: 100px;" id="tb2-10"></th>
                                        <th class="text-center" style="width: 100px;" id="tb2-11"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stages_noti as $stage_noti)
                                        
                                   
                                    <tr class='clickable-row' >
                                        
                                        <td>{{$stage_noti->S_CASE_FILE_NUM}}</td>
                                    <td>{{$stage_noti->N_CASE_ID}}</td>
                                          <td>
                                              {{$stage_noti->S_CASE_UID}}
                                          </td>
                                          <td> {{$stage_noti->S_HEARING_DESIGION}}</td>
                                          <td>{{$stage_noti->DT_HearingEnterDate}}</td>
                                         
                                          <td>{{ \Carbon\Carbon::parse($stage_noti->DT_HearingEnterDate)->addDays($stage_noti->N_Period)->format('Y-m-d') }}</td>
                                       
                                       <td>
                                       <span class="badge badge-boxed  badge-soft-primary">{{$stage_noti->S_Desc_A}}</span>
                                       </td>
                                       <td class="text-center"> 
                                           <a href="{{url('main-case-cases/'.$stage_noti->N_CASE_ID)}}">
                                        <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                    </a>
                                    </td>

                                    <td class="text-center"> 
                                        <a href="{{url('hide-stage/'.$stage_noti->N_HEARING_ID)}}">
                                     <button class="btn-sm btn-danger"> <i class="dripicons-trash "></i> </button>
                                 </a>
                                 </td>

                                      
                                      </tr>
                                      @endforeach
                                                                                                                                 
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $stages_noti->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->

        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb2-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0" style="bordercolor: black;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 100px;" id="tb3-1"></th>
                                        <th style="width: 100px;" id="tb3-2"></th>
                                        <th id="tb3-3"></th>
                                        <th style="width: 150px;" id="tb3-4"></th>
                                      
                                        <th style="width: 150px;" id="tb3-5">  </th>
                                        <th id="tb3-6"></th>
                                        <th  id="tb3-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($short_stages as $stage)
                                   
                                    <tr  >
                                         <td> {{$stage->S_CASE_FILE_NUM}} </td>
                                        <td> {{$stage->N_CASE_ID}} </td>
                                        <td> {{$stage->S_CASE_UID}}</td>
                                        <td> {{$stage->DT_HearingEnterDate}}</td>
                                      
                                        <td>{{$stage->DT_HEARING_DATE}}</td>
                                        <td>{{$stage->S_HEARING_DESIGION}}</td>
                                        <td class="text-center">
                                           
                                           <a href="{{url('case-stages/'.$stage->N_CASE_DETAILS_ID)}}">
                                            <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>  
                                        </a>
                                            
                                            </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $short_stages->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->
    </div><!--end col-->
    {{-- <div class="col-lg-3">
        <div class="card" style="height: 830px;">                                       
            <div class="card-body"> 
                <h4 class="header-title mt-0 mb-3">النشاطات</h4>
                <div class="slimscroll project-dash-activity">
                    <div class="activity">
                        <i class="mdi mdi-check text-success"></i>
                        <div class="time-item">
                            <div class="item-info">
                                <div class="text-muted text-right font-10"> قبل 5 دقائق - بواسطة (___)</div>
                                <h5 class="mt-0">تم فتح ملف جديد</h5>
                                <p class="text-muted font-13">------------------------------------------------
                                    <a href="#" class="text-info">[مزيد من المعلومات]</a>
                                </p>
                            </div>
                        </div>
                        <i class="mdi mdi-check text-success"></i>                                                                                                            
                        <div class="time-item">
                            <div class="item-info">
                                <div class="text-muted text-right font-10">قبل 30 دقيقة - بواسطة (___)</div>
                                <h5 class="mt-0">تم اضافة عميل جديد</h5>
                                <p class="text-muted font-13">------------------------------------------
                                    <a href="#" class="text-info">[مزيد من المعلومات]</a>
                                </p>
                            </div>
                        </div>
                        <i class="mdi mdi-check text-success"></i>    
                        <div class="time-item ">
                            <div class="item-info">
                                <div class="text-muted text-right font-10">قبل 50 دقيقة - بواسطة (___)</div>
                                <h5 class="mt-0">تم اضافة جلسة</h5>
                                <p class="text-muted font-13">-------------------------------------------
                                    <a href="#" class="text-info">[مزيد من المعلومات]</a>
                                </p>
                            </div>
                        </div>                                 
                    </div><!--end activity-->
                </div><!--end project-dash-activity-->
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->
    </div><!--end col-->   --}}
</div><!--end row-->   
@elseif($user_type == 'emp')

{{-- /////////////////////////////////////////////////////employee view////////////////////////////////////////////////////////////////   --}}
{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   --}}
{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   --}}


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="wrap">
                    <div class="jctkr-label">
                        <span id="last-activity"> </span>
                    </div>
                    <div class="js-conveyor-example">
                        <ul>
                            @foreach ($activities as $activity)
                            <li>
                                <img src="../assets/images/coins/qub.png" alt="" class="thumb-xs rounded">
                                <span class="usd-rate font-14"> {{$activity->description}} </span>
                              
                            </li>
                            @endforeach
                      
                          
                        </ul>
                    </div>
                </div>    
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>  <!--end row-->
<div class="d-none" id='calendar'></div>
<div class="row">
    <div class="col-lg-9">
    <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-multiple text-primary"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="emp-cases-box">القضايا</p>
                                            <h4 class="mt-0 mb-1">{{$main_cases->count()}}</h4>                   
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder-multiple  text-purple"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="emp-stages-box">الدعاوى</p>
                                            <h4 class="mt-0 mb-1">{{$cases->count()}}</h4>                                                                                                                                           
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-chart-timeline text-success"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted" id="emp-hearings-box">الجلسات</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{$hearings->count()}}</h4>
                                                                                                                                                                              
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 col-4 align-self-center text-center">
                                        <div class="icon-info">
                                            <i class="dripicons-checklist  text-primary"></i>
                                        </div> 
                                    </div>
                                    <div class="col-sm-8 col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="emp-tasks-box">المهام</p>
                                        <h4 class="mt-0 mb-1">{{$tasks_count->count()}}</h4>                                                                                                                                           
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->  
                     </div>                                  
                  </div><!--end col-->
                  <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-account-off-outline   text-danger"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="emp-leaves-box">الاجازات</p>
                                            <h4 class="mt-0 mb-1">{{$leaves->count()}}</h4>                   
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-timer  text-secondary"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-center">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted" id="emp-hours-box">ساعات العمل</p>
                                            <h4 class="mt-0 mb-1">0</h4>                                                                                                                                           
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    {{-- <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-folder text-warning"></i>
                                        </div> 
                                    </div>
                                    <div class="col-8 align-self-center text-left">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted">الدعاوى الابتدائية</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{$cases_startup->count()}}</h4>
                                                                                                                                                                              
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col--> --}}

                    {{-- <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 col-4 align-self-center">
                                        <div class="icon-info">
                                            <i class="mdi mdi-hammer text-danger"></i>
                                        </div> 
                                    </div>
                                    <div class="col-sm-8 col-8 align-self-center text-left">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">الاحكام</p>
                                            <h4 class="mt-0 mb-1">658</h4>                                                                                                                                           
                                        </div>
                                    </div>                    
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->  
                     </div>                                   --}}
                  </div><!--end col-->
             </div>
         <div class="col-lg-3">
            <div class="card">
                <div class="card-body dash-info-carousel mb-0">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">                                            
                                    <div class="col-12 align-self-center">
                                        <div class="text-center">
                                            <h4 class="mt-0 header-title" id="dubai-court">محاكم دبي</h4>
                                            <div class="my-3 ">
                                               <img src="../assets/images/widgets/Dubai.png" alt="" height="103" class="">
                                            </div>
                                            <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                            <a href="https://www.dc.gov.ae/PublicServices" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                        </div>
                                    </div><!--end col-->                                                        
                                </div><!--end row-->                                                    
                            </div><!--end carousel-item-->
                            <div class="carousel-item">
                                <div class="row">                                            
                                    <div class="col-12 align-self-center">
                                        <div class="text-center">
                                            <h4 class="mt-0 header-title" id="abudabi-court">محاكم ابوظبي</h4>
                                            <div class="my-3">
                                                <img src="../assets/images/widgets/Abudhabi.png" alt="" height="103" class="">
                                            </div>
                                            <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                            <a href="https://www.adjd.gov.ae/Ar/Pages/Home.aspx" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                        </div>
                                    </div><!--end col-->                                                        
                                </div><!--end row-->                                                
                            </div><!--end carousel-item-->

                            <div class="carousel-item">
                                <div class="row">                                            
                                    <div class="col-12 align-self-center">
                                        <div class="text-center">
                                            <h4 class="mt-0 header-title" id="united-court">المحاكم الاتحادية</h4>
                                            <div class="my-3">
                                                <img src="../assets/images/widgets/Etihadia.png" alt="" height="103" class="">
                                            </div>
                                            <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                            <a href="https://www.moj.gov.ae/" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                        </div>
                                    </div><!--end col-->                                                        
                                </div><!--end row-->                                              
                            </div><!--end carousel-item-->
                            <div class="carousel-item">
                                <div class="row">                                            
                                    <div class="col-12 align-self-center">
                                        <div class="text-center">
                                            <h4 class="mt-0 header-title" id="alsharga-court">محاكم الشارقة</h4>
                                            <div class="my-3">
                                                <img src="../assets/images/widgets/Sharja.png" alt="" height="103" class="">
                                            </div>
                                            <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                            <a href="https://www.moj.gov.ae/" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                        </div>
                                    </div><!--end col-->                                                        
                                </div><!--end row-->                                                
                            </div><!--end carousel-item-->
                            <div class="carousel-item">
                                <div class="row">                                            
                                    <div class="col-12 align-self-center text-center ">
                                        <div class="text-center">
                                            <h4 class="mt-0 header-title " id="rass-al5ima-court">محاكم راس الخيمة</h4>
                                            <div class="my-3 text-center">
                                                <img src="../assets/images/widgets/Rasalkhima.png" alt="" height="103" class="">
                                            </div>
                                            <h2 class="project-title mb-1">قم بزيارة الموقع</h2>
                                            <a href="http://www.courts.rak.ae/ar/Pages/default.aspx" target="_blank"  class="btn btn-primary btn-square"><i class="mdi mdi-earth "></i> </a>
                                        </div>
                                    </div><!--end col-->                                                        
                                </div><!--end row-->                                                
                            </div><!--end carousel-item-->
                            
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div><!--end col-->

    </div><!--end row--> 
    <div class="row">
        <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="emp-tasks-th-title">المهام</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                           <tr>
                                            <th id="emp-tasks-th-1" style="width: 150px;">اسم المهمة</th>
                                            <th id="emp-tasks-th-2" style="width: 220px;">وصف المهمة</th>
                                            <th id="emp-tasks-th-3"> رقم الملف</th>
                                             <th id="emp-tasks-th-4"> رقم الدعوى</th>
                                            <th id="emp-tasks-th-5"> تاريخ الاسناد</th>
                                           
                                            <th id="emp-tasks-th-6"> تاريخ التسليم</th>
                                            <th id="emp-tasks-th-7"> تاريخ التنفيذ</th>
                                            <th id="emp-tasks-th-8">الحالة</th>
                                          
                                            <th id="emp-tasks-th-9"> القضية</th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            
                                       
                                      <tr class='clickable-row' >
                                        
                                        <td>{{$task->S_NOTES}}</td>
                                      <td>{{$task->S_SUBJECT}}</td>
                                      <td>{{$task->file_id}}</td>
                                      <td>{{$task->case_uid}}</td>
                                      <td>{{$task->DT_DOINGWORK}}</td>
                                      <td>{{$task->DT_WANTED}}</td>
                                      <td>{{$task->excute_date}}</td>
                                    
                                      <td>
                                          {{$task->N_Status}} 
                                         <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".status_{{$task->N_TASK_ID}}">
                                        <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                    </a> </td>
                                     
                                      <td class="text-center">
                                        <a href="{{url('main-case-cases/'.$task->N_CASE_ID)}}">
                                        <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                        </a>

                                      </td>
                                        
                                        </tr>
                                        @endforeach                                                                                          
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $tasks->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>

        
     @foreach ($tasks as $task)
    
     <div class="modal fade status_{{$task->N_TASK_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header" style=" display: block; ">
                     
                     <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                 </div>
                 <div class="modal-body">
                     <form class="form"  method="POST" action="{{route('update-task-status')}}">
                         @csrf
                         <input type="hidden" name="task_id" value="{{$task->N_TASK_ID}}">
                         @if (Session::get('lang') == "ar")
                            <div class="row">
                                <div class="col-12"> 
                                   <div class="form-group row">
                                            
                                     
                                              <div class="col-sm-6">
                                               <label for="noe_date"> <span id="current-task-status">  حالة المهمة الحالية  </span> -  ({{$task->N_Status}})</label>
                                                  <select class="custom-select" name="task_status">
                                                     <option value="قيد التنفيذ">
                                                         قيد التنفيذ
                                                     </option>
                                                     
                                                     <option value="اكتملت">
                                                          اكتلمت
                                                     </option>
                                                     <option value="الغيت">
                                                        الغاء 
                                                     </option>
                                                     
                                                 </select>
                                             </div>
                                         </div>
                                      </div>
          
                                     <div class="col-12">
                                             <button class="btn btn-sm btn-primary mr-1 font-15" id="update-task-btn">تحديث</button>
                                         </div> 
                               
         
                                  </div> 
                         @else
                            <div class="row">
                                <div class="col-12"> 
                                   <div class="form-group row">
                                            
                                     
                                              <div class="col-sm-6">
                                               <label for="noe_date"> <span id="current-task-status">  Current Status  </span> -  ({{$task->N_Status}})</label>
                                                  <select class="custom-select" name="task_status">
                                                     <option value="قيد التنفيذ">
                                                        Proccessing
                                                     </option>
                                                     
                                                     <option value="اكتملت">
                                                         Completed
                                                     </option>
                                                     <option value="الغيت">
                                                       Cancel
                                                     </option>
                                                     
                                                 </select>
                                             </div>
                                         </div>
                                      </div>
          
                                     <div class="col-12">
                                             <button class="btn btn-sm btn-primary mr-1 font-15" id="update-task-btn">Update</button>
                                         </div> 
                               
         
                                  </div> 
                         @endif
                   
                     </form> 
                 </div>
             </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
     </div><!-- /.modal --> 
     @endforeach


        <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="emp-activities-title">النشاطات</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                           <tr>
                                            <th id="emp-activities-th-1" style="width: 100px;">اسم التنبيه</th>
                                            <th id="emp-activities-th-2" style="width: 100px;"> الوصف</th>
                                            <th id="emp-activities-th-3" style="width: 100px;">التاريخ</th>
                                            <th id="emp-activities-th-4" style="width: 100px;">بواسطة</th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                       @foreach ($activities as $active)
                                           
                                     
                                      <tr class='clickable-row' >
                                        
                                      <td>{{$active->short_name}}</td>
                                      <td>{{$active->description}}</td>
                                      <td>{{$active->date_time}}</td>
                                      <td>{{$active->user_create}}</td>
                                        
                                        </tr>
                                        @endforeach                                                                                 
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $activities->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="emp-cases-title">القضايا</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                           <tr>
                                            <th id="emp-cases-th-1" style="width: 100px;"> رقم الملف</th>
                                            <th id="emp-cases-th-2" style="width: 160px;">رقم القضية </th>
                                            <th id="emp-cases-th-3"> تاريخ الانشاء</th>
                                            <th id="emp-cases-th-4">موضوع القضية</th>
                                            <th id="emp-cases-th-5">  عرض القضية</th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                        @foreach ($main_cases as $main_case)
                                            
                                       
                                      <tr class='clickable-row' >
                                        
                                        <td>{{$main_case->S_CASE_FILE_NUM}}</td>
                                      <td>{{$main_case->N_CASE_ID}}</td>
                                      <td>{{$main_case->DT_CASE_DATE}}</td>
                                      <td>{{$main_case->S_CASE_SUBJECT}}</td>
                                      <td  class="text-center">
                                 <a href="{{url('main-case-cases/'.$main_case->N_CASE_ID)}}">
                                      <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                    </a>
                                </td>
                                        
                                        </tr>
                                        @endforeach                                                                                          
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $main_cases->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>

        <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="emp-stages-title">الدعاوى</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                        <tr>
                                            <th id="emp-stages-th-1" style="width: 100px;"> رقم الملف</th>
                                            <th id="emp-stages-th-2" style="width: 160px;">رقم القضية </th>
                                            <th id="emp-stages-th-3">رقم الدعوى</th>
                                            <th id="emp-stages-th-4">مرحلة الدعوى</th>
                                            <th id="emp-stages-th-5"> موضوع الدعوى</th>
                                            <th id="emp-stages-th-6"> عرض الدعوى</th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                        @foreach ($cases as $case)
                                            
                                       
                                        <tr class='clickable-row' >
                                          
                                          <td>{{$case->file_id}}</td>
                                        <td>{{$case->N_CASE_ID}}</td>
                                        <td>{{$case->S_CASE_UID}}</td>
                                        <td>{{$case->stage_name}}</td> 
                                        <td>{{$case->S_SUMMARY}}</td> 
                                      
                                        <td  class="text-center">
                                   <a href="{{url('main-case-cases/'.$case->N_CASE_ID)}}">
                                    <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                </a>
                                  </td>
                                          
                                          </tr>
                                          @endforeach                                                                               
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $cases->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>
    </div>
  

<div class="row">
    <div class="col-lg-12">
        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb1-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                   
                                       <tr>
                                        <th style="width: 100px;" id="tb1-1"></th>
                                        <th style="width: 160px;" id="tb1-2"></th>
                                        <th  style="width: 120px;" id="tb1-3"></th>
                                        <th id="tb1-4"></th>
                                        <th  style="width: 120px;" id="tb1-5"></th>
                                        <th style="width: 140px;" id="tb1-6"></th>
                                        <th style="width: 140px;" id="tb1-7"></th>
                                        <th style="width: 140px;" id="tb1-8"></th>
                                        <th id="tb1-9"></th>
                                        <th style="width: 100px;" id="tb1-10"></th>
                                        <th id="tb1-11"></th>
                                    </tr>




                                </thead>
                                <tbody>
                                    @foreach ($decisions_noti as $decision_noti)
                                        
                                   
                                  <tr class='clickable-row' >
                                    
                                    <td>{{$decision_noti->S_CASE_FILE_NUM}}</td>
                                  <td>{{$decision_noti->N_CASE_ID}}</td>
                                        <td>
                                            {{$decision_noti->S_CASE_UID}}
                                        </td>
                                        <td> {{$decision_noti->S_HEARING_DESIGION}}</td>
                                        <td>{{$decision_noti->DT_HearingEnterDate}}</td>
                                       
                                        <td>{{ \Carbon\Carbon::parse($decision_noti->DT_HearingEnterDate)->addDays($decision_noti->N_Period)->format('Y-m-d') }}</td>
                                        <td>{{ ($today_date)->diffInDays( \Carbon\Carbon::parse($decision_noti->DT_HearingEnterDate)->addDays($decision_noti->N_Period), false )}}</td>
                                        <td>{{$decision_noti->N_Period}}</td>
                                     <td>
                                     <span class="badge badge-boxed  badge-soft-primary">{{$decision_noti->S_Desc_A}}</span>
                                     </td>
                                     <td class="text-center">
                                        <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".decision-update-{{$decision_noti->N_HEARING_ID}}">
                                            <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                        </a>
                                     </td>
                                     <td  class="text-center"> 
                                         <a href="{{url('main-case-cases/'.$decision_noti->N_CASE_ID)}}">
                                            <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                        </a>
                                        </td>

                                    </tr>
                                    @endforeach                                                                                          
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $decisions_noti->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->
        @foreach ($decisions_noti as $decision_noti)
    
        <div class="modal fade decision-update-{{$decision_noti->N_HEARING_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style=" display: block; ">
                        
                        <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
                        <h4>نحديث حالة الجلسة</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form"  method="POST" action="{{route('update-decision')}}">
                            @csrf
                            <input type="hidden" name="stage_id" value="{{$decision_noti->N_HEARING_ID}}">
                      <div class="row">
                           <div class="col-12"> 
                              <div class="form-group row">
                                       
                                
                                         <div class="col-sm-6">
                                          <label for="noe_date">تحديث حالة الحكم </label>
                                             <select class="custom-select" name="status">
                                                <option value="تم">
                                                  تم
                                                </option>
                                                
                                                <option value="لم يتم">
                                                    لم يتم
                                                </option>
                                             
                                            </select>
                                        </div>
                                    </div>
                                 </div>
     
                                <div class="col-12">
                                        <button class="btn btn-sm btn-primary mr-1 font-15">تحديث</button>
                                    </div> 
                          
    
                             </div>
                        </form> 
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        @endforeach
        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb3-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 100px;" id="tb2-1"></th>
                                        <th style="width: 150px;" id="tb2-2"></th>
                                        <th style="width: 120px;" id="tb2-3"></th>
                                        <th style="width: 180px;" id="tb2-4"></th>
                                        <th  style="width: 140px;" id="tb2-5">  </th>
                                        <th style="width: 140px;" id="tb2-6"> </th>
                                       
                                        <th style="width: 100px;" id="tb2-9"></th>
                                        <th class="text-center" style="width: 100px;" id="tb2-10"></th>
                                        <th class="text-center" style="width: 100px;" id="tb2-11"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stages_noti as $stage_noti)
                                        
                                   
                                    <tr class='clickable-row' >
                                        
                                        <td>{{$stage_noti->S_CASE_FILE_NUM}}</td>
                                    <td>{{$stage_noti->N_CASE_ID}}</td>
                                          <td>
                                              {{$stage_noti->S_CASE_UID}}
                                          </td>
                                          <td> {{$stage_noti->S_HEARING_DESIGION}}</td>
                                          <td>{{$stage_noti->DT_HearingEnterDate}}</td>
                                         
                                          <td>{{ \Carbon\Carbon::parse($stage_noti->DT_HearingEnterDate)->addDays($stage_noti->N_Period)->format('Y-m-d') }}</td>
                                       <td>
                                       <span class="badge badge-boxed  badge-soft-primary">{{$stage_noti->S_Desc_A}}</span>
                                       </td>
                                       <td class="text-center"> 
                                           <a href="{{url('main-case-cases/'.$stage_noti->N_CASE_ID)}}">
                                        <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                    </a>
                                    </td>

                                    <td class="text-center"> 
                                        <a href="{{url('hide-stage/'.$stage_noti->N_HEARING_ID)}}">
                                     <button class="btn-sm btn-danger"> <i class="dripicons-trash "></i> </button>
                                 </a>
                                 </td>

                                      
                                      </tr>
                                      @endforeach
                                                                                                                                 
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $stages_noti->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->

     
        <div class="card">                                
            <div class="card-body">
                <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tb2-title"></h4>           
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 100px;" id="tb3-1"></th>
                                        <th style="width: 150px;" id="tb3-2"></th>
                                        <th id="tb3-3"></th>
                                        <th style="width: 150px;" id="tb3-4"></th>
                                      
                                        <th style="width: 150px;" id="tb3-5">  </th>
                                        <th id="tb3-6"></th>
                                        <th  id="tb3-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($short_stages as $stage)
                                   
                                    <tr  >
                                         <td> {{$stage->S_CASE_FILE_NUM}} </td>
                                        <td> {{$stage->N_CASE_ID}} </td>
                                        <td> {{$stage->S_CASE_UID}}</td>
                                        <td> {{$stage->DT_HearingEnterDate}}</td>
                                      
                                        <td>{{$stage->DT_HEARING_DATE}}</td>
                                        <td>{{$stage->S_HEARING_DESIGION}}</td>
                                        <td class="text-center">
                                           
                                           <a href="{{url('case-stages/'.$stage->N_CASE_DETAILS_ID)}}">
                                            <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>  
                                        </a>
                                            
                                            </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--end table-responsive-->                                            
                    </div><!--end col-->
                </div> <!--end row-->
                <div class=" mt-4">
                    {{ $short_stages->links() }}
                    
                    </div>
            </div><!--end card-body-->                                                                                                        
        </div><!--end card-->
    </div><!--end col-->
  
</div><!--end row-->

{{-- /////////////////////////////////////////////////////Support view////////////////////////////////////////////////////////////////   --}}
{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   --}}
{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   --}}


@elseif($user_type == 'support')

<div class="row">
                  
    <div class="col-lg-12">
          <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-none">
                    <div id='calendar'></div>
                    <div style='clear:both'></div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!-- End row -->
 </div>
</div><!--end row-->


<div class="row">
    <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="support-tasks-th-title">المهام</h4>           
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                           <tr>
                                            <th id="support-tasks-th-0" style="width: 150px;">اسم العميل</th>
                                            <th id="support-tasks-th-1" style="width: 150px;">اسم المهمة</th>
                                            <th id="support-tasks-th-2" style="width: 220px;">وصف المهمة</th>
                                            <th id="support-tasks-th-3"> رقم القضية</th>
                                             <th id="support-tasks-th-4"> رقم الدعوى</th>
                                            <th id="support-tasks-th-5"> تاريخ الاسناد</th>
                                           
                                            <th id="support-tasks-th-6"> تاريخ التسليم</th>
                                            <th id="support-tasks-th-7"> تاريخ التنفيذ</th>
                                            <th id="support-tasks-th-8">اسناد</th>
                                          
                                            <th id="support-tasks-th-9"> القضية</th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            
                                       
                                      <tr class='clickable-row' >
                                         <td>{{$task->createBy}}</td>
                                        <td>{{$task->S_NOTES}}</td>
                                      <td>{{$task->S_SUBJECT}}</td>
                                      <td>{{$task->N_CASE_ID}}</td>
                                      <td>{{$task->case_uid}}</td>
                                      <td>{{$task->DT_DOINGWORK}}</td>
                                      <td>{{$task->DT_WANTED}}</td>
                                      <td>{{$task->excute_date}}</td>
                                    
                                      <td>
                                        
                                         <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".assign_{{$task->N_TASK_ID}}">
                                        <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                    </a> </td>
                                     
                                      <td class="text-center">
                                        <a href="{{url('main-case-cases/'.$task->N_CASE_ID)}}">
                                        <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i> </button>
                                        </a>

                                      </td>
                                        
                                        </tr>
                                        @endforeach                                                                                          
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $tasks->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>

        <div class="col-12">
            <div class="card">                                
                <div class="card-body">
                    <h4 class="mt-0 header-title" id="op-table-title"></h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-bordered">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                       
                                           <tr>
                                            <th id="op-th-0"> </th>
                                            <th id="op-th-1"> </th>
                                            <th id="op-th-2"></th>
                                            <th id="op-th-3"></th>
                                            <th id="op-th-4"> </th>
                                            <th id="op-th-5"></th>
                                        </tr>
    
    
                                    </thead>
                                    <tbody>
                                        @foreach ($open_case as $case)

                            <tr>
                                <td>{{$case->clientName}}</td>
                            <td>{{$case->against}}</td>
                            <td>{{$case->caseStatus}}</td>
                                <td>{{$case->subject}}</td>
                              
                                <td>{{$case->cliam_amount}}</td>
                                <td>
                             @if ($case->docs)
                                <a href="{{asset('assets/open-case-documents/'.$case->docs)}}" class="download-icon-link" download>
                                    <i class="dripicons-download file-download-icon"></i> 
                                </a>
                            @else 
                            <a> </a>
                                @endif
                             </td>
    
                            </tr>
                                
                            @endforeach                                                                         
                                    </tbody>
                                </table>
                            </div><!--end table-responsive-->                                            
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class=" mt-4">
                        {{ $tasks->links() }}
                        
                        </div>
                </div><!--end card-body-->                                                                                                        
            </div><!--end card-->
        </div>

        
     @foreach ($tasks as $task)
    
     <div class="modal fade assign_{{$task->N_TASK_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header" style=" display: block; ">
                     
                     <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                 </div>
                 <div class="modal-body">
                     <form class="form"  method="POST" action="{{route('assign-task')}}">
                         @csrf
                         <input type="hidden" name="task_id" value="{{$task->N_TASK_ID}}">
                   <div class="row">
                        <div class="col-12"> 
                           <div class="form-group row">
                                    
                             
                                      <div class="col-sm-6">
                                       <label for="noe_date"> <span class="assing-emp-label"> اختر الموظف  </span> </label>
                                          <select class="custom-select" name="assign_user">
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}} </option>
                                            @endforeach
                                             
                                         </select>
                                     </div>
                                 </div>
                              </div>
  
                             <div class="col-12">
                                     <button class="btn btn-sm btn-primary mr-1 font-15 assing-task-btn">تحديث</button>
                                 </div> 
                       
 
                          </div>
                     </form> 
                 </div>
             </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
     </div><!-- /.modal --> 
     @endforeach

</div>

@endif
    
@endsection

@section('page-script')
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/ticker/jquery.jConveyorTicker.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.crypto-news.init.js')}}"></script>


<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/core/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/timegrid/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{asset('assets/plugins/fullcalendar/packages/list/main.js')}}'></script>
<script src='{{asset('assets/pages/jquery.calendar.js')}}'></script>

  
<script>
   
   if (lang == "ar") {
   document.body.style.direction = "rtl"; 
   document.body.style.textAlign = "right"; 

   document.getElementById("breadcrumb-float").classList.add('float-left');
   document.getElementById("breadcrumb-1").innerHTML = "الرئيسية";

   document.getElementById("page-name").innerHTML = "الرئيسية";
   if (  document.getElementById("last-activity")) {
    document.getElementById("last-activity").innerHTML = "النشاطات الأخيرة &nbsp  <i class='fas fa-exchange-alt mr-2'></i>";

   }

if ( document.getElementById("clients-box")) {
    document.getElementById("clients-box").innerHTML = "العملاء";
   document.getElementById("files-box").innerHTML = "الملفات";
   document.getElementById("cases-box").innerHTML = "القضايا";
   document.getElementById("payments-box").innerHTML = "المدفوعات المالية";
   document.getElementById("stages-box").innerHTML = "الدعاوى";
   document.getElementById("notRegistred-box").innerHTML = "قيد التسجيل";
   document.getElementById("startStages-box").innerHTML = "الدعاوى الابتدائية";
   document.getElementById("judeges-box").innerHTML = "الاحكام";
}
 

if ( document.getElementById("dubai-court")) {
    document.getElementById("dubai-court").innerHTML = "محكمة دبي";
   document.getElementById("dubai-court").classList.add('text-left');

   document.getElementById("abudabi-court").innerHTML = "محكمة ابوظبي";
   document.getElementById("abudabi-court").classList.add('text-left');

   document.getElementById("united-court").innerHTML = "المحاكم الاتحادية";
   document.getElementById("united-court").classList.add('text-left');

   document.getElementById("alsharga-court").innerHTML = "محكمة الشارقة";
   document.getElementById("alsharga-court").classList.add('text-left');

   document.getElementById("rass-al5ima-court").innerHTML = "محكمة راس الخيمة";
   document.getElementById("rass-al5ima-court").classList.add('text-left');  
}
  
  if (document.getElementById("op-table-title")) {
    document.getElementById("op-table-title").innerHTML ="جميع طلبات فتح قضية";
document.getElementById("op-th-0").innerHTML = "العميل";

document.getElementById("op-th-1").innerHTML = "الخصم";
document.getElementById("op-th-2").innerHTML = "حالة القضية";
document.getElementById("op-th-3").innerHTML = "موضوع القضية";
document.getElementById("op-th-4").innerHTML = "قيمة المطالبة";
document.getElementById("op-th-5").innerHTML = "المستند";
  }

if (  document.getElementById("tb1-title")) {
    document.getElementById("tb1-title").innerHTML = "تنبيهات الاحكام";

document.getElementById("tb1-1").innerHTML = "رقم الملف";
document.getElementById("tb1-2").innerHTML = "رقم القضية";
document.getElementById("tb1-3").innerHTML = "رقم الدعوى";
document.getElementById("tb1-4").innerHTML = "الحكم";
document.getElementById("tb1-5").innerHTML = "تاريخ الجلسة";
document.getElementById("tb1-6").innerHTML = "تاريخ نهاية الحكم";
document.getElementById("tb1-7").innerHTML = "الايام المتبقية";
document.getElementById("tb1-8").innerHTML = "فترة السماح";
document.getElementById("tb1-9").innerHTML = "نوع الجلسة";
document.getElementById("tb1-10").innerHTML = "تم / لم يتم";
document.getElementById("tb1-11").innerHTML = "عرض";

 
document.getElementById("tb2-title").innerHTML = "تنبيهات الجلسات";

document.getElementById("tb2-1").innerHTML = "رقم الملف";
document.getElementById("tb2-2").innerHTML = "رقم القضية";
document.getElementById("tb2-3").innerHTML = "رقم الدعوى";
document.getElementById("tb2-4").innerHTML = "قرار الجلسة";
document.getElementById("tb2-5").innerHTML = "تاريخ الجلسة الحالية";
document.getElementById("tb2-6").innerHTML = "تاريخ الجلسة القادمة";

document.getElementById("tb2-9").innerHTML = "نوع الجلسة";
document.getElementById("tb2-10").innerHTML = "عرض";
document.getElementById("tb2-11").innerHTML = "حذف";



document.getElementById("tb3-title").innerHTML = "تنبيهات نواقص الجلسات";

document.getElementById("tb3-1").innerHTML = "رقم الملف";
document.getElementById("tb3-2").innerHTML = "رقم القضية";
document.getElementById("tb3-3").innerHTML = "رقم الدعوى";
document.getElementById("tb3-4").innerHTML = "تاريخ الجلسة";
document.getElementById("tb3-5").innerHTML = "تاريخ الجلسة القادمة";
document.getElementById("tb3-6").innerHTML = " القرار";
document.getElementById("tb3-7").innerHTML = " عرض";




}
  


}else{
   document.body.style.direction = "ltr"; 
   document.body.style.textAlign = "left"; 
   document.getElementById("breadcrumb-float").classList.add('float-right');
   document.getElementById("breadcrumb-1").innerHTML = "Home";

   document.getElementById("page-name").innerHTML = "HOME";

   if (  document.getElementById("last-activity")) {
    document.getElementById("last-activity").innerHTML = "Last activity &nbsp  <i class='fas fa-exchange-alt mr-2'></i>";
   }
if (  document.getElementById("clients-box")) {
    document.getElementById("clients-box").innerHTML = "Clients";
   document.getElementById("files-box").innerHTML = "Files";
   document.getElementById("cases-box").innerHTML = "Main Cases";
   document.getElementById("payments-box").innerHTML = "Payment";
   document.getElementById("stages-box").innerHTML = "Cases";
   document.getElementById("notRegistred-box").innerHTML = "Under registration ";
   document.getElementById("startStages-box").innerHTML = "F court instance ";
   document.getElementById("judeges-box").innerHTML = "Judgments";
} else if(document.getElementById("emp-cases-box")) {
    document.getElementById("emp-cases-box").innerHTML = "Main Cases";
    document.getElementById("emp-stages-box").innerHTML = "Cases";
    document.getElementById("emp-hearings-box").innerHTML = "Hearings";
    document.getElementById("emp-tasks-box").innerHTML = "Tasks";
    document.getElementById("emp-leaves-box").innerHTML = "Leaves";
    document.getElementById("emp-hours-box").innerHTML = "Worked hours";

  
    document.getElementById("emp-tasks-th-title").innerHTML = "Tasks";
    document.getElementById("emp-tasks-th-1").innerHTML = "Task name";
    document.getElementById("emp-tasks-th-2").innerHTML = "Task desc.";
    document.getElementById("emp-tasks-th-3").innerHTML = "File number";
    document.getElementById("emp-tasks-th-4").innerHTML = "Stage number";
    document.getElementById("emp-tasks-th-5").innerHTML = "Task create date";
    document.getElementById("emp-tasks-th-6").innerHTML = "Task deleverd date";
    document.getElementById("emp-tasks-th-7").innerHTML = "Taske needed date";
    document.getElementById("emp-tasks-th-8").innerHTML = "Taske Status";
    document.getElementById("emp-tasks-th-9").innerHTML = "View case";

   
   if ( document.getElementById("current-task-status")) {
     document.getElementById("current-task-status").innerHTML = "Current task status";
    document.getElementById("update-task-btn").innerHTML = "Update task status";
   }
   

    
    document.getElementById("emp-activities-title").innerHTML = "Activities";
    document.getElementById("emp-activities-th-1").innerHTML = "Activity name";
    document.getElementById("emp-activities-th-2").innerHTML = "Activity desc.";
    document.getElementById("emp-activities-th-3").innerHTML = "Activity date";
    document.getElementById("emp-activities-th-4").innerHTML = "Created by";

   
    document.getElementById("emp-cases-title").innerHTML = "Main Cases";
    document.getElementById("emp-cases-th-1").innerHTML = "File number";
    document.getElementById("emp-cases-th-2").innerHTML = "Main Case number";
    document.getElementById("emp-cases-th-3").innerHTML = "Created date";
    document.getElementById("emp-cases-th-4").innerHTML = "Case subject";
    document.getElementById("emp-cases-th-5").innerHTML = "View case";

 
    document.getElementById("emp-stages-title").innerHTML = "Cases";
    document.getElementById("emp-stages-th-1").innerHTML = "File number";
    document.getElementById("emp-stages-th-2").innerHTML = "Main Case number";
    document.getElementById("emp-stages-th-3").innerHTML = "Case number";
    document.getElementById("emp-stages-th-4").innerHTML = "Case Stage";
    document.getElementById("emp-stages-th-5").innerHTML = "Stage subject";
    document.getElementById("emp-stages-th-6").innerHTML = "View";

}

if (document.getElementById("update-judgment-status")) {
    document.getElementById("update-judgment-status").innerHTML = "Update judgment status";
document.getElementById("update-j-btn").innerHTML = "Update status";
}


if ( document.getElementById("dubai-court")) {
    document.getElementById("dubai-court").innerHTML = "Dubai court";
   document.getElementById("dubai-court").classList.add('text-left');

   document.getElementById("abudabi-court").innerHTML = "AD court";
   document.getElementById("abudabi-court").classList.add('text-left');

   document.getElementById("united-court").innerHTML = "United court";
   document.getElementById("united-court").classList.add('text-left');

   document.getElementById("alsharga-court").innerHTML = "alsharja court";
   document.getElementById("alsharga-court").classList.add('text-left');

   document.getElementById("rass-al5ima-court").innerHTML = "Ras alkhima court";
   document.getElementById("rass-al5ima-court").classList.add('text-left');
}
  

if (  document.getElementById("tb1-title")) {
    document.getElementById("tb1-title").innerHTML = "Judgments alert";

document.getElementById("tb1-1").innerHTML = "File number";
document.getElementById("tb1-2").innerHTML = "Main Case number";
document.getElementById("tb1-3").innerHTML = "Case number";
document.getElementById("tb1-4").innerHTML = "Decision";
document.getElementById("tb1-5").innerHTML = "Date of hearing ";
document.getElementById("tb1-6").innerHTML = "Hearing end date";
document.getElementById("tb1-7").innerHTML = "Remaining Days";
document.getElementById("tb1-8").innerHTML = "Decision period";
document.getElementById("tb1-9").innerHTML = "Case type";
document.getElementById("tb1-10").innerHTML = "Done/Not";
document.getElementById("tb1-11").innerHTML = "View";

 
document.getElementById("tb2-title").innerHTML = "Hearing alert";


document.getElementById("tb2-1").innerHTML = "File number";
document.getElementById("tb2-2").innerHTML = "Main Case number";
document.getElementById("tb2-3").innerHTML = "Case number";
document.getElementById("tb2-4").innerHTML = "Decision";
document.getElementById("tb2-5").innerHTML = "Date of hearing ";
document.getElementById("tb2-6").innerHTML = "Next date of hearing";

document.getElementById("tb2-9").innerHTML = "Case type";
document.getElementById("tb2-10").innerHTML = "View";
document.getElementById("tb2-11").innerHTML = "Delete";





document.getElementById("tb3-title").innerHTML = "Missing hearing alert ";

document.getElementById("tb3-1").innerHTML = "File number";
document.getElementById("tb3-2").innerHTML = "Main Case number";
document.getElementById("tb3-3").innerHTML = "Case number";
document.getElementById("tb3-4").innerHTML = "Date of hearing ";
document.getElementById("tb3-5").innerHTML = "Next hearing date";
document.getElementById("tb3-6").innerHTML = "Decison";
document.getElementById("tb3-7").innerHTML = " View";
}
 


if (document.getElementById("support-tasks-th-title")) {
    document.getElementById("support-tasks-th-title").innerHTML = "Tasks";
    document.getElementById("support-tasks-th-0").innerHTML = "Client name";
    document.getElementById("support-tasks-th-1").innerHTML = "Task name";
    document.getElementById("support-tasks-th-2").innerHTML = "Task desc.";
    document.getElementById("support-tasks-th-3").innerHTML = "File number";
    document.getElementById("support-tasks-th-4").innerHTML = "Stage number";
    document.getElementById("support-tasks-th-5").innerHTML = "Task create date";
    document.getElementById("support-tasks-th-6").innerHTML = "Task deleverd date";
    document.getElementById("support-tasks-th-7").innerHTML = "Taske needed date";
    document.getElementById("support-tasks-th-8").innerHTML = "Assign Task";
    document.getElementById("support-tasks-th-9").innerHTML = "View case"; 

    
   document.getElementById("op-table-title").innerHTML ="All clients supports request";

   document.getElementById("op-th-0").innerHTML = "Client";
document.getElementById("op-th-1").innerHTML = "Against";
document.getElementById("op-th-2").innerHTML = "Case Status";
document.getElementById("op-th-3").innerHTML = "Subject";
document.getElementById("op-th-4").innerHTML = "Cliam Amount";
document.getElementById("op-th-5").innerHTML = "Document";

    var timestampArray = document.getElementsByClassName("assing-emp-label");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Employee Name';
  
}
var timestampArray = document.getElementsByClassName("assing-task-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Add';
  
}
}



}
 
</script>


@endsection