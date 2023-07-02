@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Budget</h4>
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
                        <a href="" data-toggle="modal" data-target="#addContact" id="addContactButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Order </a>
                    </div>
                    <div class="row">
                        <div class="custom-control custom-checkbox col-sm-3" style="display:flex; padding:8px;float:left;margin-left: 30px">
                            <input type="checkbox" class="custom-control-input" id="customCheck02">
                            <label class="custom-control-label" for="customCheck02">Display Active Only</label>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cost Code</th>
                                    <th>Descritpion</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Budget</th>
                                    <th>Value Ordered</th>
                                    <th>Balance</th>
                                    <th width="3%">Modify</th>
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
<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="addContactLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addContactLabel">Add Contact</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addContactForm">
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
                            <td>' + contact.entity.entity + '</td>\
                            <td>' + contact.role + '</td>\
                            <td><button value="' + contact.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchEntities() {
            $.ajax({
                type: "GET",
                url: "fetchEntities",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").text('Select Entity'));
                    $.each(response.entities, function(key) {
                        entity_id.append($("<option />").val(response.entities[key].id).text(response.entities[key].entity));
                    });
                }
            });
        }

        $(document).on('click', '#addContactButton', function(e) {
            e.preventDefault();
            fetchEntities();
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
                        var edit_entity_id = $('#edit_entity_id');
                        var active = 1;
                        if (response.contact.active == 'No') {
                            active = 0;
                        }

                        $('#edit_entity_id').children().remove().end();
                        $.each(response.entities, function(entity) {
                            edit_entity_id.append($("<option />").val(response.entities[entity].id).text(response.entities[entity].entity));
                        });
                        var name = response.contact.user.name;
                        name = name.split(" ");
                        $('#contact_id').val(response.contact.id);
                        $('.edit_active').val(active).change();
                        $('#editContactLabel').text('Contact ID ' + response.contact.id);
                        $('#edit_fname').val(name[0]);
                        $('#edit_lname').val(name[1]);
                        $('#edit_email').val(response.contact.user.email);
                        $('#edit_phone').val(response.contact.user.phone);
                        $('#edit_entity_id').val(response.contact.entity_id).change();
                        $('#edit_role').val(response.contact.role);
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

        $(document).on('submit', '#addContactForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addContactForm')[0]);
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
                        $('#addContact').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addContactForm')[0].reset();
                        $('#addContact').modal('hide');
                        fetchContacts();
                    }
                },
                error: function(error) {
                    $('#addContact').modal('show')
                }
            });
        });
    });
</script>
@endsection