@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
 
        <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-doc-btn"></button>
       
    </div>
   
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3" id="docs-type"></h4>
                    <div class="files-nav">                                     
                        <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                            <a class="nav-link active" id="files-pdf-tab" data-toggle="pill" href="#files-pdf" aria-selected="false">
                                <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                <div class="d-inline-block align-self-center">
                                    <h5 class="m-0" id="stage-docs"> </h5>
                                    <small class="text-muted">{{$excute_docs->count()}} ملفات</small>                                                    
                                </div>
                            </a>
                            <a class="nav-link " id="files-projects-tab" data-toggle="pill" href="#files-projects" aria-selected="true">
                                <i class="em em-file_folder ml-3 text-warning d-inline-block"></i>
                                <div class="d-inline-block align-self-center">
                                    <h5 class="m-0" id="all-docs">  </h5>
                                    <small class="text-muted"> {{$all_excute_docs->count()}} ملفات</small>                                                    
                                </div>
                            </a>
                           
                      
                       
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->

            <div class="card">
                <div class="card-body">                                        
                   
                    <h6 class="mt-0" id="size"></h6>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-9">

            <div class="">                                    
                <div class="tab-content" id="files-tabContent">
                    <div class="tab-pane fade " id="files-projects">
                        <h4 class="header-title mt-0 mb-3" id="all-docs-title"> </h4>                                         
                        <div class="file-box-content">
                            
                            @foreach ($all_excute_docs as $all_docs)
                                
                          
                            <div class="file-box">
                              
                                <a href="{{asset('assets/excute-docs/'.$all_docs->main_case_id.'/'.$all_docs->S_path)}}" class="download-icon-link" download>
                                  
                                    <i class="dripicons-download file-download-icon"></i>
                                </a>
                                <div class="text-center">
                                    <i class="far fa-file-alt text-primary"></i>
                                    <h5 class="text-truncate"> {{$all_docs->S_name}} </h5>
                                    <hr>
                                    <h6 class=" text-muted"> {{$all_docs->S_subject}} </h6>
                                    
                                    <small class="text-muted">{{$all_docs->DT_Doc_Date }} / النسخة : {{$all_docs->N_version }} </small>
                                </div>                                                        
                            </div>
                           
                            @endforeach
                                                                           
                        </div> 
                        
                      
                        
                    </div><!--end tab-pane-->

                    <div class="tab-pane fade show active" id="files-pdf">
                        <h4 class="mt-0 header-title mb-3" id="all-stage-docs-title"></h4>
                        <div class="file-box-content">
                            @foreach ($excute_docs as $excute_doc)
                                
                          
                            <div class="file-box">
                              
                                <a href="{{asset('assets/excute-docs/'.$excute_doc->main_case_id.'/'.$excute_doc->S_path)}}" class="download-icon-link" download>
                                  
                                    <i class="dripicons-download file-download-icon"></i>
                                </a>
                                <div class="text-center">
                                    <i class="far fa-file-alt text-primary"></i>
                                    <h5 class="text-truncate"> {{$excute_doc->S_name}} </h5>
                                    <hr>
                                    <h6 class=" text-muted"> {{$excute_doc->S_subject}} </h6>
                                    
                                    <small class="text-muted">{{$excute_doc->DT_Doc_Date }} / النسخة : {{$excute_doc->N_version }} </small>
                                </div>                                                        
                            </div>
                           
                            @endforeach
                            
                                                               
                        </div> 
                    </div><!--end tab-pane-->

                  

                    <div class="tab-pane fade" id="files-hide">
                        <h4 class="mt-0 header-title mb-3">Hide</h4>
                    </div><!--end tab-pane-->
                </div>  <!--end tab-content-->                                                                              
            </div><!--end card-body-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{ route('add-excute-document') }}" enctype="multipart/form-data">
                        @csrf
                  <div class="row">

                      <div class="col-12"> 
                          <div class="form-group row">
                            <input class="form-control col-sm-6" value=" {{$excute_id}} " name="excute_id" type="hidden" id="example-text-input">

                                    <div class="col-sm-4">
                                        <label id="doc-main-case-number">رقم القضية</label>
                                        <input class="form-control col-sm-6" value=" {{$main_case_id}} " name="main_case_id" type="hidden" id="example-text-input">

                                        <input disabled class="form-control col-sm-6" value=" {{$main_case_id}} " type="text" id="example-text-input">
                                    </div>
                                     <div class="col-sm-4">
                                        <label id="doc-number">رقم المستند</label>
                                        <input class="form-control col-sm-6" disabled value="  {{$all_excute_docs->count()+1}} "  type="text" id="example-text-input">
                                    </div>
                                    <div class="col-sm-4">
                                        <label id="doc-attach">تحميل المستند</label>
                                        <input class="form-control col-sm-12" required type="file" name="doc" id="example-text-input">
                                    </div>
                              </div>
                     </div>
                     <div class="col-12"> <hr>  </div>
                   

                     
                     <div class="col-12"> 
                        <div class="form-group row">
                                 
                                  <div class="col-sm-4">
                                   <label id="doc-name-ar">اسم المستند عربي</label>
                                      <input class="form-control" placeholder="" name="name" type="text" id="example-text-input">
                                  </div>

                                  <div class="col-sm-4">
                                      <label id="doc-name-eng">اسم المستند انجليزي</label>
                                      <input class="form-control" placeholder="" name="name_eng" type="text" id="example-text-input">

                                    </div>

                                   <div class="col-sm-4">
                                    <label id="doc-v">رقم النسخة</label>
                                      <input class="form-control"  type="text" name="v_num" id="example-text-input">
                                  </div>
                                  
                               

                              </div>
            
                   </div>
                   <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-sm-4">
                                <label id="doc-date">تاريخ المستند</label>
                              <input type="date" disabled class="form-control" id="now_date" value="5" >
                              </div>
                               <div class="col-sm-12 mt-3">
                                    <label id="doc-subject">موضوع المستند</label>
                               <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                              </div>

                          </div>
        
               </div>
            
                   <div class="col-12">                         
                      <button type="submit" class="btn btn-sm btn-success mr-1 font-16" id="doc-add-btn">إضافة مستند</button>
                   </div>
         
                         </div> 
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
    
