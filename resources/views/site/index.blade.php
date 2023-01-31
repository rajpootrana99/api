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
                        <div class="card-title mt-4">Sites
                            <a href="" data-toggle="modal" data-target="#addSite" id="addSiteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Site </a>
                        </div>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Site</th>
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
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="addSiteLabel"></h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form method="post" id="addSiteForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row"><label for="user_id" class="text-left col-form-label col-lg-8">Select User</label></div>
                                    <select class="select2 mb-3 form-control custom-select" name="user_id" id="user_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row"><label for="site" class="my-1 col-sm-3 control-label">Site Name</label></div>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="site" id="site">
                                    </div>
                                    <span class="text-danger error-text site_error"></span>
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

    <div class="modal fade" id="editSite" tabindex="-1" role="dialog" aria-labelledby="editSiteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="editSiteLabel"></h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
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
                                    <div class="row"><label for="edit_user_id" class="text-left col-form-label col-lg-8">Select User</label></div>
                                    <select class="select2 mb-3 form-control custom-select" name="user_id" id="edit_user_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text user_id_update_error"></span>
                                </div>
                            </div>
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
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetchSites();

            function fetchSites()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchSites",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.sites, function (key, site) {
                            
                            $('tbody').append('<tr>\
                            <td>'+site.id+'</td>\
                            <td>'+site.user.name+'</td>\
                            <td>'+site.site+'</td>\
                            <td><button value="'+site.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="'+site.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            function fetchUsers()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchUsers",
                    dataType: "json",
                    success: function (response) {
                        var user_id = $('#user_id');
                        $('#user_id').children().remove().end();
                        $.each(response.users, function (user) {
                            user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                        });
                    }
                });
            }

            $(document).on('click', '#addSiteButton', function (e) {
                e.preventDefault();
                fetchUsers();
                $(document).find('span.error-text').text('');
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var site_id = $(this).val();
                $('#deleteSite').modal('show');
                $('#site_id').val(site_id)
            });

            $(document).on('submit', '#deleteSiteForm', function (e) {
                e.preventDefault();
                var site_id = $('#site_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'site/'+site_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteSite').modal('hide');
                        }
                        else {
                            fetchSites();
                            $('#deleteSite').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var site_id = $(this).val();
                $('#editSite').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'site/'+site_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editSite').modal('hide');
                        }
                        else {
                            $('#editSiteLabel').text('Site ID '+response.site.id);
                            var user_id = $('#edit_user_id');
                            $('#edit_user_id').children().remove().end()
                            $.each(response.users, function (user) {
                                user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                            });
                            $('#site_id').val(response.site.id);
                            $('#edit_site').val(response.site.site);
                            $('#edit_user_id').val(response.site.user_id).change();
                        }
                    }
                });
            });

            $(document).on('submit', '#editSiteForm', function (e) {
                e.preventDefault();
                var site_id = $('#site_id').val();
                let EditFormData = new FormData($('#editSiteForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "site/"+site_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editSite').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editSiteForm')[0].reset();
                            $('#editSite').modal('hide');
                            fetchSites();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editSite').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addSiteForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addSiteForm')[0]);
                $.ajax({
                    type: "post",
                    url: "site",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addSite').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addSiteForm')[0].reset();
                            $('#addSite').modal('hide');
                            fetchSites();
                        }
                    },
                    error: function (error){
                        $('#addSite').modal('show')
                    }
                });
            });
        });
    </script>
@endsection