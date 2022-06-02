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
   
    <div class="col-12">
        <div class="chat-box-left" id="members-box">
            <ul class="nav nav-pills mb-3 nav-justified pr-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general_chat_tab" data-toggle="pill" href="#general_chat">الاعضاء في الحادثة</a>
                </li>
              
              
            </ul>
           

            <div class="tab-content chat-list slimscroll" >
                <div class="tab-pane fade show active" id="general_chat">
                  
                    <div class="media new-message">
                        <div class="media-left">
                            <img src="{{asset('assets/images/clients-imgs/'.$chat->clientLogo)}}" alt="user" class="rounded-circle thumb-md">
                            <span class="round-10 bg-success"></span>
                        </div><!-- media-left -->
                        <div class="media-body">
                            <div class="d-inline-block">
                                <h6>{{$chat->clientName}}</h6>
                            </div>
                            <div class="d-inline-block">
                              
                               
                            </div>
                           
                        </div><!-- end media-body -->
                    </div> <!--end media-->
                  
                    
                 
                                                 
                </div><!--end general chat-->

                

                
            </div><!--end tab-content-->
        </div><!--end chat-box-left -->

        <div class="chat-box-right" id="chat-box">
            <div class="chat-header">
                <a href="" class="media">
                    <div class="media-left">
                        <img src="{{asset('assets/images/clients-imgs/'.$chat->clientLogo)}}" alt="user" class="rounded-circle thumb-md">
                    </div><!-- media-left -->
                    <div class="media-body">
                        <div>
                        <h6 class="mb-1 mt-0">{{$chat->clientName}}</h6>
                           
                        </div>
                    </div><!-- end media-body -->
                </a><!--end media-->   
                <div class="chat-features" id="chat-icons">
                    <div class="d-none d-sm-inline-block">
                        <a href="#"><i class="fas fa-phone"></i></a>
                        <a href="#"><i class="fas fa-video"></i></a>
                        <a href="#"><i class="fas fa-trash-alt"></i></a>
                        <a href="#"><i class="fas fa-ellipsis-v"></i></a>                                                       
                    </div>
                </div><!-- end chat-features -->
            </div><!-- end chat-header -->
            <div class="chat-body ">
                <div class="chat-detail slimscroll">
                    @foreach ($messages as $msg)
                    <div class="media">
                        @if ($msg->message_by == 'Admin')
                        <div class="media-img">
                            <img src="{{asset('assets/images/users-imgs/'.auth()->user()->avatar)}}" alt="user" class="rounded-circle thumb-md">
                        </div>
                        <div class="media-body">
                            <div class="chat-msg">
                            <p>
                                <span class="text-muted"> {{$msg->date_time}}</span> <br>
                                {{$msg->message}}
                            </p>
                            </div>
                            
                        </div><!--end media-body--> 
                        @else 
                     
                        <div class="media-body reverse">
                            <div class="chat-msg">
                            <p>
                                <span class="text-muted"> {{$msg->date_time}}</span> <br>
                                {{$msg->message}}
                            </p>
                            </div>
                            
                        </div><!--end media-body--> 
                        <div class="media-img">
                            <img src="{{asset('assets/images/clients-imgs/'.Session::get('client_pic'))}}" alt="user" class="rounded-circle thumb-md">
                        </div>
                        @endif
                       
                       
                    </div><!--end media--> 
                    @endforeach
                    
                </div>                                 
            </div><!-- end chat-body -->
            <div class="chat-footer">
                <form class="form"  method="POST" action="{{route('add-admin-client-message')}}">
                    @csrf
                <input type="hidden" name="chat_id" value="{{$chat_id}}">
                <div class="row">                                                    
                    <div class=" col-10">
                        <span class="chat-admin"><img src="{{asset('assets/images/users-imgs/'.auth()->user()->avatar)}}" alt="user" class="rounded-circle thumb-sm"></span>
                        <input type="text" class="form-control" required name="msg" placeholder="اكتب الرسالة...">
                    </div><!-- col-8 -->
                    <div class="col-2">
                        <div class="d-none d-sm-inline-block chat-features">
                          <button class="btn-sm btn-outline-dark mx-4" id="send-btn">ارسال</button>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
                </form>
            </div><!-- end chat-footer -->
        </div><!--end chat-box-right --> 
    </div> <!-- end col -->                           
</div><!-- end row --> 
    

 
@endsection


@section('page-script')

<script>
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "البريد و المحادثات"; 
    document.getElementById("breadcrumb-2").innerHTML = "المحادثات"; 
    document.getElementById("breadcrumb-3").innerHTML = "الرسائل"; 

    document.getElementById("page-name").innerHTML = "الرسائل";

  
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-1").innerHTML = "messages";
    document.getElementById("breadcrumb-2").innerHTML = "chats";
    document.getElementById("breadcrumb-3").innerHTML = "mails & chats";

    document.getElementById("chat-icons").classList.add('float-right');

    
    document.getElementById("page-name").innerHTML = "CHATS";


    document.getElementById("general_chat_tab").innerHTML = "Members in chat";

    document.getElementById("send-btn").innerHTML = "Send";


} 
</script>
    
@endsection