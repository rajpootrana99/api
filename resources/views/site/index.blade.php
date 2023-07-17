@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Sites</h4>
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
                        <a data-toggle="modal" data-target="#addSite" id="addSiteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Site </a>
                    </div>
                    <div class="row">
                        <div class="col-sm-7"></div>
                        <div class="form-group col-sm-5">
                            <div class="row">
                                <label for="example-search-input" class="col-sm-3 col-form-label text-right">Search</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search" placeholder="Search by Site Name" id="example-search-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Site</th>
                                    <th>Site Address</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Post Code</th>
                                    <th>Owner</th>
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
<div class="modal fade" id="addSite" tabindex="-1" role="dialog" aria-labelledby="addSiteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addSiteLabel">Add Site</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addSiteForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="site" id="site" placeholder="Enter Site Name" style="width: 100%; height:30px;">
                                <span class="text-danger error-text site_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" style="width: 100%; height:30px !important;">

                                </select>
                                <span class="text-danger error-text entity_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="site_address" id="site_address" placeholder="Enter Site Address" style="width: 100%; height:30px;">
                                <span class="text-danger error-text site_address_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="suburb" id="suburb" placeholder="Enter Suburb" style="width: 100%; height:30px;">
                                <span class="text-danger error-text suburb_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="state" id="state" placeholder="Enter State" style="width: 100%; height:30px;">
                                <span class="text-danger error-text state_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="post_code" id="post_code" placeholder="Enter Post Code" style="width: 100%; height:30px;">
                                <span class="text-danger error-text post_code_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 mb-3 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                    <option disabled selected>Select Active</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
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
</div>

<div class="modal fade" id="editSite" tabindex="-1" role="dialog" aria-labelledby="editSiteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editSiteLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editSiteForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="site_id" name="site_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="site" id="edit_site" placeholder="Enter Site Name" style="width: 100%; height:30px;">
                                <span class="text-danger error-text site_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_entity_id" name="entity_id" id="edit_entity_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text entity_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="site_address" id="edit_site_address" placeholder="Enter Site Address" style="width: 100%; height:30px;">
                                <span class="text-danger error-text site_address_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="suburb" id="edit_suburb" placeholder="Enter Suburb" style="width: 100%; height:30px;">
                                <span class="text-danger error-text suburb_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="state" id="edit_state" placeholder="Enter State" style="width: 100%; height:30px;">
                                <span class="text-danger error-text state_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="post_code" id="edit_post_code" placeholder="Enter Post Code" style="width: 100%; height:30px;">
                                <span class="text-danger error-text post_code_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 mb-3 pl-1 form-control edit_active" name="active" id="edit_active" style="width: 100%; height:30px;">
                                    <option disabled selected>Select Active</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_update_error"></span>
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

<div class="modal fade" id="deleteSite" tabindex="-1" role="dialog" aria-labelledby="deleteSiteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteSiteLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteSiteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="site_id" name="site_id">
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

        fetchSites();

        function fetchSites() {
            $.ajax({
                type: "GET",
                url: "fetchSites",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.sites, function(key, site) {
                        $('tbody').append('<tr>\
                            <td>' + site.id + '</td>\
                            <td>' + site.site + '</td>\
                            <td>' + site.site_address + '</td>\
                            <td>' + site.suburb + '</td>\
                            <td>' + site.state + '</td>\
                            <td>' + site.post_code + '</td>\
                            <td>' + site.entity.entity + '</td>\
                            <td><button value="' + site.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchEntities() {
            $.ajax({
                type: "GET",
                url: "/fetchEntities",
                dataType: "json",
                success: function(response) {
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").text('Select Entity'));
                    $.each(response.entities, function(entity) {
                        entity_id.append($("<option />").val(response.entities[entity].id).text(response.entities[entity].entity));
                    });
                }
            });
        }

        $(document).on('click', '#addSiteButton', function(e) {
            e.preventDefault();
            fetchEntities();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var site_id = $(this).val();
            $('#deleteSite').modal('show');
            $('#site_id').val(site_id)
        });

        $(document).on('submit', '#deleteSiteForm', function(e) {
            e.preventDefault();
            var site_id = $('#site_id').val();

            $.ajax({
                type: 'delete',
                url: 'site/' + site_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteSite').modal('hide');
                    } else {
                        fetchSites();
                        $('#deleteSite').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var site_id = $(this).val();
            $('#editSite').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'site/' + site_id + '/edit',
                success: function(response) {
                    if (response.status == 404) {
                        $('#editSite').modal('hide');
                    } else {
                        $('#editSiteLabel').text('Site ID ' + response.site.id);
                        var active = 1;
                        if (response.site.active == 'No') {
                            active = 0;
                        }
                        var entity_id = $('#edit_entity_id');
                        $('#edit_entity_id').children().remove().end();
                        entity_id.append($("<option />").val(0).text('Select Client'));
                        $.each(response.entities, function(entity) {
                            entity_id.append($("<option />").val(response.entities[entity].id).text(response.entities[entity].entity));
                        });
                        $('#site_id').val(response.site.id);
                        $('.edit_active').val(active).change();
                        $('#edit_site').val(response.site.site);
                        $('#edit_site_address').val(response.site.site_address);
                        $('#edit_suburb').val(response.site.suburb);
                        $('#edit_state').val(response.site.state);
                        $('#edit_post_code').val(response.site.post_code);
                        $('#edit_entity_id').val(response.site.entity_id);
                    }
                }
            });
        });

        $(document).on('submit', '#editSiteForm', function(e) {
            e.preventDefault();
            var site_id = $('#site_id').val();
            let EditFormData = new FormData($('#editSiteForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "site/" + site_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editSite').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editSiteForm')[0].reset();
                        $('#editSite').modal('hide');
                        fetchSites();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editSite').modal('show');
                }
            });
        })

        $(document).on('submit', '#addSiteForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addSiteForm')[0]);
            $.ajax({
                type: "post",
                url: "site",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addSite').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addSiteForm')[0].reset();
                        $('#addSite').modal('hide');
                        fetchSites();
                    }
                },
                error: function(error) {
                    $('#addSite').modal('show')
                }
            });
        });
    });
</script>
@endsection