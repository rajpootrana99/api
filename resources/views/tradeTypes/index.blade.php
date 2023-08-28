@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Trade Types</h4>
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
                        <a href="" data-toggle="modal" data-target="#addTradeType" id="addTradeTypeButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Trade Type</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Trade Types</th>
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
<div class="modal fade" id="addTradeType" tabindex="-1" role="dialog" aria-labelledby="addTradeTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addTradeTypeLabel">Add Trade Type</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addTradeTypeForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="name" id="name" placeholder="Enter Name">
                                <span class="text-danger error-text name_error"></span>
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

<div class="modal fade" id="editTradeType" tabindex="-1" role="dialog" aria-labelledby="editTradeTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editTradeTypeLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editTradeTypeForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="trade_type_id" name="trade_type_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="name" id="edit_name" placeholder="Enter Name">
                                <span class="text-danger error-text name_update_error"></span>
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

<div class="modal fade" id="deleteTradeType" tabindex="-1" role="dialog" aria-labelledby="deleteTradeTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteTradeTypeLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteTradeTypeForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="trade_type_id" name="trade_type_id">
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

        fetchTradeTypes();

        function fetchTradeTypes() {
            $.ajax({
                type: "GET",
                url: "fetchTradeTypes",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.tradeTypes, function(key, tradeType) {
                        $('tbody').append('<tr>\
                            <td>' + tradeType.id + '</td>\
                            <td>' + tradeType.name + '</td>\
                            <td><button value="' + tradeType.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + tradeType.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        $(document).on('click', '#addTradeTypeButton', function(e) {
            e.preventDefault();
            $('#addTradeType').modal('show');
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var trade_type_id = $(this).val();
            $('#deleteTradeType').modal('show');
            $('#trade_type_id').val(trade_type_id)
        });

        $(document).on('submit', '#deleteTradeTypeForm', function(e) {
            e.preventDefault();
            var trade_type_id = $('#trade_type_id').val();
            $.ajax({
                type: 'delete',
                url: 'tradeType/' + trade_type_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteTradeType').modal('hide');
                    } else {
                        fetchTradeTypes();
                        $('#deleteTradeType').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var trade_type_id = $(this).val();
            $('#editTradeType').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'tradeType/' + trade_type_id + '/edit',
                success: function(response) {
                    $('#editTradeTypeLabel').text('Trade Type ID ' + response.tradeType.id);
                    $('#trade_type_id').val(response.tradeType.id);
                    $('#edit_name').val(response.tradeType.name);
                }
            });
        });

        $(document).on('submit', '#editTradeTypeForm', function(e) {
            e.preventDefault();
            var trade_type_id = $('#trade_type_id').val();
            let EditFormData = new FormData($('#editTradeTypeForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "tradeType/" + trade_type_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editTradeType').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editTradeTypeForm')[0].reset();
                        $('#editTradeType').modal('hide');
                        fetchTradeTypes();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editTradeType').modal('show');
                }
            });
        })

        $(document).on('submit', '#addTradeTypeForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addTradeTypeForm')[0]);
            $.ajax({
                type: "post",
                url: "tradeType",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addTradeType').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addTradeTypeForm')[0].reset();
                        $('#addTradeType').modal('hide');
                        fetchTradeTypes();
                    }
                },
                error: function(error) {
                    $('#addTradeType').modal('show')
                }
            });
        });
    });
</script>
@endsection