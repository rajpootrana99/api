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
                <form action="{{ route('purchaseOrder.add') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="card-title row">
                            <h3>{{$task->site->site}} - {{$task->title}}</h3>
                            <!-- href="{{ route('purchaseOrder.create') }}" -->
                        </div>
                        <div class="row" style="position:absolute; top:10px; right: 20px;">
                            <button type="submit" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Order </button>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="" class="btn btn-primary" style="float:left;margin-left: 10px">Orders by Job</a>
                                <a href="{{route('enquiry.index')}}" class="btn btn-primary" style="float:left;margin-left: 10px">Orders By </a>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom-control custom-switch switch-primary">
                                    <label style="padding-right: 40px; padding-top: 2px;">Simple View</label>
                                    <input type="checkbox" class="custom-control-input" id="view">
                                    <label class="custom-control-label" for="view">Detailed View</label>
                                </div>
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
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>


<script>
    let USDollar = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    var i=1;

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchSimpleQuotes();

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
                            var sub_header_total_value_ordered = 0;
                            $.each(response.quotes, function(key, quote) {
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    sub_header_total_budget += quote.order_total_amount;
                                    sub_header_total_value_ordered += quote.amount;
                                    sub_header_total_balance += quote.amount - quote.order_total_amount;
                                }
                            });
                            $('tbody').append('<tr style="background:#fa9c69; color: #000">\
                                <td></td>\
                                <td colspan="5"><strong>' + subHeader.cost_code + '___' + subHeader.sub_header + '</strong></td>\
                                <td><strong>' + USDollar.format(sub_header_total_budget) + '</strong></td>\
                                <td><strong>' + USDollar.format(sub_header_total_value_ordered) + '</strong></td>\
                                <td><strong>' + USDollar.format(sub_header_total_balance) + '</strong></td>\
                                <td colspan="3"></td>\
                            </tr>');
                            $.each(response.quotes, function(key, quote) {
                                let balance = 0;
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    total_qty += quote.qty;
                                    total_rate += quote.rate;
                                    total_budget += quote.order_total_amount;
                                    balance = quote.amount - quote.order_total_amount;
                                    total_balance += balance;
                                    total_value_ordered += quote.amount;
                                    var capture_savings = ''
                                    if(quote.capture_savings == 1){
                                        capture_savings = 'Checked'
                                    }
                                    $('tbody').append('<tr>\
                                        <td><input type="checkbox" name="quote_id[]" value="'+quote.id+'"/></td>\
                                        <td>' + quote.estimate.sub_header.cost_code + '___' + quote.estimate.item + '</td>\
                                        <td>' + quote.description + '</td>\
                                        <td>' + quote.unit + '</td>\
                                        <td>' + quote.qty + '</td>\
                                        <td>' + USDollar.format(quote.rate) + '</td>\
                                        <td>' + USDollar.format(quote.amount) + '</td>\
                                        <td>' + USDollar.format(quote.order_total_amount) + '</td>\
                                        <td>' + USDollar.format(balance) + '</td>\
                                        <td><input class="align-center" type="checkbox" name="capture_saving_check" '+capture_savings+' id="capture_saving_check" value="'+quote.id+'" '+capture_savings+' class="capture_saving_check" /></td>\
                                        <td>' + USDollar.format(quote.movement) + '</td>\
                                        <td><button value="' + quote.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                                    </tr>');
                                }
                            });
                        })
                    });
                    $('#total_qty').html(total_qty);
                    $('#total_rate').html(USDollar.format(total_rate));
                    $('#total_budget').html(USDollar.format(total_budget));
                    $('#total_value_ordered').html(USDollar.format(total_value_ordered));
                    $('#total_balance').html(USDollar.format(total_balance));
                }
            });
        }

        function fetchSimpleQuotes() {
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
                        var flag = 0;
                        
                        $.each(header.sub_headers, function(key, subHeader) {
                            var subheaderflag = 0;
                            var sub_header_total_budget = 0;
                            var sub_header_total_balance = 0;
                            var sub_header_total_value_ordered = 0;
                            $.each(response.quotes, function(key, quote) {
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    sub_header_total_budget += quote.order_total_amount;
                                    sub_header_total_value_ordered += quote.amount;
                                    sub_header_total_balance += quote.amount - quote.order_total_amount;
                                }
                            });
                            
                            $.each(response.quotes, function(key, quote) {
                                let balance = 0;
                                if (subHeader.cost_code === quote.estimate.sub_header.cost_code) {
                                    if(flag == 0){
                                        flag = 1;
                                        $('tbody').append('<tr style="background:#F96D22; color: #fff">\
                                            <td></td>\
                                            <td colspan="11"><strong>' + header.major_code + '___' + header.header + '</strong></td>\
                                        </tr>');
                                    }
                                    if(subheaderflag == 0){
                                        subheaderflag = 1;
                                        $('tbody').append('<tr style="background:#fa9c69; color: #000">\
                                            <td></td>\
                                            <td colspan="5"><strong>' + subHeader.cost_code + '___' + subHeader.sub_header + '</strong></td>\
                                            <td><strong>' + USDollar.format(sub_header_total_budget) + '</strong></td>\
                                            <td><strong>' + USDollar.format(sub_header_total_value_ordered) + '</strong></td>\
                                            <td><strong>' + USDollar.format(sub_header_total_balance) + '</strong></td>\
                                            <td colspan="3"></td>\
                                        </tr>');
                                    }
                                    total_qty += quote.qty;
                                    total_rate += quote.rate;
                                    total_budget += quote.order_total_amount;
                                    balance = quote.amount - quote.order_total_amount;
                                    total_balance += balance;
                                    total_value_ordered += quote.amount;
                                    var capture_savings = ''
                                    if(quote.capture_savings == 1){
                                        capture_savings = 'Checked'
                                    }
                                    $('tbody').append('<tr>\
                                        <td><input type="checkbox" name="quote_id[]" value="'+quote.id+'"/></td>\
                                        <td>' + quote.estimate.sub_header.cost_code + '___' + quote.estimate.item + '</td>\
                                        <td>' + quote.description + '</td>\
                                        <td>' + quote.unit + '</td>\
                                        <td>' + quote.qty + '</td>\
                                        <td>' + USDollar.format(quote.rate) + '</td>\
                                        <td>' + USDollar.format(quote.order_total_amount) + '</td>\
                                        <td>' + USDollar.format(quote.amount) + '</td>\
                                        <td>' + USDollar.format(balance) + '</td>\
                                        <td><input class="align-center" type="checkbox" name="capture_saving_check_simple" '+capture_savings+' id="capture_saving_check_simple" value="'+quote.id+'" class="capture_saving_check_simple" /></td>\
                                        <td>' + USDollar.format(quote.movement) + '</td>\
                                        <td><button value="' + quote.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                                    </tr>');
                                }
                            });
                        })
                    });
                    $('#total_qty').html(total_qty);
                    $('#total_rate').html(USDollar.format(total_rate));
                    $('#total_budget').html(USDollar.format(total_budget));
                    $('#total_value_ordered').html(USDollar.format(total_value_ordered));
                    $('#total_balance').html(USDollar.format(total_balance));
                }
            });
        }

        $(document).on('change', '#capture_saving_check_simple', function(e) {
            e.preventDefault();
            var quote_id = $(this).val();
            $.ajax({
                type: "GET",
                url: '/captureSaving/' + quote_id,
                success: function(response) {
                    fetchSimpleQuotes();
                }
            });     
        });

        $(document).on('change', '#capture_saving_check', function(e) {
            e.preventDefault();
            var quote_id = $(this).val();
            $.ajax({
                type: "GET",
                url: '/captureSaving/' + quote_id,
                success: function(response) {
                    fetchQuotes();
                }
            });     
        });

        $(document).on('change', '#view', function(e) {
            e.preventDefault();
            if($('#view').is(":checked")){
                fetchQuotes();
            }
            else{
                fetchSimpleQuotes();
            }
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
        });
    });
</script>
@endsection