@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <input type="hidden" id="task_id_for_quote" value="{{$task->id}}">
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
                    <div class="card-title row">
                        <h3>{{$task->site->site}} - {{$task->title}}</h3>
                    </div>
                    <div class="row" style="position:absolute; top:10px; right: 20px;">
                        <a href="" data-toggle="modal" data-target="#addQuote" id="addQuoteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Order </a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="" class="btn btn-primary" style="float:left;margin-left: 10px">Orders by Job</a>
                            <a href="{{route('enquiry.index')}}" class="btn btn-primary" style="float:left;margin-left: 10px">Orders By </a>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Cost Code</th>
                                    <th>Descritpion</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Budget</th>
                                    <th>Value Ordered</th>
                                    <th>Balance</th>
                                    <th>Capture Savings</th>
                                    <th>Movement</th>
                                    <th width="3%">Modify</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td id="total_qty"></td>
                                    <td id="total_rate"></td>
                                    <td id="total_budget"></td>
                                    <td id="total_value_ordered"></td>
                                    <td id="total_balance"></td>
                                    <td colspan="3"></td>
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

        fetchQuotes();

        function fetchQuotes() {
            var quote_id = $('#task_id_for_quote').val();
            $.ajax({
                type: "GET",
                url: '/fetchQuotes/' + quote_id,
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    var total_qty = 0;
                    var total_rate = 0;
                    var total_budget = 0;
                    var total_balance = 0;
                    var total_value_ordered = 0;
                    var i = 0;
                    $.each(response.headers, function(key, header) {
                        $('tbody').append('<tr style="background:#F96D22; color: #fff">\
                            <td></td>\
                            <td colspan="11"><strong>' + header.major_code + '___' + header.header + '</strong></td>\
                        </tr>');
                        $.each(header.sub_headers, function(key, subHeader) {
                            var sub_header_total_budget = 0;
                            var sub_header_total_balance = 0;
                            $.each(response.quotes, function(key, quote) {
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    sub_header_total_budget += quote.amount;
                                    sub_header_total_balance += quote.subtotal;
                                }
                            });
                            $('tbody').append('<tr style="background:#c7c7c7; color: #000">\
                                <td></td>\
                                <td colspan="5"><strong>' + subHeader.cost_code + '___' + subHeader.sub_header + '</strong></td>\
                                <td><strong>' + USDollar.format(sub_header_total_budget) + '</strong></td>\
                                <td></td>\
                                <td><strong>' + USDollar.format(sub_header_total_balance) + '</strong></td>\
                                <td colspan="3"></td>\
                            </tr>');
                            $.each(response.quotes, function(key, quote) {
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    total_qty += quote.qty;
                                    total_rate += quote.rate;
                                    total_budget += quote.amount;
                                    total_balance += quote.subtotal;
                                    $('tbody').append('<tr>\
                                        <td><input type="checkbox" /></td>\
                                        <td>' + quote.estimate.sub_header.cost_code + '___' + quote.estimate.item + '</td>\
                                        <td>' + quote.description + '</td>\
                                        <td>' + quote.unit + '</td>\
                                        <td>' + quote.qty + '</td>\
                                        <td>' + USDollar.format(quote.rate) + '</td>\
                                        <td>' + USDollar.format(quote.amount) + '</td>\
                                        <td></td>\
                                        <td>' + USDollar.format(quote.subtotal) + '</td>\
                                        <td></td>\
                                        <td></td>\
                                        <td><button value="' + quote.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                                    </tr>');
                                }
                            });
                        })
                    })
                    $('#total_qty').html(total_qty);
                    $('#total_rate').html(USDollar.format(total_rate));
                    $('#total_budget').html(USDollar.format(total_budget));
                    $('#total_balance').html(USDollar.format(total_balance));
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