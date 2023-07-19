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
                <form method="post" action="{{route('task.store')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="supplier_id" class="col-sm-12 col-form-label text-left">Supplier<strong>*</strong></label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="supplier_id" id="supplier_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Supplier</option>
                                                </select>
                                                <span class="text-danger error-text supplier_id_error"></span>
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
                                            <label for="message" class="col-sm-12 col-form-label text-left">Shipping Address</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="2" id="message"></textarea>
                                            </div>
                                        </div>                             
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row">
                                            <label for="job_id" class="col-sm-6 col-form-label text-right">Job<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <select class="select2 pl-1 form-control" name="job_id" id="job_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Job</option>
                                                </select>
                                                <span class="text-danger error-text job_id_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="po_number" class="col-sm-6 col-form-label text-right">Purchase Order Number<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="po_number" id="po_number">
                                                <span class="text-danger error-text po_number_error"></span>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="issue_date" class="col-sm-6 col-form-label text-right">Issue Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" value="2023-06-19" style="width: 100%; height:30px;" id="issue_date">
                                                <span class="text-danger error-text issue_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="promised_date" class="col-sm-6 col-form-label text-right">Promised Date</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" id="promised_date">
                                                <span class="text-danger error-text promised_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="promised_date" class="col-sm-6 col-form-label text-right">Amounts Are</label>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="tax" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="customRadio3">Tax Inclusive</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio4" name="tax" class="custom-control-input">
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
                                                <th width="10%">Item</th>
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
                                            <label for="message" class="col-sm-12 col-form-label text-left">Notes</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="2" id="message"></textarea>
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
                                            <label for="freight" class="col-sm-6 col-form-label text-right"><strong>Freight ($)</strong></label>
                                            <div class="col-sm-6 mt-2">
                                                <strong><a href="" style="color:#F96D22 ">Set up Freight Account</a></strong>
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
                                        <div class="form-group row">
                                            <label for="amount_paid" class="col-sm-6 col-form-label text-right"><strong>Amount Paid ($)</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" style="width: 100%; height:30px;" id="amount_paid">
                                                <span class="text-danger error-text amount_paid_error"></span>
                                            </div>
                                        </div>    
                                        <div class="form-group row">
                                            <label for="balance_due" class="col-sm-6 col-form-label text-right"><strong>Balance Due</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="balance_due" id="balance_due">
                                            </div>      
                                        </div>                                                                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" style="float:right" class="btn btn-primary mb-2">Create</button>
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
            html += '<td><select class="select2 form-control" name="items[' + number + '][priority]" id="priority_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Item"><option value="0">Select Item</option></select></td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][progress]" id="progress_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Tax Code"><option value="0">GST 10%</option></select></td>';
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
        fetchEntities();

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

        function fetchEntities() {
            $.ajax({
                type: "GET",
                url: "/fetchEntities",
                dataType: "json",
                success: function(response) {
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").val(0).text('Select Entity'));
                    $.each(response.entities, function(key) {
                        entity_id.append($("<option />").val(response.entities[key].id).text(response.entities[key].entity));
                    });
                }
            });
        }
    });
</script>
@endsection