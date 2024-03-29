@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Estimates</h4>
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
                        <a data-toggle="modal" data-target="#addEstimate" id="addEstimateButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Estimate </a>
                        <a data-toggle="modal" data-target="#addSubHeader" id="addSubHeaderButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Sub Header </a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>Major Code</th>
                                    <th>Code</th>
                                    <th>Item</th>
                                    <th>Label</th>
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
<div class="modal fade" id="addEstimate" tabindex="-1" role="dialog" aria-labelledby="addEstimateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addEstimateLabel">Add Estimate</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addEstimateForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="header_id" id="header_id" style="width: 100%; height:30px !important;">
                                    <option value selected disabled>Select header</option>
                                </select>
                                <span class="text-danger error-text header_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="sub_header_id" id="sub_header_id" style="width: 100%; height:30px !important;">
                                    <option value selected disabled>Select header first</option>
                                </select>
                                <span class="text-danger error-text sub_header_id_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="item" id="item" placeholder="Enter Item" style="width: 100%; height:30px;">
                                <span class="text-danger error-text item_error"></span>
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
</div>

<div class="modal fade" id="addSubHeader" tabindex="-1" role="dialog" aria-labelledby="addSubHeaderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addSubHeaderLabel">Add SubHeader</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addSubHeaderForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="header_id" id="subHeader_id" style="width: 100%; height:30px !important;">

                                </select>
                                <span class="text-danger error-text header_id_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="cost_code" id="cost_code">
                        <input type="hidden" name="code" id="code">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="sub_header" id="sub_header" placeholder="Enter Sub Header" style="width: 100%; height:30px;">
                                <span class="text-danger error-text sub_header_error"></span>
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
</div>

<div class="modal fade" id="editSubHeader" tabindex="-1" role="dialog" aria-labelledby="editSubHeaderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editSubHeaderLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editSubHeaderForm">
                @csrf
                @method('PATCH')
                <input type="hidden" id="updated_sub_header_id" name="sub_header_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="header_id" id="edit_subHeader_id" style="width: 100%; height:30px !important;">

                                </select>
                                <span class="text-danger error-text header_id_update_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="cost_code" id="edit_cost_code">
                        <input type="hidden" name="code" id="edit_code">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="sub_header" id="edit_sub_header" placeholder="Enter Sub Header" style="width: 100%; height:30px;">
                                <span class="text-danger error-text sub_header_update_error"></span>
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
</div>

