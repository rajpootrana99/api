@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col-8">
                        <h4 class="page-title">Purchase Order</h4>
                    </div><!--end col-->
                    <div class="col-4">
                    <a href="{{ route('purchaseOrder.create') }}" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Purchase Order </a>
                    </div>
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="supplier_id">Select Supplier</label>
                                <select class="select2 form-control" name="supplier_id" id="supplier_id">
                                    <option value="" disabled selected>Select Supplier</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="issued_from">Issued from</label>
                                <input type="date" class="form-control" style="height: 30px" id="issued_from">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="issued_to">Issued to</label>
                                <input type="date" class="form-control" style="height: 30px" id="issued_to">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="search_text">Search</label>
                                <input type="search" class="form-control" style="height: 30px" id="search_text">
                            </div>
                        </div>
                    </div>
                    <strong><a href="" style="float:right; margin-left: 10px">Reset</a></strong>
                </div><!--end card-header-->
                <div class="card-body">
                <p href="" style="float:right; margin-left: 10px"><strong>Total Amount $0.00</strong></p>
                    <p href="" style="float:right; margin-left: 10px">Total Amount $0.00</p>
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>PO Number</th>
                                    <th>Supplier</th>
                                    <th>Amount($)</th>
                                    <th>Sent</th>
                                    <th>Site Start</th>
                                    <th>Job No</th>
                                    <th>Site Name</th>
                                    <th><i class="las la-ellipsis-v font-20 text-muted"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td id="total_amount"></td>
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

<script>
    let USDollar = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    });

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchPurchaseOrders();

        function fetchPurchaseOrders() {
            $.ajax({
                type: "GET",
                url: "fetchPurchaseOrders",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.purchaseOrders, function(key, purchaseOrder) {
                        $('tbody').append('<tr>\
                            <td>' + purchaseOrder.date + '</td>\
                            <td>' + purchaseOrder.id + '</td>\
                            <td>' + purchaseOrder.entity.entity + '</td>\
                            <td>' + purchaseOrder.total + '</td>\
                            <td>' + purchaseOrder.date + '</td>\
                            <td>' + purchaseOrder.site_start + '</td>\
                            <td>' + purchaseOrder.task_id + '</td>\
                            <td>' + purchaseOrder.task.site.site + '</td>\
                            <td><div class="dropdown d-inline-block" style="float:right;">\
                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                    <i class="las la-ellipsis-v font-20 text-muted"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                    <a class="dropdown-item" href="#">Edit</a>\
                                    <a class="dropdown-item" href="purchaseOrder/'+purchaseOrder.id+'">Invoice</a>\
                                </div>\
                            </div>\</td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchQuoteTasks() {
            $.ajax({
                type: "GET",
                url: "fetchQuoteTasks",
                dataType: "json",
                success: function(response) {
                    var task_id = $('#task_id');
                    $('#task_id').children().remove().end();
                    task_id.append($("<option />").val(0).text('Select Task'));
                    $.each(response.tasks, function(task) {
                        task_id.append($("<option />").val(response.tasks[task].id).text(response.tasks[task].title));
                    });
                }
            });
        }

        function fetchClients() {
            $.ajax({
                type: "GET",
                url: "fetchClients",
                dataType: "json",
                success: function(response) {
                    var user_id = $('#user_id');
                    $('#user_id').children().remove().end();
                    user_id.append($("<option />").val(0).text('Select Client'));
                    $.each(response.users, function(user) {
                        user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                    });
                }
            });
        }

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var enquiry_id = $(this).val();
            $('#deleteEnquiry').modal('show');
            $('#enquiry_id').val(enquiry_id);
        });

        $(document).on('submit', '#deleteEnquiryForm', function(e) {
            e.preventDefault();
            var enquiry_id = $('#enquiry_id').val();

            $.ajax({
                type: 'delete',
                url: 'enquiry/' + enquiry_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteEnquiry').modal('hide');
                    } else {
                        fetchEnquiries();
                        $('#deleteEnquiry').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var enquiry_id = $(this).val();
            $('#editEnquiry').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'enquiry/' + enquiry_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editEnquiry').modal('hide');
                    } else {
                        var edit_site_id = $('#edit_site_id');
                        var edit_user_id = $('#edit_user_id');
                        var status = 0;
                        var priority = 0;
                        if (response.enquiry.priority == 'Low') {
                            priority = 1;
                        }
                        if (response.enquiry.priority == 'High') {
                            priority = 2;
                        }
                        if (response.enquiry.status == 'Completed') {
                            status = 2;
                        }
                        if (response.enquiry.status == 'Review') {
                            status = 1;
                        }
                        $('#editEnquiryLabel').text('enquiry ID ' + response.enquiry.id);
                        $('#edit_site_id').children().remove().end();
                        edit_site_id.append($("<option />").val(0).text('Select Site'));
                        $.each(response.sites, function(site) {
                            edit_site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
                        });
                        $('#edit_user_id').children().remove().end();
                        edit_user_id.append($("<option />").val(0).text('Select Client'));
                        $.each(response.users, function(user) {
                            edit_user_id.append($("<option />").val(response.users[user].id).text(response.users[user].name));
                        });
                        $('#enquiry_id').val(response.enquiry.id);
                        $('.edit_site_id').val(response.enquiry.site_id).change();
                        $('.edit_user_id').val(response.enquiry.user_id).change();
                        $('#edit_description').val(response.enquiry.description);
                        $('.edit_status').val(status).change();
                        $('.edit_priority').val(priority).change();
                        $('#edit_quoted_price_ex_gst').val(response.enquiry.quoted_price_ex_gst);
                        $('#edit_completed_date').val(response.enquiry.completed_date);
                        $('#edit_type').val(response.enquiry.type);
                        $('#edit_requested_by').val(response.enquiry.requested_by);
                        $('#edit_requested_completion').val(response.enquiry.requested_completion);
                        $('#edit_quote_type').val(response.enquiry.quote_type);
                        $('#edit_profit').val(response.enquiry.profit);

                    }
                }
            });
        });

        $(document).on('submit', '#editEnquiryForm', function(e) {
            e.preventDefault();
            var enquiry_id = $('#enquiry_id').val();
            let EditFormData = new FormData($('#editEnquiryForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "enquiry/" + enquiry_id,
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

        $(document).on('click', '#addEnquiryButton', function(e) {
            e.preventDefault();
            fetchQuoteTasks();
            $(document).find('span.error-text').text('');
        });

        $(document).on('submit', '#addEnquiryForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addEnquiryForm')[0]);
            $.ajax({
                type: "post",
                url: "enquiry",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addEnquiry').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addEnquiryForm')[0].reset();
                        $('#addEnquiry').modal('hide');
                        fetchEnquiries();
                    }
                },
                error: function(error) {
                    $('#addEnquiry').modal('show')
                }
            });
        });
    });
</script>
@endsection