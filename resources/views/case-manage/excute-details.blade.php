@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-lg-8">
            <form class="form" action=" {{ url('update-excute-details/'.$excute_details->excute_stage_id) }}"method="POST" enctype="multipart/form-data" >
                @csrf
               <div class="card client-card">                               
                  <div class="card-body" >

                  <div class="row">
                  
                   
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                                   <div class="col-sm-4">
                                      <label id="excute-number">رقم التنقيذ</label>
                                      <input class="form-control"  name="excute_uid" value="{{$excute_details->excute_uid}}" type="text" id="example-text-input">
                                  </div>
                                  
                                  <div class="col-sm-4">
                                    <label id="excute-file-number"></label>
                                    <input class="form-control" disabled value="{{$excute_details->file_id}}"  type="text" id="example-text-input">
                                  </div>

                                   <div class="col-sm-4">
                                    <label id="excute-case-number"></label>
                                    <input class="form-control" disabled value="{{$excute_details->main_case_id}}" type="text" id="example-text-input">
                                  </div>

                                 
                               

                              </div>
            
                   </div>

                     <div class="col-12"> 
                        <div class="form-group row">
                                 
                          <div class="col-sm-4">
                            <label id="excute-type"></label>
                            <select class="custom-select" name="excute_type" >
                                   <option value="{{$excute_details->excuteCode}}">{{$excute_details->excuteType}}</option>
                                   @foreach ($excutes_type as $c_type)
                                   <option value="{{$c_type->N_DetailedCode}}">{{$c_type->S_Desc_A}}</option>  
                                   @endforeach
                                   
                                  </select>
                           </div>
                                  <div class="col-sm-4">
                                    <label id="excute-cliam"></label>
                                    <input class="form-control fraction-commas" name="cliam_amount" value="{{$excute_details->cliam_amount}}" type="text" id="example-text-input">

                                  </div>
                                  <div class="col-sm-4">
                                    <label id="excute-collected"></label>
                                    <input class="form-control fraction-commas"  name="collected" value="{{$excute_details->collected_amount}}" type="text" id="example-text-input">
 
                                   </div>
                                 

                              </div>
            
                   </div>

                   
                <div class="col-12"> 
                        <div class="form-group row">
                                 
                         

                           
                                    <div class="col-sm-4">
                                      <label id="excute-date"></label>
                                      <input class="form-control" value="{{$excute_details->excute_date}}" name="excute_date" type="date" id="example-text-input">
                                  </div>
                                  

                              </div>
            
                   </div>

                    

                   <div class="col-12"> 
                        <div class="form-group row">
                                       
                            <div class="col-sm-4">
                              <label id="excute-fees"></label>
                              <input class="form-control fraction-commas" name="excute_fee" value="{{$excute_details->excute_fee}}" type="text" id="example-text-input">
                                                     
                                  </div>

                            <div class="col-sm-4">
                              <label id="excute-expenss"></label>
                              <input class="form-control fraction-commas" name="case_fee" value="{{$excute_details->case_fee}}" type="text" id="example-text-input">
                                                     
                                  </div>

                                  <div class="col-sm-4">
                                    <label id="excute-office-fees"></label>
                                    <input class="form-control fraction-commas" name="office_fee" value="{{$excute_details->office_fee}}" type="text" id="example-text-input">
                          </div>
                                  
                                  

                              </div>
            
                   </div>
            
                      <div class="col-12"> 
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label for="noe_date" id="excute-subject">الموضوع</label>
                            <textarea class="form-control"  name="subject"  id="message">
                              {{$excute_details->subject}}
                            </textarea>
                          </div>
                        </div>
                      </div>
                       


                       <div class="col-12"> 
                        <button type="submit" class="btn btn-sm btn-primary mr-1 font-15" id="excute-add-btn">إضافة تنفيذ</button>
                      </div> 
                    

                 </div> 
                  </div>
              </div>
            </form>
          </div>
     </div>
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
    document.getElementById("breadcrumb-2").innerHTML = 'التنفيذات' ;
    document.getElementById("breadcrumb-3").innerHTML = "بيانات التنفيذ"; 

    document.getElementById("page-name").innerHTML = "بيانات التنفذ";

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
document.getElementById("excute-add-btn").innerHTML = "تحديث تنفيذ";
  }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'excutes' ;
    document.getElementById("breadcrumb-1").innerHTML = "excutes details" ;


    document.getElementById("page-name").innerHTML = "EXCUTES DETAILS";

    document.getElementById("excute-number").innerHTML = "Excute number";
document.getElementById("excute-file-number").innerHTML = "File number";
document.getElementById("excute-case-number").innerHTML = "Main case number";
document.getElementById("excute-type").innerHTML = "Excute type";
document.getElementById("excute-cliam").innerHTML = "Cliam amount";
document.getElementById("excute-date").innerHTML = "Register date";
document.getElementById("excute-fees").innerHTML = "Excute fees";
document.getElementById("excute-collected").innerHTML = "Collected amount";
document.getElementById("excute-expenss").innerHTML = "Case fees";
document.getElementById("excute-office-fees").innerHTML = "Office fees";
document.getElementById("excute-subject").innerHTML = "Subject";
document.getElementById("excute-add-btn").innerHTML = "Update excute";
  }
</script>
    
@endsection