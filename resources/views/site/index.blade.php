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
                                    <input class="form-control" type="search" placeholder="Search by Task Title or Store Name" id="example-search-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="site" class="col-sm-12 control-label">Site Name</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="site" id="site">
                                </div>
                                <span class="text-danger error-text site_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="site_address" class="col-sm-12 control-label">Site Address</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="site_address" id="site_address">
                                </div>
                                <span class="text-danger error-text site_address_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="suburb" class="col-sm-12 control-label">Suburb</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="suburb" id="suburb">
                                </div>
                                <span class="text-danger error-text suburb_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="state" class="col-sm-12 control-label">State</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="state" id="state">
                                </div>
                                <span class="text-danger error-text state_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="post_code" class="col-sm-12 control-label">Post Code</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="post_code" id="post_code">
                                </div>
                                <span class="text-danger error-text post_code_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="owner" class="col-sm-12 control-label">Owner</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="owner" id="owner">
                                </div>
                                <span class="text-danger error-text owner_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="owner_id" class="col-sm-12 control-label">Owner ID</label></div>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="owner_id" id="owner_id">
                                </div>
                                <span class="text-danger error-text owner_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row"><label for="active" class="col-sm-12 control-label">Active</label></div>
                                <select class="select2 mb-3 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
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
                                <div class="row"><label for="edit_site" class="col-form-label text-right">Site</label></div>
                                <input class="form-control" style="height: 30px;" type="text" name="site" id="edit_site">
                                <span class="text-danger error-text site_update_error"></span>
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
                            <td>' + site.owner + '</td>\
                            <td><button value="' + site.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        $(document).on('click', '#addSiteButton', function(e) {
            e.preventDefault();
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
                        $('#site_id').val(response.site.id);
                        $('#edit_site').val(response.site.site);
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