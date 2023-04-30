@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Entities</h4>
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
                        <a href="" data-toggle="modal" data-target="#addEntity" id="addEntityButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Entity </a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Entity</th>
                                    <th>ABN</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Primary Phone</th>
                                    <th>Mobile</th>
                                    <th>Fax</th>
                                    <th>Director</th>
                                    <th>Active</th>
                                    <th>Trade</th>
                                    <th>Inc</th>
                                    <th>Abbrev</th>
                                    <th>Contract Signed</th>
                                    <th>Payment Terms</th>
                                    <th>PL Expirey</th>
                                    <th>WC Expirey</th>
                                    <th>Item Type</th>
                                    <th>Path</th>
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
<div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntityLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addEntityLabel">Add Entity</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addEntityForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="type" class="col-sm-12 control-label">Select Type</label></div>
                                <select class="select2 pl-1 form-control" name="type" id="type" style="width: 100%; height:30px;">
                                    <option value="3">Client</option>
                                    <option value="4">Suplier</option>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="entity" class="col-sm-12 control-label">Entity</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="entity" id="entity">
                                </div>
                                <span class="text-danger error-text entity_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="abn" class="col-sm-12 control-label">ABN</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="abn" id="abn">
                                </div>
                                <span class="text-danger error-text abn_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="email" class="col-sm-12 control-label">Email</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="email">
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="address" class="col-sm-12 control-label">Address</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="address" id="address">
                                </div>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="primary_phone" class="col-sm-12 control-label">Primary Phone</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="primary_phone" id="primary_phone">
                                </div>
                                <span class="text-danger error-text primary_phone_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="phone" class="col-sm-12 control-label">Mobile</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="phone" id="phone">
                                </div>
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="fax" class="col-sm-12 control-label">Fax</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="fax" id="fax">
                                </div>
                                <span class="text-danger error-text fax_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="director" class="col-sm-12 control-label">Director</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="director" id="director">
                                </div>
                                <span class="text-danger error-text director_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="trade" class="col-sm-12 control-label">Trade</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="trade" id="trade">
                                </div>
                                <span class="text-danger error-text trade_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="inc" class="col-sm-12 control-label">Inc</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="inc" id="inc">
                                </div>
                                <span class="text-danger error-text inc_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="active" class="col-sm-12 control-label">Active</label></div>
                                <select class="select2 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                    <option value="1">y</option>
                                    <option value="0">n</option>
                                </select>
                                <span class="text-danger error-text active_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="abbrev" class="col-sm-12 control-label">Abbrev</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="abbrev" id="abbrev">
                                </div>
                                <span class="text-danger error-text abbrev_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="contract_signed" class="col-sm-12 control-label">Contract Signed</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="contract_signed" id="contract_signed">
                                </div>
                                <span class="text-danger error-text contract_signed_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="payment_terms" class="col-sm-12 control-label">Payment Terms</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="payment_terms" id="payment_terms">
                                </div>
                                <span class="text-danger error-text payment_terms_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="pl_expirey" class="col-sm-12 control-label">PL Expirey</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="date" name="pl_expirey" id="pl_expirey">
                                </div>
                                <span class="text-danger error-text pl_expirey_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="wc_expirey" class="col-sm-12 control-label">WC Expirey</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="date" name="wc_expirey" id="wc_expirey">
                                </div>
                                <span class="text-danger error-text wc_expirey_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="item_type" class="col-sm-12 control-label">Item Type</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="item_type" id="item_type">
                                </div>
                                <span class="text-danger error-text item_type_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="row"><label for="path" class="col-sm-12 control-label">Path</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="path" id="path">
                                </div>
                                <span class="text-danger error-text path_error"></span>
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
                                <div class="row"><label for="edit_mobile" class="col-sm-12 control-label">Mobile</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" style="width: 100%; height:30px;" type="number" name="mobile" id="edit_mobile">
                                </div>
                                <span class="text-danger error-text mobile_update_error"></span>
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

        fetchEntities();

        function fetchEntities() {
            $.ajax({
                type: "GET",
                url: "fetchEntities",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('tbody').html("");
                    $.each(response.entities, function(key, entity) {
                        $('tbody').append('<tr>\
                            <td>' + entity.id + '</td>\
                            <td>' + entity.user.roles[0] + '</td>\
                            <td>' + entity.entity + '</td>\
                            <td>' + entity.abn + '</td>\
                            <td>' + entity.user.email + '</td>\
                            <td>' + entity.user.address + '</td>\
                            <td>' + entity.primary_phone + '</td>\
                            <td>' + entity.user.phone + '</td>\
                            <td>' + entity.fax + '</td>\
                            <td>' + entity.director + '</td>\
                            <td>' + entity.active + '</td>\
                            <td>' + entity.trade + '</td>\
                            <td>' + entity.inc + '</td>\
                            <td>' + entity.abbrev + '</td>\
                            <td>' + entity.contract_signed + '</td>\
                            <td>' + entity.payment_terms + '</td>\
                            <td>' + entity.pl_expirey + '</td>\
                            <td>' + entity.wc_expirey + '</td>\
                            <td>' + entity.item_type + '</td>\
                            <td>' + entity.path + '</td>\
                            <td><button value="' + entity.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + entity.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
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

        $(document).on('click', '#addEntityButton', function(e) {
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
                        fetchEntities();
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
                        fetchEditSites();
                        $('#contact_id').val(response.contact.id);
                        $('.edit_site_id').val(response.contact.site_id).change();
                        $('.edit_active').val(response.contact.active).change();
                        $('#editContactLabel').text('Contact ID ' + response.contact.id);
                        $('#edit_fname').val(response.contact.fname);
                        $('#edit_lname').val(response.contact.lname);
                        $('#edit_email').val(response.contact.email);
                        $('#edit_mobile').val(response.contact.mobile);
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
                        fetchEntities();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editContact').modal('show');
                }
            });
        })

        $(document).on('submit', '#addEntityForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addEntityForm')[0]);
            $.ajax({
                type: "post",
                url: "entity",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addEntity').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addEntityForm')[0].reset();
                        $('#addEntity').modal('hide');
                        fetchEntities();
                    }
                },
                error: function(error) {
                    $('#addEntity').modal('show')
                }
            });
        });
    });
</script>
@endsection