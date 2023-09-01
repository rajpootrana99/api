@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">{{ $purchaseOrder->task->title }}</h4>
                    </div><!--end col-->  
                </div><!--end row-->                                                              
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body invoice-head"> 
                    <div class="row">
                        <div class="col-md-4 align-self-center">                                                
                            <img src="{{ asset('assets/images/logo.jpg')}}" alt="logo-small" class="logo-sm mr-1" width="80px">                                          
                        </div><!--end col-->    
                        <div class="col-md-8">
                                
                            <ul class="list-inline mb-0 contact-detail float-right">                                                   
                                <li class="list-inline-item">
                                    <div class="pl-3">
                                        <p class="text-muted mb-0">{{ $purchaseOrder->entity->primary_phone }}</p>
                                        <p class="text-muted mb-0">{{ $purchaseOrder->entity->email }}</p>
                                        <p class="text-muted mb-0">{{ $purchaseOrder->entity->abn }}</p>
                                        <p class="text-muted mb-0">{{ $purchaseOrder->entity->phone }}</p>
                                    </div>                                                
                                </li>
                            </ul>
                        </div><!--end col-->    
                    </div><!--end row-->     
                </div><!--end card-body-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="">
                                <h6 class="mb-0"><b>Date : </b>{{ $purchaseOrder->date }}</h6>
                                <h6><b>Job # </b>{{ $purchaseOrder->task_id }}</h6>
                                <h6><b>Invoice # </b>{{ $purchaseOrder->id }}</h6>
                                <h6><b>Due Date : </b>{{ $purchaseOrder->task->requested_completion }}</h6>
                            </div>
                        </div><!--end col--> 
                        <div class="col-md-3">                                            
                            <div class="float-left">
                                <address class="font-13">
                                    <strong class="font-14">Customer</strong><br>
                                    {{ $purchaseOrder->task->entity->entity }}
                                </address>
                            </div>
                        </div><!--end col--> 
                        <div class="col-md-3">
                            <div class="">
                                <address class="font-13">
                                    <strong class="font-14">Site Address</strong><br>
                                    {{ $purchaseOrder->site_address }}
                                </address>
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
                                            <th>Qty</th> 
                                            <th>Unit Price</th>
                                            <th>Amount</th>
                                        </tr><!--end tr-->
                                    </thead>
                                    <tbody>
                                        @foreach($purchaseOrder->task->quotes as $purchaseItem)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $purchaseItem->estimate->subHeader->cost_code }}___{{ $purchaseItem->estimate->item }}</p>
                                            </td>
                                            <td>{{ $purchaseItem->description }}</td>
                                            <td>{{ $purchaseItem->qty }}</td>
                                            <td>${{ $purchaseItem->order_unit_price }}</td>
                                            <td>${{ $purchaseItem->order_total_amount }}</td>
                                        </tr><!--end tr-->
                                        @endforeach
                                        
                                        <tr>                                                        
                                            <td colspan="3" class="border-0"></td>
                                            <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                            <td class="border-0 font-14 text-dark"><b>${{ $purchaseOrder->sub_total }}</b></td>
                                        </tr><!--end tr-->
                                        <tr>
                                            <th colspan="3" class="border-0"></th>                                                        
                                            <td class="border-0 font-14 text-dark"><b>Tax</b></td>
                                            <td class="border-0 font-14 text-dark"><b>${{ $purchaseOrder->tax }}</b></td>
                                        </tr><!--end tr-->
                                        <tr class="bg-black text-white">
                                            <th colspan="3" class="border-0"></th>                                                        
                                            <td class="border-0 font-14"><b>Total</b></td>
                                            <td class="border-0 font-14"><b>${{ $purchaseOrder->total }}</b></td>
                                        </tr><!--end tr-->
                                    </tbody>
                                </table><!--end table-->
                            </div>  <!--end /div-->                                          
                        </div>  <!--end col-->                                      
                    </div><!--end row-->

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h5 class="mt-4">Terms And Condition :</h5>
                            <ul class="pl-3">
                                <li><small class="font-12">All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                <li><small class="font-12">To be paid by cheque or credit card or direct payment online.</small ></li>
                                <li><small class="font-12"> If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</small></li>                                            
                            </ul>
                        </div> <!--end col-->                                       
                        <div class="col-lg-6 align-self-end">
                            <div class="float-right" style="width: 30%;">
                                <small>Account Manager</small>
                                <img src="{{ asset('assets/images/signature.png') }}" alt="" class="mt-2 mb-1" height="15">
                                <p class="border-top">Signature</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                            <div class="text-center"><small class="font-12">Thank you very much for doing business with us.</small></div>
                        </div><!--end col-->
                        <div class="col-lg-12 col-xl-4">
                            <div class="float-right d-print-none">
                                <a href="javascript:window.print()" class="btn btn-soft-info btn-sm">Print</a>
                                <a href="#" class="btn btn-soft-primary btn-sm">Email</a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

</div><!-- container -->

<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchTasks();

        function fetchTasks() {
            $.ajax({
                type: "GET",
                url: "fetchTasks",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.tasks, function(key, task) {
                        $('tbody').append('<tr>\
                            <td>' + task.id + '</td>\
                            <td><a href="/quote/'+task.id+'">' + task.site.site+'-'+task.title + '</a></td>\
                            <td><button value="' + task.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

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

    });
</script>
@endsection