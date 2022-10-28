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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newExamType">
                                New Exam Type
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Exam Type</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($scholarships as $scholarship)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $scholarship['name'] }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $scholarship['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button class="btn btn-secondary edit-exam-type" data-exam-type-id="{{ $scholarship['id'] }}" data-exam-type-name="{{ $scholarship['name'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger remove-exam-type" data-exam-type-id="{{ $scholarship['id'] }}">
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

<div class="modal fade" id="newExamType" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Exam Type </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('exam_types.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name" class="form-control p-input validate-input" placeholder="Enter Exam Type Name" required>
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

<div class="modal fade" id="editExamType" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=""> Edit Exam Type </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('exam_types.edit')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="examTypeId" value="" id="editExamTypeId">
                            <input type="text" name="name" id="editExamTypeName" class="form-control p-input validate-input" placeholder="Enter Exam Type Name" required>
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
        $(".remove-exam-type").click(function() {
            const yearId = $(this).attr('data-exam-type-id');

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

                    $.post("/admin/exam-types/remove", {
                            "_token": post_token,
                            "examTypeId": yearId,
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
         *  Edit Acadamic Year Function
         */
        $(".edit-exam-type").click(function() {

            const examTypeId = $(this).attr('data-exam-type-id');
            const examTypeName = $(this).attr('data-exam-type-name');

            $('#editExamTypeName').val(examTypeName);
            $('#editExamTypeId').val(examTypeId);
            $('#editExamType').modal('show');

        });

    });
</script>

@endsection