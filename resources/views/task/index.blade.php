@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Tasks</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="task-section" >
                    
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<!-- Modal -->

<div class="modal fade" id="deleteTask" tabindex="-1" role="dialog" aria-labelledby="deleteTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteTaskLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteTaskForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="task_id" name="task_id">
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

        fetchTasks();

        function getFileExtension(filename) {
            return filename.split('.').pop();
        }

        function fetchTasks() {
            $.ajax({
                type: "GET",
                url: "fetchTasks",
                dataType: "json",
                success: function(response) {
                    var tags = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
                    $('tbody').html("");
                    $.each(response.tasks, function(key, task) {
                        var options = new Array();
                        let i = 0;
                        task.items.forEach(function(p) {
                            // shuffle(tags);
                            options[i] = '<span class="badge badge-info">Item # ' + p.id + '</span>';
                            i = i + 1;
                        });
                        $('#task-section').append('<div class="accordion" id="accordionExample">\
                                        <div class="card border mb-1 shadow-none">\
                                            <div class="card-header rounded-0" id="heading_'+task.id+'">\
                                                <a href="" class="text-dark" data-toggle="collapse" data-target="#collapse_'+task.id+'" aria-expanded="true" aria-controls="collapse_'+task.id+'">\
                                                <strong>Task ID # ' + task.id + ' - ' + task.title + '</strong>\
                                                </a>\
                                            </div>\
                                            <div id="collapse_'+task.id+'" class="collapse" aria-labelledby="heading'+task.id+'" data-parent="#accordionExample">\
                                                <div class="card-body">\
                                                <div class="table-responsive">\
                                                    <table class="table mb-0">\
                                                        <thead class="thead-light">\
                                                            <tr>\
                                                                <th class="border-top-0">Item ID</th>\
                                                                <th class="border-top-0">ITem Descrition</th>\
                                                                <th class="border-top-0">User Name</th>\
                                                                <th class="border-top-0">Gallery</th>\
                                                                <th class="border-top-0">Priority</th>\
                                                                <th class="border-top-0">Status</th>\
                                                                <th class="border-top-0">Progress</th>\
                                                            </tr>\
                                                        </thead>\
                                                    <tbody id="item-body-' + task.id + '"> </tbody>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');
                        $.each(task.items, function(key, item) {
                            var priority = '';
                            var status = '';
                            var file;
                            if (item.priority === "High") {
                                priority = '<span class="badge badge-warning">' + item.priority + '</span>';
                            } else if (item.priority === "Low") {
                                priority = '<span class="badge badge-primary">' + item.priority + '</span>';
                            } else {
                                priority = '<span class="badge badge-secondary">' + item.priority + '</span>';
                            }
                            if (item.status === "Completed") {
                                status = '<span class="badge badge-success">' + item.status + '</span>';
                            } else if (item.status === "Overdue") {
                                status = '<span class="badge badge-danger">' + item.status + '</span>';
                            } else {
                                status = '<span class="badge badge-secondary">' + item.status + '</span>';
                            }
                            if (getFileExtension(item.item_galleries[0].image) === 'mp4' || getFileExtension(item.item_galleries[0].image) === 'mkv') {
                                    file = '<video width="200px" height="100px" controls><source src="' + item.item_galleries[0].image + '" type="video/ogg"></video>'
                            } else if (getFileExtension(item.item_galleries[0].image) === 'png' || getFileExtension(item.item_galleries[0].image) === 'jpg' || getFileExtension(item.item_galleries[0].image) === 'jpeg') {
                                file = '<img src="' + item.item_galleries[0].image + '" width="200px" height="100px" alt="" class="rounded float-left ml-3 mb-3">';
                            } else {
                                file = 'No image or video file exists';
                            }
                            $('#item-body-' + task.id).append('<tr>\
                                <td>' + item.id + '</td>\
                                <td>' + item.description + '</td>\
                                <td>' + task.user.name + '</td>\
                                <td>' + file + '</td>\
                                <td>' + priority + '</td>\
                                <td>' + status + '</td>\
                                <td>' + item.progress + '</td>\
                            </tr>')
                        });
                    });
                }
            });
        }

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var task_id = $(this).val();
            $('#deleteTask').modal('show');
            $('#task_id').val(task_id)
        });

        $(document).on('submit', '#deleteTaskForm', function(e) {
            e.preventDefault();
            var task_id = $('#task_id').val();

            $.ajax({
                type: 'delete',
                url: 'task/' + task_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 0) {
                        $('#deleteTask').modal('hide');
                    } else {
                        fetchTasks();
                        $('#deleteTask').modal('hide');
                    }
                }
            });
        });

    });
</script>
@endsection