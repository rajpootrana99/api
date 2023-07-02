@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Budget</h4>
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
                        <a href="" data-toggle="modal" data-target="#addQuote" id="addQuoteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Order </a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <a href="" class="btn btn-primary" style="float:left;margin-left: 10px">Orders by Job</a>
                            <a href="{{route('enquiry.index')}}" class="btn btn-primary" style="float:left;margin-left: 10px">Orders By </a>
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
                                    <th>Descritpion</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Budget</th>
                                    <th>Value Ordered</th>
                                    <th>Balance</th>
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


<script>
    function calculateCost() {
        var rate = $('#rate').val();
        var qty = $('#qty').val();
        var margin = $('#margin').val();
        var gst = $('#gst').val();
        var amount = parseFloat(rate) * parseFloat(qty);
        var subtotal = parseFloat(amount) + ((amount / 100) * margin);
        var amount_inc_gst = parseFloat(subtotal) + parseFloat(gst);
        $('#amount').val(amount);
        $('#subtotal').val(subtotal);
        $('#amount_inc_gst').val(amount_inc_gst);
    }

    function editCalculateCost() {
        var rate = $('#edit_rate').val();
        var qty = $('#edit_qty').val();
        var margin = $('#edit_margin').val();
        var gst = $('#edit_gst').val();
        var amount = parseFloat(rate) * parseFloat(qty);
        var subtotal = parseFloat(amount) + ((amount / 100) * margin);
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