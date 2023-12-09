@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Notes</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mt-4">
                        <a href="" data-toggle="modal" data-target="#addNote" id="addNoteButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Note</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Notes</th>
                                    <th>Note Type</th>
                                    <th width="3%">Modify</th>
                                    <th width="3%">Delete</th>
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
<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="addNoteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="addNoteLabel">Add Note</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="addNoteForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="note" id="note" placeholder="Enter Note">
                                <span class="text-danger error-text note_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="note_type" id="note_type" placeholder="Enter Note Type">
                                <span class="text-danger error-text note_type_error"></span>
                            </div>
                        </div>
                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<div class="modal fade" id="editNote" tabindex="-1" role="dialog" aria-labelledby="editNoteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editNoteLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editNoteForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="note_id" name="note_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="note" id="edit_note" placeholder="Enter Note">
                                <span class="text-danger error-text note_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="note_type" id="edit_note_type" placeholder="Enter Note Type">
                                <span class="text-danger error-text note_type_update_error"></span>
                            </div>
                        </div>
                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<div class="modal fade" id="deleteNote" tabindex="-1" role="dialog" aria-labelledby="deleteNoteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteNoteLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteNoteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="note_id" name="note_id">
                        <p class="mb-4">Are you sure want to delete?</p>
                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Yes</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchNotes();

        function fetchNotes() {
            $.ajax({
                type: "GET",
                url: "fetchNotes",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.notes, function(key, note) {
                        $('tbody').append('<tr>\
                            <td>' + note.id + '</td>\
                            <td>' + note.note + '</td>\
                            <td>' + note.note_type + '</td>\
                            <td><button value="' + note.id + '" style="border: none; background-color: #fff" class="edit_btn"><i class="fa fa-edit"></i></button></td>\
                            <td><button value="' + note.id + '" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                    });
                }
            });
        }

        $(document).on('click', '#addNoteButton', function(e) {
            e.preventDefault();
            $('#addNote').modal('show');
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var note_id = $(this).val();
            $('#deleteNote').modal('show');
            $('#note_id').val(note_id)
        });

        $(document).on('submit', '#deleteNoteForm', function(e) {
            e.preventDefault();
            var note_id = $('#note_id').val();
            $.ajax({
                type: 'delete',
                url: 'note/' + note_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteNote').modal('hide');
                    } else {
                        fetchNotes();
                        $('#deleteNote').modal('hide');
                        showToast(response.message, "danger");
                        event.preventDefault();
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var note_id = $(this).val();
            $('#editNote').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'note/' + note_id + '/edit',
                success: function(response) {
                    $('#editNoteLabel').text('Note ID ' + response.note.id);
                    $('#note_id').val(response.note.id);
                    $('#edit_note').val(response.note.note);
                    $('#edit_note_type').val(response.note.note_type);
                }
            });
        });

        $(document).on('submit', '#editNoteForm', function(e) {
            e.preventDefault();
            var note_id = $('#note_id').val();
            let EditFormData = new FormData($('#editNoteForm')[0]);
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "note/" + note_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editNote').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editNoteForm')[0].reset();
                        $('#editNote').modal('hide');
                        showToast(response.message, "success");
                        event.preventDefault();
                        fetchNotes();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editNote').modal('show');
                }
            });
        })

        $(document).on('submit', '#addNoteForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addNoteForm')[0]);
            $.ajax({
                type: "post",
                url: "note",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addNote').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addNoteForm')[0].reset();
                        $('#addNote').modal('hide');
                        showToast(response.message, "success");
                        event.preventDefault();
                        fetchNotes();
                    }
                },
                error: function(error) {
                    $('#addNote').modal('show')
                }
            });
        });
    });
</script>
@endsection