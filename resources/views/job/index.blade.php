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
                    <div class="row mt-5">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="row">
                                    <label for="example-search-input" class="col-sm-4 col-form-label text-right">Views</label>
                                    <div class="col-sm-8">
                                        <select class="select2 pl-1 form-control" id="view_status" style="width: 100%; height:30px !important;">
                                            <option value="" disabled>Select View</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Scheduled</option>
                                            <option value="2">In Progress</option>
                                            <option value="3">Complete</option>
                                            <option value="4">Invoiced</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5"></div>
                        <div class="form-group col-sm-4">
                            <div class="row">
                                <label for="example-search-input" class="col-sm-3 col-form-label text-right">Search</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search" placeholder="Search by desc site or client" style="height: 30px" id="search-input">
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
                                    <th>Description</th>
                                    <th>Suppliers</th>
                                    <th>Job Status</th>
                                    <th>Owner</th>
                                    <th>Completed Date</th>
                                    <th>Days in Progress</th>
                                    <th>Total Sell Price</th>
                                    <th>Profit</th>
                                    <th>%</th>
                                    <th>Invoiced (ex GST)</th>
                                    <th>Remaining Invoice Amount</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8"><strong>Total</strong></td>
                                    <td id="total_quoted_price_ex_gst"></td>
                                    <td id="total_profit"></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<!-- Modal -->

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
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="task_id" id="task_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_job_status" name="job_status" id="edit_job_status" style="width: 100%; height:30px !important;">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Scheduled</option>
                                    <option value="2">In Progress</option>
                                    <option value="3">Invoiced</option>
                                    <option value="4">Complete</option>
                                </select>
                                <span class="text-danger error-text job_status_update_error"></span>
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

<script>
    $(document).ready(function() {
        var jobs;
        var total_quoted_price_ex_gst = 0;
        var total_profit = 0;

        let USDollar = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchJobs();

        $("#search-input").keyup(function() {
            $('tbody').html("");
            var val = $.trim(this.value);
            if (val.length == 0) {
                showJobs(jobs);
            }
            if (val) {
                val = val.toLowerCase();
                $.each(jobs, function(_, job) {
                    if (job.title.toLowerCase().indexOf(val) != -1) {
                        viewJobs(job);
                    }
                });
            }
        });

        function showJobs(jobs) {
            $('tbody').html("");
            $.each(jobs, function(key, job) {
                if ($('#view_status').val() == 0) {
                    if (job.job_status == 'Pending') {
                        console.log(job)
                        viewJobs(job);
                    }
                }
                if ($('#view_status').val() == 1) {
                    if (job.job_status == 'Scheduled') {
                        console.log(job)
                        viewJobs(job);
                    }
                }
                if ($('#view_status').val() == 2) {
                    if (job.job_status == 'In Progress') {
                        console.log(job)
                        viewJobs(job);
                    }
                }
                if ($('#view_status').val() == 3) {
                    if (job.job_status == 'Invoiced') {
                        console.log(job)
                        viewJobs(job);
                    }
                }
                if ($('#view_status').val() == 4) {
                    if (job.job_status == 'Complete') {
                        console.log(job)
                        viewJobs(job);
                    }
                }
            });
            $('#total_quoted_price_ex_gst').html(USDollar.format(total_quoted_price_ex_gst));
            $('#total_profit').html(USDollar.format(total_profit));
        }

        function viewJobs(job) {
            var invoiced = 0;
            $.each(job.invoices, function(key, invoice) {
                invoiced += parseFloat(invoice.sub_total);
            })
            var status = '';
            if (job.job_status === "Scheduled") {
                status = '<span class="badge badge-primary">' + job.job_status + '</span>';
            } else if (job.job_status === "Complete") {
                status = '<span class="badge badge-success">' + job.job_status + '</span>';
            } else if (job.job_status === "Invoiced") {
                status = '<span class="badge badge-info">' + job.job_status + '</span>';
            } else if (job.job_status === "In Progress") {
                status = '<span class="badge badge-warning">' + job.job_status + '</span>';
            } else {
                status = '<span class="badge badge-secondary">' + job.job_status + '</span>';
            }

            var quoted_price_ex_gst = 0;
            var profit = 0;
            $.each(job.quotes, function(key, quote) {
                quoted_price_ex_gst += quote.subtotal;
                profit += quote.subtotal - quote.amount;
            })
            total_quoted_price_ex_gst += quoted_price_ex_gst;
            total_profit += profit;
            var name = "No Client";
            if (job.user_id != null) {
                name = job.user.name;
            }
            $('tbody').append('<tr>\
                <td>' + job.id + '</td>\
                <td>' + job.site.site + '</td>\
                <td>' + job.title + '</td>\
                <td> </td>\
                <td>' + status + '</td>\
                <td>' + job.entity.entity + '</td>\
                <td>' + formatDate(job.requested_completion) + '</td>\
                <td>20</td>\
                <td>' + USDollar.format(quoted_price_ex_gst) + '</td>\
                <td>' + USDollar.format(profit) + '</td>\
                <td>' + ((profit / quoted_price_ex_gst) * 100).toFixed(2) + '%</td>\
                <td>' + USDollar.format(invoiced) + '</td>\
                <td>' + USDollar.format(parseFloat(quoted_price_ex_gst) - parseFloat(invoiced)) + '</td>\
                <td><div class="dropdown d-inline-block" style="float:right;">\
                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                        <i class="las la-ellipsis-v font-20 text-muted"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                        <button value="' + job.id + '" style="border: none; background-color: #fff" class="edit_btn dropdown-item">Edit</button>\
                        <a class="dropdown-item" href="/quote/' + job.id + '">Budget</a>\
                        <a class="dropdown-item" href="/quote/' + job.id + '/edit/">Quote</a>\
                        <a class="dropdown-item" href="#">Chat</a>\
                        <a class="dropdown-item" target="_blank" href="job/' + job.id + '">Invoice</a>\
                    </div>\
                </div>\</td>\
            </tr>');
        }

        function fetchJobs() {
            $.ajax({
                type: "GET",
                url: "fetchJobs",
                dataType: "json",
                success: function(response) {
                    jobs = response.jobs;
                    showJobs(jobs);
                }
            });
        }

        $(document).on('change', '#view_status', function(e) {
            showJobs(jobs);
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var task_id = $(this).val();
            $('#editJob').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'job/' + task_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editJob').modal('hide');
                    } else {
                        var status = 0;
                        if (response.task.job_status == 'Pending') {
                            status = 0;
                        }
                        if (response.task.job_status == 'Scheduled') {
                            status = 1;
                        }
                        if (response.task.job_status == 'In Progress') {
                            status = 2;
                        }
                        if (response.task.job_status == 'Invoiced') {
                            status = 3;
                        }
                        if (response.task.job_status == 'Complete') {
                            status = 4;
                        }
                        $('#task_id').val(task_id);
                        $('.edit_job_status').val(status).change();
                        $('#editJobLabel').text(response.task.title);
                    }
                }
            });
        });

        $(document).on('submit', '#editJobForm', function(e) {
            e.preventDefault();
            var task_id = $('#task_id').val();
            let EditFormData = new FormData($('#editJobForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "job/" + task_id,
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

    });
</script>
@endsection