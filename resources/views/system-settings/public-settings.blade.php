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
      <form class="form"  method="POST" action="{{route('update-about-info')}}">
        @csrf
      <div class="form-group row">
        <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="comp-name">اسم الشركة</label>
                         <div class="col-sm-12">
                         <input class="form-control" name="name" type="text" value="{{$about->company_name}}" id="example-text-input">
                         </div>
             
           </div>
           <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="comp-mail">الايميل</label>
              <div class="col-sm-12">
                <input class="form-control" name="email" type="text" value="{{$about->email}}" id="example-text-input">
                </div>
             
           </div>
           <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="phone">رقم الهاتف</label>
                         <div class="col-sm-12">
                             <input class="form-control" name="phone" type="text" value="{{$about->phone}}" id="example-text-input">
                         </div>
             
           </div>
      </div>
    </div>

           <div class="col-lg-12">
            <div class="form-group row">
            <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="address">العنوان</label>
                         <div class="col-12">
                             <textarea class="form-control" name="address"  rows="5" >
                              {{$about->address}}
                             </textarea>
                         </div>
             
           </div>

           <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="info">معلومات عن الشركة</label>
                         <div class="col-12">
                             <textarea class="form-control" name="info"  rows="5" >
                              {{$about->about}}
                             </textarea>
                         </div>
             
           </div>

           <div class="col-4">
            <label for="example-text-input" class="col-sm-6 " id="established">التأتسيس</label>
                         <div class="col-12">
                             <textarea class="form-control" name="establish" rows="5" >
                              {{$about->establish}}
                             </textarea>
                         </div>
             
           </div>
    </div>      
</div>
<div class="col-lg-12">
  <button class="btn btn-sm btn-primary mr-2 font-15 mt-2" id="update-btn">تحديث بيانات الشركة</button>   
</div>
</form>


<div class="col-lg-12 mt-5">
  <form class="form"  method="POST" action="{{route('update-logo')}}"  enctype="multipart/form-data">
    @csrf
      <div class="form-group row">
       
           <div class="col-6">
            <label for="example-text-input" class="col-sm-6" id="logo">الشعار</label><br>
           <img src="../assets/images/{{$about->logo}}" alt="logo-large" width="120" height="120" class="logo-lg text-right">
              <div class="col-sm-10">
                <input class="form-control" name="logo" type="file" id="example-text-input">
                </div>
             
           </div>
         
    </div> 
    <div class="col-lg-12">
      <button class="btn btn-sm btn-primary mr-2 font-15 mt-2" id="update-logo-btn">تحديث  الشعار</button>   
  </div>
  </form>     
</div>

<div class="col-lg-12 mt-5">
  <div class="card">
   
   
      <div class="card-body">
        <h3 class="mr-3 mb-4" id="tbl-title"> الاسئلة الشائعة</h3>
        <div class="col-lg-12 ">
          <div class="">
              <ul class="list-inline">                                    
                 
                  <li class="list-inline-item">

                  <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-question" id="add-ques"><i class="mdi mdi-plus-box mx-2"></i> إضافة  سؤال</button>

                  </li>
              </ul>
          </div>                            
      </div><!--end col-->

        
          <div class="table-responsive">
              <table class="table table-bordered mb-0 table-centered">
                  <thead>
                  <tr>
                  <th>#</th>
                    
                      <th id="th-1">السؤال</th>
                      <th id="th-2">الاجابة</th>
                      <th  class="text-center"></th>
                      
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($questions as $q)
                        
                 
                  <tr>
                    <td>{{$q->id}}</td>
                  <td>{{$q->question}}</td>
                    <td>{{$q->answer}}</td>
                    <td class="text-center">
                      <a  data-toggle="modal" data-animation="bounce" data-target=".edit-question-{{$q->id}}" style="cursor: pointer;" class="ml-3"><i class="fas fa-edit text-info font-16"></i></a>

                          <a href="{{url('delete-question/'.$q->id)}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                     
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
<div class="modal fade add-question" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              
              <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
              
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('add-question') }}">
                  @csrf
            <div class="row">
              
      
                <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-12">
                                 <label id="ques-label">السؤال </label>
                                  <input class="form-control" name="question" type="text" id="example-text-input">
                              </div>

                               <div class="col-12">
                                 <label id="answer-label">الاجابة</label>
                                 <textarea rows="5" name="answer"  class="form-control"></textarea>
                                </div>
                             
                           

                     </div>
        
               </div>
                

                   <div class="col-12"> 
                    <button class="btn btn-sm btn-primary mr-1 font-15" id="add-ques-btn">إضافة </button>
                   </div> 
                

                   </div> 
              </form>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
@foreach ($questions as $q)
    

<div class="modal fade edit-question-{{$q->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              
              <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
              
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('update-question') }}">
                  @csrf
            <div class="row">
              
            <input type="hidden" name="id" value="{{$q->id}}">
                <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-12">
                                <label id="edit-ques-label">السؤال </label>
                                <input class="form-control" name="question" value="{{$q->question}}" type="text" id="example-text-input">
                              </div>

                               <div class="col-12">
                                <label id="edit-answer-label">الاجابة</label>
                                <textarea rows="5" name="answer"  class="form-control">
                                  {{$q->answer}}"
                                 </textarea>
                                </div>
                             
                           

                     </div>
        
               </div>
                

                   <div class="col-12"> 
                    <button class="btn btn-sm btn-primary mr-1 font-15" id="edit-ques-btn">تعديل </button>
                   </div> 
                

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
    document.getElementById("breadcrumb-1").innerHTML = "الاعدادات"; 
    document.getElementById("breadcrumb-2").innerHTML = "الاعدادات العامة"; 

    document.getElementById("page-name").innerHTML = "الاعدادات العامة";
    }else{
      document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "settings";
    document.getElementById("breadcrumb-1").innerHTML = "public settings";


    document.getElementById("page-name").innerHTML = "PUBLIC SETTINGS";

    document.getElementById("comp-name").innerHTML = "Firm name";
    document.getElementById("comp-mail").innerHTML = "Company E-mail";
    document.getElementById("phone").innerHTML = "Phone number";
    document.getElementById("address").innerHTML = "Address";
    document.getElementById("info").innerHTML = "About firm";
    document.getElementById("established").innerHTML = "Established";
    document.getElementById("update-btn").innerHTML = "Update firm info.";

    document.getElementById("logo").innerHTML = "Firm logo";
    document.getElementById("update-logo-btn").innerHTML = "Update logo";


    document.getElementById("add-ques").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add question';
    document.getElementById("ques-label").innerHTML = "Question";
    document.getElementById("answer-label").innerHTML = "Answer";
    document.getElementById("add-ques-btn").innerHTML = "Add";

    document.getElementById("edit-ques-label").innerHTML = "Question";
    document.getElementById("edit-answer-label").innerHTML = "Answer";
    document.getElementById("edit-ques-btn").innerHTML = "Edit";

    document.getElementById("tbl-title").innerHTML = "FAQ";
    document.getElementById("th-1").innerHTML = "Question";
    document.getElementById("th-2").innerHTML = "Answer";



    }
</script>
    
@endsection