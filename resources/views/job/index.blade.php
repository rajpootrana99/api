@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Jobs</h4>
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
                                <select class="select2 pl-1 form-control" name="site_id" id="site_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text site_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="user_id" id="user_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text user_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" placeholder="Enter Description" name="description" id="description">
                                <span class="text-danger error-text description_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="status" id="status" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="0">In Progress</option>
                                    <option value="1">Review</option>
                                    <option value="2">Completed</option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="owner" id="owner" placeholder="Enter Owner">
                                <span class="text-danger error-text owner_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="completed_date" id="completed_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Completed Date">
                                <span class="text-danger error-text completed_date_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="days_in_progress" id="days_in_progress" placeholder="Enter Days in Progress">
                                <span class="text-danger error-text days_in_progress_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="total_sell_price" id="total_sell_price" placeholder="Enter Total Sell Price">
                                <span class="text-danger error-text total_sell_price_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="profit" id="profit" placeholder="Enter Profit">
                                <span class="text-danger error-text profit_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="percentage" id="percentage" placeholder="Enter Percentage">
                                <span class="text-danger error-text percentage_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="invoiced" id="invoiced" placeholder="Enter Invoiced">
                                <span class="text-danger error-text invoiced_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="remaining_invoice_amount" id="remaining_invoice_amount" placeholder="Enter Remaining Invoice Amount">
                                <span class="text-danger error-text remaining_invoice_amount_error"></span>
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

<div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="editJobLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editJobLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editJobForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="job_id" id="job_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_site_id" name="site_id" id="edit_site_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text site_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_user_id" name="user_id" id="edit_user_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text user_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" placeholder="Enter Description" name="description" id="edit_description">
                                <span class="text-danger error-text description_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_status" name="status" id="edit_status" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="0">In Progress</option>
                                    <option value="1">Review</option>
                                    <option value="2">Completed</option>
                                </select>
                                <span class="text-danger error-text status_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="owner" id="edit_owner" placeholder="Enter Owner">
                                <span class="text-danger error-text owner_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="completed_date" id="edit_completed_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Completed Date">
                                <span class="text-danger error-text completed_date_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="days_in_progress" id="edit_days_in_progress" placeholder="Enter Days in Progress">
                                <span class="text-danger error-text days_in_progress_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="total_sell_price" id="edit_total_sell_price" placeholder="Enter Total Sell Price">
                                <span class="text-danger error-text total_sell_price_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="profit" id="edit_profit" placeholder="Enter Profit">
                                <span class="text-danger error-text profit_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="percentage" id="edit_percentage" placeholder="Enter Percentage">
                                <span class="text-danger error-text percentage_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="invoiced" id="edit_invoiced" placeholder="Enter Invoiced">
                                <span class="text-danger error-text invoiced_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="remaining_invoice_amount" id="edit_remaining_invoice_amount" placeholder="Enter Remaining Invoice Amount">
                                <span class="text-danger error-text remaining_invoice_amount_update_error"></span>
                            </div>
                        </div>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<div class="modal fade" id="deleteJob" tabindex="-1" role="dialog" aria-labelledby="deleteJobLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteJobLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteJobForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="job_id" name="job_id">
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

        fetchJobs();

        function fetchJobs() {
            $.ajax({
                type: "GET",
                url: "fetchJobs",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.jobs, function(key, job) {
                        $('tbody').append('<tr>\
                            <td>' + job.id + '</td>\
                            <td>' + job.site.site + '</td>\
                            <td>' + job.description + '</td>\
                            <td>' + job.user.name + '</td>\
                            <td>' + job.status + '</td>\
                            <td>' + job.owner + '</td>\
                            <td>' + job.completed_date + '</td>\
                            <td>' + job.days_in_progress + '</td>\
                            <td>' + job.total_sell_price + '</td>\
                            <td>' + job.profit + '</td>\
                            <td>' + job.percentage + '</td>\
                            <td>' + job.invoiced + '</td>\
                            <td>' + job.remaining_invoice_amount + '</td>\
                            <td><button value="' + job.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + job.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
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
                    site_id.append($("<option />").val(0).text('Select Site'));
                    $.each(response.sites, function(site) {
                        site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                    });
                }
            });
        }

        function fetchSuppliers() {
            $.ajax({
                type: "GET",
                url: "fetchSuppliers",
                dataType: "json",
                success: function(response) {
                    var user_id = $('#user_id');
                    $('#user_id').children().remove().end();
                    user_id.append($("<option />").val(0).text('Select Supplier'));
                    $.each(response.users, function(user) {
                        user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                    });
                }
            });
        }

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var job_id = $(this).val();
            $('#deleteJob').modal('show');
            $('#job_id').val(job_id);
        });

        $(document).on('submit', '#deleteJobForm', function(e) {
            e.preventDefault();
            var job_id = $('#job_id').val();

            $.ajax({
                type: 'delete',
                url: 'job/' + job_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteJob').modal('hide');
                    } else {
                        fetchJobs();
                        $('#deleteJob').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var job_id = $(this).val();
            $('#editJob').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'job/' + job_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editJob').modal('hide');
                    } else {
                        var edit_site_id = $('#edit_site_id');
                        var edit_user_id = $('#edit_user_id');
                        var status = 0;
                        if (response.job.status == 'Completed') {
                            status = 2;
                        }
                        if (response.job.status == 'Review') {
                            status = 1;
                        }
                        $('#editJobLabel').text('job ID ' + response.job.id);
                        $('#edit_site_id').children().remove().end();
                        edit_site_id.append($("<option />").val(0).text('Select Site'));
                        $.each(response.sites, function(site) {
                            edit_site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                        });
                        $('#edit_user_id').children().remove().end();
                        edit_user_id.append($("<option />").val(0).text('Select Supplier'));
                        $.each(response.users, function(user) {
                            edit_user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                        });
                        $('#job_id').val(response.job.id);
                        $('.edit_site_id').val(response.job.site_id).change();
                        $('.edit_user_id').val(response.job.user_id).change();
                        $('#edit_description').val(response.job.description);
                        $('.edit_status').val(status).change();
                        $('#edit_owner').val(response.job.owner);
                        $('#edit_completed_date').val(response.job.completed_date);
                        $('#edit_days_in_progress').val(response.job.days_in_progress);
                        $('#edit_total_sell_price').val(response.job.total_sell_price);
                        $('#edit_profit').val(response.job.profit);
                        $('#edit_percentage').val(response.job.percentage);
                        $('#edit_invoiced').val(response.job.invoiced);
                        $('#edit_remaining_invoice_amount').val(response.job.remaining_invoice_amount);

                    }
                }
            });
        });

        $(document).on('submit', '#editJobForm', function(e) {
            e.preventDefault();
            var job_id = $('#job_id').val();
            let EditFormData = new FormData($('#editJobForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "job/" + job_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editJob').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editJobForm')[0].reset();
                        $('#editJob').modal('hide');
                        fetchJobs();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editJob').modal('show');
                }
            });
        })

        $(document).on('click', '#addJobButton', function(e) {
            e.preventDefault();
            fetchSites();
            fetchSuppliers();
            $(document).find('span.error-text').text('');
        });

        $(document).on('submit', '#addJobForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addJobForm')[0]);
            $.ajax({
                type: "post",
                url: "job",
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
                        fetchJobs();
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