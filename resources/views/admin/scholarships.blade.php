@extends('layouts.admin')

@section('title') Semesters @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Scholarships </h3>
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
                            <h6> Scholarships </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newScholarship">
                                New Scholarship
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Scholarship</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Institution</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
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
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $scholarship['type'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $scholarship['institution'] }} </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ number_format($scholarship['amount'],2) }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $scholarship['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href=" {{ route('scholarships.students',['scUrl'=> $scholarship['url'] ]) }} " class="btn btn-secondary">
                                            <i class="fa fa-users"></i>
                                        </a>
                                        <button class="btn btn-secondary edit-scholarship" data-scholarship-id="{{ $scholarship['id'] }}" data-scholarship-name="{{ $scholarship['name'] }}" data-scholarship-type="{{ $scholarship['type'] }}" data-scholarship-ins="{{ $scholarship['institution'] }}" data-scholarship-amount="{{ $scholarship['amount'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger remove-scholarship" data-scholarship-id="{{ $scholarship['id'] }}">
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

<div class="modal fade" id="newScholarship" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamYearLabel"> New Scholarship </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('scholarships.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="scholarshipName"> Scholarship Name </label>
                            <input type="text" name="name" id="scholarshipName" class="form-control mb-3 p-input validate-input" placeholder="Scholarship Name" required>

                            <label for="scholarshipType"> Scholarship Type </label>
                            <select name="type" id="scholarshipType" class="form-control form-select mb-3" placeholder="Scholarship Type">
                                <option value="private"> Private </option>
                                <option value="government"> Government </option>
                            </select>

                            <label for="institution"> Scholarship Institution </label>
                            <input type="text" name="institution" id="institution" class="form-control p-input validate-input mb-3" placeholder="Scholarship institution" required>

                            <label for="fee"> Scholarship Amount </label>
                            <input type="number" name="amount" id="fee" class="form-control p-input validate-input" placeholder="Scholarship Amount">

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

<div class="modal fade" id="editScholarship" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=""> Edit Scholarship </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('scholarships.edit')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">

                            <input type="hidden" name="id" id="editScholarshipId">
                            <label for="editScholarshipName"> Scholarship Name </label>
                            <input type="text" name="name" id="editScholarshipName" class="form-control mb-3 p-input validate-input" placeholder="Scholarship Name" required>

                            <label for="editScholarshipType"> Scholarship Type </label>
                            <select name="type" id="editScholarshipType" class="form-control form-select mb-3" placeholder="Scholarship Type">
                                <option value="private"> Private </option>
                                <option value="government"> Government </option>
                            </select>

                            <label for="editInstitutionType"> Scholarship Institution </label>
                            <input type="text" name="institution" id="editInstitutionType" class="form-control p-input validate-input mb-3" placeholder="Scholarship institution" required>

                            <label for="editFee"> Scholarship Amount </label>
                            <input type="number" name="amount" id="editFee" class="form-control p-input validate-input" placeholder="Scholarship Amount">

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
        $(".remove-scholarship").click(function() {
            const scholarshipId = $(this).attr('data-scholarship-id');

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

                    $.post("/admin/scholarships/remove", {
                            "_token": post_token,
                            "scholarshipId": scholarshipId,
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
        $(".edit-scholarship").click(function() {

            const scholarshipId = $(this).attr('data-scholarship-id');
            const scholarshipName = $(this).attr('data-scholarship-name');
            const scholarshipType = $(this).attr('data-scholarship-type');
            const scholarshipIns = $(this).attr('data-scholarship-ins');
            const scholarshipAmount = $(this).attr('data-scholarship-amount');

            $('#editScholarshipName').val(scholarshipName);
            $('#editScholarshipId').val(scholarshipId);
            $("#editInstitutionType").val(scholarshipIns);
            $("#editScholarshipType").val(scholarshipType);
            $("#editFee").val(scholarshipAmount);

            $('#editScholarship').modal('show');
        });

    });
</script>

@endsection