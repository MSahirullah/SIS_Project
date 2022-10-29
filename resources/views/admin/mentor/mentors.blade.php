@extends('layouts.admin')

@section('title') Lecturers @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Mentors</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Mentors </h3>
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
                            <h6> Mentors </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMentor">
                                New Mentor
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mentor Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Day</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($mentors as $mentor)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $mentor['title'] }}. {{ $mentor['name_with_initial'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ date('l', strtotime($mentor['day'])) }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ date('h:i A', strtotime($mentor['time'])) }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $mentor['location'] }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $mentor['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href="{{ route('mentors.students',['url'=> $mentor['url']]) }}" class="btn btn-primary">
                                            <i class="fa fa-users"></i>
                                        </a>
                                        <button class="btn btn-secondary edit-mentor" data-mentor-id="{{ $mentor['id'] }}" data-lecturer="{{ $mentor['lecturer_id'] }}" data-date="{{ $mentor['day'] }}" data-time="{{$mentor['time']}}" data-location="{{ $mentor['location'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger remove-mentor" data-mentor-id="{{ $mentor['id'] }}">
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

<div class="modal fade" id="newMentor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Mentor </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('mentors.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="lecturer"> Lecturer </label>
                            <select name="lecturer" id="lecturer" class="form-select mb-3" required>
                                @foreach($lecturers as $lecturer)

                                @if(!in_array($lecturer['id'], $selectedLecturers))

                                <option value="{{ $lecturer['id'] }}">
                                    {{ $lecturer['title'] }} {{ $lecturer['name_with_initial'] }}
                                </option>

                                @endif

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="day">Day</label>
                            <select name="day" id="day" class="form-select mb-3" required>
                                <option value="mon"> Monday </option>
                                <option value="tue"> Tuesday </option>
                                <option value="wed"> Wednesday </option>
                                <option value="thu"> Thursday </option>
                                <option value="fri"> Friday </option>
                                <option value="sat"> Saturday </option>
                                <option value="sun"> Sunday </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control mb-3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control mb-3" required>
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

<div class="modal fade" id="editMentor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Mentor </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('mentors.edit')}}" method="POST">
                @csrf
                <input type="hidden" name="mentorId" id="mentorId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="editLecturer"> Lecturer </label>
                            <select name="lecturer" id="editLecturer" class="form-select mb-3" required>
                                @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer['id'] }}">
                                    {{ $lecturer['title'] }} {{ $lecturer['name_with_initial'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="editDay">Day</label>
                            <select name="day" id="editDay" class="form-select mb-3" required>
                                <option value="mon"> Monday </option>
                                <option value="tue"> Tuesday </option>
                                <option value="wed"> Wednesday </option>
                                <option value="thu"> Thursday </option>
                                <option value="fri"> Friday </option>
                                <option value="sat"> Saturday </option>
                                <option value="sun"> Sunday </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="editTime">Time</label>
                            <input type="time" name="time" id="editTime" class="form-control mb-3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="editLocation">Location</label>
                            <input type="text" name="location" id="editLocation" class="form-control mb-3" required>
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
         *  Remove Mentor Function
         */
        $(".remove-mentor").click(function() {
            const mentorId = $(this).attr('data-mentor-id');

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

                    $.post("/admin/mentors/remove", {
                            "_token": post_token,
                            "mentorId": mentorId,
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
         *  Edit Mentor Function
         */
        $(".edit-mentor").click(function() {


            const mentorId = $(this).attr('data-mentor-id');
            const lecturer = $(this).attr('data-lecturer');
            const date = $(this).attr('data-date');
            const time = $(this).attr('data-time');
            const location = $(this).attr('data-location');

            $("#mentorId").val(mentorId);
            $('#editLecturer').val(lecturer);
            $('#editDay').val(date);
            $('#editTime').val(time);
            $('#editLocation').val(location);

            $("#editLecturer option").show();
            $("#editLecturer option").each(function() {
                const optionVal = parseInt($(this).attr('value'));

                if (optionVal != lecturer) {
                    $(this).hide();
                }

            });

            $('#editMentor').modal('show');

        });

    });
</script>

@endsection