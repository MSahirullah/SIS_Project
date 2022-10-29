@extends('layouts.admin')

@section('title') Semesters @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Semesters </h3>
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
                            <h6> Semesters </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newSemester">
                                New Semester
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Semester</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($semesters as $semester)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $semester['name'] }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $semester['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button class="btn btn-secondary edit-semester" data-semester-id="{{ $semester['id'] }}" data-semester-name="{{ $semester['name'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger remove-semester" data-semester-id="{{ $semester['id'] }}">
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

<div class="modal fade" id="newSemester" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Semester </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('semesters.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name" class="form-control p-input validate-input" placeholder="Enter Semester Name" required>
                            <!-- TODO : UPLOAD IMAGE -->
                            <!-- TODO : INPUT VALIDATION -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editSemester" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=""> Edit Acadamic Year </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('semesters.edit')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" id="editSemesterId">
                            <input type="text" name="name" id="editSemesterName" class="form-control p-input validate-input" placeholder="Enter Semester Name" required>
                            <!-- TODO : INPUT VALIDATION -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        /**
         *  Remove Semester Function
         */
        $(".remove-semester").click(function() {
            const semesterId = $(this).attr('data-semester-id');

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

                    $.post("/admin/semesters/remove", {
                            "_token": post_token,
                            "semesterId": semesterId,
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

        /**
         *  Edit Semester Function
         */
        $(".edit-semester").click(function() {

            const semesterId = $(this).attr('data-semester-id');
            const semesterName = $(this).attr('data-semester-name');

            $('#editSemesterName').val(semesterName);
            $('#editSemesterId').val(semesterId);
            $('#editSemester').modal('show');
        });

    });
</script>

@endsection