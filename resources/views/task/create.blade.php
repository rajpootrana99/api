@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Task</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('task.store')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="site_id" id="site_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text site_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="user_id" id="user_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" placeholder="Enter Title" name="title" id="title">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text"  name="requested_completion" id="requested_completion" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Requested Completion Date">
                                    <span class="text-danger error-text requested_completion_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Item Detail</div>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 table-centered">
                                                <thead>
                                                    <tr>
                                                        <th width="3%">#</th>
                                                        <th width="30%">Description</th>
                                                        <th width="10%">Priority</th>
                                                        <th width="20%">Status</th>
                                                        <th width="20%">Progress</th>
                                                        <th width="20%">Gallery</th>
                                                        <th width="3%"><i class="fa fa-plus-circle"></i></th>
                                                        <th width="3%"><i class="fa fa-minus-circle"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemsDetailTableBody">

                                                </tbody>
                                            </table><!--end /table-->
                                        </div><!--end tableresponsive-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!-- end col -->
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" style="float:right" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    $(document).ready(function() {

        var itemsCount = 1;
        itemsDetailDynamicField(itemsCount);

        function itemsDetailDynamicField(number) {
            html = '<tr>';
            html += '<td>' + number + '</td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][priority]" id="priority_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Priority"><option value="0">Low</option><option value="1">Medium</option><option value="2">High</option><option value="3">Urgent</option></select></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][status]" id="status_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Status"><option value="0">Pending</option><option value="1">Quoting</option><option value="2">Awaiting Approval</option><option value="3">Scheduled</option><option value="4">Complete</option><option value="5">Invoiced</option><option value="6">Cancelled</option></select></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][progress]" id="progress_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Progress"><option value="0">Quote</option><option value="1">Order</option></select></td>';
            html += '<td><div class="custom-file"><input type="file" multiple class="custom-file-input" style="width: 100%; height:30px;" name="items[' + number + '][image][]" id="images_' + number + '"><label class="custom-file-label" for="image">Choose file</label></div></td>';
            if (number > 1) {
                html += '<td><button style="border: none; background-color: #fff" name="addItems" id="addItems"><i class="fa fa-plus-circle"></i></button></td>';
                html += '<td><button style="border: none; background-color: #fff" name="removeItems" id="removeItems"><i class="fa fa-minus-circle"></i></button></td></tr>';
                $('#itemsDetailTableBody').append(html);
            } else {
                html += '<td><button style="border: none; background-color: #fff" name="addItems" id="addItems"><i class="fa fa-plus-circle"></i></button></td>';
                html += '<td></td></tr>';
                $('#itemsDetailTableBody').html(html);

            }
        }

        $(document).on('click', '#addItems', function(e) {
            e.preventDefault();
            itemsCount++;
            itemsDetailDynamicField(itemsCount);
        });
        $(document).on('click', '#removeItems', function(e) {
            e.preventDefault();
            itemsCount--;
            $(this).closest("tr").remove();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        fetchSites();
        fetchClients();

        function fetchSites() {
            $.ajax({
                type: "GET",
                url: "/fetchSites",
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

        function fetchClients() {
            $.ajax({
                type: "GET",
                url: "/fetchClients",
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
            fetchSites();
            fetchClients();
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