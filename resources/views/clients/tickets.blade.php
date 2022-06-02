@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')

<div class="row">
    
      
    

    <div class="col-12">
                            <div class="card">
                                <div class="card-body">
    
                                    <h4 class="mt-0 header-title" id="table-title"></h4>
                                    <p class="text-muted mb-3">
                                    </p>
    
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                                <th id="th-1"> </th>
                                                <th id="th-2"></th>
                                                <th id="th-3"></th>
                                                <th id="th-4"> </th>
                                                <th id="th-5"></th>
                                                <th id="th-6"></th>
                                                <th id="th-7"></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tickets as $ticket)

                                                <tr>
                                                <td>{{$ticket->id}}</td>
                                                    <td>{{$ticket->subject}}</td>
                                                    <td>{{$ticket->description}}</td>
                                                    <td>{{$ticket->case_related}}</td>
                                                    <td>
                                                 @if ($ticket->file)
                                                    <a href="{{asset('assets/tickets-documents/'.$ticket->file)}}" class="download-icon-link" download>
                                                        <i class="dripicons-download file-download-icon"></i> 
                                                    </a>
                                                @else 
                                                <a> </a>
                                                    @endif
                                                 </td>
                                                    <td>{{$ticket->date}}</td>
                                                   
                                                    <td>
                                                        @if ($ticket->status == 'معلق')
                                                        <span 
                                                        
                                                        class="badge badge-soft-warning">
                                                            {{$ticket->status}}
                                                        </span>
                                                        @endif
                                                        @if ($ticket->status == 'اكتملت')
                                                        <span 
                                                        
                                                        class="badge badge-soft-success">
                                                            {{$ticket->status}}
                                                        </span>
                                                        @endif

                                                        @if ($ticket->status == 'الغيت')
                                                        <span 
                                                        
                                                        class="badge badge-soft-danger">
                                                            {{$ticket->status}}
                                                        </span>
                                                        @endif
                                                        @if ($ticket->status == 'قيد التنفيذ')
                                                        <span 
                                                        
                                                        class="badge badge-soft-warning ">
                                                            {{$ticket->status}}
                                                        </span>
                                                        @endif
                                                       
                                                    </td>
                                                 
                                                
                                                    <td class="text-center">
                                                        
                                                        <div class="dropdown d-inline-block ">
                                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                            </a>
                                                            @if (Session::get('lang') == "ar")
                                                            <div class="dropdown-menu" aria-labelledby="dLabel8">
                                                                <a class="dropdown-item text-center text-warning" href="{{url('processing-ticket/'.$ticket->id)}}">قيد التنفيذ</a>
                                                                <a class="dropdown-item text-center text-success" href="{{url('complete-ticket/'.$ticket->id)}}">اكتملت</a>

                                                                <a class="dropdown-item text-danger text-center" href="{{url('cancel-ticket/'.$ticket->id)}}">الغاء</a>
                                                                <a class="dropdown-item text-danger text-center" style="font-weight: bold;" href="{{url('delete-tickect/'.$ticket->id)}}">حذف</a>
                                                            </div>  
                                                            @else
                                                            <div class="dropdown-menu" aria-labelledby="dLabel8">
                                                                <a class="dropdown-item text-center text-warning" href="{{url('processing-ticket/'.$ticket->id)}}">under proccess</a>
                                                                <a class="dropdown-item text-center text-success" href="{{url('complete-ticket/'.$ticket->id)}}">completed</a>

                                                                <a class="dropdown-item text-danger text-center" href="{{url('cancel-ticket/'.$ticket->id)}}">cancel</a>
                                                                <a class="dropdown-item text-danger text-center" style="font-weight: bold;" href="{{url('delete-tickect/'.$ticket->id)}}">delete</a>
                                                            </div> 
                                                            @endif
                                                          
                                                        </div>
                                                    </td>
                                                    
                                                  
                                                </tr>
                                                    
                                                @endforeach
                                             

                                         

                                               
                                   
                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
</div>


   
@endsection

@section('page-script')
<script>
         
    if (lang == "ar") {
   document.body.style.direction = "rtl"; 
   document.body.style.textAlign = "right"; 

   document.getElementById("breadcrumb-float").classList.add('float-left');
   document.getElementById("breadcrumb-1").innerHTML ="طلبات الدعم"; 
   document.getElementById("breadcrumb-2").innerHTML ="العملاء"; 

   document.getElementById("page-name").innerHTML ="طلبات الدعم";



   document.getElementById("table-title").innerHTML ="جميع طلبات الدعم";

   document.getElementById("th-1").innerHTML = "رقم الطلب";
   document.getElementById("th-2").innerHTML = "الموضوع";
   document.getElementById("th-3").innerHTML = "الوصف";
   document.getElementById("th-4").innerHTML = "رقم الدعوى";
   document.getElementById("th-5").innerHTML = "المستند";
   document.getElementById("th-6").innerHTML = "التاريخ";
   document.getElementById("th-7").innerHTML = "الحالة";

    }else{
       document.body.style.direction = "ltr"; 
   document.body.style.textAlign = "left"; 
   document.getElementById("breadcrumb-float").classList.add('float-right');
   document.getElementById("breadcrumb-1").innerHTML = "clients support";
   document.getElementById("breadcrumb-2").innerHTML ="clients"; 

   document.getElementById("page-name").innerHTML = "CLIENTS SUPPORT";



   document.getElementById("table-title").innerHTML ="All clients supports request";

   document.getElementById("th-1").innerHTML = "Ticket NO.";
   document.getElementById("th-2").innerHTML = "Subject";
   document.getElementById("th-3").innerHTML = "Description";
   document.getElementById("th-4").innerHTML = "Case number";
   document.getElementById("th-5").innerHTML = "Document";
   document.getElementById("th-6").innerHTML = "Date";
   document.getElementById("th-7").innerHTML = "Status";

    }
   </script>
@endsection