@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Invoice</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('invoice.store')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="entity_id" class="col-sm-12 col-form-label text-left">Customer<strong>*</strong></label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="entity_id" onchange="fetchJobs()" id="entity_id" style="width: 100%; height:30px !important;">
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
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" readonly value="{{ $invoiceNo }}">
                                                <span class="text-danger error-text inoice_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customer_po_number" class="col-sm-6 col-form-label text-right">Customer PO Number</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="number" name="customer_po_number">
                                                <span class="text-danger error-text customer_po_number_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="task_id" class="col-sm-6 col-form-label text-right">Job<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <select class="select2 pl-1 form-control" name="task_id" onchange="fetchEstimates()" id="task_id" style="width: 100%; height:30px !important;">
                                                    <option value="" selected disabled>Select Job</option>
                                                </select>
                                                <span class="text-danger error-text task_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="issue_date" class="col-sm-6 col-form-label text-right">Issue Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" name="issue_date" id="issue_date">
                                                <span class="text-danger error-text issue_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="due_date" class="col-sm-6 col-form-label text-right">Due Date<strong>*</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="date" style="width: 100%; height:30px;" name="due_date" id="due_date">
                                                <span class="text-danger error-text due_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="promised_date" class="col-sm-6 col-form-label text-right">Amounts Are</label>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="amount_are" value="0" class="custom-control-input" checked>
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
                                            <label for="fileInput" id="fileListLabel">
                                                <div id="fileList">
                                                    <p>Click to select files</p>
                                                </div>
                                            </label>
                                            <input type="file" id="fileInput" name="image[]" multiple>
                                        </div>
                                        <div class="form-group row">
                                            <label for="note_id" class="col-sm-12 col-form-label text-left">Note to Customer</label>
                                            <div class="col-sm-12">
                                                <select class="select2 pl-1 form-control" name="note_id" onchange="fetchNote()" id="note_id" style="width: 100%; height:30px !important;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="note" class="col-sm-12 col-form-label text-left">Note</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" rows="2" name="note" id="note"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="subtotal" class="col-sm-6 col-form-label text-right"><strong>Subtotal</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" style="width: 100%; height:30px;" type="text" readonly name="sub_total" id="sub_total">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tax" class="col-sm-6 col-form-label text-right"><strong>Tax</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="tax" name="tax">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="total" class="col-sm-6 col-form-label text-right"><strong>Total</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly style="width: 100%; height:30px;" id="total" name="total">
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

