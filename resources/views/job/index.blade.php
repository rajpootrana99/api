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
                                            <option value="7">Scheduled</option>
                                            <option value="8">In Progress</option>
                                            <option value="9">Complete</option>
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
                                    <input class="form-control" type="search" placeholder="Search by desc site or client" style="height: 30px" id="example-search-input">
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
                                    <th>Invoiced</th>
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

<script>
    $(document).ready(function() {
        var jobs;

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

        function showJobs(jobs){
            $('tbody').html("");   
            var total_quoted_price_ex_gst = 0;
            var total_profit = 0;            
            $.each(jobs, function(key, job) {
                
                console.log($('#view_status').val)
                if($('#view_status').val() == 0){
                    if(job.job_status == 'Pending'){     
                        viewEnquiries(job);
                    }
                }
                if($('#view_status').val() == 1){
                    if(job.job_status == 'Scheduled'){
                        viewEnquiries(job);
                    }
                }
                if($('#view_status').val() == 2){
                    if(job.job_status == 'In Progress'){
                        viewEnquiries(job);
                    }
                }
                if($('#view_status').val() == 3){
                    if(job.job_status == 'Complete'){
                        viewEnquiries(job);
                    }
                }
                function viewEnquiries(job){
                    var status = '';  
                    if (job.job_status === "Scheduled") {
                        status = '<span class="badge badge-primary">' + job.job_status + '</span>';
                    } else if (job.job_status === "Complete") {
                        status = '<span class="badge badge-success">' + job.job_status + '</span>';
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
                    if (job.contact_id != null) {
                        name = job.contact.user.name;
                    }
                    $('tbody').append('<tr>\
                        <td>' + job.id + '</td>\
                        <td>' + job.site.site + '</td>\
                        <td>' + job.title + '</td>\
                        <td> </td>\
                        <td>' + status + '</td>\
                        <td>' + job.entity.entity + '</td>\
                        <td>' + job.requested_completion + '</td>\
                        <td>20</td>\
                        <td>' + USDollar.format(quoted_price_ex_gst) + '</td>\
                        <td>' + USDollar.format(profit) + '</td>\
                        <td></td>\
                        <td></td>\
                        <td></td>\
                        <td><div class="dropdown d-inline-block" style="float:right;">\
                            <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                <i class="las la-ellipsis-v font-20 text-muted"></i>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                <a class="dropdown-item" href="#">Edit</a>\
                                <a class="dropdown-item" href="/quote/'+job.id+'">Budget</a>\
                                <a class="dropdown-item" href="#">Chat</a>\
                                <a class="dropdown-item" href="job/'+job.id+'">Invoice</a>\
                            </div>\
                        </div>\</td>\
                    </tr>');
                }
            });
            $('#total_quoted_price_ex_gst').html(USDollar.format(total_quoted_price_ex_gst));
            $('#total_profit').html(USDollar.format(total_profit));
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

    });
</script>
@endsection