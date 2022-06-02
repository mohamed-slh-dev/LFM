@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
   
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 ">
            <div class="">
                <ul class="list-inline mt-3 pr-0 mr-1 mb-0">                                    
                   
                  
                       <li class="list-inline-item">
   
                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-chat" id="add-btn"><i class="mdi mdi-plus-box mx-2"></i> انشاء محادثة</button>
                    </li>
                  
                 
                    
                </ul>
            </div>                            
        </div><!--end col--> 
      <div class="col-12">
        @if ($chats)
            
       
        @foreach ($chats as $chat)
            
        <div class="col-md-4">
            <div class="bg-light p-4">               
                <div id="project-list-left" class="">
                    <div class="card mb-0">
                        <div class="card-body">
                            @if (Session::get('lang') == "ar")
                            <div class="dropdown d-inline-block float-left">
                                <a class="nav-link dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="drop2">
                                   
                                    <a class="dropdown-item text-danger" href="{{url('delete-chat/'.$chat->chat_id)}}">حذف</a>
                                   
                                    <a class="dropdown-item text-danger" href="{{url('delete-chat/'.$chat->chat_id)}}">Delete</a> 
                                  
                                </div>
                            </div><!--end dropdown-->
                            <i class="mdi mdi-chat  d-block mt-n2 font-18 text-dark float-right"></i>
                            <h5 class="mr-1">{{$chat->chat_name}} </h5>
                            <p class="text-muted mb-2"> {{$chat->chat_about}} </p>


                        </div><!--end card-body-->
                        <div class="row mb-3">
                            <div class="col-4"></div>
                           
                            <a href="{{url('chat-messages/'.$chat->chat_id)}}" class="col-4">
                                <button type="button" class="btn-sm btn-block btn-outline-primary  ">
                                   عرض المحادثات
                                </button>
    
                            </a>
                            <div class="col-4"></div>
                        </div>
                        @else
                        <div class="dropdown d-inline-block float-right">
                            <a class="nav-link dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drop2">
                               
                                <a class="dropdown-item text-danger" href="{{url('delete-chat/'.$chat->chat_id)}}">حذف</a>
                               
                                <a class="dropdown-item text-danger" href="{{url('delete-chat/'.$chat->chat_id)}}">Delete</a> 
                              
                            </div>
                        </div><!--end dropdown-->
                        <i class="mdi mdi-chat  d-block mt-n2 font-18 text-dark float-left"></i>
                        <h5 class="mr-1">{{$chat->chat_name}} </h5>
                        <p class="text-muted mb-2"> {{$chat->chat_about}} </p>


                    </div><!--end card-body-->
                    <div class="row mb-3">
                        <div class="col-4"></div>
                       
                        <a href="{{url('chat-messages/'.$chat->chat_id)}}" class="col-4">
                            <button type="button" class="btn-sm btn-block btn-outline-primary  ">
                              view messages
                            </button>

                        </a>
                        <div class="col-4"></div>
                    </div>
                        @endif
                    </div><!--end card-->
                   

                </div><!--end project-list-left-->
        </div><!--end col-->
        @endforeach
        @endif
    </div>

    <div class="col-12 mt-5">
        
        @if ($clients_chat)
            
       
        @foreach ($clients_chat as $chat)
            
        <div class="col-md-4">
            <div class="bg-light p-4">               
                <div id="project-list-left" class="">
                    <div class="card mb-0">
                        <div class="card-body">
                            @if (Session::get('lang') == "ar")
                            <div class="dropdown d-inline-block float-left">
                                <a class="nav-link dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="drop2">
                                   
                                   
                                </div>
                            </div><!--end dropdown-->
                            <i class="mdi mdi-chat  d-block mt-n2 font-18 text-dark float-right"></i>
                            <h5 class="mr-1">{{$chat->clientName}} </h5>


                        </div><!--end card-body-->
                        <div class="row mb-3">
                            <div class="col-4"></div>
                           
                            <a href="{{url('client-chat-messages/'.$chat->chat_id)}}" class="col-4">
                                <button type="button" class="btn-sm btn-block btn-outline-primary  ">
                                   عرض المحادثات
                                </button>
    
                            </a>
                            <div class="col-4"></div>
                        </div>
                        @else
                        <div class="dropdown d-inline-block float-right">
                            <a class="nav-link dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </a>
                           
                        </div><!--end dropdown-->
                        <i class="mdi mdi-chat  d-block mt-n2 font-18 text-dark float-left"></i>
                        <h5 class="mr-1">{{$chat->clientName}} </h5>


                    </div><!--end card-body-->
                    <div class="row mb-3">
                        <div class="col-4"></div>
                       
                        <a href="{{url('client-chat-messages/'.$chat->chat_id)}}" class="col-4">
                            <button type="button" class="btn-sm btn-block btn-outline-primary  ">
                              view messages
                            </button>

                        </a>
                        <div class="col-4"></div>
                    </div>
                        @endif
                    </div><!--end card-->
                   

                </div><!--end project-list-left-->
        </div><!--end col-->
        @endforeach
        @endif
    </div>
 </div>

    
<div class="modal fade add-chat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-chat')}}">
                    @csrf
              <div class="row">
                
        
                  <div class="col-12"> 
                      <div class="form-group row">
                               
                                 <div class="col-sm-4">
                                    <label id="chat-name"> اسم المحادثة</label>
                                    <input class="form-control" name="name" type="text" id="example-text-input">
                                </div>
                                
                            
                               
                             

                            </div>
          
                 </div>

              
                 
                 <div class="col-12"> 
                    <label for="noe_date" id="chat-subject">موضوع المحادثة</label>
                     <textarea class="form-control" name="about" rows="5" id="message"></textarea>
                    </div>
                   

           
          
                 </div>
                

                     <div class="col-12 mt-3"> 
                      <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="add-chat-btn">إضافة محادثة</button>
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
    document.getElementById("breadcrumb-1").innerHTML = "البريد و المحادثات"; 
    document.getElementById("breadcrumb-2").innerHTML = "المحادثات"; 

    document.getElementById("page-name").innerHTML = "المحادثات";
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "mails & chats";
    document.getElementById("breadcrumb-1").innerHTML = "chats";


    document.getElementById("page-name").innerHTML = "CHATS";

    document.getElementById("add-btn").innerHTML =  '<i class="mdi mdi-plus-box mx-2"></i> Add new chat';

    document.getElementById("chat-name").innerHTML = "Chat name";
    document.getElementById("chat-subject").innerHTML = "Chat Subject";
    document.getElementById("add-chat-btn").innerHTML = "Add chat";


} 
</script>
    
@endsection