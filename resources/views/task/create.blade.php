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
                                    <select class="select2 pl-1 form-control" name="site_id" id="site_id" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text site_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="entity_id" id="entity_id" onchange="fetchUsers()" style="width: 100%; height:30px;">

                                    </select>
                                    <span class="text-danger error-text entity_id_error"></span>
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

                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                                                        <!-- <th width="20%">Status</th> -->
                                                        <th width="20%">Progress</th>
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

<div class="modal fade" id="filesModal"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="filesModalLabel">Select or Change Images</h6>
                <button type="button" class="close " id="filesModalClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            {{-- <form action="javascript:void(0)" enctype="multipart/form-data" id="filesModalForm" class="needs-validation" novalidate>

                {{ csrf_field() }} --}}

                <div class="modal-body">


                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="No Images Selected" disabled>
                            <div class="input-group-append">
                                <label class="btn btn-secondary" for="images_1" id="basic-addon2">Select or Add Images</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="images_container">
                            {{-- <div class="image_item_container">
                                <img src="{{asset('item_images/fotor-ai-20230430224722.jpg')}}" class="item_image" alt="" srcset="">
                                <div class="item_name">fotor-ai-20230430224722.jpg</div>
                                <div class="item_controls">
                                    <button class="btn btn-light folder_action_button" onclick="" title="Delete this image">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                            </div> --}}
                            <div class="custom-control custom-checkbox image-checkbox">
                                <input type="checkbox" class="custom-control-input" id="image_1">
                                <label class="custom-control-label" for="image_1">
                                    <img src="{{asset('item_images/ethical traveler.png')}}" alt="user" class="thumb-xxl rounded">
                                </label>
                            </div>

                            <a class="user-avatar mr-2" href="javascript:void(0);">
                                <img src="{{asset('item_images/ethical traveler.png')}}" alt="user" class="thumb-xxl rounded">
                                <input type="checkbox" class="selectable_image">
                            </a>

                            <a class="user-avatar mr-2" href="javascript:void(0);">
                                <img src="{{asset('item_images/fotor-ai-20230430224722.jpg')}}" alt="user" class="thumb-xxl rounded">
                            </a>

                            <a class="user-avatar mr-2" href="javascript:void(0);">
                                <img src="{{asset('item_images/ethical traveler.png')}}" alt="user" class="thumb-xxl rounded">
                            </a>
                            <a class="user-avatar mr-2" href="javascript:void(0);">
                                <img src="{{asset('item_images/fotor-ai-20230430224722.jpg')}}" alt="user" class="thumb-xxl rounded">
                            </a>

                            <a class="user-avatar mr-2" href="javascript:void(0);">
                                <img src="{{asset('item_images/ethical traveler.png')}}" alt="user" class="thumb-xxl rounded">
                            </a>
                        </div>
                    </div>

                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="uploadFileButton" class="btn btn-primary btn-sm">Upload</button>
                </div><!--end modal-footer-->
            {{-- </form> --}}
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
<style>
    .images_container{
        display: flex;
        flex-direction: row;
        border: 1px solid lightgray;
        border-radius: 5px;
        padding: 10px;
        background-color: #f5f5f5;
        gap: 10px;
    }
    .images_container > a{
        margin: 0
    }
    .images_container * img{
        object-fit: cover;
        width: 150px;
        height: 150px;
    }
</style>
<script defer>
    var entities;

    function removeFilesByIndex(id, i){
        let data = new DataTransfer()
        let fileInput = document.getElementById(id)
        let { files } = fileInput

        for (let index = 0; index < files.length; index++) {
            if( index != i )
                data.items.add(files[index])
        }

        fileInput.files = data.files
    }

    function showFilesModal(input) {

        $("#filesModal").modal("show");

    }

    function fetchUsers(){
        let entity_id = $('#entity_id').val();
        var user_id = $('#user_id');
        $('#user_id').children().remove().end();
        $.each(entities, function(key, entity) {
            if(entity.id == entity_id){
                console.log(entity);
                user_id.append($("<option />").text('Requested By').prop({selected: true, disabled: true}));
                $.each(entity.users, function(key, user) {
                    user_id.append($("<option />").val(user.id).text(user.name));
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
                    var site_id = $('#site_id');
                    $('#site_id').children().remove().end();
                    site_id.append($("<option />").text('Select Site').prop({selected: true, disabled: true}));
                    $.each(response.sites, function(site) {
                        site_id.append($("<option />").val(response.sites[site].id).text(response.sites[site].site));
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
            // html += '<td><select class="select2 form-control" name="items[' + number + '][status]" id="status_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Status"><option value="0">Pending</option><option value="1">Quoting</option><option value="2">Awaiting Approval</option><option value="3">Scheduled</option><option value="4">Complete</option><option value="5">Invoiced</option><option value="6">Cancelled</option></select></td>';
            html += '<td><select class="select2 form-control" name="items[' + number + '][progress]" id="progress_' + number + '" style="width: 100%; height:30px;" data-placeholder="Select Progress"><option value="0">Quote</option><option value="1">Order</option></select></td>';
            html += '<td><label onclick="showFilesModal(this)" class="btn btn-light" title="Select or Change Images">Select or Change Images</label> <div class="custom-file d-none"><input type="file" multiple class="custom-file-input" style="width: 100%; height:30px;" name="items[' + number + '][image][]" id="images_' + number + '"><label class="custom-file-label" for="image">Choose file</label></div></td>';
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

        fetchSites();
        fetchClientEntities();



        function fetchClientEntities() {
            $.ajax({
                type: "GET",
                url: "/fetchClientEntities",
                dataType: "json",
                success: function(response) {
                    entities = response.entities;
                    var entity_id = $('#entity_id');
                    $('#entity_id').children().remove().end();
                    entity_id.append($("<option />").text('Select Entity').prop({selected: true, disabled: true}));
                    $.each(response.entities, function(key) {
                        entity_id.append($("<option />").val(response.entities[key].id).text(response.entities[key].entity));
                    });
                }
            });
        }
    });
</script>
@endsection
