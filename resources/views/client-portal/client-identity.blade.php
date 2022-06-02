@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('content')

<div class="row">
   @foreach ($identities as $identity)
       
   <div class="col-lg-3">
    <div class="card e-co-product">
        <a href="">  
        <img src="{{asset('assets/clients-identities/'.$identity->identity)}}" alt="" class="img-fluid">
        </a>                                    
        <div class="card-body product-info">
            <a href="" class="product-title" style="font-weight: bold">{{$identity->identity_name}}</a>
            <div class="d-flex justify-content-between my-2">
             @if (Session::get('lang') == "ar")
             <p > تاريخ الاصدار :  <span class=" text-muted">{{$identity->start_date}}</span> </p>
             <p > تاريخ الانتهاء :  <span class=" text-muted">{{$identity->end_date}}</span> </p>
         
                @else
                <p >Release date :  <span class=" text-muted">{{$identity->start_date}}</span> </p>
                <p > End date :  <span class=" text-muted">{{$identity->end_date}}</span> </p>
            
                @endif
                </div>
                @if (Session::get('lang') == "ar")
                <button class="btn btn-cart btn-sm waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".add_ident_{{$identity->id}}"><i class="mdi mdi-attachment ml-1"></i>اضافة اثبات</button>

                @else
                <button class="btn btn-cart btn-sm waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".add_ident_{{$identity->id}}"><i class="mdi mdi-attachment mr-1"></i>Add identity</button>

                @endif
           </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->
  @endforeach
</div>


@foreach ($identities as $ident)
    
<div class="modal fade add_ident_{{$ident->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-identity')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ident_id" value="{{$ident->id}}">
              <div class="row">
                <div class="col-12"> 
                   <div class="form-group row">
                            
                     
                              <div class="col-sm-6">
                               <label for="noe_date" class="identity-doc"></label>
                               <input type="file" required name="image" class="form-control" id="">
                             </div>
                         </div>
                      </div>

                      <div class="col-12"> 
                        <div class="form-group row">
                                 
                          
                                   <div class="col-sm-6">
                                    <label for="noe_date" class="identity-start"></label>
                                    <input type="date" required name="start_date" class="form-control" id="">
                                  </div>

                                  <div class="col-sm-6">
                                    <label for="noe_date" class="identity-end"></label>
                                    <input type="date" required name="end_date" class="form-control" id="">
                                  </div>
                              </div>
                           </div>

                     <div class="col-12">
                             <button class="btn btn-sm btn-primary mr-1 font-15 identity-add" ></button>
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
document.getElementById("breadcrumb-1").innerHTML = "منصتي"; 
document.getElementById("breadcrumb-2").innerHTML = " الهوية و رخص العمل"; 

document.getElementById("page-name").innerHTML = " الهوية و رخص العمل";


var timestampArray = document.getElementsByClassName("identity-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'اثبات الهوية (صورة)';
  
}
var timestampArray = document.getElementsByClassName("identity-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ الاصدار';
  
}
var timestampArray = document.getElementsByClassName("identity-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ الانتهاء';
  
}
var timestampArray = document.getElementsByClassName("identity-add");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تحميل';
  
}
    }else{
        document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "my platform";
document.getElementById("breadcrumb-1").innerHTML = "Identities";

document.getElementById("page-name").innerHTML = "IDENTITES & LICINSE";



var timestampArray = document.getElementsByClassName("identity-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Identity (image)';
  
}
var timestampArray = document.getElementsByClassName("identity-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Release date';
  
}
var timestampArray = document.getElementsByClassName("identity-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'End date';
  
}
var timestampArray = document.getElementsByClassName("identity-add");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Upload';
  
}
    }

</script>
    
@endsection