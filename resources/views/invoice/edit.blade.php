@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Edit Invoice</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('invoice.update', ['invoice' => $invoice->id ])}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="entity_id" class="col-sm-12 col-form-label text-left">Customer<strong>*</strong></label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Customer</option>
                                                </select>
                                                <span class="text-danger error-text entity_id_error"></span>
                                            </div>
                                        </div>                        
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="inoice_id" class="col-sm-6 col-form-label text-right">Invoice Number<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" readonly value="{{ $invoice->id }}">
                                                <span class="text-danger error-text inoice_id_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="customer_po_number" class="col-sm-6 col-form-label text-right">Customer PO Number</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" value="{{ $invoice->customer_po_number }}" name="customer_po_number" >
                                                <span class="text-danger error-text customer_po_number_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="task_id" class="col-sm-6 col-form-label text-right">Job<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <select class="select2 pl-1 form-control" name="task_id" disabled onchange="fetchEstimates()" id="task_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Job</option>
                                                </select>
                                                <span class="text-danger error-text task_id_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="issue_date" class="col-sm-6 col-form-label text-right">Issue Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" name="issue_date" id="issue_date" value="{{ $invoice->issue_date }}">
                                                <span class="text-danger error-text issue_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="due_date" class="col-sm-6 col-form-label text-right">Due Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" name="due_date" id="due_date" value="{{ $invoice->due_date }}">
                                                <span class="text-danger error-text due_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="promised_date" class="col-sm-6 col-form-label text-right">Amounts Are</label>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="amount_are" value="0" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio3">Tax Inclusive</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio4" name="amount_are" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="customRadio4">Tax Exclusive</label>
                                                </div>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 table-centered">
                                        <thead>
                                            <tr>
                                                <th width="10%">Cost Code</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">Account</th>
                                                <th width="10%">Qty</th>
                                                <th width="10%">Rate</th>
                                                <th width="10%">Amount($)</th>
                                                <th width="10%">Tax Code</th>
                                                <th width="10%">Total</th>
                                                <th width="3%"><i class="fa fa-plus-circle"></i></th>
                                                <th width="3%"><i class="fa fa-minus-circle"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsDetailTableBody">

                                        </tbody>
                                    </table><!--end /table-->
                                </div><!--end tableresponsive-->
                            </div> <!-- end col -->
                            <div class="col-lg-12 mt-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="notes_to_customer" class="col-sm-12 col-form-label text-left">Note to Customer</label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="notes_to_customer" onchange="fetchNote()" id="notes_to_customer" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Std Note</option>
                                                    <option value="This is Note 1">This is Note 1</option>
                                                    <option value="This is Note 2">This is Note 2</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="form-group row">
                                            <label for="note" class="col-sm-12 col-form-label text-left">Note</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="2" name="note" id="note">{{ $invoice->note }}</textarea>
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="subtotal" class="col-sm-6 col-form-label text-right"><strong>Subtotal</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="sub_total" id="sub_total" value="{{ $invoice->sub_total }}">
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="tax" class="col-sm-6 col-form-label text-right"><strong>Tax</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="tax" name="tax" value="{{ $invoice->tax }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="total" class="col-sm-6 col-form-label text-right"><strong>Total</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="total" name="total" value="{{ $invoice->total }}">
                                            </div>
                                        </div>                                                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mb-2">Email</button>
                        <button type="submit" style="float:right" class="btn btn-primary mb-2">Save</button>
                    </div>
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    var quotes = <?php echo $invoice->quotes ?>;
    var invoice = <?php echo $invoice ?>;
    var jobList = <?php echo $jobs ?>;
    var quoteList;

    if (invoice.amount_are == 0){
        $('#customRadio3').prop("checked", true);
    }
    else{
        $('#customRadio4').prop("checked", true);
    }
    
    var itemsCount = 1;
    fetchJobs();
    fetchClientEntities();
    itemsDynamicField(itemsCount);

    function itemsDynamicField(number) {
        $.each(quotes, function(key, quote){
            itemsDetailDynamicField(number);
            number++;
            itemsCount++;
        })
    }

    function itemsDetailDynamicField(number) {
        html = '<tr class="item" >';
        html += '<td><select class="select2 form-control select-estimate" name="items[' + number + '][quote_id]" id="estimate_id_' + number + '" onchange="quoteInsert()"  style="width: 100%; height:30px;" data-placeholder="Select Cost Code"><option value="0">Select Cost Code</option></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][account]" id="account_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Account"><option value="0">Maintenance Income</option><option value="1">Construction Income</option><option value="2">Management Income</option></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][qty]" id="qty_' + number + '" onchange="calculateCost()" class="form-control qty" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][rate]" id="rate_' + number + '" onchange="calculateCost()" class="form-control rate" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][amount]" id="amount_' + number + '" readonly class="form-control amount" /></td>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][tax]" id="tax_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Tax Code"><option value="10">GST 10%</option></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][total]" id="total_' + number + '" readonly class="form-control total" /></td>';
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
        fetchEstimates()
    });
    $(document).on('click', '#removeItems', function(e) {
        e.preventDefault();
        itemsCount--;
        $(this).closest("tr").remove();
        calculateCost();
    });


    function fetchNote(){
        $('#note').text($('#notes_to_customer').val());
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fetchJobs() {
        $.ajax({
            type: "GET",
            url: "/fetchJobs",
            dataType: "json",
            success: function(response) {
                jobList = response.jobs;
                var task_id = $('#task_id');
                $('#task_id').children().remove().end();
                task_id.append($("<option />").val(0).text('Select Job'));
                $.each(response.jobs, function(key, job) {
                    task_id.append($("<option />").val(job.id).text(job.id + ' - ' + job.title + ' : ' + job.site.site));
                });
                task_id.val(<?php echo $invoice->task->id ?>).change();
            }
        });
    }

    function fetchClientEntities() {
        $.ajax({
            type: "GET",
            url: "/fetchClientEntities",
            dataType: "json",
            success: function(response) {
                var entity_id = $('#entity_id');
                $('#entity_id').children().remove().end();
                entity_id.append($("<option />").val(0).text('Select Customer'));
                $.each(response.entities, function(key, entity) {
                    entity_id.append($("<option />").val(entity.id).text(entity.entity));
                });
                entity_id.val(<?php echo $invoice->entity_id ?>).change();
            }
        });
    }

    var task = invoice.task_id;
    const estimates = document.querySelectorAll(".select-estimate")
    $.each(estimates, function(key, estimate){ 
        estimate.add(new Option('Select Cost Code', '', true, true));
        $.each(quotes, function(key, quote) {
            estimate.add(new Option(quote.estimate.subheader.cost_code + '___' + quote.estimate.item, quote.id));
        });
        estimate.value = quotes[key].id
        let i = key+1
        $('#description_' + i).val(quotes[key].pivot.description);
        $('#qty_' + i).val(quotes[key].pivot.qty);
        $('#rate_' + i).val(quotes[key].pivot.rate);
        $('#amount_' + i).val(quotes[key].pivot.amount);
        $('#account_' + i).val(quotes[key].pivot.account);
        $('#total_' + i).val(quotes[key].pivot.total);
    });

    function quoteInsert(){
        var quote_id = $('#estimate_id_' + itemsCount).val();
        $.each(quoteList, function(key, quote) {
            if(quote.id == quote_id){
                $('#description_' +itemsCount).val(quote.description);
                $('#qty_' +itemsCount).val(quote.qty);
                $('#rate_' +itemsCount).val(quote.rate);
                $('#account_' +itemsCount).val(quote.account);
                $('#amount_' +itemsCount).val(quote.amount);
                $('#total_' +itemsCount).val(quote.amount_inc_gst);
            }
        });
    }

    function fetchEstimates(){
        var estimate_id = $('#estimate_id_' + itemsCount);
        $.each(jobList, function(key, job) {
            if(job.id == task){
                quoteList = job.quotes;
                $('#estimate_id_'+itemsCount).children().remove().end();
                $('#estimate_id_'+itemsCount).append($("<option />").text('Select Cost Code'));
                $.each(job.quotes, function(key, quote) {
                    $('#estimate_id_'+itemsCount).append($("<option />").val(quote.id).text(quote.estimate.subheader.cost_code + '___' + quote.estimate.item));
                });
            }
        });
        if(quotes.length >= itemsCount){
            $('#estimate_id_'+itemsCount).val(quotes[itemsCount-1].id).change();
        }
    }

    function calculateCost() {
        let tax = 0;
        let subtotal = 0;
        let total = 0;
        document.querySelectorAll(".item").forEach((item) => {
            const quantity = parseInt(item.querySelector(".qty").value) ? parseInt(item.querySelector(".qty").value) : 0;
            const rate = parseFloat(item.querySelector(".rate").value) ? parseFloat(item.querySelector(".rate").value) : 0;
            subtotal += quantity * rate
            const itemTax = ((quantity * rate)/100)*10;
            tax += itemTax;
            total = subtotal+tax;
            const amount = quantity * rate;
            const item_total = amount + ((amount/100)*10)
            item.querySelector(".amount").value = amount.toFixed(2);
            item.querySelector(".total").value = item_total.toFixed(2);
        });
        $('#sub_total').val(subtotal);
        $('#tax').val(tax);
        $('#total').val(total);
    }

    
    itemsDetailDynamicField(itemsCount);

    $(document).ready(function() {

    });
</script>
@endsection