<div class="modal fade" id="editEstimate" tabindex="-1" role="dialog" aria-labelledby="editEstimateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editEstimateLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editEstimateForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="estimate_id" name="estimate_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="major_code" readonly id="edit_major_code" placeholder="Enter Major Code" style="width: 100%; height:30px;">
                                <span class="text-danger error-text major_code_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="cost_code" readonly id="edit_cost_code" placeholder="Enter Cost Code" style="width: 100%; height:30px;">
                                <span class="text-danger error-text cost_code_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_header_id" name="header_id" id="edit_header_id" style="width: 100%; height:30px !important;">
                                    <option value selected disabled>Select Header</option>

                                </select>
                                <span class="text-danger error-text header_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control" name="sub_header_id" id="edit_sub_header_id" style="width: 100%; height:30px !important;">
                                    <option value selected disabled>Select header first</option>
                                </select>
                                <span class="text-danger error-text sub_header_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="item" id="edit_item" placeholder="Enter Item" style="width: 100%; height:30px;">
                                <span class="text-danger error-text item_update_error"></span>
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
                        <input type="hidden" id="estimate_id" name="estimate_id">
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

        var headers, subHeaders;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchEstimates();

        function fetchEstimates() {
            $.ajax({
                type: "GET",
                url: "fetchHeaders",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.headers, function(key, header) {
                        $('tbody').append('<tr style="background:#F96D22; color: #fff; font-size: 16px;">\
                            <td><strong>' + header.major_code + '</strong></td>\
                            <td><strong>' + header.major_code + '</strong></td>\
                            <td><strong>' + header.header + '</strong></td>\
                            <td colspan="2"><strong>' + header.major_code + '___' + header.header + '</strong></td>\
                        </tr>');
                        $.each(header.sub_headers, function(key, subHeader) {
                            $('tbody').append('<tr style="background:#c7c7c7; color: #000">\
                                <td><strong>' + header.major_code + '</strong></td>\
                                <td><strong>' + subHeader.cost_code + '</strong></td>\
                                <td><strong>' + subHeader.sub_header + '</strong></td>\
                                <td><strong>' + subHeader.cost_code + '___' + subHeader.sub_header + '</strong></td>\
                                <td><button value="' + subHeader.id + '" style="border: none; background-color: transparent" class="edit_subHeader_btn"><i class="fa fa-edit"></i></button></td>\
                            </tr>');
                            $.each(subHeader.estimates, function(key, estimate) {
                                $('tbody').append('<tr>\
                                    <td>' + header.major_code + '</td>\
                                    <td>' + subHeader.cost_code + '</td>\
                                    <td>' + estimate.item + '</td>\
                                    <td>' + subHeader.cost_code + '___' + estimate.item + '</td>\
                                    <td><button value="' + estimate.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                                </tr>');
                            });
                        })
                    })
                }
            });
        }

        fetchHeaders();

        function fetchHeaders() {
            $.ajax({
                type: "GET",
                url: "/fetchHeaders",
                dataType: "json",
                success: function(response) {
                    headers = response.headers;
                }
            });
        }

        function fetchSubHeaders() {
            const header_id = $('#header_id').val();
            $.ajax({
                type: "GET",
                url: "/fetchSubHeaders/" + header_id,
                dataType: "json",
                success: function(response) {
                    var sub_header_id = $('#sub_header_id');
                    $('#sub_header_id').children().remove().end();
                    sub_header_id.append($("<option />").text('Select Sub Header').prop({
                        selected: true,
                        disabled: true
                    }));
                    console.log(response.subHeaders);
                    $.each(response.subHeaders, function(key, subHeader) {
                        sub_header_id.append($("<option />").val(subHeader.id).text(subHeader.sub_header));
                    });
                }
            });
        }

        $(document).on('change', '#header_id', function(e) {
            fetchSubHeaders();
        });

        $(document).on('change', '#subHeader_id', function(e) {
            e.preventDefault();
            $.each(headers, function(key, header) {
                if ($('#subHeader_id').val() == header.id) {
                    var code;
                    var cost_code;
                    if (header.sub_headers.length == 0) {
                        code = header.code + 1;
                        cost_code = '5-' + code.toString().padStart(4, '0');
                    } else {
                        code = header.sub_headers[header.sub_headers.length - 1].code + 1;
                        cost_code = '5-' + code.toString().padStart(4, '0');
                    }
                    $('#code').val(code)
                    $('#cost_code').val(cost_code)
                }
            });
        });

        $(document).on('change', '#edit_subHeader_id', function(e) {
            e.preventDefault();
            $.each(headers, function(key, header) {
                if ($('#edit_subHeader_id').val() == header.id) {
                    var code;
                    var cost_code;
                    if (header.sub_headers.length == 0) {
                        code = header.code + 1;
                        cost_code = '5-' + code.toString().padStart(4, '0');
                    } else {
                        code = header.sub_headers[header.sub_headers.length - 1].code + 1;
                        cost_code = '5-' + code.toString().padStart(4, '0');
                    }
                    $('#edit_code').val(code)
                    $('#edit_cost_code').val(cost_code)
                }
            });
        });

        $(document).on('click', '#addEstimateButton', function(e) {
            e.preventDefault();
            $('#addEstimate').modal('show');
            var header_id = $('#header_id');
            $('#header_id').children().remove().end();
            header_id.append($("<option />").text('Select Header').prop({
                selected: true,
                disabled: true
            }));
            $.each(headers, function(key, header) {
                header_id.append($("<option />").val(header.id).text(header.header));
            });
            $(document).find('span.error-text').text('');
        });

        $(document).on('submit', '#addEstimateForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addEstimateForm')[0]);
            $.ajax({
                type: "post",
                url: "estimate",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addEstimate').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addEstimateForm')[0].reset();
                        $('#addEstimate').modal('hide');
                        showToast(response.message, "success");
                        fetchEstimates();
                    }
                },
                error: function(error) {
                    $('#addEstimate').modal('show')
                }
            });
        });

        $(document).on('click', '#addSubHeaderButton', function(e) {
            e.preventDefault();
            $('#addEstimate').modal('hide');
            $('#addSubHeader').modal('show');
            $('#addSubHeaderForm')[0].reset();
            var header_id = $('#subHeader_id');
            $('#subHeader_id').children().remove().end();
            header_id.append($("<option />").text('Select Header').prop({
                selected: true,
                disabled: true
            }));
            $.each(headers, function(key, header) {
                header_id.append($("<option />").val(header.id).text(header.header));
            });
            $(document).find('span.error-text').text('');
        });

        $(document).on('submit', '#addSubHeaderForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addSubHeaderForm')[0]);
            $.ajax({
                type: "post",
                url: "/addSubHeader",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    console.log(response)
                    if (response.status == 0) {
                        $('#addSubHeader').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addSubHeaderForm')[0].reset();
                        $('#addSubHeader').modal('hide');
                        showToast(response.message, "success");
                        fetchEstimates();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#addSubHeader').modal('show')
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var estimate_id = $(this).val();
            $('#editEstimate').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'estimate/' + estimate_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editEstimate').modal('hide');
                    } else {
                        console.log(response)
                        $('#editEstimateLabel').text('Estimate ID ' + response.estimate.id);
                        $('#estimate_id').val(response.estimate.id);
                        var header_id = $('#edit_header_id');
                        $('#edit_header_id').children().remove().end();
                        header_id.append($("<option />").text('Select Header').prop({
                            selected: true,
                            disabled: true
                        }));
                        $.each(headers, function(key, header) {
                            header_id.append($("<option />").val(header.id).text(header.header));
                        });
                        $('#edit_header_id').val(response.estimate.sub_header.header_id).change();
                        $('#edit_major_code').val(response.estimate.sub_header.header.major_code);
                        $('#edit_cost_code').val(response.estimate.sub_header.cost_code);
                        var edit_sub_header_id = $('#edit_sub_header_id');
                        $('#edit_sub_header_id').children().remove().end();
                        edit_sub_header_id.append($("<option />").text('Select Sub Header').prop({
                            selected: true,
                            disabled: true
                        }));
                        $.each(headers, function(key, header) {
                            if (header.id == response.estimate.sub_header.header_id) {
                                $.each(header.sub_headers, function(key, sub_header) {
                                    edit_sub_header_id.append($("<option />").val(sub_header.id).text(sub_header.sub_header));
                                })
                            }
                        });
                        $('#edit_sub_header_id').val(response.estimate.sub_header_id).change();
                        $('#edit_item').val(response.estimate.item);
                    }
                }
            });
        });

        $(document).on('click', '.edit_subHeader_btn', function(e) {
            e.preventDefault();
            var sub_header_id = $(this).val();
            $('#editSubHeader').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'subHeader/' + sub_header_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editSubHeader').modal('hide');
                    } else {
                        console.log(response)
                        $('#editSubHeaderLabel').text('Sub Header ID ' + response.subHeader.id);
                        $('#updated_sub_header_id').val(response.subHeader.id);
                        var header_id = $('#edit_subHeader_id');
                        $('#edit_subHeader_id').children().remove().end();
                        header_id.append($("<option />").text('Select Header').prop({
                            selected: true,
                            disabled: true
                        }));
                        $.each(headers, function(key, header) {
                            header_id.append($("<option />").val(header.id).text(header.header));
                        });
                        $('#edit_subHeader_id').val(response.subHeader.header_id).change();
                        $('#edit_sub_header').val(response.subHeader.sub_header);
                        $('#edit_cost_code').val(response.subHeader.cost_code);
                        $('#edit_code').val(response.subHeader.code);
                    }
                }
            });
        });

        $(document).on('submit', '#editSubHeaderForm', function(e) {
            e.preventDefault();
            const sub_header_id = $('#updated_sub_header_id').val();
            let EditFormData = new FormData($('#editSubHeaderForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "subHeader/" + sub_header_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editSubHeader').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editSubHeaderForm')[0].reset();
                        $('#editSubHeader').modal('hide');
                        showToast(response.message, "success");
                        fetchEstimates();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editEstimate').modal('show');
                }
            });
        });

        $(document).on('submit', '#editEstimateForm', function(e) {
            e.preventDefault();
            var estimate_id = $('#estimate_id').val();
            let EditFormData = new FormData($('#editEstimateForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "estimate/" + estimate_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editEstimate').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editEstimateForm')[0].reset();
                        $('#editEstimate').modal('hide');
                        showToast(response.message, "success");
                        fetchEstimates();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editEstimate').modal('show');
                }
            });
        });

    });
</script>
@endsection