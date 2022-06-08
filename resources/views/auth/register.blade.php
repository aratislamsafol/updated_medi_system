@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

@section('content')

<style>
/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

.border-md {
    border-width: 2px;
}

.btn-facebook {
    background: #405D9D;
    border: none;
}

.btn-facebook:hover, .btn-facebook:focus {
    background: #314879;
}

.btn-twitter {
    background: #42AEEC;
    border: none;
}

.btn-twitter:hover, .btn-twitter:focus {
    background: #1799e4;
}

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

body {
    min-height: 100vh;
}

/* .form-control:not(select) {
    padding: 1.5rem 0.5rem;
} */

select.form-control {
    height: 52px;
    padding-left: 0.5rem;
}

.form-control::placeholder {
    color: #ccc;
    font-weight: bold;
    font-size: 0.9rem;
}
.form-control:focus {
    box-shadow: none;
}
</style>
<!-- Navbar-->
{{-- <header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <!-- Navbar Brand -->
            <a href="#" class="navbar-brand">
                <img src="https://bootstrapious.com/i/snippets/sn-registeration/logo.svg" alt="logo" width="150">
            </a>
        </div>
    </nav>
</header> --}}


<div class="container">
    <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
            <h1>Create Your Account</h1>
            <p class="font-italic text-muted mb-0">Complete Your Registration And Take Your Services</p>
            <p class="font-italic text-muted">Best Wishes for Your Safe & Healthy Life
            </p>
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>

                        <input id="f_name" type="text" class="form-control bg-white border-left-0 border-md @error('f_name') is-invalid @enderror" name="f_name" placeholder="First Name" value="{{ old('f_name') }}" required autocomplete="f_name" autofocus>

                        @error('f_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>

                        <input id="l_name" type="text" class="form-control bg-white border-left-0 border-md @error('f_name') is-invalid @enderror" name="l_name" placeholder="Last Name" value="{{ old('l_name') }}" required autocomplete="l_name" autofocus>

                        @error('l_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" class="form-control bg-white border-left-0 border-md @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <select id="countryCode" name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="">+12</option>
                            <option value="">+10</option>
                            <option value="">+15</option>
                            <option value="">+18</option>
                        </select>

                        <input id="phone" type="number" class="form-control bg-white border-md border-left-0 pl-3 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required autocomplete="phone">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                    <!-- Division -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted"></i>
                            </span>
                        </div>

                        <select class="form-control custom-select bg-white border-left-0 border-md" name="division_id" id="division_id">

                            <option value="">Please select your division</option>
                            @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>

                    </div>

                     <!-- District -->
                     <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted"></i>
                            </span>
                        </div>

                        <select class="form-control" name="district_id" id="district_id">

                        </select>
                    </div>

                    <!-- Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <input id="address" type="text" class="form-control bg-white border-left-0 border-md @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Address" required autocomplete="address">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    {{-- Blood Group --}}
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted"></i>
                            </span>
                        </div>

                        <select class="form-control custom-select bg-white border-left-0 border-md col-md-4" aria-label="Default select example" id="blood_group"  name="blood_group">
                            <option selected>Select Blood Group</option>
                            <option>AB+</option>
                            <option>AB-</option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>0+</option>
                            <option>0-</option>
                        </select>
                    </div>

                    <!-- Age -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>

                        <input id="age" type="text" class="form-control bg-white border-left-0 border-md @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" placeholder="Age" required autocomplete="age">

                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    {{-- Gender --}}
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted"></i>
                            </span>
                        </div>
                        <select class="form-control custom-select bg-white border-left-0 border-md col-md-4" aria-label="Default select example" id="gender"  name="gender">
                            <option selected>Select Gender Please</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>

                        <input id="password" placeholder="Password" type="password" class="form-control bg-white border-left-0 border-md @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>

                        <input id="password-confirm" type="password" class="form-control bg-white border-left-0 border-md" name="password_confirmation" placeholder="Confirm Password"  required autocomplete="new-password">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn-block py-2 btn btn-primary font-weight-bold">
                            <span class="font-weight-bold">Create your account</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Social Login -->
                    <div class="form-group col-lg-12 mx-auto">
                        <a href="#" class="btn btn-primary btn-block py-2 btn-facebook">
                            <i class="fa fa-facebook-f mr-2"></i>
                            <span class="font-weight-bold">Continue with Facebook</span>
                        </a>
                        <a href="#" class="btn btn-primary btn-block py-2 btn-twitter">
                            <i class="fa fa-twitter mr-2"></i>
                            <span class="font-weight-bold">Continue with Twitter</span>
                        </a>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="{{route('login')}}" class="text-primary ml-2">Login</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
   {
       $("#division_id").change(function(){
           var division = $("#division_id").val();
           // Send an ajax request to server with this division
           $("#district_id").html("");
           var option = "";

           $.get( "http://127.0.0.1:8000/get-districts/"+division, function( data ) {

               data = JSON.parse(data);
               data.forEach( function(element) {
                 option += "<option value='"+ element.id +"'>"+ element.name +"</option>";
               });

             $("#district_id").html(option);

           });
       })
   })

</script>

<script>
    // For Demo Purpose [Changing input group text on focus]
$(function () {
    $('input, select').on('focus', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
    });
    $('input, select').on('blur', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
    });
});
</script>

@endsection

