@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col-8">
                        <h4 class="page-title">Purchase Order</h4>
                    </div><!--end col-->
                    <div class="col-4">
                        <a href="{{ route('purchaseOrder.create') }}" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Purchase Order </a>
                    </div>
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="supplier_id">Select Supplier</label>
                                <select class="select2 form-control" name="supplier_id" id="supplier_id">
                                    <option value="" disabled selected>Select Supplier</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="issued_from">Issued from</label>
                                <input type="date" class="form-control" style="height: 30px" id="issued_from">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="issued_to">Issued to</label>
                                <input type="date" class="form-control" style="height: 30px" id="issued_to">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="search_text">Search</label>
                                <input type="search" class="form-control" style="height: 30px" id="search_text">
                            </div>
                        </div>
                    </div>
                    <strong><a href="" style="float:right; margin-left: 10px">Reset</a></strong>
                </div><!--end card-header-->
                <div class="card-body">
                    <p href="" style="float:right; margin-left: 10px"><strong>Total Amount $0.00</strong></p>
                    <p href="" style="float:right; margin-left: 10px">Total Amount $0.00</p>
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>PO Number</th>
                                    <th>Supplier</th>
                                    <th>Amount($)</th>
                                    <th>Sent</th>
                                    <th>Expected Site Start</th>
                                    <th>Job No</th>
                                    <th>Site Name</th>
                                    <th><i class="las la-ellipsis-v font-20 text-muted"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td id="total_amount"></td>
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

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

        fetchPurchaseOrders();

        function fetchPurchaseOrders() {
            var total_amount = 0;
            $.ajax({
                type: "GET",
                url: "fetchPurchaseOrders",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.purchaseOrders, function(key, purchaseOrder) {
                        total_amount += parseFloat(purchaseOrder.sub_total);
                        $('tbody').append('<tr>\
                            <td>' + formatDate(purchaseOrder.date) + '</td>\
                            <td>' + purchaseOrder.id + '</td>\
                            <td>' + purchaseOrder.entity.entity + '</td>\
                            <td>' + USDollar.format(purchaseOrder.sub_total) + '</td>\
                            <td></td>\
                            <td>' + formatDate(purchaseOrder.site_start) + '</td>\
                            <td>' + purchaseOrder.task_id + '</td>\
                            <td>' + purchaseOrder.task.site.site + '</td>\
                            <td><div class="dropdown d-inline-block" style="float:right;">\
                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                    <i class="las la-ellipsis-v font-20 text-muted"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                    <a class="dropdown-item" href="purchaseOrder/' + purchaseOrder.id + '/edit">Edit</a>\
                                    <a class="dropdown-item" target="_blank" href="purchaseOrder/' + purchaseOrder.id + '">Purchase Order</a>\
                                </div>\
                            </div>\</td>\
                        </tr>');
                        $('#total_amount').text(USDollar.format(total_amount));
                    });
                }
            });
        }
    });
</script>
@endsection