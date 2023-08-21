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
                    <div class="table-responsive mb-0 fixed-solution">
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
                                    <th>Trade</th>
                                    <th>Abbrev</th>
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

<div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addEntityLabel">Add Site</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addEntityForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="type" id="type" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="0">Client</option>
                                    <option value="1">Suplier</option>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Active</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="entity" id="entity" placeholder="Enter Entity">
                                <span class="text-danger error-text entity_error"></span>
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
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="address" id="address" placeholder="Enter Address">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="primary_phone" id="primary_phone" placeholder="Enter Primary Phone">
                                <span class="text-danger error-text primary_phone_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="mobile" id="mobile" placeholder="Enter Mobile">
                                <span class="text-danger error-text mobile_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="fax" id="fax" placeholder="Enter Fax">
                                <span class="text-danger error-text fax_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="director" id="director" placeholder="Enter Director">
                                <span class="text-danger error-text director_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="trade" id="trade" placeholder="Enter Trade">
                                <span class="text-danger error-text trade_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abn" id="abn" placeholder="Enter ABN">
                                <span class="text-danger error-text abn_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="inc" id="inc" placeholder="Enter Inc">
                                <span class="text-danger error-text inc_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abbrev" id="abbrev" placeholder="Enter Abbrev">
                                <span class="text-danger error-text abbrev_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="contract_signed" id="contract_signed" placeholder="Enter Contract Signed">
                                <span class="text-danger error-text contract_signed_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="payment_terms" id="payment_terms" placeholder="Enter Payment Terms">
                                <span class="text-danger error-text payment_terms_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="pl_expirey" id="pl_expirey" placeholder="Enter PL Expiry">
                                <span class="text-danger error-text pl_expirey_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="wc_expirey" id="wc_expirey" placeholder="Enter WC Expiry">
                                <span class="text-danger error-text wc_expirey_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="item_type" id="item_type" placeholder="Enter Item Type">
                                <span class="text-danger error-text item_type_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="path" id="path" placeholder="Enter Path">
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
</div>

