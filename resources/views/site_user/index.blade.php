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
                        <a href="" data-toggle="modal" data-target="#addSite" id="addSiteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> Assign Site to User </a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Sites</th>
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
                                <div class="row"><label for="user_id" class="text-left col-form-label col-lg-8">Select Users</label></div>
                                <select class="select2 mb-3 select2-multiple form-control" name="user_id[]" id="user_id" style="width: 100%; height:30px;" multiple="multiple">

                                </select>
                                <span class="text-danger error-text user_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row"><label for="site_id" class="text-left col-form-label col-lg-8">Select Sites</label></div>
                                <select class="select2 mb-3 select2-multiple form-control" name="site_id[]" id="site_id" style="width: 100%; height:30px;" multiple="multiple">

                                </select>
                                <span class="text-danger error-text site_id_error"></span>
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

<div class="modal fade" id="editSiteUser" tabindex="-1" role="dialog" aria-labelledby="editSiteUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editSiteUserLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editSiteUserForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="user_site_id" name="user_site_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row"><label for="edit_user_id" class="text-left col-form-label col-lg-8">Select Users</label></div>
                                <select class="select2 mb-3 select2-multiple pl-1 form-control" name="user_id[]" id="edit_user_id" style="width: 100%; height:30px;" multiple="multiple">

                                </select>
                                <span class="text-danger error-text user_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row"><label for="edit_site_id" class="text-left col-form-label col-lg-8">Select Sites</label></div>
                                <select class="select2 mb-3 select2-multiple pl-1 form-control" name="site_id[]" id="edit_site_id" style="width: 100%; height:30px;" multiple="multiple">

                                </select>
                                <span class="text-danger error-text site_id_update_error"></span>
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
                        <input type="hidden" id="user_site_id" name="user_site_id">
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

        fetchSiteUsers();

        function fetchSiteUsers() {
            $.ajax({
                type: "GET",
                url: "fetchSiteUsers",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.user_sites, function(key, user_site) {
                        var options = new Array();
                        let i = 0;
                        user_site.sites.forEach(function(p) {
                            options[i] = '<span class="badge badge-info">' + p.site + '</span>';
                            i = i + 1;
                        })
                        $('tbody').append('<tr>\
                            <td>' + user_site.id + '</td>\
                            <td>' + user_site.name + '</td>\
                            <td>' + options.join(' ') + '</td>\
                            <td><button value="' + user_site.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + user_site.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchUsers() {
            $.ajax({
                type: "GET",
                url: "fetchUsers",
                dataType: "json",
                success: function(response) {
                    var user_id = $('#user_id');
                    $('#user_id').children().remove().end();
                    $.each(response.users, function(user) {
                        user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
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

        $(document).on('click', '#addSiteButton', function(e) {
            e.preventDefault();
            fetchUsers();
            fetchSites();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var user_site_id = $(this).val();
            $('#deleteSite').modal('show');
            $('#user_site_id').val(user_site_id)
        });

        $(document).on('submit', '#deleteSiteForm', function(e) {
            e.preventDefault();
            var user_site_id = $('#user_site_id').val();
            $.ajax({
                type: 'delete',
                url: 'site-user/' + user_site_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteSite').modal('hide');
                    } else {
                        fetchSiteUsers();
                        $('#deleteSite').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var user_site_id = $(this).val();
            $('#editSiteUser').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'site-user/' + user_site_id + '/edit',
                success: function(response) {
                    if (response.status == 404) {
                        $('#editSiteUser').modal('hide');
                    } else {
                        $('#editSiteUserLabel').text('Site User ID ' + response.site_user.id);
                        var user_id = $('#edit_user_id');
                        $('#edit_user_id').children().remove().end()
                        $.each(response.users, function(user) {
                            user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                        });
                        var site_id = $('#edit_site_id');
                        $('#edit_site_id').children().remove().end()
                        $.each(response.sites, function(site) {
                            site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                        });
                        $('#user_site_id').val(response.site_user.id);
                        var sites = new Array();
                        $.each(response.site_user.sites, function(key, site) {
                            sites[key] = site.id;
                        });
                        $('#edit_user_id').val(response.site_user.id)
                        $('#edit_site_id').val(sites)
                    }
                }
            });
        });

        $(document).on('submit', '#editSiteUserForm', function(e) {
            e.preventDefault();
            var user_site_id = $('#user_site_id').val();
            let EditFormData = new FormData($('#editSiteUserForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "site-user/" + user_site_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editSiteUser').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editSiteUserForm')[0].reset();
                        $('#editSiteUser').modal('hide');
                        fetchSiteUsers();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editSiteUser').modal('show');
                }
            });
        })

        $(document).on('submit', '#addSiteForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addSiteForm')[0]);
            $.ajax({
                type: "post",
                url: "site-user",
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
                        fetchSiteUsers();
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