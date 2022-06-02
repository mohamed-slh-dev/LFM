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
                                       <p class="mb-1 text-muted" id="all-excutes"></p>
                                       <h4 class="mt-0 mb-1 text-success">{{$excutes_count->count()}}</h4>                                                         
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
    
          
    
    
           </div><!--end row-->  
       </div> <!-- end col -->
    
    
        <div class="col-lg-6">
           <div class="card">
               <div class="card-body">        
                   <h4 class="mt-0 header-title" id="chart-title"></h4>
                <p class="text-muted mb-3 d-inline-block text-truncate w-100" id="chart-desc">
                   </p>
                   <div id="donut-chart">
                       <div id="donut-chart-container" class="flot-chart" style="height: 320px">
                       </div>
                   </div>
               </div><!--end card-body-->
           </div><!--end card-->
       </div> <!-- end col -->
    </div>

    <div class="row">
                     
   


        <div class="col-lg-12">
           <div class="card client-card">
               <div class="col-lg-12 ">
                   <div class="">
                       <ul class="list-inline mt-3 pr-0 mr-1 mb-0">                                    
                          
                          @if ($add_case == 'true')
                              
                           <li class="list-inline-item">
          
                              <button type="button" class="btn btn-primary waves-effect waves-light mb-3 mx-3" data-toggle="modal" data-animation="bounce" data-target=".excute-stage" id="add-excute"></button>
                       </li>
                          @endif
                           
                       </ul>
                   </div>                            
               </div><!--end col-->  
             <form class="form"  method="POST" action="{{route('search-excutes')}}">
                 @csrf                               
              <div class="card-body text-center" >
                    <div class="row">
                    <div class="col-12">
                       <div class="row">
                      
                       <div class="col-3 px-0">
                          <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="search-number"></label>
                              <div class="col-sm-8">
                               <input class="form-control pl-0 font-11"  name="excute_num" type="text" id="example-text-input">
                           </div>
                          </div>
                           
                                 
                   </div>
                   
                    
   
                   
                   <div class="col-3 ">
                       <div class="form-group row">
                        <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="search-type"> </label>
                        <div class="col-sm-8">
                          <select class="custom-select text-center" name="type">
                           <option value="all"></option>
                           @foreach ($excute_type as $excute_type_filter)
                              <option value="{{$excute_type_filter->N_DetailedCode}}">{{$excute_type_filter->S_Desc_A}}</option>  
                              @endforeach
                                
                            </select>
                        </div>
                    </div>
                           
             </div>
             
               
   
               <div class="col-1">
                <button class="btn btn-success waves-effect waves-light mr-3" id="search-btn"> </button>
               </div>
                   </div>
                    </div>
                   
                              
                             
                           
                   </div>
   
             </div>
             </form>
          </div>      
     </div>     
    </div><!--end row-->

    <div class="row">
        @foreach ($excutes as $excute)
        <div class="col-lg-6">
            <div class="card" style="border: 1px solid #c6c6c6;">
                   <div class="card-body"> 
                    @if (Session::get('lang') == "ar")
                          <div class="task-box">
                            <a href="{{url('main-case-cases/'.$excute->main_case_id)}}"  class=" float-left">
                                <button class="btn-sm btn-outline-dark btn-round">
                                    <span>عرض القضية :   </span>
                                    <span class="" style=" font-weight: bold; ">  {{$excute->main_case_id}} </span>  
                                </button>
                             </a>
                               <h5 class="mt-0" style="font-weight: bold;"> - {{$excute->excute_uid}} </h5>
                              <p class="text-muted mb-1">
                              -  {{$excute->subject}}  
                               </p>
                               <div style="display: block ruby;" class="mt-4">
                                  <p class=" text-right mb-1">  نوع التنفيذ : {{$excute->typeName}} </p>4
    
                                  <p class=" float-left mb-1">  تاريخ التنفيذ : {{$excute->excute_date}} </p>
    
                               </div>
                                 
           
                               <hr>
                               
                               <div class="d-flex justify-content-between">
                               <a href="{{url('excute-details/'.$excute->excute_stage_id)}}">
                                 <button class="btn btn-outline-dark waves-effect waves-light" >البيانات</button>
                               </a> 
                                 
                                 
                                 <a href="{{url('excute-actions/'.$excute->excute_stage_id)}} ">
                                   <button class="btn btn-outline-dark waves-effect waves-light">الاجراءات التنفيذية</button>
                               </a>
                               
                              
    
                         
                            <a
                             href="{{url('excute-tasks/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المهام</button>
                            </a>
    
                            <a href="{{url('excute-documents/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >المستندات</button></a>
    
                            
                            <a href="{{url('delete-excute/'.$excute->excute_stage_id)}} ">
                                <button class="btn btn-outline-danger waves-effect waves-light">حذف</button>
                            </a>
                              
                               </div>                                        
                           </div><!--end task-box--> 
                       @else
                          <div class="task-box">
                            <a href="{{url('main-case-cases/'.$excute->main_case_id)}}"  class=" float-right">
                                <button class="btn-sm btn-outline-dark btn-round">
                                    <span>view case :   </span>
                                    <span class="" style=" font-weight: bold; ">  {{$excute->main_case_id}} </span>  
                                </button>
                             </a>
                               <h5 class="mt-0" style="font-weight: bold;"> - {{$excute->excute_uid}} </h5>
                              <p class="text-muted mb-1">
                              -  {{$excute->subject}}  
                               </p>
                               <div style="display: block ruby;" class="mt-4">
                                  <p class=" text-right mb-1">  Excute type : {{$excute->typeName}} </p>
    
                                  <p class=" float-right mb-1 "> Excute date : {{$excute->excute_date}} </p>
    
                               </div>
                                 
           
                               <hr>
                               
                               <div class="d-flex justify-content-between">
                               <a href="{{url('excute-details/'.$excute->excute_stage_id)}}">
                                 <button class="btn btn-outline-dark waves-effect waves-light" >Details</button>
                               </a> 
                                 
                                 
                                 <a href="{{url('excute-actions/'.$excute->excute_stage_id)}} ">
                                   <button class="btn btn-outline-dark waves-effect waves-light">Excute actions</button>
                               </a>
                               
                              
    
                         
                            <a
                             href="{{url('excute-tasks/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-dark waves-effect waves-light" >Tasks</button>
                            </a>
    
                            <a href="{{url('excute-documents/'.$excute->excute_stage_id,$excute->main_case_id)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >Documents</button></a>
    
                            
                            <a href="{{url('delete-excute/'.$excute->excute_stage_id)}} ">
                                <button class="btn btn-outline-danger waves-effect waves-light">DELETE</button>
                            </a>
                              
                               </div>                                        
                           </div><!--end task-box--> 
                       @endif                                   
                       
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
        @endforeach
        <div class="float-left mt-4">
           {{ $excutes->links() }}
           
           </div>

    </div>

    <div class="modal fade excute-stage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('add-excute-stage')}}" enctype="multipart/form-data">
                        @csrf
                  <div class="row">
                   
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                     <div class="col-sm-4">
                                        <label id="excute-number"></label>
                                        <input class="form-control" name="excute_uid" type="text" id="example-text-input">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                       <label id="excute-file-number"></label>
                                       <select class="custom-select" name="file_id">
                                        @foreach ($files as $file)
                                        <option value="{{$file->file_id}}">{{$file->file_id}}</option>
                                          @endforeach
                                           
                                       </select>
                                    </div>
    
                                     <div class="col-sm-4">
                                       <label id="excute-case-number"></label>
                                       <select class="custom-select" name="main_case_id">
                                        @foreach ($main_cases as $mc)
                                        <option value="{{$mc->N_CASE_ID}}">{{$mc->N_CASE_ID}}</option>
                                          @endforeach  
                                       </select>
                                                              
                                      </div>
                                   
                                 
    
                                </div>
              
                     </div>
                       <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                     <label id="excute-type">نوع الخدمة</label>
                                     <select class="custom-select" name="excute_type"> 
                                        @foreach ($excute_type as $excute)
                                        <option value="{{$excute->N_DetailedCode}}">{{$excute->S_Desc_A}}</option>  
                                        @endforeach 
                                        
                                    </select>
                                    </div>
                                      <div class="col-sm-4">
                                        <label id="excute-cliam"></label>
                                        <input class="form-control fraction-commas" name="cliam_amount" type="text" id="example-text-input">
                                      </div>
    
                                    <div class="col-sm-4">
                                        <label id="excute-date"></label>
                                        <input class="form-control" type="date" name="register_date" id="example-text-input">
                                    </div>
                                   
                                   
    
                                </div>
              
                     </div>
    
                     <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-sm-4">
                                     <label id="excute-fees"></label>
                                     <input class="form-control fraction-commas" name="excute_fee" type="text" id="example-text-input">
    
                                  </div>
    
                                  
                         </div>
                      </div>
                 
    
                   
    
                      <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-sm-4">
                              <label id="excute-collected"></label>
                              <input class="form-control fraction-commas" name="collected_amount" type="text" id="example-text-input">
                                  </div>
  
                             <div class="col-sm-4">
                              <label id="excute-expenss"></label>
                              <input class="form-control fraction-commas" name="case_cost" type="text" id="example-text-input">
                                  </div>
  
                                  <div class="col-sm-4">
                                      <label id="excute-office-fees"></label>
                                      <input class="form-control fraction-commas" name="office_cost" type="text" id="example-text-input">
                                   </div>
                         </div>
                                  
                                  
  
                              </div>
              
                     </div>
                     <div class="col-12"> 
                        <label for="noe_date" id="excute-subject"></label>
                         <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                        </div>
    
                         <div class="col-12 mt-3"> 
                          <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="excute-add-btn"></button>
                         </div> 
                      
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
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
        document.getElementById("breadcrumb-2").innerHTML = " التنفيذات"; 
    
        document.getElementById("page-name").innerHTML = " التنفيذات";

        document.getElementById("all-excutes").innerHTML = " عدد التنفيذات الكلي";

        document.getElementById("chart-title").innerHTML = "انواع التنفيذات";
        document.getElementById("chart-desc").innerHTML = "رسم توضيحي";

