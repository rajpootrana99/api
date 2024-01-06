@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Task</h4>
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text entity_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="site_id" id="site_id" style="width: 100%; height:30px;">
                                        <option value disabled selected>Select Entity First</option>
                                    </select>
                                    <span class="text-danger error-text site_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" placeholder="Enter Title" name="title" id="title">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="user_id" id="user_id" style="width: 100%; height:30px;">
                                        <option value disabled selected>Select Site First</option>
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="requested_completion" id="requested_completion" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Requested Completion Date">
                                    <span class="text-danger error-text requested_completion_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="status" id="status" style="width: 100%; height:30px !important;">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Cancelled</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="progress" id="progress" style="width: 100%; height:30px !important;">
                                        <option value="" selected disabled>Select Progress</option>
                                        <option value="0">Quote</option>
                                        <option value="1">Order</option>
                                    </select>
                                    <span class="text-danger error-text progress_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Item Detail</div>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 table-centered" id="items_table">
                                                <thead>
                                                    <tr>
                                                        <th width="3%">#</th>
                                                        <th width="30%">Description</th>
                                                        <th width="10%">Priority</th>
                                                        <th width="20%">Gallery</th>
                                                        <th width="3%"><i class="fa fa-plus-circle"></i></th>
                                                        <th width="3%"><i class="fa fa-minus-circle"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemsDetailTableBody">

                                                </tbody>
                                            </table><!--end /table-->
                                        </div><!--end tableresponsive-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!-- end col -->
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <button type="submit" style="float:right" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<div class="modal fade" id="filesModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 701px;" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="filesModalLabel">Select or Change Images</h6>
                {{-- <button type="button" class="close " id="filesModalClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button> --}}
            </div><!--end modal-header-->
            {{-- <form action="javascript:void(0)" enctype="multipart/form-data" id="filesModalForm" class="needs-validation" novalidate>

                {{ csrf_field() }} --}}

            <div class="modal-body">


                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="image_files_text" placeholder="No Images Selected" disabled>
                        <div class="input-group-append">
                            <label class="btn btn-secondary" for="images_1" onclick="loadImagesContainer(this)" id="file_select_button">Select or Add Images</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="justify-content-between align-items-center" style="display:flex;padding-bottom: 5px;" id="image_modal_action_tab">
                        <div class="h5">Actions</div>
                        <div class="" btn-group role="group">
                            <button onclick="removeSelectedImages(this)" type="button" class="btn btn-secondary" style="display: inline-flex;align-items:center;gap:5px;">
                                <i style="width:20px" data-feather="trash-2"></i> Remove Images
                            </button>
                            <button onclick="selectImageAll()" id="select_all_image_btn" type="button" class="btn btn-primary" style="display: inline-flex;align-items:center;gap:5px;">
                                <i style="width:18px" data-feather="check-square"></i> Select All
                            </button>
                        </div>
                    </div>
                    <div class="images_container" >

                    </div>
                </div>

            </div>
            <!--end modal-body-->
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="reset_dialog()">Cancel</button>
                <button class="btn btn-primary btn-sm" data-dismiss="modal" onclick="reset_dialog()">Done</button>
            </div><!--end modal-footer-->
        {{-- </form> --}}
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
<style>
    .images_container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        border: 1px solid lightgray;
        border-radius: 5px;
        padding: 10px;
        background-color: #f5f5f5;
        height: 350px;
        gap: 10px;
        overflow-y: auto;
    }

    .image_dragged_over_container{
        display: flex;
        width: -webkit-fill-available;
        align-items: center;
        border-radius: 5px;
        /* border: 1px solid lightgray; */
        padding: 0px;
        background-color: rgba(0,0,0,0.1);
        font-size: 16px;
        font-family: monospace;
        font-weight: bold;
        justify-content: center;
        position: relative;
    }

    .images_container>.image_item * {
        cursor: pointer;
        margin: 0;
    }

    .images_container>a {
        display: flex;
        justify-content: end;
        position: relative;
        height: min-content;
        width: min-content;
        margin: 0;
        box-shadow: 0 3rem 6rem rgba(0, 0, 0, .1);
        transition: 0.2s all ease-out;
    }

    .images_container>a:hover {
        transform: translateY(-.5%);
        box-shadow: 0 4rem 8rem rgba(0, 0, 0, .2);
        transition: 0.2s all ease-in;

    }

    .images_container * img {
        object-fit: cover;
        width: 150px;
        height: 150px;
    }

    .images_container * .selectable_image {
        position: absolute;
        display: flex;
        border: none;
        margin: 10px;
        z-index: 10;
        transition: 0.1s all ease-out;
    }

    .selectable_image:checked+label {
        filter: brightness(0.5);
        transition: 0.1s all ease-in;
    }
</style>
<script defer>
    var entities;


    // IMAGE UPLOADING MODAL HANDLERS HERE
    let storedFiles = new DataTransfer()
    let urlsArray = Array();
    let image_check = document.getElementById("select_all_image_btn")
    let select_or_add_button = document.getElementById("file_select_button")
    let images_container = document.getElementsByClassName("images_container")[0]
    let reset_dialog = () => {
        $("#image_files_text").val("")
        images_container.innerHTML = ""
        storedFiles = null
        storedFiles = new DataTransfer()
        urlsArray = Array()
    }

    //DRAGGING CODE HERE
    let highlight_drag_box = `<div class="image_dragged_over_container">
                                Drag and Drop Here.....
                            </div>`;
    let dragged =

    images_container.addEventListener("dragover", (event) => {
        event.preventDefault();
    }, false);

    images_container.addEventListener("dragenter", (event) => {
        // console.log(event.target)

        event.stopPropagation();
        event.preventDefault();
        console.log("element entered");
        if ($(".images_container > .image_dragged_over_container").length == 0) {
            $(".images_container").html(highlight_drag_box);
        }
    },false);

    images_container.addEventListener("dragleave", (event) => {

        //if the leaving element is its own child then it is still in drag and drop container
        if ($(`.images_container .${event.fromElement.className}`).length == 1 ) {
            return
        }

        event.stopPropagation();
        event.preventDefault();
        if (event.target === images_container) {
            if ($(".images_container > .image_dragged_over_container").length == 1) {
                console.log("element leaving");
                loadImagesContainer(select_or_add_button.getAttribute("for"));
            }
        }
    },false);

    images_container.addEventListener("drop", (event) => {

        // preventing from behaving like default in browsers, openeing  as hyperlink
        event.preventDefault();

        // let the dropped files or images in our case are
        let files_dropped = event.dataTransfer.files;
        // files_dropped.forEach(file => {
        //     storedFiles.items.add(file);
        // })
        let file_input = document.getElementById(select_or_add_button.getAttribute("for"))

        file_input.files = files_dropped;
        console.log(file_input.files);
        loadImagesContainer(select_or_add_button.getAttribute("for"));
    },false);


    function loadImagesContainer(id) {
        // CHECKING AND DISPLAYING PREVIOUS SELECTED FILES
        let file_input = document.getElementById(id)


        $("#image_modal_action_tab").addClass("d-none")

        //Show How Many Files Selected
        console.log("File Input:\t" + file_input)
        if (file_input == null) {
            return;
        }

        if (file_input.files.length == 0 && storedFiles.files.length == 0) {
            reset_dialog()
            return;
        } else {

            images_container.innerHTML = "";
            file_input.files.forEach(file => {
                let duplicateFlag = false;
                for (let i = 0; i < storedFiles.files.length; i++) {
                    temp = storedFiles.files[i]
                    if (temp.name == file.name) {
                        duplicateFlag = true
                    }
                }
                if (!duplicateFlag) storedFiles.items.add(file)
            });
            file_input.files = storedFiles.files;
            $("#image_files_text").val(file_input.files.length + " Images Selected")

            //show all images
            // Create All Selected Images URLs
            let imageIndex = 0;
            for (let i = 0; i < storedFiles.files.length; i++) {
                image_file = storedFiles.files[i]
                let url = URL.createObjectURL(image_file)
                urlsArray.push(url);

                let imagePath = url;
                let image_item = `<a class="user-avatar image_item" href="javascript:void(0);">
                                        <input type="checkbox" id="${imageIndex}" class="form-check-input selectable_image">
                                        <label for="${imageIndex}">
                                            <img src="${imagePath}" alt="user"  class="thumb-xxl rounded">
                                        </label>
                                    </a>`;

                imageIndex++;
                images_container.innerHTML += image_item;
            }

            $("#image_modal_action_tab").removeClass("d-none")

            // now after images are loaded revoke the urls to save memory space
            setTimeout(() => {
                urlsArray.forEach((element) => {
                    URL.revokeObjectURL(element)
                })
            }, 500);
        }
    }

    function removeSelectedImages(remove_button) {
        let file_input = document.getElementById(select_or_add_button.getAttribute("for"))

        let all_checks = document.querySelectorAll(".images_container * input[type='checkbox']");
        for (let index = all_checks.length - 1; index >= 0; index--) {
            let element = all_checks[index]
            if (element.checked) {
                storedFiles.items.remove(parseInt(element.id))
                element.parentElement.remove()
            }
        }

        if (image_check.classList.contains("active")) {
            image_check.classList.remove("active")
        }

        file_input.files = storedFiles.files
        loadImagesContainer(select_or_add_button.getAttribute("for"))
    }

    function selectImageAll() {
        let click_on_images = (flag) => {
            $(".images_container * input[type='checkbox']").each(function(index, element) {
                element.checked = flag
            });
        }
        if (image_check.classList.contains("active")) {
            click_on_images(false)
            image_check.classList.remove("active")
        } else {
            click_on_images(true)
            image_check.classList.add("active")
        }
    }

    function showFilesModal(input_id) {
        select_or_add_button.setAttribute("for", input_id)

        loadImagesContainer(input_id)

        $("#filesModal").modal("show");
    }

    function fetchUsers() {
        let site_id = $('#site_id').val();
        let entity_id = $('#entity_id').val();
        var user_id = $('#user_id');
        $('#user_id').children().remove().end();
        $.each(entities, function(key, entity) {
            if (entity.id == entity_id) {
                user_id.append($("<option />").text('Requested By').prop({
                    selected: true,
                    disabled: true
                }));
                $.each(entity.users, function(key, user) {
                    $.each(user.sites, function(key, site) {
                        if (site.id == site_id) {
                            user_id.append($("<option />").val(user.id).text(user.name));
                        }
                    });
                });
            }
        });
    }

    function fetchSites() {
        $.ajax({
            type: "GET",
            url: "/fetchSites",
            dataType: "json",
            success: function(response) {
                let entity_id = $('#entity_id').val();
                var site_id = $('#site_id');
                $('#site_id').children().remove().end();
                site_id.append($("<option />").text('Select Site').prop({
                    selected: true,
                    disabled: true
                }));
                $.each(response.sites, function(key, site) {
                    if (site.entity_id == entity_id) {
                        site_id.append($("<option />").val(site.id).text(site.site));
                    }
                });
            }
        });
    }
    $(document).ready(function() {

        var itemsCount = 1;
        itemsDetailDynamicField(itemsCount);

        function itemsDetailDynamicField(number) {
            html = '<tr>';
            html += '<td>' + number + '</td>';
            html += '<td><input type="text" style="height: 30px" name="items[' + number + '][description]" id="description_' + number + '" class="form-control" /></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][priority]" id="priority_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Priority"><option value="0">Low</option><option value="1">Medium</option><option value="2">High</option><option value="3">Urgent</option></select></td>';
            html += '<td><label onclick="showFilesModal(\'images_' + number + '\')" class="btn btn-light" title="Select or Change Images">Select or Change Images</label> <div class="custom-file d-none"><input onchange="loadImagesContainer(\'images_' + number + '\')" type="file" multiple class="custom-file-input" style="width: 100%; height:30px;" name="items[' + number + '][image][]" id="images_' + number + '"><label class="custom-file-label" for="image">Choose file</label></div></td>';
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

        fetchClientEntities();

        $(document).on('change', '#entity_id', function(e) {
            e.preventDefault();
            fetchSites();
        });

        $(document).on('change', '#site_id', function(e) {
            e.preventDefault();
            fetchUsers();
        });

        function fetchClientEntities() {
            $.ajax({
                type: "GET",
                url: "/fetchClientEntities",
                dataType: "json",
                success: function(response) {
                    entities = response.entities;
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").text('Select Entity').prop({
                        selected: true,
                        disabled: true
                    }));
                    $.each(response.entities, function(key) {
                        entity_id.append($("<option />").val(response.entities[key].id).text(response.entities[key].entity));
                    });
                }
            });
        }
    });
</script>
@endsection
