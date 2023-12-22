@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col-8">
                        <h4 class="page-title">Invoice</h4>
                    </div><!--end col-->
                    <div class="col-4">
                        <a href="{{ route('invoice.create') }}" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Invoice </a>
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
                                <label for="client_id">Select Client</label>
                                <select class="select2 form-control" onchange="search()" name="entity_id" id="entity_id">
                                    <option value="" disabled selected>Select Client</option>
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
                    <strong><a href="javascript:void(0)" style="float:right; margin-left: 10px" onclick="clearFilters()">Reset</a></strong>
                </div><!--end card-header-->
                <div class="card-body">
                    <p href="" style="float:right; margin-left: 10px"><strong>Total Amount $0.00</strong></p>
                    <p href="" style="float:right; margin-left: 10px">Total Amount $0.00</p>
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer PO Number</th>
                                    <th>Client</th>
                                    <th>Amount($)</th>
                                    <th>Sent</th>
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
    var invoices, clients;

    fetchClientEntities();

    function fetchClientEntities() {
        $.ajax({
            type: "GET",
            url: "/fetchClientEntities",
            dataType: "json",
            success: function(response) {
                clients = response.entities;
                showClients(clients);
            }
        });
    }

    function showClients(clients) {
        var entity_id = $('#entity_id');
        $('#entity_id').children().remove().end();
        entity_id.append($("<option />").text('Select Client').prop({
            selected: true,
            disabled: true
        }));
        $.each(clients, function(key, entity) {
            entity_id.append($("<option />").val(entity.id).text(entity.entity));
        });
    }

    const clientDropdown = document.getElementById("entity_id");
    const issuedFromDateInput = document.getElementById("issued_from");
    const issuedToDateInput = document.getElementById("issued_to");
    const searchTextInput = document.getElementById("search_text");

    issuedFromDateInput.addEventListener("change", search);
    issuedToDateInput.addEventListener("change", search);
    searchTextInput.addEventListener("keyup", search);

    function search() {
        // Get selected client
        const selectedClient = clientDropdown;

        // Get date values for Issued From and Issued To
        const issuedFromDate = issuedFromDateInput.value;
        const issuedToDate = issuedToDateInput.value;

        // Get search text
        const searchText = searchTextInput.value.toLowerCase();

        // Convert date inputs to Date objects
        const fromDate = new Date(issuedFromDate);
        const toDate = new Date(issuedToDate);

        // Filter the data based on the selected client, date range, and search text
        var filterInvoices = [];
        $.each(invoices, function(key, invoice) {
            const issuedDate = new Date(invoice.issue_date);
            if ((selectedClient.selectedIndex == 0 || invoice.entity_id == selectedClient.value) &&
                (!issuedFromDate || issuedDate >= fromDate) &&
                (!issuedToDate || issuedDate <= toDate) &&
                (invoice.task.title.toLowerCase().includes(searchText))) {
                filterInvoices.push(invoice);
            }
        });
        // Display the filtered results
        displayResults(filterInvoices);
    }

    function displayResults(results) {
        // Display the results
        if (results.length >= 0) {
            var total_amount = 0;
            $('tbody').html("");
            $.each(results, function(key, invoice) {
                total_amount = total_amount + parseFloat(invoice.total);
                $('tbody').append('<tr>\
                            <td>' + formatDate(invoice.issue_date) + '</td>\
                            <td>' + invoice.customer_po_number + '</td>\
                            <td>' + invoice.entity.entity + '</td>\
                            <td>' + USDollar.format(invoice.total) + '</td>\
                            <td></td>\
                            <td>' + invoice.task_id + '</td>\
                            <td>' + invoice.task.site.site + '</td>\
                            <td><div class="dropdown d-inline-block" style="float:right;">\
                                <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                    <i class="las la-ellipsis-v font-20 text-muted"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                    <a class="dropdown-item" href="invoice/' + invoice.id + '/edit">Edit</a>\
                                    <a class="dropdown-item" target="_blank" href="invoice/' + invoice.id + '">View</a>\
                                </div>\
                            </div>\</td>\
                    </tr>');
            });
            $('#total_amount').text(USDollar.format(total_amount));
        }
    }

    function clearFilters() {
        // Clear all input fields and trigger a search to show all results
        showClients(clients);
        issuedFromDateInput.value = "";
        issuedToDateInput.value = "";
        searchTextInput.value = "";

        displayResults(invoices);
    }

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchInvoices();

        function fetchInvoices() {
            $.ajax({
                type: "GET",
                url: "fetchInvoices",
                dataType: "json",
                success: function(response) {
                    invoices = response.invoices;
                    displayResults(invoices);
                }
            });
        }
    });
</script>
@endsection