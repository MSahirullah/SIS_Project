@extends('layouts.admin')

@section('title') New Dean @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href=" {{ route('deans.index') }} ">Admins</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admins</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Add New Admin </h3>
</nav>

@endsection

@section('body')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <form action="{{ route('users.save') }}" method="post" onSubmit="return validateForm();">
                    @csrf
                    <input type="hidden" name="userType" value="1">
                    <div class="card-body px-3 pt-3 pb-2">
                        <h6><b>Basic Information</b></h6>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="title"> Title </label>
                                <select name="title" id="title" class="form-select">
                                    <option value="Mr"> Mr </option>
                                    <option value="Ms"> Ms </option>
                                    <option value="Mrs"> Mrs </option>
                                    <option value="Dr"> Dr </option>
                                    <option value="Professor"> Professor </option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <label for="firstName"> First Name</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-sm-5">
                                <label for="lastName"> First Name</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-5">
                                <label for="nameWithInitial"> Name with Initial </label>
                                <input type="text" name="nameWithInitial" id="nameWithInitial" class="form-control" placeholder="Name with Initial" required>
                            </div>
                            <div class="col-sm-5">
                                <label for="fullName"> Full Name </label>
                                <input type="text" name="fullName" id="fullName" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="gender"> Gender </label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="male"> Male </option>
                                    <option value="female"> Female </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="email"> Email </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="nic"> NIC </label>
                                <input type="text" name="nic" id="nic" class="form-control" placeholder="NIC">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label for="address"> Address </label>
                                <textarea name="address" id="address" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="hometown"> Hometown </label>
                                    <input type="text" name="hometown" id="hometown" class="form-control" placeholder="Hometown">
                                </div>
                                <label for="contactNo"> Contact No </label>
                                <input type="text" name="contactNo" id="contactNo" class="form-control" placeholder="contact No">
                            </div>
                        </div>
                        <h6><b>Login Details</b></h6>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label for="username"> Username </label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="contactNo"> Password </label>
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success"> Save </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="/js/form-validation.js"></script>

@endsection