<div class="modal fade" id="editEntity" tabindex="-1" role="dialog" aria-labelledby="editEntityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editEntityLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editEntityForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="entity_id" id="entity_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_type" name="type" id="edit_type" style="width: 100%; height:30px;">
                                    <option value="0">Client</option>
                                    <option value="1">Suplier</option>
                                </select>
                                <span class="text-danger error-text type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_active" name="active" id="edit_active" style="width: 100%; height:30px;">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="entity" id="edit_entity" placeholder="Enter Entity">
                                <span class="text-danger error-text entity_update_error"></span>
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
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="address" id="edit_address" placeholder="Enter Address">
                                <span class="text-danger error-text address_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="primary_phone" id="edit_primary_phone" placeholder="Enter Primary Phone">
                                <span class="text-danger error-text primary_phone_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="mobile" id="edit_mobile" placeholder="Enter Mobile">
                                <span class="text-danger error-text mobile_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="fax" id="edit_fax" placeholder="Enter Fax">
                                <span class="text-danger error-text fax_update_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="director" id="edit_director" placeholder="Enter Director">
                                <span class="text-danger error-text director_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="trade" id="edit_trade" placeholder="Enter Trade">
                                <span class="text-danger error-text trade_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abn" id="edit_abn" placeholder="Enter ABN">
                                <span class="text-danger error-text abn_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="inc" id="edit_inc" placeholder="Enter Inc">
                                <span class="text-danger error-text inc_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abbrev" id="edit_abbrev" placeholder="Enter Abbrev">
                                <span class="text-danger error-text abbrev_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="contract_signed" id="edit_contract_signed" placeholder="Enter Contract Signed">
                                <span class="text-danger error-text contract_signed_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="payment_terms" id="edit_payment_terms" placeholder="Enter Payment Terms">
                                <span class="text-danger error-text payment_terms_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="pl_expirey" id="edit_pl_expirey" placeholder="Enter PL Expiry">
                                <span class="text-danger error-text pl_expirey_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="wc_expirey" id="edit_wc_expirey" placeholder="Enter WC Expiry">
                                <span class="text-danger error-text wc_expirey_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="item_type" id="edit_item_type" placeholder="Enter Item Type">
                                <span class="text-danger error-text item_type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="path" id="edit_path" placeholder="Enter Path">
                                <span class="text-danger error-text path_update_error"></span>
                            </div>
                        </div>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<div class="modal fade" id="deleteEntity" tabindex="-1" role="dialog" aria-labelledby="deleteEntityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteEntityLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteEntityForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="entity_id" name="entity_id">
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
                    $('tbody').html("");
                    $.each(response.entities, function(key, entity) {
                        $('tbody').append('<tr>\
                            <td>' + entity.id + '</td>\
                            <td>' + entity.type + '</td>\
                            <td><a href="/entity/'+entity.id+'">' + entity.entity + '</a></td>\
                            <td>' + entity.abn + '</td>\
                            <td>' + entity.email + '</td>\
                            <td>' + entity.address + '</td>\
                            <td>' + entity.primary_phone + '</td>\
                            <td>' + entity.mobile + '</td>\
                            <td>' + entity.fax + '</td>\
                            <td>' + entity.director + '</td>\
                            <td>' + entity.trade + '</td>\
                            <td>' + entity.abbrev + '</td>\
                            <td><button value="' + entity.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }


        $(document).on('click', '#addEntityButton', function(e) {
            e.preventDefault();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var entity_id = $(this).val();
            $('#deleteEntity').modal('show');
            $('#entity_id').val(entity_id);
        });

        $(document).on('submit', '#deleteEntityForm', function(e) {
            e.preventDefault();
            var entity_id = $('#entity_id').val();

            $.ajax({
                type: 'delete',
                url: 'entity/' + entity_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteEntity').modal('hide');
                    } else {
                        fetchEntities();
                        $('#deleteEntity').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var entity_id = $(this).val();
            $('#editEntity').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'entity/' + entity_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editEntity').modal('hide');
                    } else {
                        var active = 1;
                        if (response.entity.active == 'No') {
                            active = 0;
                        }
                        var type = 1;
                        if (response.entity.type == 'Client') {
                            type = 0;
                        }
                        $('.edit_type').val(type).change();
                        $('.edit_active').val(active).change();
                        $('#entity_id').val(response.entity.id);
                        $('#edit_abn').val(response.entity.abn);
                        $('#edit_entity').val(response.entity.entity);
                        $('#editEntityLabel').text('Entity ID ' + response.entity.id);
                        $('#edit_email').val(response.entity.email);
                        $('#edit_address').val(response.entity.address);
                        $('#edit_primary_phone').val(response.entity.primary_phone);
                        $('#edit_mobile').val(response.entity.mobile);
                        $('#edit_fax').val(response.entity.fax);
                        $('#edit_director').val(response.entity.director);
                        $('#edit_trade').val(response.entity.trade);
                        $('#edit_inc').val(response.entity.inc);
                        $('#edit_abbrev').val(response.entity.abbrev);
                        $('#edit_pl_expirey').val(response.entity.pl_expirey);
                        $('#edit_wc_expirey').val(response.entity.wc_expirey);
                        $('#edit_item_type').val(response.entity.item_type);
                        $('#edit_path').val(response.entity.path);
                        $('#edit_payment_terms').val(response.entity.payment_terms);
                        $('#edit_contract_signed').val(response.entity.contract_signed);
                        $('#edit_path').val(response.entity.path);

                    }
                }
            });
        });

        $(document).on('submit', '#editEntityForm', function(e) {
            e.preventDefault();
            var entity_id = $('#entity_id').val();
            let EditFormData = new FormData($('#editEntityForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "entity/" + entity_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editEntity').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editEntityForm')[0].reset();
                        $('#editEntity').modal('hide');
                        fetchEntities();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editEntity').modal('show');
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