@extends('layouts.admin')

@section('title') Courses @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Courses </h3>
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
                            <h6> Courses </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCourse">
                                New Courses
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Department</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Duration</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($courses as $course)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $course['name'] }} <br> <small> {{$course['code']}} </small> </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $course['department_name'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $course['type'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $course['duration'] }} Years </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $course['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button class="btn btn-secondary edit-course" data-course-id="{{ $course['id'] }}" data-course-name="{{ $course['name'] }}" data-course-code="{{ $course['code'] }}" data-course-department-id="{{ $course['department_id'] }}" data-course-type="{{ $course['type'] }}" data-course-duration="{{ $course['duration'] }}">
                                            <i class="fa fa-edit"></i>

                                        </button>
                                        <button class="btn btn-danger remove-course" data-course-id="{{ $course['id'] }}">
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

<div class="modal fade" id="newCourse" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Course </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('courses.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">

                            <label for="name"> Course Name </label>
                            <input type="text" name="name" class="form-control p-input validate-input mb-3" placeholder="Enter Course Name" required>

                            <label for="code"> Code </label>
                            <input type="text" name="code" class="form-control p-input validate-input mb-3" placeholder="Course Code" required>

                            <label for="department"> Department </label>
                            <select name="department" id="department" class="form-select mb-3">
                                @foreach($departments as $department)
                                <option value="{{ $department['id'] }}">
                                    {{ $department['name'] }}
                                </option>
                                @endforeach
                            </select>

                            <label for="type"> Type </label>
                            <input type="text" name="type" id="type" class="form-control p-input validate-input mb-3" placeholder="Type" required>

                            <label for="duration"> Duration </label>
                            <select name="duration" id="duration" class="form-select mb-3">
                                <option value="1">1 Year</option>
                                <option value="2">2 Year</option>
                                <option value="3">3 Year</option>
                                <option value="4">4 Year</option>
                            </select>

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

<div class="modal fade" id="editCourse" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> Edit Course </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('courses.edit')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" id="editId">
                            <label for="editName"> Course Name </label>
                            <input type="text" name="name" id="editName" class="form-control p-input validate-input mb-3" placeholder="Enter Course Name" required>

                            <label for="editCode"> Code </label>
                            <input type="text" name="code" id="editCode" class="form-control p-input validate-input mb-3" placeholder="Course Code" required>

                            <label for="editDepartment"> Department </label>
                            <select name="department" id="editDepartment" class="form-select mb-3">
                                @foreach($departments as $department)
                                <option value="{{ $department['id'] }}">
                                    {{ $department['name'] }}
                                </option>
                                @endforeach
                            </select>

                            <label for="editType"> Type </label>
                            <input type="text" name="type" id="editType" class="form-control p-input validate-input mb-3" placeholder="Type" required>

                            <label for="editDuration"> Duration </label>
                            <select name="duration" id="editDuration" class="form-select mb-3">
                                <option value="1">1 Year</option>
                                <option value="2">2 Year</option>
                                <option value="3">3 Year</option>
                                <option value="4">4 Year</option>
                            </select>

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
         *  Remove Acadamic Year Function
         */
        $(".remove-course").click(function() {
            const courseId = $(this).attr('data-course-id');

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

                    $.post("/admin/courses/remove", {
                            "_token": post_token,
                            "courseId": courseId,
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
         *  Edit Course Function
         */
        $(".edit-course").click(function() {

            const courseId = $(this).attr('data-course-id');
            const courseName = $(this).attr('data-course-name');
            const courseCode = $(this).attr('data-course-code');
            const courseDepartmentId = $(this).attr('data-course-department-id');
            const courseType = $(this).attr('data-course-type');
            const courseDuration = $(this).attr('data-course-duration');

            $('#editId').val(courseId);
            $('#editName').val(courseName);
            $('#editCode').val(courseCode);
            $('#editDepartment').val(courseDepartmentId);
            $('#editType').val(courseType);
            $('#editDuration').val(courseDuration);

            $('#editCourse').modal('show');

        });

    });
</script>

@endsection