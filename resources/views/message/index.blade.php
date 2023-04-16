<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Maintenance App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Maintenance App" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Jquery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

    @include('layouts.partials.sidebar')

    <div class="page-wrapper">
        @include('layouts.partials.header')

        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">Chat</h4>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger border-0" style="display: none" role="alert" id="warning_alert"></div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div><!--end row-->

                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-8">
                        <div class="chat-box-left">
                            <div class="chat-header">
                                <h4 class="text-center">User</h4>
                            </div><!--end chat-search-->
                            <hr>
                            <div data-simplebar>
                                <div class="tab-content chat-list" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="people_list">

                                    </div><!--end general chat-->
                                </div><!--end tab-content-->
                            </div>
                        </div><!--end chat-box-left -->

                        <div class="chat-box-right">
                            <div class="chat-header">
                                <a class="media">
                                    <div class="media-left">
                                        <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle thumb-md" id="sender-image">
                                    </div><!-- media-left -->
                                    <div class="media-body">
                                        <div>
                                            <h6 class="m-0" id="sender-name"></h6>
                                        </div>
                                    </div><!-- end media-body -->
                                </a><!--end media-->
                                <div class="chat-features">
                                    <div class="d-none d-sm-inline-block">
                                        <a href=""><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div><!-- end chat-features -->
                            </div><!-- end chat-header -->
                            <div class="chat-body" data-simplebar>
                                <div class="chat-detail" id="messages">
                                    <div class="media">
                                        <p>Select User to Chat</p>
                                    </div><!--end media-->


                                </div> <!-- end chat-detail -->
                            </div><!-- end chat-body -->
                            <form id="sendMessageForm">
                                @csrf
                                <div class="chat-footer">
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <span class="chat-admin"><img src="assets/images/users/user-8.jpg" alt="user" class="rounded-circle thumb-sm"></span>
                                            <input type="hidden" name="receiver_id" id="receiver_id">
                                            <input type="hidden" name="task_id" id="task_id">
                                            <input type="text" class="form-control" name="message" id="message_input" placeholder="Type something here...">
                                        </div><!-- col-8 -->
                                        <div class="col-3 text-right">
                                            <div class="d-none d-sm-inline-block chat-features">
                                                <button type="submit" class="btn btn-primary btn-sm" id="message_send"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end chat-footer -->
                            </form>
                        </div><!--end chat-box-right -->
                    </div> <!-- end col -->
                    <div class="col-3">
                        <div class="chat-box-left">
                            <div class="chat-header">
                                <h4 class="text-center">Task</h4>
                            </div><!--end chat-search-->
                            <hr>

                            <div data-simplebar>
                                <div class="tab-content chat-list" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="task_list">

                                    </div><!--end general chat-->
                                </div><!--end tab-content-->
                            </div>
                        </div><!--end chat-box-left -->
                    </div> <!-- end col -->
                </div><!-- end row -->

            </div><!-- container -->

            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.analytics_dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-upload.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('assets/pages/jquery.forms-advanced.js')}}"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
            $('.custom-file-input').css('overflow', 'hidden');
        });
    </script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {

            var user_id = 0;
            var task_id;
            var task = 0;

            function fetchMessages() {
                $.ajax({
                    type: "GET",
                    url: 'fetchMessages/' + user_id,
                    success: function(response) {
                        task = 0;
                        fetchTasks();
                        console.log(response)
                        $('#messages').children().remove().end();
                        if (response.sender.image) {
                            image = '<img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle thumb-md">'
                        } else {
                            $('#sender-image').attr('src', 'storage/' + response.sender.image)
                        }
                        $('#sender-name').text(response.sender.name);
                        $.each(response.messages, function(key, message) {
                            if (message.sender_id == 1) {
                                $('#receiver_id').val(message.receiver_id);
                            } else {
                                $('#receiver_id').val(message.sender_id);
                            }
                            $('#task_id').val(message.task_id);
                            console.log(message);
                            var reverse = '';
                            if (message.sender_id == 1) {
                                reverse = "reverse";
                            }
                            $('#messages').append('<div class="media">\
                            <div class="media-body ' + reverse + '">\
                                <div class="chat-msg">\
                                    <p>' + message.message + '</p>\
                                </div>\
                            </div>\
                        </div>')
                        });
                    }
                });
            }

            function fetchTaskMessages() {
                $.ajax({
                    type: "GET",
                    url: 'fetchTaskMessages/' + task_id,
                    success: function(response) {
                        if (response.status === true) {
                            task = 1;
                            console.log(response)
                            $('#messages').children().remove().end();
                            $('#sender-name').text(response.messages[0].task.title);
                            $.each(response.messages, function(key, message) {
                                if (message.sender_id == 1) {
                                    $('#receiver_id').val(message.receiver_id);
                                } else {
                                    $('#receiver_id').val(message.sender_id);
                                }
                                $('#task_id').val(message.task_id);
                                console.log(message);
                                var reverse = '';
                                if (message.sender_id == 1) {
                                    reverse = "reverse";
                                }
                                $('#messages').append('<div class="media">\
                                        <div class="media-body ' + reverse + '">\
                                            <div class="chat-msg">\
                                                <p>' + message.message + '</p>\
                                            </div>\
                                        </div>\
                                    </div>')
                            });
                        } else {
                            $('#messages').children().remove().end();
                            $('#messages').append('<p>' + response.message + '</p>')
                            $('#task_id').val(task_id);
                        }
                    }
                });
            }

            fetchPeoples();

            function fetchPeoples() {
                $.ajax({
                    type: "GET",
                    url: "fetchPeoples",
                    dataType: "json",
                    success: function(response) {
                        // $('tbody').html("");
                        $.each(response.users, function(key, user) {
                            var image;
                            if (user.sender.image == " ") {
                                image = '<img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle thumb-md">'
                            } else {
                                image = '<img src="storage/' + user.sender.image + '" height="50px" alt="user" class="rounded-circle thumb-md">'
                            }
                            $('#people_list').append('<a href="' + user.sender.id + '" class="media new-message" id="view-message">\
                            <div class="media-left">\
                                ' + image + '\
                            </div>\
                            <div class="media-body">\
                                <div>\
                                    <h6>' + user.sender.name + '</h6>\
                                </div>\
                            </div>\
                        </a>')
                        });
                    }
                });
            }

            fetchTasks();

            function fetchTasks() {
                if (user_id === 0) {
                    $('#task_list').children().remove().end();
                    $('#task_list').append('<a href="' + task.id + '" class="media new-message" id="view-task-message">\
                                    <h6>Select people</h6>\
                        </a>')
                } else {
                    $.ajax({
                        type: "GET",
                        url: "fetchUserTasks/" + user_id,
                        dataType: "json",
                        success: function(response) {
                            $('#task_list').children().remove().end();
                            $.each(response.tasks, function(key, task) {
                                console.log(task)
                                var image = '<img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle thumb-md">'
                                $('#task_list').append('<a href="' + task.id + '" class="media new-message" id="view-task-message">\
                            <div class="media-body">\
                                <div>\
                                    <h6>' + task.title + '</h6>\
                                </div>\
                            </div>\
                        </a>')
                            });
                        }
                    });
                }
            }

            $(document).on("click", "#view-message", function(e) {
                e.preventDefault();
                user_id = $(this).attr('href');
                fetchMessages();
            })

            $(document).on("click", "#view-task-message", function(e) {
                e.preventDefault();
                task_id = $(this).attr('href');
                fetchTaskMessages();
            })

            $(document).on("submit", "#sendMessageForm", function(e) {
                e.preventDefault();
                let has_error = false;
                if ($('#message_input').value == "") {
                    $("#warning_alert").html(
                        "<strong>Error! Please enter a message</strong>"
                    );
                    $("#warning_alert").css("display", "block");
                    setTimeout(function() {
                        $("#warning_alert").css("display", "none");
                    }, 5000);
                    has_error = true;
                }
                if (has_error) {
                    return;
                }
                let formDate = new FormData($('#sendMessageForm')[0]);
                $.ajax({
                    type: "post",
                    url: "send-message",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(response) {
                        $('#sendMessageForm')[0].reset();
                        if (task === 1) {
                            fetchTaskMessages();
                        } else {
                            fetchMessages();
                        }
                    },
                    error: function(error) {
                        $('#warning_alert').html('<strong>Warning! </strong>' + error)
                        $('#warning_alert').css('display', 'block')
                        setTimeout(function() {
                            $('#warning_alert').css('display', 'none')
                        }, 5000)
                    }
                });
            });

        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- socket.io cdn -->
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>

</body>

</html>