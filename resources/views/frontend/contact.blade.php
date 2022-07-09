@extends('frontend.layouts.app')
@section('breadcrumb')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('assets/img/bg/14.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Contact Us</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('index')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->
@endsection
@section('content')
<!-- CONTACT ADDRESS AREA START -->
<div class="ltn__contact-address-area mb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{asset('assets/img/icons/10.png')}}" alt="Icon Image">
                    </div>
                    <h3>Email Address</h3>
                    <p>info@webmail.com <br>
                        zawmyohtutdev@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{asset('assets/img/icons/11.png')}}" alt="Icon Image">
                    </div>
                    <h3>Phone Number</h3>
                    <p>09 955535053 <br> 09 684137018</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{asset('assets/img/icons/12.png')}}" alt="Icon Image">
                    </div>
                    <h3>Office Address</h3>
                    <p>Thanlyin <br>
                        Yangon, Myanmar</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT ADDRESS AREA END -->

<!-- GOOGLE MAP AREA START -->
<div class=" mb-120">
     
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18172.651156281314!2d96.23949394555888!3d16.760292222146642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1f27c83ffffff%3A0xb5733117a5ddbe4b!2z4YCe4YCU4YC64YCc4YC74YCE4YC64YCZ4YC84YCt4YCv4YC34YCZ4YCF4YC74YCx4YC44YCA4YC84YCu4YC4!5e0!3m2!1sen!2ssg!4v1657206848135!5m2!1sen!2ssg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>
<!-- GOOGLE MAP AREA END -->

@endsection

@section('script')

@endsection 