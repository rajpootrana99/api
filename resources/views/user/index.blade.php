@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Users</h4>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mt-4">Users
                        </div>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Email</th>
                                    <th width="8%">Status</th>          
                                    <th width="3%">Verified</th>
                                    <th width="3%">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- Modal -->

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="deleteUserLabel">Delete</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form method="post" id="deleteUserForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="user_id" name="user_id">
                            <p class="mb-4">Are you sure want to delete?</p>
                        </div><!--end row-->
                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Yes</button>
                    </div><!--end modal-footer-->
                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <script>
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetchUsers();

            function fetchUsers()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchUsers",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.users, function (key, user) {
                            var status, date_of_interview;
                            if (user.is_approved == 'Approved'){
                                status = '<span class="badge badge-success">'+user.is_approved+'</span>';
                            }
                            else {
                                status = '<span class="badge badge-primary">'+user.is_approved+'</span>';
                            }
                            $('tbody').append('<tr>\
                            <td>'+user.id+'</td>\
                            <td>'+user.name +'</td>\
                            <td>'+user.email+'</td>\
                            <td>'+status+'</td>\
                            <td><button value="'+user.id+'" style="border: none; background-color: #fff" class="approve_btn"><i class="fa fa-check-circle"></i></button></td>\
                            <td><button value="'+user.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.approve_btn', function (e) {
                e.preventDefault();
                var user_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: 'approveUser/'+user_id,
                    dataType: "json",
                    success: function (response) {
                        fetchUsers();
                    }
                });
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var user_id = $(this).val();
                $('#deleteUser').modal('show');
                $('#user_id').val(user_id)
            });

            $(document).on('submit', '#deleteUserForm', function (e) {
                e.preventDefault();
                var user_id = $('#user_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'user/'+user_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteUser').modal('hide');
                        }
                        else {
                            fetchUsers();
                            $('#deleteUser').modal('hide');
                        }
                    }
                });
            });

        });
    </script>
@endsection