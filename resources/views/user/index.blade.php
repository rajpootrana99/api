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
                    <div class="card-title mt-4">
                        <a href="" data-toggle="modal" data-target="#addUser" id="addUserButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New User </a>
                    </div>
                    <div class="row">
                        <div class="custom-control custom-checkbox col-sm-3" style="display:flex; padding:8px;float:left;margin-left: 30px">
                            <input type="checkbox" class="custom-control-input" id="display-active-only">
                            <label class="custom-control-label" for="display-active-only">Display Active Only</label>
                        </div>
                    </div>
                </div><!--end card-header-->

                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Email</th>
                                    <th width="8%">Status</th>
                                    <th width="1%">View</th>
                                    <th width="1%">Verified</th>
                                    <th width="1%">Modify</th>
                                    <th width="1%">Delete</th>
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
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addUserLabel">Add User</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addUserForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="fname" id="fname" placeholder="Enter First Name">
                                <span class="text-danger error-text fname_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="lname" id="lname" placeholder="Enter Last Name">
                                <span class="text-danger error-text lname_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="email" placeholder="Enter Email">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="phone" id="phone" placeholder="Enter Mobile">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                    <option disabled selected>Select Active</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text entity_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="role" id="role" placeholder="Enter Role">
                                <span class="text-danger error-text role_error"></span>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div>
    </div><!--end modal-content-->
</div><!--end modal-dialog-->
</div>

<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editUserLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editUserForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="fname" id="edit_fname" placeholder="Enter First Name">
                                <span class="text-danger error-text fname_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="lname" id="edit_lname" placeholder="Enter Last Name">
                                <span class="text-danger error-text lname_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="edit_email" placeholder="Enter Email">
                                <span class="text-danger error-text email_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="phone" id="edit_phone" placeholder="Enter Mobile">
                                <span class="text-danger error-text phone_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_active" name="active" id="edit_active" style="width: 100%; height:30px;">
                                    <option disabled selected>Select Active Status</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_entity_id" name="entity_id" id="edit_entity_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text entity_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="role" id="edit_role" placeholder="Enter Role">
                                <span class="text-danger error-text role_update_error"></span>
                            </div>
                        </div>

                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
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

<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="showUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="showUserLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <div class="modal-body text-center">
                <img src="assets/images/users/user-5.jpg" alt="" class="thumb-lg rounded-circle">
                <h4 class="mb-1" id="name"></h4>
                <p class="mb-0 text-muted" id="email"></p>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Yes</button>
            </div><!--end modal-footer-->

        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var users;

        fetchUsers();

        function fetchUsers() {
            $.ajax({
                type: "GET",
                url: "fetchUsers",
                dataType: "json",
                success: function(response) {
                    users = response.users;
                    $('tbody').html("");
                    $.each(response.users, function(key, user) {
                        userData(user);
                    });
                }
            });
        }

        function userData(user){
            var status, date_of_interview;
            if (user.is_approved == 'Approved') {
                status = '<span class="badge badge-success">' + user.is_approved + '</span>';
            } else {
                status = '<span class="badge badge-primary">' + user.is_approved + '</span>';
            }
            $('tbody').append('<tr>\
                <td>' + user.id + '</td>\
                <td>' + user.name + '</td>\
                <td>' + user.email + '</td>\
                <td>' + status + '</td>\
                <td><button value="' + user.id + '" style="border: none; background-color: #fff" class="view_btn"><i class="fas fa-eye"></i></button></td>\
                <td><button value="' + user.id + '" style="border: none; background-color: #fff" class="approve_btn"><i class="fa fa-check-circle"></i></button></td>\
                <td><button value="' + user.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                <td><button value="' + user.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
            </tr>');
        }

        $(document).on('change', '#display-active-only', function(e) {
            if ($("#display-active-only").prop('checked') == true){
                $('tbody').html("");
                $.each(users, function(key, user) {
                    if (user.is_approved == 'Approved'){
                        userData(user);
                    }
                });
            } 
            else {
                $('tbody').html("");
                $.each(users, function(key, user) {
                    userData(user);
                });
            }
        });

        $(document).on('click', '.view_btn', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $('#showUser').modal('show');
            $.ajax({
                type: "GET",
                url: 'user/' + user_id,
                success: function(response) {
                    if (response.status == 404) {
                        $('#showUser').modal('hide');
                    } else {
                        $('#showUserLabel').text('User ID ' + response.user.id);
                        $('#name').text(response.user.name);
                        $('#email').text(response.user.email);
                    }
                }
            });
        });

        $(document).on('click', '.approve_btn', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $.ajax({
                type: "GET",
                url: 'approveUser/' + user_id,
                dataType: "json",
                success: function(response) {
                    fetchUsers();
                }
            });
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $('#deleteUser').modal('show');
            $('#user_id').val(user_id)
        });

        $(document).on('submit', '#deleteUserForm', function(e) {
            e.preventDefault();
            var user_id = $('#user_id').val();

            $.ajax({
                type: 'delete',
                url: 'user/' + user_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteUser').modal('hide');
                    } else {
                        fetchUsers();
                        $('#deleteUser').modal('hide');
                    }
                }
            });
        });



        function fetchEntities() {
            $.ajax({
                type: "GET",
                url: "fetchEntities",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").text('Select Entity').prop({selected: true, disabled: true}));
                    $.each(response.entities, function(key) {
                        entity_id.append($("<option />").val(response.entities[key].id).text(response.entities[key].entity));
                    });
                }
            });
        }

        $(document).on('click', '#addUserButton', function(e) {
            e.preventDefault();
            fetchEntities();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $('#editUser').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'user/' + user_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editUser').modal('hide');
                    } else {
                        var edit_entity_id = $('#edit_entity_id');
                        var active = 1;
                        if (response.user.active == 'No') {
                            active = 0;
                        }

                        $('#edit_entity_id').children().remove().end();
                        edit_entity_id.append($("<option />").text('Select Entity').prop({selected: true, disabled: true}));
                        $.each(response.entities, function(entity) {
                            edit_entity_id.append($("<option />").val(response.entities[entity].id).text(response.entities[entity].entity));
                        });
                        var name = response.user.name;
                        name = name.split(" ");
                        $('#user_id').val(response.user.id);
                        $('.edit_active').val(active).change();
                        $('#editUserLabel').text('User ID ' + response.user.id);
                        $('#edit_fname').val(name[0]);
                        $('#edit_lname').val(name[1]);
                        $('#edit_email').val(response.user.email);
                        $('#edit_phone').val(response.user.phone);
                        $('#edit_entity_id').val(response.user.entity_id).change();
                        $('#edit_role').val(response.user.role);
                    }
                }
            });
        });

        $(document).on('submit', '#editUserForm', function(e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            let EditFormData = new FormData($('#editUserForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "user/" + user_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editUser').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editUserForm')[0].reset();
                        $('#editUser').modal('hide');
                        fetchUsers();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editUser').modal('show');
                }
            });
        })

        $(document).on('submit', '#addUserForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addUserForm')[0]);
            $.ajax({
                type: "post",
                url: "user",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addUser').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addUserForm')[0].reset();
                        $('#addUser').modal('hide');
                        fetchUsers();
                    }
                },
                error: function(error) {
                    $('#addUser').modal('show')
                }
            });
        });
    });
</script>
@endsection
