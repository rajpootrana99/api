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
                                            <table class="table table-bordered mb-0 table-centered">
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

<script>
    var entities;

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
            html += '<td><div class="custom-file"><input type="file" multiple class="custom-file-input" style="width: 100%; height:30px;" name="items[' + number + '][image][]" id="images_' + number + '"><label class="custom-file-label" for="image">Choose file</label></div></td>';
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
