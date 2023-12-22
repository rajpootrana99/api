@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Enquiries</h4>
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
                                            <option selected value="0">Pending</option>
                                            <option value="1">Quoting</option>
                                            <option value="2">Submitted</option>
                                            <option value="3">Won</option>
                                            <option value="4">Lost</option>
                                            <option value="5">Cancelled</option>
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
                                    <th>Clients</th>
                                    <th>Status</th>
                                    <th>Quoted Price Ex GST</th>
                                    <th>Profit</th>
                                    <th>Requested By</th>
                                    <th>Requested Completion</th>
                                    <th>Quote Type</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"><strong>Total</strong></td>
                                    <td id="total_quoted_price_ex_gst"></td>
                                    <td id="total_profit"></td>
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<div class="modal fade" id="editEnquiry" tabindex="-1" role="dialog" aria-labelledby="editEnquiryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editEnquiryLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editEnquiryForm">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="task_id" id="task_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" placeholder="Enter Title" name="title" id="title">
                                <span class="text-danger error-text title_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="requested_completion" id="requested_completion" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Requested Completion Date">
                                <span class="text-danger error-text requested_completion_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="quote_type" id="quote_type" style="width: 100%; height:30px !important;">
                                    <option value="" selected disabled>Select Quote Type</option>
                                    <option value="0">Cost Plus</option>
                                    <option value="1">Do & Charge</option>
                                </select>
                                <span class="text-danger error-text quote_type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_enquiry_status" name="enquiry_status" id="edit_enquiry_status" style="width: 100%; height:30px !important;">
                                    <option value="" selected disabled>Select Enquiry Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Quoting</option>
                                    <option value="2">Submitted</option>
                                    <option value="3">Won</option>
                                    <option value="4">Lost</option>
                                    <option value="5">Cancelled</option>
                                </select>
                                <span class="text-danger error-text enquiry_status_update_error"></span>
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
    let USDollar = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    $(document).ready(function() {
        var total_quoted_price_ex_gst = 0;
        var total_profit = 0;
        var enquiries;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchEnquiries();

        $("#search-input").keyup(function() {
            $('tbody').html("");
            var val = $.trim(this.value);
            if (val.length == 0) {
                showEnquiries(enquiries);
            }
            if (val) {
                val = val.toLowerCase();
                $.each(enquiries, function(_, enquiry) {
                    if (enquiry.title.toLowerCase().indexOf(val) != -1 || enquiry.entity.entity.toLowerCase().indexOf(val) != -1) {
                        viewEnquiries(enquiry);
                    }
                });
            }
        });

        function showEnquiries(enquiries) {
            $('tbody').html("");
            $.each(enquiries, function(key, enquiry) {
                if ($('#view_status').val() == 0) {
                    if (enquiry.enquiry_status == 'Pending') {
                        viewEnquiries(enquiry);
                    }
                }
                if ($('#view_status').val() == 1) {
                    if (enquiry.enquiry_status == 'Quoting') {
                        viewEnquiries(enquiry);
                    }
                }
                if ($('#view_status').val() == 2) {
                    if (enquiry.enquiry_status == 'Submitted') {
                        viewEnquiries(enquiry);
                    }
                }
                if ($('#view_status').val() == 3) {
                    if (enquiry.enquiry_status == 'Won') {
                        viewEnquiries(enquiry);
                    }
                }
                if ($('#view_status').val() == 4) {
                    if (enquiry.enquiry_status == 'Lost') {
                        viewEnquiries(enquiry);
                    }
                }
                if ($('#view_status').val() == 5) {
                    if (enquiry.enquiry_status == 'Cancelled') {
                        viewEnquiries(enquiry);
                    }
                }
            });
            $('#total_quoted_price_ex_gst').html(USDollar.format(total_quoted_price_ex_gst));
            $('#total_profit').html(USDollar.format(total_profit));
        }

        function viewEnquiries(enquiry) {
            var status = '';
            if (enquiry.enquiry_status === "Quoting") {
                status = '<span class="badge badge-info">' + enquiry.enquiry_status + '</span>';
            } else if (enquiry.enquiry_status === "Submitted") {
                status = '<span class="badge badge-primary">' + enquiry.enquiry_status + '</span>';
            } else if (enquiry.enquiry_status === "Won") {
                status = '<span class="badge badge-success">' + enquiry.enquiry_status + '</span>';
            } else if (enquiry.enquiry_status === "Lost") {
                status = '<span class="badge badge-danger">' + enquiry.enquiry_status + '</span>';
            } else if (enquiry.enquiry_status === "Cancelled") {
                status = '<span class="badge badge-warning">' + enquiry.enquiry_status + '</span>';
            } else {
                status = '<span class="badge badge-secondary">' + enquiry.enquiry_status + '</span>';
            }

            var quoted_price_ex_gst = 0;
            var profit = 0;
            $.each(enquiry.quotes, function(key, quote) {
                quoted_price_ex_gst += quote.subtotal;
                profit += quote.subtotal - quote.amount;
            })
            total_quoted_price_ex_gst += quoted_price_ex_gst;
            total_profit += profit;
            var name = "No Client";
            if (enquiry.user_id != null) {
                name = enquiry.user.name;
            }
            $('tbody').append('<tr>\
                <td>' + enquiry.id + '</td>\
                <td>' + enquiry.site.site + '</td>\
                <td>' + enquiry.title + '</td>\
                <td>' + enquiry.entity.entity + '</td>\
                <td>' + status + '</td>\
                <td>' + USDollar.format(quoted_price_ex_gst) + '</td>\
                <td>' + USDollar.format(profit) + '</td>\
                <td>' + name + '</td>\
                <td>' + formatDate(enquiry.requested_completion) + '</td>\
                <td>' + enquiry.quote_type + '</td>\
                <td><div class="dropdown d-inline-block" style="float:right;">\
                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                        <i class="las la-ellipsis-v font-20 text-muted"></i>\
                    </a>\
                    <div style="z-index: 1 !important;" class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                        <button value="' + enquiry.id + '" style="border: none; background-color: #fff" class="edit_btn dropdown-item">Edit</button>\
                        <a class="dropdown-item" href="/convertToJob/' + enquiry.id + '">Convert to Job</a>\
                        <a class="dropdown-item" href="/quote/' + enquiry.id + '/edit/">Quote</a>\
                        <a class="dropdown-item" href="#">Chat</a>\
                    </div>\
                </div>\</td>\
            </tr>');
        }

        function fetchEnquiries() {
            $.ajax({
                type: "GET",
                url: "fetchEnquiries",
                dataType: "json",
                success: function(response) {
                    enquiries = response.enquiries;
                    total_quoted_price_ex_gst = 0;
                    total_profit = 0;
                    showEnquiries(enquiries);
                }
            });
        }

        $(document).on('change', '#view_status', function(e) {
            total_quoted_price_ex_gst = 0;
            total_profit = 0;
            showEnquiries(enquiries);
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var task_id = $(this).val();
            $('#editEnquiry').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'enquiry/' + task_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editEnquiry').modal('hide');
                    } else {
                        var status, quote_type = 0;
                        if (response.task.enquiry_status == 'Pending') {
                            status = 0;
                        }
                        if (response.task.enquiry_status == 'Quoting') {
                            status = 1;
                        }
                        if (response.task.enquiry_status == 'Submitted') {
                            status = 2;
                        }
                        if (response.task.enquiry_status == 'Won') {
                            status = 3;
                        }
                        if (response.task.enquiry_status == 'Lost') {
                            status = 4;
                        }
                        if (response.task.enquiry_status == 'Cancelled') {
                            status = 5;
                        }
                        if(response.task.quote_type == 'Cost Plus'){
                            quote_type = 0;
                        }
                        if(response.task.quote_type == 'Do & Charge'){
                            quote_type = 1;
                        }
                        $('#task_id').val(task_id);
                        $('.edit_enquiry_status').val(status).change();
                        $('#quote_type').val(quote_type).change();
                        $('#title').val(response.task.title);
                        $('#requested_completion').val(response.task.requested_completion);
                        $('#editEnquiryLabel').text(response.task.title);
                    }
                }
            });
        });

        $(document).on('submit', '#editEnquiryForm', function(e) {
            e.preventDefault();
            var task_id = $('#task_id').val();
            let EditFormData = new FormData($('#editEnquiryForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "enquiry/" + task_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editEnquiry').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editEnquiryForm')[0].reset();
                        $('#editEnquiry').modal('hide');
                        fetchEnquiries();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editEnquiry').modal('show');
                }
            });
        })

    });
</script>
@endsection