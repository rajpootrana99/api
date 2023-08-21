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
                                        <select class="select2 pl-1 form-control" name="status" id="status" style="width: 100%; height:30px !important;">
                                            <option value="" disabled>Select View</option>
                                            <option value="0">Pending</option>
                                            <option selected value="3">Quoting</option>
                                            <option value="4">Submitted</option>
                                            <option value="5">Won</option>
                                            <option value="6">Lost</option>
                                            <option value="2">Cancelled</option>
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
<!-- Modal -->
<div class="modal fade" id="addEnquiry" tabindex="-1" role="dialog" aria-labelledby="addEnquiryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addEnquiryLabel">Add Enquiry</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addEnquiryForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="task_id" id="task_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text task_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="status" id="status" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">In Progress</option>
                                    <option value="2">Draft</option>
                                    <option value="0">Submitted</option>
                                    <option value="1">Won</option>
                                    <option value="2">Lost</option>
                                    <option value="2">Cancelled</option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="priority" id="priority" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Priority</option>
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                    <option value="3">Urgent</option>
                                </select>
                                <span class="text-danger error-text priority_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="type" id="type" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="0">None</option>
                                    <option value="1">Low</option>
                                    <option value="2">High</option>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="quote_type" id="quote_type" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Quote Type</option>
                                    <option value="0">Fixed</option>
                                    <option value="1">Do</option>
                                    <option value="2">Charge</option>
                                </select>
                                <span class="text-danger error-text quote_type_error"></span>
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
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="enquiry_id" id="enquiry_id">
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
                        <div class="col-lg-6">
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
                                <select class="select2 pl-1 form-control edit_priority" name="priority" id="edit_priority" style="width: 100%; height:30px;">
                                    <option value="" disabled selected>Select Priority</option>
                                    <option value="0">None</option>
                                    <option value="1">Low</option>
                                    <option value="2">High</option>
                                </select>
                                <span class="text-danger error-text priority_update_error"></span>
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
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="quoted_price_ex_gst" id="edit_quoted_price_ex_gst" placeholder="Enter Quoted Price Ex GST">
                                <span class="text-danger error-text quoted_price_ex_gst_update_error"></span>
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
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="type" id="edit_type" placeholder="Enter Type">
                                <span class="text-danger error-text type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="requested_by" id="edit_requested_by" placeholder="Enter Requested By">
                                <span class="text-danger error-text requested_by_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="requested_completion" id="edit_requested_completion" placeholder="Enter Requested Completion">
                                <span class="text-danger error-text requested_completion_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="quote_type" id="edit_quote_type" placeholder="Enter Quote Type">
                                <span class="text-danger error-text quote_type_update_error"></span>
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

<div class="modal fade" id="deleteEnquiry" tabindex="-1" role="dialog" aria-labelledby="deleteEnquiryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteEnquiryLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteEnquiryForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="enquiry_id" name="enquiry_id">
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

        fetchEnquiries();

        function fetchEnquiries() {
            $.ajax({
                type: "GET",
                url: "fetchEnquiries",
                dataType: "json",
                success: function(response) {
                    var total_quoted_price_ex_gst = 0;
                    var total_profit = 0;
                    $('tbody').html("");
                    $.each(response.enquiries, function(key, enquiry) {
                        
                        var quoted_price_ex_gst = 0;
                        var profit = 0;
                        $.each(enquiry.quotes, function(key, quote) {
                            quoted_price_ex_gst += quote.subtotal;
                            profit += quote.subtotal - quote.amount;
                        })
                        total_quoted_price_ex_gst += quoted_price_ex_gst;
                        total_profit += profit;
                        var name = ' ';
                        if (enquiry.user_id != null) {
                            name = enquiry.task.user.name;
                        }
                        $('tbody').append('<tr>\
                            <td>' + enquiry.id + '</td>\
                            <td>' + enquiry.site.site + '</td>\
                            <td>' + enquiry.title + '</td>\
                            <td>' + enquiry.entity.entity + '</td>\
                            <td>' + enquiry.status + '</td>\
                            <td>' + USDollar.format(quoted_price_ex_gst) + '</td>\
                            <td>' + USDollar.format(profit) + '</td>\
                            <td>' + name + '</td>\
                            <td>' + enquiry.requested_completion + '</td>\
                            <td>' + enquiry.quote_type + '</td>\
                            <td><div class="dropdown d-inline-block" style="float:right;">\
                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                    <i class="las la-ellipsis-v font-20 text-muted"></i>\
                                </a>\
                                <div style="z-index: 1 !important;" class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                    <a class="dropdown-item" href="#">Edit</a>\
                                    <a class="dropdown-item" href="/job/'+enquiry.id+'/edit">Convert to Job</a>\
                                    <a class="dropdown-item" href="/quote/' + enquiry.id + '/edit/">Quote</a>\
                                    <a class="dropdown-item" href="#">Chat</a>\
                                </div>\
                            </div>\</td>\
                        </tr>');
                    });

                    $('#total_quoted_price_ex_gst').html(USDollar.format(total_quoted_price_ex_gst));
                    $('#total_profit').html(USDollar.format(total_profit));
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