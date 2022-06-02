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
                <form class="form"  method="POST" action="{{route('search-files')}}">
                    @csrf                           
               <div class="card-body text-center" >
                     <div class="row">
                     <div class="col-12">
                        <div class="row">
                

                    <div class="col-3  ">
                        <div class="form-group row">
                      <label for="example-text-input" class="col-sm-4 col-form-label px-0" id="files-search-file-num"> رقم الملف</label>
                      <div class="col-sm-8">
                        <input class="form-control " name="file_num"  type="text" id="example-text-input">

                      </div>
                  </div>
                         
           </div>

                    <div class="col-3  ">
                                 <div class="form-group row">
                               <label for="example-text-input" class="col-sm-4 col-form-label px-0" id="files-search-client"></label>
                               <div class="col-sm-8">
                                 <select class="custom-select text-right" name="client">
                                     <option value=" "></option>
                                    @foreach ($clients as $client)
                                    <option value="{{$client->N_CLIENT_ID}}">{{$client->S_CLIENT_AR_NAME}}</option>
                                      @endforeach
                                  </select>
                               </div>
                           </div>
                                  
                    </div>
                   
   
                <div class="col-1  text-right">
                 <button class="btn btn-success waves-effect waves-light mx-3" id="files-search-btn"> </button>
                </div>
                    </div>
                     </div>
                 

                               
                              
                            
                    </div>

              </div>
                </form>
           </div>      
      </div>
      @foreach ($files as $file)
      
      <div class="col-lg-4">
          <div class="card" style="border: 1px solid; box-shadow: 5px 5px 19px 3px #6e2a1638">
              <div class="card-body py-1 px-">                                        
                  <div class=" d-flex justify-content-end">                                        
                      <div class="dropdown d-inline-block">
                       <a class="nav-link dropdown-toggle arrow-none" id="dLabel1" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                           <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                       </a>
                          <div class="dropdown-menu text-center" aria-labelledby="dLabel3">
                            @if (Session::get('lang') == "ar")
                            <a data-toggle="modal" data-animation="bounce" data-target=".edit-file-{{$file->id}}" class="dropdown-item" href="#">تعديل</a>
                            <a class="dropdown-item" href="#">حذف</a>
                            @else 
                            <a data-toggle="modal" data-animation="bounce" data-target=".edit-file-{{$file->id}}" class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a> 
                            @endif
                          </div>
                      </div>
                  </div> 
                  <div class="text-center project-card" style="margin-top: -40px;">
                      <img src="{{asset('assets/images/clients-imgs/'.$file->client_logo)}}" alt="" height="80" class="mx-auto d-block mb-0"> 
                     <br>
                     <span class="badge badge-soft-purple font-11">{{$file->branchName}}</span>

                   
                     @if (Session::get('lang') == "ar")
                     <h4> <i class="mdi mdi-account  mr-2 text-info ml-2"></i>  {{$file->S_CLIENT_AR_NAME}}</h4>
                     <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14"><b>بيانات الملف : </b></span>{{$file->more_info}}
                        <h4 class="project-title mb-0" >   {{$file->file_id}} </h4>
                        <form action="{{route('file-case')}}" method="post">
                            @csrf
                            <input type="hidden" name="file_id" value="{{$file->file_id}}">
                            
                             <button class="btn btn-outline-secondary waves-effect waves-light my-3" type="submit" > عرض القضية </button>
          
                          </form> 
                     @else
                     <h4> <i class="mdi mdi-account  mr-2 text-info ml-2"></i>  {{$file->S_CLIENT_EG_NAME}}</h4>
                     <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14"><b>File info : </b></span>  {{$file->more_info}}
                        <h4 class="project-title mb-0" >   {{$file->file_id}} </h4>
                        <form action="{{route('file-case')}}" method="post">
                            @csrf
                            <input type="hidden" name="file_id" value="{{$file->file_id}}">
                            
                             <button class="btn btn-outline-secondary waves-effect waves-light my-3" type="submit" > view case </button>
          
                          </form>
                     @endif
                     
                   </p>
                      
                                     

                      <p class="text-muted mb-0"> {{$file->create_date}} </p>
                          
                  </div>                                                                      
              </div><!--end card-body-->
          </div><!--end card-->
      </div><!--end col-->
      @endforeach
    </div>
  
     
    @foreach ($files as $file)
