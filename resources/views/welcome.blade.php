@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')

<div class="has-bg-img" style="background-image: url('/img/bg/bg-web.jpg'); background-size:cover;background-repeat:no-repeat;">
    <div class="container vh-100 p-4">
        <div class="row justify-content-center  mb-4">
            <div class="col-md-6 text-center">
                <img src="/img/logo/logo.png" alt="SIS - Login | FOT - UOC" height="100">
                <div class="mt-2 login-title-font">Faculty of Technology</div>
                <div class="login-title-font">University of Colombo</div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50rem; background:#ffffffbf;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pt-2 pb-3">
                            <div class="text-center">
                                <div style="font-size: 1.2rem;"> Student Information System</div>
                                <div class="mb-3" style="font-size: 1.4rem; font-weight: 500;">SignIn</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="username">{{ __('Username') }} </label>
                                    <input type="text" class="form-control mt-2" name="username" required autocomplete="username" autofocus id="username" onkeypress="return /[0-9T]/i.test(event.key)" placeholder="Username" pattern="([0-9]T){10}"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="password">{{ __('Password') }} </label>
                                    <input type="text" class="form-control mt-2" name="password" required autocomplete="password" autofocus id="password" onkeypress="return /[a-z]/i.test(event.key)" placeholder="Password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-dark">Sign In</button>
                            </div>
                            <div class="mt-4 d-flex justify-content-between ">
                                <div>
                                    <a href="#" class="login-link"> Forgot Password?</a>
                                </div>
                                <div>
                                    <a href="#" class="login-link" style="margin-right: 10px;"><i class="fa-solid fa-circle-info pr-1"></i> About</a>
                                    <a href="#" class="login-link"><i class="fas fa-question-circle"></i> Help</a>
                                </div>
                            </div>
                            <div class="mt-4 text-center" style="font-size: 0.8rem; color: #4a4a4a;">
                                © 2022 Department of ICT, Faculty of Technology
                            </div>
                        </div>
                        <div class="col-md-6">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/5ejFFf_BqtI" style="    border-radius: 0rem 0.5rem 0.5rem 0rem;">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection