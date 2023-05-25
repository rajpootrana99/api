@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Quotes</h4>
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
                    <div class="card-title row" style="position:absolute; top:10px; right: 10px;">
                        <a href="" data-toggle="modal" data-target="#addQuote" id="addQuoteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Quote </a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <a href="" class="btn btn-primary" style="float:left;margin-left: 10px">Orders </a>
                            <a href="{{route('enquiry.index')}}" class="btn btn-primary" style="float:left;margin-left: 10px">Enquiries </a>
                            <div class="custom-control custom-checkbox" style="display:flex; padding:8px;float:left;margin-left: 30px">
                                <input type="checkbox" class="custom-control-input" id="customCheck02">
                                <label class="custom-control-label" for="customCheck02">Hide Archived Items</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="row">
                                <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search" placeholder="Search by Task Title or Store Name" id="example-search-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                    <th>Cost Code</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Margin</th>
                                    <th>Sub Total</th>
                                    <th>GST</th>
                                    <th>Ammount INC GST</th>
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
<div class="modal fade" id="addQuote" tabindex="-1" role="dialog" aria-labelledby="addQuoteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addQuoteLabel">Add Quote</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addQuoteForm">
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="description" id="description" placeholder="Enter Description">
                                <span class="text-danger error-text description_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="cost_code" id="cost_code" placeholder="Enter Cost Code">
                                <span class="text-danger error-text cost_code_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="unit" id="unit" placeholder="Enter Unit">
                                <span class="text-danger error-text unit_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="qty" id="qty" onchange="calculateCost()" placeholder="Enter Qty">
                                <span class="text-danger error-text qty_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="rate" id="rate" onchange="calculateCost()" placeholder="Enter Rate">
                                <span class="text-danger error-text rate_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="amount" id="amount" placeholder="Enter Amount" value="0" readonly>
                                <span class="text-danger error-text amount_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="margin" id="margin" onchange="calculateCost()" placeholder="Enter Margin">
                                <span class="text-danger error-text margin_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="subtotal" id="subtotal" placeholder="Enter subtotal" value="0" readonly>
                                <span class="text-danger error-text subtotal_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="gst" id="gst" onchange="calculateCost()" placeholder="Enter GST">
                                <span class="text-danger error-text gst_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="amount_inc_gst" id="amount_inc_gst" placeholder="Enter Amount inc GST" value="0" readonly>
                                <span class="text-danger error-text amount_inc_gst_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="quote_complete" id="quote_complete" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Completed Date">
                                <span class="text-danger error-text quote_complete_error"></span>
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

<div class="modal fade" id="editQuote" tabindex="-1" role="dialog" aria-labelledby="editQuoteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editQuoteLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editQuoteForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="quote_id" id="quote_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_task_id" name="task_id" id="edit_task_id" style="width: 100%; height:30px;">

                                </select>
                                <span class="text-danger error-text task_id_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="description" id="edit_description" placeholder="Enter Description">
                                <span class="text-danger error-text description_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="cost_code" id="edit_cost_code" placeholder="Enter Cost Code">
                                <span class="text-danger error-text cost_code_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="unit" id="edit_unit" placeholder="Enter Unit">
                                <span class="text-danger error-text unit_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="qty" id="edit_qty" onchange="editCalculateCost()" placeholder="Enter Qty">
                                <span class="text-danger error-text qty_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="rate" id="edit_rate" onchange="editCalculateCost()" placeholder="Enter Rate">
                                <span class="text-danger error-text rate_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="amount" id="edit_amount" placeholder="Enter Amount" value="0" readonly>
                                <span class="text-danger error-text amount_update_error"></span>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="margin" id="edit_margin" onchange="editCalculateCost()" placeholder="Enter Margin">
                                <span class="text-danger error-text margin_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="subtotal" id="edit_subtotal" placeholder="Enter subtotal" value="0" readonly>
                                <span class="text-danger error-text subtotal_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="gst" id="edit_gst" onchange="editCalculateCost()" placeholder="Enter GST">
                                <span class="text-danger error-text gst_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="amount_inc_gst" id="edit_amount_inc_gst" placeholder="Enter Amount inc GST" value="0" readonly>
                                <span class="text-danger error-text amount_inc_gst_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="quote_complete" id="edit_quote_complete" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Completed Date">
                                <span class="text-danger error-text quote_complete_update_error"></span>
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
                        <input type="hidden" id="quote_id" name="quote_id">
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

    function calculateCost(){
        var rate = $('#rate').val();
        var qty = $('#qty').val();
        var margin = $('#margin').val();
        var gst = $('#gst').val();
        var amount = parseFloat(rate)*parseFloat(qty);
        var subtotal = parseFloat(amount) + ((amount/100)*margin);
        var amount_inc_gst = parseFloat(subtotal) + parseFloat(gst);
        $('#amount').val(amount);
        $('#subtotal').val(subtotal);
        $('#amount_inc_gst').val(amount_inc_gst);
    }

    function editCalculateCost(){
        var rate = $('#edit_rate').val();
        var qty = $('#edit_qty').val();
        var margin = $('#edit_margin').val();
        var gst = $('#edit_gst').val();
        var amount = parseFloat(rate)*parseFloat(qty);
        var subtotal = parseFloat(amount) + ((amount/100)*margin);
        var amount_inc_gst = parseFloat(subtotal) + parseFloat(gst);
        $('#edit_amount').val(amount);
        $('#edit_subtotal').val(subtotal);
        $('#edit_amount_inc_gst').val(amount_inc_gst);
    }

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchQuotes();

        function fetchQuotes() {
            $.ajax({
                type: "GET",
                url: "fetchQuotes",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.quotes, function(key, quote) {
                        $('tbody').append('<tr>\
                            <td>' + quote.id + '</td>\
                            <td>' + quote.task.title + '</td>\
                            <td>' + quote.cost_code + '</td>\
                            <td>' + quote.description + '</td>\
                            <td>' + quote.unit + '</td>\
                            <td>' + quote.qty + '</td>\
                            <td>' + quote.rate + '</td>\
                            <td>' + quote.amount + '</td>\
                            <td>' + quote.margin + '</td>\
                            <td>' + quote.subtotal + '</td>\
                            <td>' + quote.gst + '</td>\
                            <td>' + quote.amount_inc_gst + '</td>\
                            <td><button value="' + quote.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + quote.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        function fetchTasks() {
            $.ajax({
                type: "GET",
                url: "fetchTasks",
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

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var quote_id = $(this).val();
            $('#deleteEnquiry').modal('show');
            $('#quote_id').val(quote_id);
        });

        $(document).on('submit', '#deleteEnquiryForm', function(e) {
            e.preventDefault();
            var quote_id = $('#quote_id').val();

            $.ajax({
                type: 'delete',
                url: 'enquiry/' + quote_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteEnquiry').modal('hide');
                    } else {
                        fetchQuotes();
                        $('#deleteEnquiry').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var quote_id = $(this).val();
            $('#editQuote').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'quote/' + quote_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editQuote').modal('hide');
                    } else {
                        var edit_task_id = $('#edit_task_id');
                        
                        $('#editQuoteLabel').text('Quote ID ' + response.quote.id);
                        $('#edit_task_id').children().remove().end();
                        edit_task_id.append($("<option />").val(0).text('Select Task'));
                        $.each(response.tasks, function(task) {
                            edit_task_id.append($("<option />").val(response.tasks[task].id).text(response.tasks[task].title));
                        });
                        $('#quote_id').val(response.quote.id);
                        $('.edit_task_id').val(response.quote.task_id).change();
                        $('#edit_description').val(response.quote.description);
                        $('#edit_cost_code').val(response.quote.cost_code);
                        $('#edit_unit').val(response.quote.unit);
                        $('#edit_qty').val(response.quote.qty);
                        $('#edit_rate').val(response.quote.rate);
                        $('#edit_amount').val(response.quote.amount);
                        $('#edit_margin').val(response.quote.margin);
                        $('#edit_subtotal').val(response.quote.subtotal);
                        $('#edit_gst').val(response.quote.gst);
                        $('#edit_amount_inc_gst').val(response.quote.amount_inc_gst);
                        $('#edit_quote_complete').val(response.quote.quote_complete);

                    }
                }
            });
        });

        $(document).on('submit', '#editQuoteForm', function(e) {
            e.preventDefault();
            var quote_id = $('#quote_id').val();
            let EditFormData = new FormData($('#editQuoteForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "quote/" + quote_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editQuote').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editQuoteForm')[0].reset();
                        $('#editQuote').modal('hide');
                        fetchQuotes();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editQuote').modal('show');
                }
            });
        })

        $(document).on('click', '#addQuoteButton', function(e) {
            e.preventDefault();
            fetchTasks();
            $(document).find('span.error-text').text('');
        });

        $(document).on('submit', '#addQuoteForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addQuoteForm')[0]);
            $.ajax({
                type: "post",
                url: "quote",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addQuote').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addQuoteForm')[0].reset();
                        $('#addQuote').modal('hide');
                        fetchQuotes();
                    }
                },
                error: function(error) {
                    $('#addQuote').modal('show')
                }
            });
        });
    });
</script>
@endsection