<div class="modal fade edit-file-{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-file')}}">
                        @csrf
                <div class="row">
                    

          
               

                    <input type="hidden" name="file_id" id="" value="{{$file->id}}">
                    <input type="hidden" name="file_idd" id="" value="{{$file->file_id}}">

                
                    
                
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                           
                            @if (Session::get('lang') == "ar")
                            <div class="col-4">
                                <label class="edit-file-client"></label>
                                <select  class="select2 form-control mb-3 custom-select" name="client_id">
                                    <option value="{{$file->N_CLIENT_ID}}">{{$file->S_CLIENT_AR_NAME}}</option>  

                                    @foreach ($clients as $client)
                                             <option value="{{$client->N_CLIENT_ID}}">{{$client->S_CLIENT_AR_NAME}}</option>
                                     @endforeach
                                </select>        
                              </div>
                            <div class="col-4">
                                <label id="edit-file-branch">الفرع</label>
                                <select required class="custom-select" name="branch">
                                    <option value="{{$file->branchCode}}">{{$file->branchName}}</option>  

                                    @foreach ($branchs as $branch)
                                    <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>

                                <div class="col-4">
                                    <label id="edit-file-fees">رسوم المكتب</label>
                                    <input type="number" class="form-control" value="{{$file->office_fee}}" name="fee" >
                               
                            </div>

                            <div class="col-12 mt-3">
                                <label for="noe_date" id="edit-file-info">معلومات الملف</label>
                                <textarea class="form-control"  name="more_info" rows="5" id="message"> {{$file->more_info}}</textarea>
                               </div>
                            </div>
                               
                                   
                               

                              </div>
            
                   </div>
                    

                      

                   <button class="btn btn-primary my-4" type="submit" id="edit-file-btn"> تحديث</button>
                              @else
                              <div class="col-6">
                                <label id="edit-file-branch">Branch</label>
                                <select required class="custom-select" name="branch">
                                    <option value="{{$file->branchCode}}">{{$file->branchName}}</option>  

                                    @foreach ($branchs as $branch)
                                    <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>

                                <div class="col-6">
                                    <label id="edit-file-fees">Office fees</label>
                                    <input type="number" class="form-control" value="{{$file->office_fee}}" name="fee" >
                               
                            </div>

                            <div class="col-12 mt-3">
                                <label for="noe_date" id="edit-file-info">File info.</label>
                                <textarea class="form-control"  name="more_info" rows="5" id="message"> {{$file->more_info}}</textarea>
                               </div>
                            </div>
                               
                                   
                               

                              </div>
            
                   </div>
                    

                      

                   <button class="btn btn-primary my-4" type="submit" id="edit-file-btn">Update </button> 
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
          if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "البحث"; 
    document.getElementById("breadcrumb-2").innerHTML = "بحث الملفات"; 

    document.getElementById("page-name").innerHTML = "بحث الملفات";

    document.getElementById("files-search-file-num").innerHTML = "رقم الملف ";
    document.getElementById("files-search-client").innerHTML = " اسم الموكل ";
    document.getElementById("files-search-btn").innerHTML = "بحث ";

    var timestampArray = document.getElementsByClassName("edit-file-branch");



          }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "search";
    document.getElementById("breadcrumb-1").innerHTML = "files search";

    document.getElementById("page-name").innerHTML = "FILES SEARCH";

    document.getElementById("files-search-file-num").innerHTML = "File number";
    document.getElementById("files-search-client").innerHTML = "Client name ";
    document.getElementById("files-search-btn").innerHTML = "search ";

 
          }
</script>
    
@endsection