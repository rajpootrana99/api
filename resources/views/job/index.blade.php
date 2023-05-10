@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Contacts</h4>
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
                        <a href="" data-toggle="modal" data-target="#addJob" id="addJobButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Job </a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Site</th>
                                    <th>Description</th>
                                    <th>Suppliers</th>
                                    <th>Job Status</th>
                                    <th>Owner</th>
                                    <th>Completed Date</th>
                                    <th>Days in Progress</th>
                                    <th>Total Sell Price</th>
                                    <th>Profit</th>
                                    <th>%</th>
                                    <th>Invoiced</th>
                                    <th>Remaining Invoice Amount</th>
                                    <th width="3%">Modify</th>
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
<div class="modal fade" id="addJob" tabindex="-1" role="dialog" aria-labelledby="addJobLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addJobLabel">Add Job</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addJobForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row"><label for="site_id" class="col-sm-12 control-label">Select Site</label></div>
                                <select class="select2 pl-1 form-control" name="site_id" id="site_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text site_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="fname" class="col-sm-12 control-label">First Name</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="fname" id="fname">
                                </div>
                                <span class="text-danger error-text fname_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="lname" class="col-sm-12 control-label">Last Name</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="lname" id="lname">
                                </div>
                                <span class="text-danger error-text lname_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="email" class="col-sm-12 control-label">Email</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="email">
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="phone" class="col-sm-12 control-label">Mobile</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="number" name="phone" id="phone">
                                </div>
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="employer" class="col-sm-12 control-label">Employer</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="employer" id="employer">
                                </div>
                                <span class="text-danger error-text employer_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="role" class="col-sm-12 control-label">Role</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="role" id="role">
                                </div>
                                <span class="text-danger error-text role_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="emp_id" class="col-sm-12 control-label">Emp ID</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="number" name="emp_id" id="emp_id">
                                </div>
                                <span class="text-danger error-text emp_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="active" class="col-sm-12 control-label">Active</label></div>
                                <select class="select2 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                    <option value="1">y</option>
                                    <option value="0">n</option>
                                </select>
                                <span class="text-danger error-text active_error"></span>
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

<div class="modal fade" id="editContact" tabindex="-1" role="dialog" aria-labelledby="editContactLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editContactLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editContactForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="contact_id" name="contact_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row"><label for="edit_site_id" class="col-sm-12 control-label">Select Site</label></div>
                                <select class="select2 pl-1 form-control edit_site_id" name="site_id" id="edit_site_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text site_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_fname" class="col-sm-12 control-label">First Name</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="fname" id="edit_fname">
                                </div>
                                <span class="text-danger error-text fname_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_lname" class="col-sm-12 control-label">Last Name</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="lname" id="edit_lname">
                                </div>
                                <span class="text-danger error-text lname_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_email" class="col-sm-12 control-label">Email</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="edit_email">
                                </div>
                                <span class="text-danger error-text email_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_phone" class="col-sm-12 control-label">Mobile</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="number" name="phone" id="edit_phone">
                                </div>
                                <span class="text-danger error-text phone_update_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_employer" class="col-sm-12 control-label">Employer</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="employer" id="edit_employer">
                                </div>
                                <span class="text-danger error-text employer_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_role" class="col-sm-12 control-label">Role</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="role" id="edit_role">
                                </div>
                                <span class="text-danger error-text role_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_emp_id" class="col-sm-12 control-label">Emp ID</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="number" name="emp_id" id="edit_emp_id">
                                </div>
                                <span class="text-danger error-text emp_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="edit_active" class="col-sm-12 control-label">Active</label></div>
                                <select class="select2 pl-1 form-control edit_active" name="active" id="edit_active" style="width: 100%; height:30px;">
                                    <option value="1">y</option>
                                    <option value="0">n</option>
                                </select>
                                <span class="text-danger error-text active_update_error"></span>
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

<div class="modal fade" id="deleteContact" tabindex="-1" role="dialog" aria-labelledby="deleteContactLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteContactLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteContactForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="contact_id" name="contact_id">
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
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchContacts();

        function fetchContacts() {
            $.ajax({
                type: "GET",
                url: "fetchContacts",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.contacts, function(key, contact) {
                        $('tbody').append('<tr>\
                            <td>' + contact.id + '</td>\
                            <td>' + contact.user.name + '</td>\
                            <td>' + contact.user.email + '</td>\
                            <td>' + contact.user.phone + '</td>\
                            <td>' + contact.site.site + '</td>\
                            <td>' + contact.employer + '</td>\
                            <td>' + contact.role + '</td>\
                            <td>' + contact.emp_id + '</td>\
                            <td>' + contact.active + '</td>\
                            <td><button value="' + contact.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + contact.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchSites() {
            $.ajax({
                type: "GET",
                url: "fetchSites",
                dataType: "json",
                success: function(response) {
                    var site_id = $('#site_id');
                    $('#site_id').children().remove().end();
                    $.each(response.sites, function(site) {
                        site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                    });
                }
            });
        }

        function fetchEditSites() {
            $.ajax({
                type: "GET",
                url: "fetchSites",
                dataType: "json",
                success: function(response) {
                    var edit_site_id = $('#edit_site_id');
                    $('#edit_site_id').children().remove().end();
                    $.each(response.sites, function(site) {
                        edit_site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                    });
                }
            });
        }

        $(document).on('click', '#addJobButton', function(e) {
            e.preventDefault();
            fetchSites();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var contact_id = $(this).val();
            $('#deleteContact').modal('show');
            $('#contact_id').val(contact_id);
        });

        $(document).on('submit', '#deleteContactForm', function(e) {
            e.preventDefault();
            var contact_id = $('#contact_id').val();

            $.ajax({
                type: 'delete',
                url: 'contact/' + contact_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteContact').modal('hide');
                    } else {
                        fetchContacts();
                        $('#deleteContact').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var contact_id = $(this).val();
            $('#editContact').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'contact/' + contact_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editContact').modal('hide');
                    } else {
                        var edit_site_id = $('#edit_site_id');
                        var active = 1;
                        if (response.contact.active == 'n') {
                            active = 0;
                        }
                        $('#edit_site_id').children().remove().end();
                        $.each(response.sites, function(site) {
                            edit_site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                        });
                        var name = response.contact.user.name;
                        name = name.split(" ");
                        $('#contact_id').val(response.contact.id);
                        $('.edit_site_id').val(response.contact.site_id).change();
                        $('.edit_active').val(active).change();
                        $('#editContactLabel').text('Contact ID ' + response.contact.id);
                        $('#edit_fname').val(name[0]);
                        $('#edit_lname').val(name[1]);
                        $('#edit_email').val(response.contact.user.email);
                        $('#edit_phone').val(response.contact.user.phone);
                        $('#edit_employer').val(response.contact.employer);
                        $('#edit_role').val(response.contact.role);
                        $('#edit_emp_id').val(response.contact.emp_id);

                    }
                }
            });
        });

        $(document).on('submit', '#editContactForm', function(e) {
            e.preventDefault();
            var contact_id = $('#contact_id').val();
            let EditFormData = new FormData($('#editContactForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "contact/" + contact_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editContact').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editContactForm')[0].reset();
                        $('#editContact').modal('hide');
                        fetchContacts();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editContact').modal('show');
                }
            });
        })

        $(document).on('submit', '#addJobForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addJobForm')[0]);
            $.ajax({
                type: "post",
                url: "contact",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addJob').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addJobForm')[0].reset();
                        $('#addJob').modal('hide');
                        fetchContacts();
                    }
                },
                error: function(error) {
                    $('#addJob').modal('show')
                }
            });
        });
    });
</script>
@endsection