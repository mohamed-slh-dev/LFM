@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <img class="card-img-top img-fluid" src="../assets/images/Library/01.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="bok1-title"></h4>
                <p class="card-text text-muted font-13" id="bok1-brief"></p>
                <a href="#" class="btn btn-secondary btn-square"> </a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-4">
        <div class="card" id="img_card">
            <img class="card-img-top img-fluid" src="../assets/images/Library/02.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="bok2-title"></h4>
                <p class="card-text text-muted font-13" id="bok2-brief"></p>
                <a href="#" class="btn btn-secondary btn-square"> </a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-4">
        <div class="card">
            <img class="card-img-top img-fluid" src="../assets/images/Library/03.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="bok3-title"></h4>
                <p class="card-text text-muted font-13" id="bok3-brief"></p>
                <a href="#" class="btn btn-secondary btn-square"> </a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top img-fluid" src="../assets/images/Library/04.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mt-0" id="bok4-title"> </h4>
                    <p class="card-text text-muted font-13" id="bok4-brief"></p>
                    <a href="#" class="btn btn-secondary btn-square"></a>   
                </div><!--end card -body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card" id="img_card">
                <img class="card-img-top img-fluid" src="../assets/images/Library/05.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mt-0" id="bok5-title"></h4>
                    <p class="card-text text-muted font-13" id="bok5-brief"></p>
                    <a href="#" class="btn btn-secondary btn-square"> </a>   
                </div><!--end card -body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top img-fluid" src="../assets/images/Library/06.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mt-0" id="bok6-title"></h4>
                    <p class="card-text text-muted font-13" id="bok6-brief"> </p>
                    <a href="#" class="btn btn-secondary btn-square"></a>   
                </div><!--end card -body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top img-fluid" src="../assets/images/Library/07.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mt-0" id="bok7-title"></h4>
                    <p class="card-text text-muted font-13" id="bok7-brief"></p>
                    <a href="#" class="btn btn-secondary btn-square"></a>   
                </div><!--end card -body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top img-fluid" src="../assets/images/Library/08.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mt-0" id="bok8-title"></h4>
                    <p class="card-text text-muted font-13" id="bok8-brief"> </p>
                    <a href="#" class="btn btn-secondary btn-square"></a>   
                </div><!--end card -body-->
            </div><!--end card-->
        </div><!--end col-->

</div><!--end row-->

</div><!-- container -->

@section('page-script')
    

<script>
  
if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
document.getElementById("breadcrumb-2").innerHTML = "المكتبة"; 

document.getElementById("page-name").innerHTML = "المكتبة";

document.getElementById("bok1-title").innerHTML = "كتاب انطاكية و القانون";
document.getElementById("bok1-brief").innerHTML = "مدخل الى القوانين الانطاكية و تطبيقها في القرن العشرين.";

document.getElementById("bok2-title").innerHTML = "تحريات الشرطة";
document.getElementById("bok2-brief").innerHTML = "القوة, الحيل و المهارات";

document.getElementById("bok3-title").innerHTML = "قانون الجرائم في الاسلام";
document.getElementById("bok3-brief").innerHTML = "القوانين و التشريعات الاسلامية للجرائم";

document.getElementById("bok4-title").innerHTML = "قانون الجرائم";
document.getElementById("bok4-brief").innerHTML = "قانون الجرائم لدولة الامارات العربية المتحدة";

document.getElementById("bok5-title").innerHTML = "الاموال و قانون الجذب";
document.getElementById("bok5-brief").innerHTML = "تعلم لجذب الثروة, الصحة و السعادة";

document.getElementById("bok6-title").innerHTML = "في خطوط متوازية";
document.getElementById("bok6-brief").innerHTML = "العمل في خطوط متوازية";

document.getElementById("bok7-title").innerHTML = "قانون العمال الاماراتي";
document.getElementById("bok7-brief").innerHTML = "القانون الفدرالي رقم (8) لسنة 1980";

document.getElementById("bok8-title").innerHTML = "قانون الاسرة الاسلامي";
document.getElementById("bok8-brief").innerHTML = "في عالم المتغيرات";



var timestampArray = document.getElementsByClassName("btn-square");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'اقرا الكتاب';
  
}



}else{
 document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "home";
document.getElementById("breadcrumb-1").innerHTML = "library";

document.getElementById("page-name").innerHTML = "LIBRARY";

document.getElementById("bok1-title").innerHTML = "The book of Antioch and the law ";
document.getElementById("bok1-brief").innerHTML = "An introduction to the laws of Antioch and their application in the twentieth century.";

document.getElementById("bok2-title").innerHTML = "Police investigations ";
document.getElementById("bok2-brief").innerHTML = "Power, tricks and skills";

document.getElementById("bok3-title").innerHTML = "Crimes Law in Islam ";
document.getElementById("bok3-brief").innerHTML = "Islamic laws and legislation for crimes ";

document.getElementById("bok4-title").innerHTML = "Crimes Law ";
document.getElementById("bok4-brief").innerHTML = "Crimes Law of the United Arab Emirates";

document.getElementById("bok5-title").innerHTML = "Money and the Law of Attraction ";
document.getElementById("bok5-brief").innerHTML = "Learn to attract wealth, health and happiness ";

document.getElementById("bok6-title").innerHTML = "In parallel lines ";
document.getElementById("bok6-brief").innerHTML = "Work in parallel lines ";

document.getElementById("bok7-title").innerHTML = "UAE Workers Law ";
document.getElementById("bok7-brief").innerHTML = "Federal Law No. (8) of 1980 ";

document.getElementById("bok8-title").innerHTML = "Islamic family law";
document.getElementById("bok8-brief").innerHTML = "In the world of variables ";

var timestampArray = document.getElementsByClassName("btn-square");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Read the book!';
  
}

}
</script>

@endsection
    
@endsection