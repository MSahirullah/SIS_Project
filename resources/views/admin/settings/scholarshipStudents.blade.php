@extends('layouts.admin')

@section('title') Scholarship Students @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('scholarships.index') }}">Scholarships</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $scholarship['name'] }}</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> {{ $scholarship['name'] }} - Students </h3>
</nav>

@endsection

@section('body')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6> {{ $scholarship['name'] }} - Students </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
                                Add Student
                            </button>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Student Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($students as $student)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $student['name_with_initial'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $student['amount'] }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $student['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button class="btn btn-danger remove-student" data-route=" {{ route('scholarships.removeStudents',['scUrl'=> $scUrl]) }}" data-student-id="{{ $student['id'] }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                @php ($i++)
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStudent" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Add Student </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('scholarships.addStudents',['scUrl'=> $scholarship['url'] ])}}" id="addNewStudentFrm" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="email" id="scholarshipEmail" class="form-control p-input validate-input" placeholder="Enter Student Email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addScholStudent">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {

        $("#addScholStudent").on('click', function() {
            const email = $("#scholarshipEmail").val();

            $.post("/admin/users-actions/check", {
                    _token: post_token,
                    email: email,
                    avalibility: 1
                },
                function(data) {
                    $("#scholarshipEmail").parent().find("span").remove();
                    if (parseInt(data) == 1) {
                        $("#scholarshipEmail").parent().append('<span class="text-success error-msg"> Email already added. </span>');
                    } else if (parseInt(data) == 2) {
                        $("#addNewStudentFrm").submit();
                    } else if (parseInt(data) == 3) {
                        $("#scholarshipEmail").parent().append('<span class="text-danger error-msg"> Email not found. </span>');
                    }
                }
            );
        });

        $("#scholarshipEmail").on('input', function() {
            $(".error-msg").remove();
        });

        $("#scholarshipEmail").on('keypress', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                $("#addScholStudent").trigger('click');
            }
        });

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        /**
         *  Remove Student Function
         */
        $(".remove-student").click(function() {
            const studentId = $(this).attr('data-student-id');
            const url = $(this).attr('data-route');

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post(url, {
                            "_token": post_token,
                            "studentId": studentId,
                        },
                        function(data) {
                            if (parseInt(data) == 1) {
                                // TODO : SHOW SUCCESS MESSAGE
                                window.location.reload();
                            }
                        }
                    );
                }
            });
        });
    });
</script>

@endsection