@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Quote</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('quote.store')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="header" class="control-label">Header</label>
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="header" id="header" value="{{ $task->title }}">
                                    <span class="text-danger error-text header_error"></span>
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
                                                        <th>Description</th>
                                                        <th width="20%">Cost Code</th>
                                                        <th>Unit</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <th>Margin</th>
                                                        <th>Subtotle</th>
                                                        <th>Amount Inc-GST</th>
                                                        <th>Completed Date</th>
                                                        <th width="3%"><i class="fa fa-plus-circle"></i></th>
                                                        <th width="3%"><i class="fa fa-minus-circle"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemsDetailTableBody">

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6"><strong>Total</strong></td>
                                                        <td><input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="total_amount" id="total_amount"></td>
                                                        <td><input type="hidden" name="total_tax" id="total_tax"></td>
                                                        <td ><input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="total_subtotal" id="total_subtotal"></td>
                                                        <td ><input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="total_amount_inc_gst" id="total_amount_inc_gst"></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table><!--end /table-->
                                        </div><!--end tableresponsive-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!-- end col -->
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" style="float:right" class="btn btn-primary mb-3" id="create_btn">Create</button>
                        <a href="{{ route('enquiry.index') }}" style="float:right" class="btn btn-primary mb-3" id="back_btn">Back</a>
                    </div>
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    var itemsCount = 1;
    var quotes = <?php echo $task->quotes ?>;
    if(quotes.length > 0){
        itemsDynamicField(itemsCount);
        $("#back_btn").show();
        $("#create_btn").hide();
    }
    else{
        itemsDetailDynamicField(itemsCount);
        fetchEstimates();
        $("#back_btn").hide();
        $("#create_btn").show();
    }

    function fetchEstimates() {
        $.ajax({
            type: "GET",
            url: "/fetchEstimates",
            dataType: "json",
            success: function(response) {
                var estimate_id = $('#estimate_id_' + itemsCount);
                estimate_id.children().remove().end();
                estimate_id.append($("<option />").text('Select Cost Code'));
                $.each(response.estimates, function(key, estimate) {
                    estimate_id.append($("<option />").val(estimate.id).text(estimate.sub_header.cost_code + '___' + estimate.item));
                });
            }
        });
    }

    function itemsDynamicField(number) {
        $.each(quotes, function(key, quote){
            html = '<tr>';
            html += '<td></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.description+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.estimate.sub_header.cost_code+'___'+quote.estimate.item+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.unit+'" /></td>';
            html += '<td><input type="number" style="height: 30px" class="form-control" readonly value="'+quote.qty+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.rate+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.amount+'" /></td>';
            html += '<td><input type="number" style="height: 30px" class="form-control" readonly value="'+quote.margin+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.subtotal+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.amount_inc_gst+'" /></td>';
            html += '<td><input type="text" style="height: 30px" class="form-control" readonly value="'+quote.quote_complete+'" /></td>';
            html += '<td></td>';
            html += '<td></td>';
            $('#itemsDetailTableBody').append(html);
        })
    }

    function itemsDetailDynamicField(number) {
        html = '<tr class="item">';
        html += '<td>' + number + '</td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
        html += '<td><select class="select2 form-control" name="quotes[' + number + '][estimate_id]" id="estimate_id_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Cost Code"></select></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][unit]" id="unit_' + number + '" class="form-control" /></td>';
        html += '<td><input type="number" style="height: 30px" name="quotes[' + number + '][qty]" id="qty_' + number + '" class="form-control quantity" onchange="calculateCost()" /></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][rate]" id="rate_' + number + '" class="form-control rate" onchange="calculateCost()" /></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][amount]" id="amount_' + number + '" class="form-control amount" readonly /></td>';
        html += '<td><input type="number" style="height: 30px" name="quotes[' + number + '][margin]" id="margin_' + number + '" class="form-control margin" onchange="calculateCost()" /></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][subtotal]" id="subtotal_' + number + '" class="form-control subtotal" readonly /></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][amount_inc_gst]" id="amount_inc_gst_' + number + '" class="form-control amountincgst" readonly /></td>';
        html += '<td><input type="text" style="height: 30px" name="quotes[' + number + '][quote_complete]" id="quote_complete_' + number + '" class="form-control" onfocus="(this.type=\'date\' )" onblur="(this.type=\'text\')" /></td>';
        if (number > 1) {
            html += '<td><button style="border: none; background-color: #fff" name="addItems" id="addItems"><i class="fa fa-plus-circle"></i></button></td>';
            html += '<td><button style="border: none; background-color: #fff" name="removeItems" id="removeItems"><i class="fa fa-minus-circle"></i></button></td></tr>';
            $('#itemsDetailTableBody').append(html);
        } else {
            html += '<td><button style="border: none; background-color: #fff" name="addItems" id="addItems"><i class="fa fa-plus-circle"></i></button></td>';
            html += '<td></td></tr>';
            $('#itemsDetailTableBody').append(html);
        }
    }

    $(document).on('click', '#addItems', function(e) {
        e.preventDefault();
        itemsCount++;
        itemsDetailDynamicField(itemsCount);
        fetchEstimates();
    });
    $(document).on('click', '#removeItems', function(e) {
        e.preventDefault();
        itemsCount--;
        $(this).closest("tr").remove();
        calculateCost();
    });

    function calculateCost() {
        let total_amount = 0;
        let total_tax = 0;
        let total_subtotal = 0;
        let total_amount_inc_gst = 0;
        document.querySelectorAll(".item").forEach((item) => {
            const quantity = parseInt(item.querySelector(".quantity").value) ? parseInt(item.querySelector(".quantity").value) : 0;
            const rate = parseFloat(item.querySelector(".rate").value) ? parseFloat(item.querySelector(".rate").value) : 0;
            const margin = parseFloat(item.querySelector(".margin").value) ? parseFloat(item.querySelector(".margin").value) : 0;
            const amount = rate*quantity;
            total_amount += amount
            const subtotal = amount + ((amount/100)*margin)
            total_subtotal += subtotal;
            const amountIncGst = subtotal + ((subtotal/100)*10);
            total_amount_inc_gst += amountIncGst;
            item.querySelector(".amount").value = amount.toFixed(2);
            item.querySelector(".subtotal").value = subtotal.toFixed(2);
            item.querySelector(".amountincgst").value = amountIncGst.toFixed(2);
        });
        total_tax = total_amount_inc_gst - total_subtotal;
        $('#total_amount').val(total_amount);
        $('#total_tax').val(total_tax);
        $('#total_subtotal').val(total_subtotal);
        $('#total_amount_inc_gst').val(total_amount_inc_gst);
    }
</script>
@endsection