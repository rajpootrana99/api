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
                <div class="card-header">
                    <div class="card-title row" style="position:absolute; top:10px; right: 10px;">
                        <a href="{{route('task.create')}}" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Task </a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <label for="example-search-input" class="col-sm-2 col-form-label text-right">Views</label>
                                    <div class="col-sm-10">
                                        <select class="select2 pl-1 form-control" id="view_status" style="width: 100%; height:30px !important;">
                                            <option value="" disabled>Select View</option>
                                            <option selected value="0">Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox col-sm-3" style="display:flex; padding:8px;float:left;margin-left: 30px">
                            <input type="checkbox" class="custom-control-input" id="customCheck02">
                            <label class="custom-control-label" for="customCheck02">Hide Archived Items</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="row">
                                <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search" placeholder="Search by Task Title or Store Name" id="example-search-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body" id="task-section">

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

<div class="modal fade" id="viewGallery" tabindex="-1" role="dialog" aria-labelledby="viewGalleryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="viewGalleryLabel">Images</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="item_gallery_carousel">

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<script>
    $(document).ready(function() {
        var tags = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
        var tasks;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchTasks();

        function getFileExtension(filename) {
            return filename.split('.').pop();
        }

        function showTasks(tasks){
            $('#task-section').html("");                
            $.each(tasks, function(key, task) {
                var options = new Array();
                let i = 0;
                var client;
                task.items.forEach(function(p) {
                    // shuffle(tags);
                    options[i] = '<span class="badge badge-info">Item # ' + p.id + '</span>';
                    i = i + 1;
                });
                console.log($('#view_status').val)
                if($('#view_status').val() == 0){
                    if(task.status == 'Pending'){     
                        viewTasks(task);
                    }
                }
                if($('#view_status').val() == 1){
                    if(task.status == 'Approved'){
                        viewTasks(task);
                    }
                }
                if($('#view_status').val() == 2){
                    if(task.status == 'Cancelled'){
                        viewTasks(task);
                    }
                }
                function viewTasks(task){
                    $('#task-section').append('<div class="accordion" id="accordionExample">\
                        <div class="card border mb-1 shadow-none">\
                            <div class="card-header rounded-0" id="heading_' + task.id + '">\
                                <a href="" class="text-dark" data-toggle="collapse" data-target="#collapse_' + task.id + '" aria-expanded="true" aria-controls="collapse_' + task.id + '">\
                                <strong>Task ID # ' + task.id + ' - ' + task.title + ' : ' + task.site.site + '</strong>\
                                </a>\
                                <div class="dropdown d-inline-block" style="float:right;">\
                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">\
                                        <i class="las la-ellipsis-v font-20 text-muted"></i>\
                                    </a>\
                                    <div style="z-index: 1 !important;" class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">\
                                        <a class="dropdown-item" href="#">Edit</a>\
                                        <a class="dropdown-item" href="/enquiry/'+task.id+'/edit">Convert to Enquiry</a>\
                                        <a class="dropdown-item" href="/job/'+task.id+'/edit">Convert to Job</a>\
                                        <a class="dropdown-item" href="#">Chat</a>\
                                    </div>\
                                </div>\
                            </div>\
                            <div id="collapse_' + task.id + '" class="collapse" aria-labelledby="heading' + task.id + '" data-parent="#accordionExample">\
                                <div class="card-body">\
                                <div class="table-responsive mb-0 fixed-solution">\
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
                        if (task.status === "Completed") {
                            status = '<span class="badge badge-success">' + task.status + '</span>';
                        } else if (task.status === "Overdue") {
                            status = '<span class="badge badge-danger">' + task.status + '</span>';
                        } else {
                            status = '<span class="badge badge-secondary">' + task.status + '</span>';
                        }
                        if (item.item_galleries.length == 0) {
                            file = 'No image or video file exists';
                        } else if (getFileExtension(item.item_galleries[0].image) === 'mp4' || getFileExtension(item.item_galleries[0].image) === 'mkv' || getFileExtension(item.item_galleries[0].image) === 'mov') {
                            file = '<video width="200px" height="100px" controls><source src="' + item.item_galleries[0].image + '" type="video/ogg"></video>'
                        } else if (getFileExtension(item.item_galleries[0].image) === 'png' || getFileExtension(item.item_galleries[0].image) === 'jpg' || getFileExtension(item.item_galleries[0].image) === 'jpeg') {
                            file = '<img src="' + item.item_galleries[0].image + '" width="200px" height="100px" alt="" class="rounded float-left ml-3 mb-3">';
                        } else {
                            file = 'No image or video file exists';
                        }
                        if (task.user == null)[
                            client = "No Client"
                        ]
                        else {
                            client = task.user.name;
                        }
                        $('#item-body-' + task.id).append('<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.description + '</td>\
                            <td>' + client + '</td>\
                            <td><button value="' + item.id + '" style="border: none; background-color: none" class="view_galery">' + file + '</button></td>\
                            <td>' + priority + '</td>\
                            <td>' + status + '</td>\
                            <td>' + item.progress + '</td>\
                        </tr>')
                    });
                }
            });
        }

        $(document).on('change', '#view_status', function(e) {
            showTasks(tasks);
        });

        function fetchTasks() {
            $.ajax({
                type: "GET",
                url: "fetchTasks",
                dataType: "json",
                success: function(response) {
                    tasks = response.tasks;
                    showTasks(tasks);
                }
            });
        }

        $(document).on('click', '.view_galery', function(e) {
            e.preventDefault();
            var item_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "fetchItemGalleries/" + item_id,
                dataType: "json",
                success: function(response) {
                    var file;
                    var active = ""
                    $('#viewGallery').modal('show');
                    $('#item_gallery_carousel').children().remove().end();
                    $.each(response.item.item_galleries, function(key, gallery) {
                        if (getFileExtension(gallery.image) === 'mp4' || getFileExtension(gallery.image) === 'mkv' || getFileExtension(gallery.image) === 'mov') {
                            file = '<video class="d-block w-100" height="400px" controls><source src="' + gallery.image + '" type="video/ogg"></video>'
                        } else if (getFileExtension(gallery.image) === 'png' || getFileExtension(gallery.image) === 'jpg' || getFileExtension(gallery.image) === 'jpeg') {
                            file = '<img height="400px" src="' + gallery.image + '" class="d-block w-100" alt="">';
                        } else {
                            file = 'No image or video file exists';
                        }
                        if (key == 0) {
                            active = "active"
                        } else {
                            active = " "
                        }
                        $('#item_gallery_carousel').append('<div class="carousel-item ' + active + '">' + file + '</div>');
                    });
                }
            });
        });

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