if ( document.getElementById("add-excute")) {
    document.getElementById("add-excute").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة تنفيذ';
}

document.getElementById("search-number").innerHTML = "رقم التنفيذ";
document.getElementById("search-type").innerHTML = "نوع التنفيذ";
document.getElementById("search-btn").innerHTML = "بحث";

document.getElementById("excute-number").innerHTML = "رقم التنفيذ";
document.getElementById("excute-file-number").innerHTML = "رقم الملف";
document.getElementById("excute-case-number").innerHTML = "رقم القضية";
document.getElementById("excute-type").innerHTML = "نوع الخدمة";
document.getElementById("excute-cliam").innerHTML = "مبلغ التنفيذ (مبلغ المطالبة)";
document.getElementById("excute-date").innerHTML = "تاريخ تسجيل التنفيذ";
document.getElementById("excute-fees").innerHTML = "رسوم التنفيذ";
document.getElementById("excute-collected").innerHTML = "المبالغ المحصلة";
document.getElementById("excute-expenss").innerHTML = "مصروفات القضية";
document.getElementById("excute-office-fees").innerHTML = "اتعاب المكتب";
document.getElementById("excute-subject").innerHTML = "موضوع التنفيذ";
document.getElementById("excute-add-btn").innerHTML = "اضافة تنفيذ";



    }else{

        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "cases manage";
    document.getElementById("breadcrumb-1").innerHTML = " excutes ";

    document.getElementById("page-name").innerHTML = " EXCUTES";

    document.getElementById("all-excutes").innerHTML = "All executes";

    document.getElementById("chart-title").innerHTML = "Executes type";
    document.getElementById("chart-desc").innerHTML = "Executes type diagram";

    if ( document.getElementById("add-excute")) {
    document.getElementById("add-excute").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i>  Add execute';
    }
    document.getElementById("search-number").innerHTML = "Excute number";
document.getElementById("search-type").innerHTML = "Execute type";
document.getElementById("search-btn").innerHTML = "search";


document.getElementById("excute-number").innerHTML = "Execute number";
document.getElementById("excute-file-number").innerHTML = "File number";
document.getElementById("excute-case-number").innerHTML = "Main case number";
document.getElementById("excute-type").innerHTML = "Execute type";
document.getElementById("excute-cliam").innerHTML = "Cliam amount";
document.getElementById("excute-date").innerHTML = "Register date";
document.getElementById("excute-fees").innerHTML = "Execute fees";
document.getElementById("excute-collected").innerHTML = "Collected amount";
document.getElementById("excute-expenss").innerHTML = "Case fees";
document.getElementById("excute-office-fees").innerHTML = "Office fees";
document.getElementById("excute-subject").innerHTML = "Subject";
document.getElementById("excute-add-btn").innerHTML = "Add execute";
 }
</script>
    
@endsection