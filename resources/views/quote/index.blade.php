@extends('layouts.base')

@section('content')
<div class="container-fluid">
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
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<!-- Modal -->


<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchJobs();

        function fetchJobs() {
            $.ajax({
                type: "GET",
                url: "fetchJobs",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.jobs, function(key, task) {
                        $('tbody').append('<tr>\
                            <td>' + task.id + '</td>\
                            <td><a href="/quote/'+task.id+'">' + task.site.site+'-'+task.title + '</a></td>\
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
