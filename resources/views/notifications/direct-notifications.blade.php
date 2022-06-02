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
                  <ul class="list-inline px-0">                                    
                     
                      <li class="list-inline-item">

                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-noti" id="add-btn"><i class="mdi mdi-plus-box ml-2"></i> إضافة تنبيه</button>

                      </li>
                  </ul>
              </div>                            
          </div><!--end col-->
       <div class="col-lg-12">
              <div class="card">                                
                  <div class="card-body">

                    <h4 class="mt-0 mb-3 header-title" style=" font-weight: bold; " id="tbl-title">التنبيهات العامة</h4>           
                    <div class="row">
                          <div class="col-sm-12">
                              <div class="table-responsive table-bordered">
                                  <table class="table table-hover mb-0">
                                      <thead class="thead-light">
                                          <tr>
                                            <th id="th-1">اسم التنبيه</th>
                                            <th id="th-2">التنبيه</th>
                                            <th id="th-3">تاريخ التنبيه</th>
                                            <th id="th-4">المكلف</th>
                                            <th id="th-5">بواسطة</th>
                                            
                                          </tr>
                                      </thead>
                                      <tbody>
                                  @foreach ($notis as $noti)
                                      <tr>
                                              <td>{{$noti->short_name}}</td>
                                      <td>{{$noti->description}}</td>
                                      <td>{{$noti->date_time}}</td>
                                      <td>{{$noti->user_assign}}</td>
                                      <td>{{$noti->user_create}}</td>
                                             
                                       
                                          </tr>
                                          @endforeach                                                                                          
                                      </tbody>
                                  </table>
                              </div><!--end table-responsive-->                                            
                          </div><!--end col-->
                      </div> <!--end row-->
                  </div><!--end card-body-->                                                                                                        
              </div><!--end card-->
           </div>
       </div>

       <div class="modal fade new-noti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form novalidate action= "{{ route('add-direct-notification') }} " method="post">
                        @csrf
                  <div class="row">
                     <div class="col-12"> 
                          <div class="form-group row">
                                   <div class="col-4">
                                    <label id="type">نوع التنبيه</label>
                                    <select class="custom-select">
                                         <option selected="">خاص</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label id="name">اسم التنبيه</label>
                                           <input type="text" name="short_name" class="form-control" id="">
                                     </div>

                                    <div class="col-4">
                                        <label id="assign">الموظف</label>
                                           <select class="custom-select" name="assign">
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>  
                                            @endforeach 
                                             
                                         </select>
                                     </div>

                                   <div class="col-12 mt-2">
                                    <label id="desc">التنبيه</label>
                                    <textarea class="form-control" rows="5" name="desc"></textarea>
                                     </div>
                                </div>
                     </div>
                    <div class="col-12"> 
                        
                        <button class="btn btn-sm btn-primary mx-1 font-15" id="add-noti">إضافة التنبيه</button>
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
    document.getElementById("breadcrumb-1").innerHTML = "التنبيهات"; 
    document.getElementById("breadcrumb-2").innerHTML = "التنبيهات الخاصة"; 

    document.getElementById("page-name").innerHTML = "التنبيهات الخاصة";
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "notifications";
    document.getElementById("breadcrumb-1").innerHTML = "direct notifications";


    document.getElementById("page-name").innerHTML = "DIRECT NOTIFICATIONS";

    document.getElementById("add-btn").innerHTML =  '<i class="mdi mdi-plus-box ml-2"></i> Add notification';

    document.getElementById("tbl-title").innerHTML = "Direct notifications";

    document.getElementById("th-1").innerHTML = "Notification name";
    document.getElementById("th-2").innerHTML = "Notification";
    document.getElementById("th-3").innerHTML = "Notification date";
    document.getElementById("th-4").innerHTML = "Assign to";
    document.getElementById("th-5").innerHTML = "Created by";

    document.getElementById("type").innerHTML = "Notification type";
    document.getElementById("name").innerHTML = "Notification name";
    document.getElementById("desc").innerHTML = "Notification description";
    document.getElementById("assign").innerHTML = "Assign to";
    document.getElementById("add-noti").innerHTML = "Add";


     }
</script>
    
@endsection