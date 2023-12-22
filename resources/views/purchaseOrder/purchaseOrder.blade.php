<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Maintenance App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Maintenance App" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Jquery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container" style="width: 60vw;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 align-self-end">
                        <h6 class="mb-0 issueDate"></h6>
                        <h6><b>Job # </b>{{ $purchaseOrder->task_id }}</h6>
                        <h6><b>Purchase Order # </b>{{ $purchaseOrder->id }}</h6>
                        <h6 class="siteStart"></h6>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="float-right">
                            <img src="{{ asset('assets/images/logo.jpg')}}" alt="logo-small" class="logo-sm mr-1" width="150px">
                            <h6 class="mb-0"><strong>Phone: </strong>{{ $purchaseOrder->entity->primary_phone }}</h6>
                            <h6 class="mb-0"><strong>Email: </strong>{{ $purchaseOrder->entity->email }}</h6>
                            <h6 class="mb-0"><strong>ABN: </strong>{{ $purchaseOrder->entity->abn }}</h6><br><br>
                        </div>
                    </div>
                </div><!--end row-->
            </div><!--end card-body-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="float-left">
                            <h6 class="font-14 text-center" style="background-color: #F96D22; color: #fff; padding: 1% 0%; width: 300px">Supplier</h6>
                            <p class="mb-0">{{ $purchaseOrder->entity->entity }}</p>
                            <p>{{ $purchaseOrder->entity->address }}</p>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="float-right">
                            <h6 class="font-14 text-center" style="background-color: #F96D22; color: #fff; padding: 1% 0%; width: 300px">Site Address</h6>
                            <p class="mb-0">{{ $purchaseOrder->task->site->site }}</p>
                            <p>{{ $purchaseOrder->task->site->site_address }}, {{ $purchaseOrder->task->site->suburb }}, {{ $purchaseOrder->task->site->state }}, {{ $purchaseOrder->task->site->post_code }}</p>
                        </div>
                    </div> <!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive project-invoice">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>No of Units</th>
                                        <th>Unit Price</th>
                                        <th>Amount</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    @foreach($purchaseOrder->quotes as $quote)
                                    <tr>
                                        <td>
                                            <p class="mb-0">{{ $quote->estimate->subHeader->cost_code }}___{{ $quote->estimate->item }}</p>
                                        </td>
                                        <td>{{ $quote->description }}<br>{{ $quote->pivot->description }}</td>
                                        <td>{{ $quote->pivot->qty }}</td>
                                        <td>${{ $quote->pivot->rate }}</td>
                                        <td>${{ $quote->pivot->amount }}</td>
                                        <td>{{ $quote->pivot->tax }}%</td>
                                        <td>${{ $quote->pivot->total }}</td>
                                    </tr><!--end tr-->
                                    @endforeach

                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="border-0 font-14"><b>Sub Total</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0 font-14"><b id="subtotal">${{ $purchaseOrder->sub_total }}</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <th class="border-0"></th>
                                        <td class="border-0 font-14"><b>Tax</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0 font-14"><b id="tax">${{ $purchaseOrder->tax }}</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                    </tr><!--end tr-->
                                    <tr class="bg-white text-black">
                                        <th class="border-0"></th>
                                        <td class="border-0 font-14 text-dark"><b>Total</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0 font-14 text-dark"><b id="total">${{ $purchaseOrder->total }}</b></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                    </tr><!--end tr-->
                                </tbody>
                            </table><!--end table-->
                        </div> <!--end /div-->
                    </div> <!--end col-->
                </div><!--end row-->

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h5 class="mt-4">Note to Supplier :</h5>
                        <p>{{ $purchaseOrder->note }}</p>
                    </div> <!--end col-->
                </div><!--end row-->
                <hr>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12 col-xl-6 ml-auto align-self-center">
                        <div class="text-center"><small class="font-12">Thank you very much for doing business with us.</small></div>
                    </div><!--end col-->
                    <div class="col-lg-12 col-xl-6">
                        <div class="float-right d-print-none">
                            <a href="javascript:window.print()" class="btn btn-soft-info btn-sm">Print</a>
                            <a href="{{ route('purchaseOrder.emailPurchaseOrder', ['purchaseOrder' => $purchaseOrder->id]) }}" class="btn btn-soft-primary btn-sm">Email</a>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
    <script>
        const purchaseOrder = <?php echo $purchaseOrder; ?>;
        const issueDate = purchaseOrder.date;
        const siteStart = purchaseOrder.site_start;
        $('.issueDate').html('<b>Date: </b>' + formatDate(issueDate));
        $('.siteStart').html('<b>Expected Site Start: </b>' + formatDate(siteStart));

        function formatDate(inputDate) {
            // Convert the input date string to a Date object
            const date = new Date(inputDate);

            // Check if the date is valid
            if (isNaN(date)) {
                return "Invalid date";
            }

            // Array of month names to convert month number to month name abbreviation
            const monthNames = [
                "jan", "feb", "mar", "apr", "may", "jun",
                "jul", "aug", "sep", "oct", "nov", "dec"
            ];

            // Get the day, month, and year
            const day = date.getDate().toString().padStart(2, '0'); // Ensure two digits for day
            const month = monthNames[date.getMonth()]; // Get the month abbreviation
            const year = date.getFullYear().toString().slice(-2); // Get the last two digits of the year

            // Construct the formatted date
            const formattedDate = `${day}-${month}-${year}`;

            return formattedDate;
        }
    </script>
    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.analytics_dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-upload.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('assets/pages/jquery.forms-advanced.js')}}"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
            $('.custom-file-input').css('overflow', 'hidden');
        });
    </script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- socket.io cdn -->
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>

</body>

</html>