<style>
    #fileInput {
        display: none;
    }

    #fileListLabel {
        display: block;
        margin-top: 20px;
        border: 1px dashed #333;
        border-radius: 15px;
        background-color: #f5f5f5;
        color: #333;
        width: 100%;
        height: 150px;
        overflow-y: auto;
        cursor: pointer;
    }

    #fileList {
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;

    }

    #fileList.has-files {
        justify-content: flex-start;

    }

    .file-preview {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
    }

    .file-preview:hover {
        background-color: #f9f9f9;
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .file-thumbnail {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 50%;
    }

    .file-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .remove-icon {
        color: orange;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 1rem;
        transform: scale(1);
        transition: transform 0.2s ease-in-out;
    }

    .remove-icon:hover {
        transform: scale(1.2);
    }
</style>

<script>

    //file uploader code starts here
    const fileInput = document.getElementById('fileInput');
    const fileListLabel = document.getElementById('fileListLabel');
    const fileList = document.getElementById('fileList');
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        if (files.length > 0) {
            fileListLabel.classList.add('has-files'); // Add a class to style the file list
            fileListLabel.querySelector('p').style.display = 'none'; // Hide the paragraph

            // Create columns to display images in three columns
            for (let i = 0; i < 3; i++) {
                const column = document.createElement('div');
                column.classList.add('column');

                for (let j = i; j < files.length; j += 3) {
                    const file = files[j];

                    // Create a preview container
                    const filePreview = document.createElement('div');
                    filePreview.classList.add('file-preview');

                    // Create an image thumbnail
                    const thumbnail = document.createElement('div');
                    thumbnail.classList.add('file-thumbnail');
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.classList.add('file-thumbnail-img');
                    thumbnail.appendChild(img);

                    // Create a remove icon
                    const removeIcon = document.createElement('span');
                    removeIcon.classList.add('remove-icon');
                    removeIcon.textContent = '❌';

                    removeIcon.addEventListener('click', (e) => {
                        e.stopPropagation(); // Prevent event propagation
                        filePreview.remove();
                        fileInput.value = ''; // Clear the input
                        if (fileInput.files.length === 0) {
                            fileListLabel.classList.remove('has-files'); // Remove styling class
                        }
                        // Add your code to remove the image here
                    });

                    // Append elements to the preview container
                    filePreview.appendChild(thumbnail);
                    filePreview.appendChild(removeIcon);

                    // Append the preview container to the column
                    column.appendChild(filePreview);
                }

                // Append the column to the file list
                fileList.appendChild(column);
            }
            const filePreviews = document.querySelectorAll('.file-preview');
            filePreviews.forEach((preview, index) => {
                preview.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent opening file explorer
                });

                const thumbnail = preview.querySelector('.file-thumbnail');
                const removeIcon = preview.querySelector('.remove-icon');

                thumbnail.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent opening file explorer
                });

                removeIcon.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent opening file explorer
                });
            });
        }
    });

    // file uploader code ends here\

    var job = <?php echo $job ?>;
    var itemsCount = 1;
    var selectedJob;

    fetchClientEntities();
    fetchNotes();
    itemsDynamicField(itemsCount);

    function itemsDynamicField(number) {
        $.each(quotes, function(key, quote) {
            itemsDetailDynamicField(number);
            number++;
            itemsCount++;
        })
    }

    function itemsDynamicField(number) {
        html = '<tr class="item" >';
        html += '<td><select class="select2 form-control select-estimate" name="items[' + number + '][quote_id]" id="estimate_id_' + number + '" onchange="quoteInsert()"  style="width: 100%; height:30px;" data-placeholder="Select Cost Code" required></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" required /></td>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][account]" id="account_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Account"><option value="Maintenance Income">Maintenance Income</option><option value="Construction Income">Construction Income</option><option value="Management Income">Management Income</option></select></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][qty]" id="qty_' + number + '" min="0" onkeyup="calculateCost()" class="form-control qty" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][rate]" id="rate_' + number + '" min="0" onkeyup="calculateCost()" class="form-control rate" /></td>';
        html += '<td><input type="text" style="height: 30px" name="items[' + number + '][amount]" id="amount_' + number + '" readonly class="form-control amount" /></td>';
        html += '<td><select class="select2 form-control" name="items[' + number + '][tax]" id="tax_' + number + '" onchange="calculateCost()" style="width: 100%; height:30px;" data-placeholder="Select Tax Code"><option value="10">GST 10%</option></select></td>';
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
        itemsDynamicField(itemsCount);
        $('#tax_' + itemsCount).select2({
        placeholder: "Select Tax Code",
        })
        $('#account_' + itemsCount).select2({
        placeholder: "Select Account",
        })
        $('#estimate_id_' + itemsCount).select2({
        tag: true,
        placeholder: "Select Cost Code",
        })

        if($("#task_id").val() != null)
            fetchEstimates()
    });
    $(document).on('click', '#removeItems', function(e) {
        e.preventDefault();
        $(this).closest("tr").remove();
        itemsCount--;
        calculateCost();
    });

    function fetchNote() {
        const note = $('#note_id option:selected').text();
        $('#note').text(note);
    }

    function fetchNotes() {
        $.ajax({
            type: "GET",
            url: "/fetchNotes",
            dataType: "json",
            success: function(response) {
                var note_id = $('#note_id');
                $('#note_id').children().remove().end();
                note_id.append($("<option />").text('Select Notes').prop({
                    selected: true,
                    disabled: true
                }));
                $.each(response.notes, function(key, note) {
                    note_id.append($("<option />").val(note.id).text(note.note));
                });

            }
        });
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
                task_id.append($("<option />").text('Select Job').prop({
                    selected: true,
                    disabled: true
                }));
                $.each(response.jobs, function(key, job) {
                    if (job.entity_id == $('#entity_id').val()) {
                        task_id.append($("<option />").val(job.id).text(job.id + ' - ' + job.title + ' : ' + job.site.site));
                    }
                });

                if (job.length > 0) {
                    task_id.val(job[0].id).change();
                }
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
                entity_id.append($("<option />").text('Select Customer').prop({
                    selected: true,
                    disabled: true
                }));
                $.each(response.entities, function(key, entity) {
                    entity_id.append($("<option />").val(entity.id).text(entity.entity));
                });
                if (job.length > 0) {
                    entity_id.val(job[0].entity_id).change();
                }
            }
        });
    }

    function quoteInsert() {
        var quote_id = $('#estimate_id_' + itemsCount).val();
        $.each(quoteList, function(key, quote) {
            if (quote.id == quote_id) {
                $('#description_' + itemsCount).val(selectedJob.title);
                $('#qty_' + itemsCount).val(quote.qty);
                $('#rate_' + itemsCount).val(quote.rate);
                $('#amount_' + itemsCount).val(quote.amount);
                $('#total_' + itemsCount).val(quote.amount_inc_gst);
                calculateCost();
            }
        });
    }

    function fetchEstimates() {
        const task = $('#task_id').val();
        var estimate_id = $('#estimate_id_' + itemsCount);
        $.each(jobList, function(key, job) {
            if (job.id == task) {
                selectedJob = job;
                quoteList = job.quotes;
                $('#estimate_id_' + itemsCount).children().remove().end();
                $('#estimate_id_' + itemsCount).append($("<option />").text('Select Cost Code').prop({
                    selected: true,
                    disabled: true,
                    value: ""
                }));
                $.each(job.quotes, function(key, quote) {
                    $('#estimate_id_' + itemsCount).append($("<option />").val(quote.id).text(quote.estimate.subheader.cost_code + '___' + quote.estimate.item));
                });

            }
        });
    }

    function calculateCost() {
        let tax = 0;
        let subtotal = 0;
        let total = 0;
        document.querySelectorAll(".item").forEach((item) => {
            const quantity = parseInt(item.querySelector(".qty").value) ? parseInt(item.querySelector(".qty").value) : 0;
            const rate = parseFloat(item.querySelector(".rate").value) ? parseFloat(item.querySelector(".rate").value) : 0;
            subtotal += quantity * rate
            const itemTax = ((quantity * rate) / 100) * 10;
            tax += itemTax;
            total = subtotal + tax;
            const amount = quantity * rate;
            const item_total = amount + ((amount / 100) * 10)
            item.querySelector(".amount").value = amount.toFixed(2);
            item.querySelector(".total").value = item_total.toFixed(2);
        });
        $('#sub_total').val(subtotal);
        $('#tax').val(tax);
        $('#total').val(total);
    }


    itemsDynamicField(itemsCount);

    $(document).ready(function() {

        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0, 10);
        });
        $('#issue_date').val(new Date().toDateInputValue());
    });
</script>
@endsection
