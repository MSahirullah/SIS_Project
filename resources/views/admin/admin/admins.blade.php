@extends('layouts.admin')

@section('title') Admins @endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admins</li>
    </ol>
    <h3 class="font-weight-bolder mb-0"> Admins </h3>
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
                            <h6> Admins </h6>
                        </div>
                        <div class="col-sm-8 text-right">
                            <a href=" {{ route('admins.add') }}" class="btn btn-primary">
                                New Admin
                            </a>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach($admins as $admin)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $admin['title'] }}. {{ $admin['name_with_initial'] }} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $admin['status'] == 1 ? 'Active' : 'Inactive' }} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href=" {{ route('admins.edit',['username'=> $admin['username'] ]) }} " class="btn btn-secondary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger remove-admin" data-admin-id="{{ $admin['id'] }}">
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
         *  Remove Admin Function
         */
        $(".remove-admin").click(function() {
            const adminId = $(this).attr('data-admin-id');

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

                    $.post("/admin/users-actions/remove", {
                            "_token": post_token,
                            "userId": adminId,
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