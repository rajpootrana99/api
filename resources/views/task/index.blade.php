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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-centered">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Title</th>
                                    <th width="20%">Site</th>
                                    <th width="8%">User</th>  
                                    <th width="20%">Items</th>
                                    <th width="1%">View</th>
                                    <th width="1%">Delete</th>
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

    <div class="modal fade" id="showTask" tabindex="-1" role="dialog" aria-labelledby="showTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="showTaskLabel"></h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body text-center">
                    <h4 class="mb-1" id="name"></h4>
                    <p class="mb-0 text-muted" id="description"></p>  
                    <h3 class="mb-1">Site</h3>  
                    <p class="mb-0 text-muted" id="site"></p>    
                    <div class="accordion" id="itemAccordion">
                        <!-- <div class="card border mb-1 shadow-none">
                            <div class="card-header custom-accordion  rounded-0" id="headingOne">
                                <a href="" class="text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#itemAccordion">
                                <div class="card-body">
                                <p class="mb-0 text-muted">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                </p> 
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="card mb-1 border shadow-none">
                            <div class="card-header  rounded-0" id="headingTwo">
                                <a href="" class="collapsed text-dark" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Collapsible Group Item #2
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="mb-0 text-muted">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                    </p> 
                                </div>
                            </div>
                        </div>
                        <div class="card mb-0 border shadow-none">
                            <div class="card-header  rounded-0" id="headingThree">
                                <a href="" class="collapsed text-dark" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="mb-0 text-muted">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                    </p> 
                                </div>
                            </div>
                        </div> -->
                    </div>                                               
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Yes</button>
                </div><!--end modal-footer-->
                
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <script>
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetchTasks();

            function fetchTasks()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchTasks",
                    dataType: "json",
                    success: function (response) {
                        var tags = ['primary','secondary','success','danger','warning','info','dark'];
                        $('tbody').html("");
                        $.each(response.tasks, function (key, task) {
                            var options = new Array();
                            let i = 0;
                            task.items.forEach(function (p){
                                // shuffle(tags);
                                options[i] = '<span class="badge badge-info">Item # '+p.id+'</span>';
                                i = i+1;
                            });
                            $('tbody').append('<tr>\
                            <td>'+task.id+'</td>\
                            <td>'+task.title +'</td>\
                            <td>'+task.site.site+'</td>\
                            <td>'+task.user.name+'</td>\
                            <td>'+options.join(' ')+'</td>\
                            <td><button value="'+task.id+'" style="border: none; background-color: #fff" class="view_btn"><i class="fas fa-eye"></i></button></td>\
                            <td><button value="'+task.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="fa fa-trash"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.view_btn', function (e) {
                e.preventDefault();
                var task_id = $(this).val();
                $('#showTask').modal('show');
                $.ajax({
                    type: "GET",
                    url: 'task/'+task_id,
                    success: function (response) {
                        if (response.status == 404) {
                            $('#showTask').modal('hide');
                        }
                        else {
                            $('#itemAccordion').children().remove().end();
                            $('#showTaskLabel').text('Task ID '+response.task.id);
                            $('#name').text(response.task.user.name);
                            $('#site').text(response.task.site.site);
                            $.each(response.task.items, function (key, item) {
                                console.log(item.status);
                                var options = new Array();
                                var priority = '';
                                var status = '';
                                let i = 0;
                                if(item.priority === "High"){
                                    priority = '<span class="badge badge-warning">'+item.priority+'</span>';
                                }
                                else if(item.priority === "Low"){
                                    priority = '<span class="badge badge-primary">'+item.priority+'</span>';
                                }
                                else{
                                    priority = '<span class="badge badge-secondary">'+item.priority+'</span>';
                                }
                                if(item.status === "Completed"){
                                    status = '<span class="badge badge-success">'+item.status+'</span>';
                                }
                                else if(item.status === "Overdue"){
                                    status = '<span class="badge badge-danger">'+item.status+'</span>';
                                }
                                else{
                                    status = '<span class="badge badge-secondary">'+item.status+'</span>';
                                }
                                item.item_galleries.forEach(function (p){
                                    options[i] = '<img src="'+p.image+'" width="200px" height="100px" alt="" class="rounded float-left ml-3 mb-3">';
                                    i++;
                                });
                                $('#itemAccordion').append('<div class="card border mb-1 shadow-none">\
                                    <div class="card-header custom-accordion  rounded-0" id="headingOne">\
                                        <a href="" class="text-dark" data-toggle="collapse" data-target="#collapse'+item.id+'" aria-expanded="true" aria-controls="collapseOne">Item ID # '+item.id+'</a>\
                                    </div>\
                                    <div id="collapse'+item.id+'" class="collapse" aria-labelledby="heading'+item.id+'" data-parent="#itemAccordion">\
                                        <div class="card-body">\
                                        <div class="row">'+options.join(' ')+'\
                                        </div>\
                                        <div class="row">\
                                            <div class="col-sm-6"><h5 class="mb-0 text-muted">Priority</h5></div>\
                                            <div class="col-sm-6"><p class="mb-0 text-muted">'+priority+'</p></div>\
                                        </div>\
                                        <div class="row">\
                                            <div class="col-sm-6"><h5 class="mb-0 text-muted">Status</h5></div>\
                                            <div class="col-sm-6"><p class="mb-0 text-muted">'+status+'</p></div>\
                                        </div>\
                                        <div class="row">\
                                            <div class="col-sm-6"><h5 class="mb-0 text-muted">Progress</h5></div>\
                                            <div class="col-sm-6"><p class="mb-0 text-muted">'+item.progress+'</p></div>\
                                        </div>\
                                        </div>\
                                    </div>\
                                </div>')
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var task_id = $(this).val();
                $('#deleteTask').modal('show');
                $('#task_id').val(task_id)
            });

            $(document).on('submit', '#deleteTaskForm', function (e) {
                e.preventDefault();
                var task_id = $('#task_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'task/'+task_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteTask').modal('hide');
                        }
                        else {
                            fetchTasks();
                            $('#deleteTask').modal('hide');
                        }
                    }
                });
            });

        });
    </script>
@endsection