@endsection


@section('page-script')

<script>
    if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('main-case-cases/'.$main_case_id)}}">القضية {{$main_case_id}} </a>' ;
    document.getElementById("breadcrumb-3").innerHTML = "مستندات التنفيذ"; 

    document.getElementById("page-name").innerHTML = "مستندات التنفيذ";
    

    document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة مستند';

    document.getElementById("docs-type").innerHTML = "انواع المستندات";
    document.getElementById("stage-docs").innerHTML = "مستندات التنفيذ";
    document.getElementById("all-docs").innerHTML = "كل المستندات";
    document.getElementById("size").innerHTML = "حجم الملفات الكلي : 22.86 GB";
    document.getElementById("all-docs-title").innerHTML = "كل المستندات";
    document.getElementById("all-stage-docs-title").innerHTML = "مستندات التنفيذ";

    document.getElementById("doc-main-case-number").innerHTML = "رقم القضية";
    document.getElementById("doc-number").innerHTML = "رقم المستند";
    document.getElementById("doc-attach").innerHTML = "تحميل المستند";
    document.getElementById("doc-name-ar").innerHTML = "اسم المستند عربي";
    document.getElementById("doc-name-eng").innerHTML = "اسم المستند انجليزي";
    document.getElementById("doc-v").innerHTML = "رقم النسخة";
    document.getElementById("doc-date").innerHTML = "تاريخ المستند";
    document.getElementById("doc-subject").innerHTML = "موضوع المستند";
    document.getElementById("doc-add-btn").innerHTML = "اضافة مستند";



    }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('main-case-cases/'.$main_case_id)}}">case {{$main_case_id}} </a>' ;
    document.getElementById("breadcrumb-1").innerHTML = "excute documents" ;

    document.getElementById("page-name").innerHTML = "EXCUTE DOCUMENTS";

    document.getElementById("add-doc-btn").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add document';

    document.getElementById("docs-type").innerHTML = "Documents type";
    document.getElementById("stage-docs").innerHTML = "Excute documents";
    document.getElementById("all-docs").innerHTML = "All documents";
    document.getElementById("size").innerHTML = "Documents size : 22.86 GB";
    document.getElementById("all-docs-title").innerHTML = "All documents";
    document.getElementById("all-stage-docs-title").innerHTML = "Stage documents";

    
    document.getElementById("doc-main-case-number").innerHTML = "Main case number";
    document.getElementById("doc-number").innerHTML = "Doc number";
    document.getElementById("doc-attach").innerHTML = "Attach doc";
    document.getElementById("doc-name-ar").innerHTML = "Doc name AR";
    document.getElementById("doc-name-eng").innerHTML = "Doc name ENG";
    document.getElementById("doc-v").innerHTML = "Doc version";
    document.getElementById("doc-date").innerHTML = "Doc date";
    document.getElementById("doc-subject").innerHTML = "Doc subject";
    document.getElementById("doc-add-btn").innerHTML = "Add doc";

    }
</script>
    
@endsection