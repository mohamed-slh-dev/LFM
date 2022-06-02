@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('css-link')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                                <p class="mb-1 text-muted" id="files-box"></p>
                                <h4 class="mt-0 mb-1">{{$files->count()}}</h4>                                                                                                                                           
                            </div>
                        </div> 
                        <div class="col-4 align-self-center">
                            <div class="icon-info">
                                <i class="mdi mdi-folder-multiple  text-success"></i>
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

     <div class="col-lg-12 col-xl-6">
       <div class="card">
           <div class="card-body">            
               <h4 class="mt-0 header-title"></h4>
               <p class="text-muted mb-3 d-inline-block text-truncate w-100">
               </p>            
               <div id="chartContainer" style="height: 300px; width: 100%;"></div>

               </div><!--end card-body-->
       </div> <!-- end card -->  
   </div> <!-- end col -->

</div>

<div class="row">
                    

    
        <div class="col-lg-12">

                <div class="card client-card"> 
                    <div class="col-lg-12 ">
                        <div class=>
                            <ul class="list-inline mt-3 ">                                    
                               @if ($add_file == 'true')
                                   <li class="list-inline-item">
         
                                <button type="button" class="btn btn-primary waves-effect waves-light " data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-new-file"></button>
         
                                </li>
                               @endif
                                
                            </ul>
                        </div>                            
                    </div><!--end col-->
                    <form class="form"  method="POST" action="{{route('search-files')}}">
                        @csrf                           
                   <div class="card-body text-center" >
                         <div class="row">
                         <div class="col-12">
                            <div class="row">
                    

                        <div class="col-3  ">
                            <div class="form-group row">
                          <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="file-num-search"> رقم الملف</label>
                          <div class="col-sm-8">
                            <input class="form-control " name="file_num" type="text" >

                          </div>
                      </div>
                             
               </div>

                        <div class="col-3  ">
                                     <div class="form-group row">
                                   <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="client-name-search"></label>
                                   <div class="col-sm-8">
                                     <select class="custom-select text-center" name="client">
                                         <option value=""></option>
                                        @foreach ($clients as $client)
                                        <option value="{{$client->N_CLIENT_ID}}">{{$client->S_CLIENT_AR_NAME}}</option>
                                          @endforeach
                                      </select>
                                   </div>
                               </div>
                                      
                        </div>
                         
                        
                    <div class="col-2">
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
                           <img src="assets/images/clients-imgs/{{$file->client_logo}}" alt="" height="80" class="mx-auto d-block mb-0"> 
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

                           <p class="text-muted mb-0"> {{$file->create_date}} </p>
                               
                       </div>                                                                      
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
           @endforeach
   
       </div><!--end row-->
       <div class=" mt-4">
        {{ $files->links() }}
        
        </div>

       <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style=" display: block; ">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                 <form class="form"  method="POST" action="{{route('add-file')}}">
                   @csrf
                  <div class="row">
                    <div class="col-12"> 
                        <div class="col-sm-2">
                            <label for="noe_date"  id="new-file-file-num"></label>
                            <input class="form-control " name="next_id" value="{{$next_file_id + 1}}" type="hidden" >
                        <input class="form-control " disabled value=" {{$next_file_id + 1}} " type="text" >
                      </div>
                      <hr>
                    </div>
                    
                  <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                     <label id="new-file-client"> </label>
                                      <select class=" select2 form-control mb-3 custom-select " name="client">
                                           
                                            @foreach ($clients as $client)
                                                        <option value="{{$client->N_CLIENT_ID}}">{{$client->S_CLIENT_AR_NAME}}</option>
                                             @endforeach
                                           
                                            
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="noe_date" id="new-file-by"></label>
                                    <input class="form-control " disabled value="{{ auth()->user()->name }}" type="text" id="example-text-input">
                                  </div>
                                   <div class="col-sm-4">
                                        <label for="noe_date" id="new-file-date"></label>
                                 <input class="form-control" type="date" value="" disabled id="todayDate">
                                  </div>
                                  
                                 

                                </div>
              
                     </div>
                   
                     <div class="col-12"> 
                        <div class="form-group row">
                                 
                           
                                   <div class="col-sm-6">
                                    <label for="noe_date" id="new-file-branch"></label>
                                       <select class="custom-select" name="branch">
                                          @foreach ($branchs as $branch)
                                              <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                              @endforeach
                                      </select>
                                  </div>
  
                                    <div class="col-sm-6">
                                    <label id="new-file-fees"></label>
                                    <input class="form-control fraction-commas" name="fee" type="text">
                                  </div>
                                  
                                   
                               
  
                              </div>
            
                   </div>
                      
                    
                  <div class="col-12"> 
                    <label for="noe_date" id="new-file-info"></label>
                     <textarea class="form-control" name="more_info" rows="5" id="message"></textarea>
                    </div>
  
                       <div class="col-12 mt-3"> 
                      
            <button class="btn btn-sm btn-primary mr-1 font-15" id="new-file-btn"></button>
                   </div> 
                      

                    </div> 
                 </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
    
    
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
                                    <label class="edit-file-branch"></label>
                                    <select  class="custom-select" name="branch">
                                        <option value="{{$file->branchCode}}">{{$file->branchName}}</option>  

                                        @foreach ($branchs as $branch)
                                        <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                        @endforeach
                                    </select>        
                                  </div>

                                    <div class="col-4">
                                        <label class="edit-file-fees"></label>
                                        <input type="text" class="form-control fraction-commas" value="{{$file->office_fee}}" name="fee" >
                                   
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="noe_date" class="edit-file-info"></label>
                                    <textarea class="form-control"  name="more_info" rows="5" id="message"> {{$file->more_info}}</textarea>
                                   </div>
                            </div>
                               
                                   
                               

                              </div>
            
                   </div>
                    

                      

                   <button class="btn btn-primary my-4 edit-file-btn" type="submit"> </button>
                                                    
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



