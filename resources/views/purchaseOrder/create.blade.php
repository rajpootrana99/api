@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Purchase Order</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('purchaseOrder.store')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="entity_id" class="col-sm-12 col-form-label text-left">Supplier<strong>*</strong></label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Supplier</option>
                                                </select>
                                                <span class="text-danger error-text entity_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="checkbox">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="tpar" checked>
                                                    <label class="custom-control-label" for="tpar">Report to ATO via TPAR</label>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="form-group row">
                                            <label for="message" class="col-sm-12 col-form-label text-left">Site Address</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="2" name="site_address" id="site_address"></textarea>
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row">
                                            <label for="task_id" class="col-sm-6 col-form-label text-right">Job<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <select class="select2 pl-1 form-control" name="task_id" id="task_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Job</option>
                                                </select>
                                                <span class="text-danger error-text task_id_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="po_number" class="col-sm-6 col-form-label text-right">Purchase Order Number<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" readonly id="po_number">
                                                <span class="text-danger error-text po_number_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-6 col-form-label text-right">Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" value="2023-06-19" style="width: 100%; height:30px;" name="date" id="date">
                                                <span class="text-danger error-text date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="site_start" class="col-sm-6 col-form-label text-right">Site Start</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" name="site_start" id="site_start">
                                                <span class="text-danger error-text site_start_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="promised_date" class="col-sm-6 col-form-label text-right">Amounts Are</label>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="amount_are" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="customRadio3">Tax Inclusive</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio4" name="amount_are" class="custom-control-input">
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
                                                <th width="10%">No of Units</th>
                                                <th width="10%">Unit Price</th>
                                                <th width="10%">Amount($)</th>
                                                <th width="10%">Tax Code</th>
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
                                            <label for="note" class="col-sm-12 col-form-label text-left">Notes</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="2" name="note" id="note"></textarea>
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="subtotal" class="col-sm-6 col-form-label text-right"><strong>Subtotal</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="subtotal" id="subtotal">
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="tax" class="col-sm-6 col-form-label text-right"><strong>Tax</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="tax">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="total" class="col-sm-6 col-form-label text-right"><strong>Total</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="total">
                                            </div>
                                        </div>                                                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mb-2">Email</button>
                        <button type="submit" style="float:right" class="btn btn-primary mb-2">Create</button>
                    </div>
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    var itemsCount = 1;
    itemsDetailDynamicField(itemsCount);

    fetchEstimates();
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

    function itemsDetailDynamicField(number) {
        html = '<tr>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][estimate_id]" id="estimate_id_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Cost Code"><option value="0">Select Cost Code</option></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][qty]" id="qty_' + number + '" class="form-control" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][unit_price]" id="unit_price_' + number + '" class="form-control" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][amount]" id="amount_' + number + '" class="form-control" /></td>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][tax]" id="tax_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Tax Code"><option value="10">GST 10%</option></select></td>';
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
        fetchEstimates();
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
    fetchJobs();
    fetchSupplierEntities();

    function fetchJobs() {
        $.ajax({
            type: "GET",
            url: "/fetchJobs",
            dataType: "json",
            success: function(response) {
                var task_id = $('#task_id');
                $('#task_id').children().remove().end();
                task_id.append($("<option />").val(0).text('Select Job'));
                $.each(response.jobs, function(key, job) {
                    task_id.append($("<option />").val(job.id).text(job.id + ' - ' + job.title + ' : ' + job.site.site));
                });
            }
        });
    }

    function fetchSupplierEntities() {
        $.ajax({
            type: "GET",
            url: "/fetchSupplierEntities",
            dataType: "json",
            success: function(response) {
                var entity_id = $('#entity_id');
                $('#entity_id').children().remove().end();
                entity_id.append($("<option />").val(0).text('Select Supplier'));
                $.each(response.entities, function(key, entity) {
                    entity_id.append($("<option />").val(entity.id).text(entity.entity));
                });
            }
        });
    }

    $(document).ready(function() {

        
    });
</script>
@endsection