<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script>



    <script>
          if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = "الملفات"; 

    document.getElementById("page-name").innerHTML = "الملفات";

    document.getElementById("files-box").innerHTML = "الملفات";
    if ( document.getElementById("add-new-file")) {
    document.getElementById("add-new-file").innerHTML =' <i class="mdi mdi-plus-box mx-2"></i> إضافة ملف جديد';  
    }
 document.getElementById("file-num-search").innerHTML = "رقم الملف";
 document.getElementById("client-name-search").innerHTML = "اسم العميل";
 document.getElementById("files-search-btn").innerHTML = "بحث"; 

 document.getElementById("new-file-branch").innerHTML = "الفرع"; 
 document.getElementById("new-file-file-num").innerHTML = "رقم الملف";  
 document.getElementById("new-file-client").innerHTML = "اسم العميل";  
 document.getElementById("new-file-by").innerHTML = "بواسطة"; 
 document.getElementById("new-file-date").innerHTML = "تاريخ الانشاء";    
 document.getElementById("new-file-info").innerHTML = "بيانات الملف"; 
 document.getElementById("new-file-fees").innerHTML = "رسوم المكتب";  
 document.getElementById("new-file-btn").innerHTML = "اضافة ملف";


 var timestampArray = document.getElementsByClassName("edit-file-client");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'العميل';
  
}

  var timestampArray = document.getElementsByClassName("edit-file-branch");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'الفرع';
  
}
var timestampArray = document.getElementsByClassName("edit-file-info");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'بيانات الملف';
  
}var timestampArray = document.getElementsByClassName("edit-file-fees");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'رسوم المكتب';
  
}var timestampArray = document.getElementsByClassName("edit-file-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تحديث الملف';
  
} 

          }else{
            document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "cases manage";
    document.getElementById("breadcrumb-1").innerHTML = "files";


    document.getElementById("page-name").innerHTML = "FILES";

    document.getElementById("files-box").innerHTML = "All files";

if ( document.getElementById("add-new-file")) {
    document.getElementById("add-new-file").innerHTML =' <i class="mdi mdi-plus-box mx-2"></i> Add new file';  
}

 document.getElementById("file-num-search").innerHTML = "File number";
 document.getElementById("client-name-search").innerHTML = "Client name";
 document.getElementById("files-search-btn").innerHTML = "search";

 document.getElementById("new-file-branch").innerHTML = "Brnach"; 
 document.getElementById("new-file-file-num").innerHTML = "File No.";  
 document.getElementById("new-file-client").innerHTML = "Client name";  
 document.getElementById("new-file-by").innerHTML = "Created by"; 
 document.getElementById("new-file-date").innerHTML = "Created date";    
 document.getElementById("new-file-info").innerHTML = "File info."; 
 document.getElementById("new-file-fees").innerHTML = "Office fee";  
 document.getElementById("new-file-btn").innerHTML = "Add file"; 


 var timestampArray = document.getElementsByClassName("edit-file-client");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Client';
  
}

 var timestampArray = document.getElementsByClassName("edit-file-branch");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Branch';
  
}

var timestampArray = document.getElementsByClassName("edit-file-info");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'File info.';
  
}

var timestampArray = document.getElementsByClassName("edit-file-fees");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Office fee';
  
}

var timestampArray = document.getElementsByClassName("edit-file-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Update file';
  
}

          }
    </script>
@endsection