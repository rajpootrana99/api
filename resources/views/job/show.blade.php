@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Entities</h4>
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
                        <h3>{{ $job->title }}</h3>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#details" role="tab" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#images" role="tab" aria-selected="false">Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#files" role="tab" aria-selected="false">Files</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane p-3 active" id="details" role="tabpanel">
                        <div class="row">
                                <div class="col-6">
                                    <span class="row"><strong>Site :  </strong>  {{ $job->site->site }}</span>
                                    <span class="row"><strong>Address :  </strong>  {{ $job->site->site_address }}</span>
                                    <span class="row"><strong>Description :  </strong>  {{ $job->title }}</span>
                                    <span class="row"><strong>Owner :  </strong>  {{ $job->entity->entity }}</span>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-center">Notes</h4>
                                    <div class="form-group row justify-center" style="margin-bottom: 0px !important;">
                                        <input class="form-control" type="text" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-3" id="images" role="tabpanel">

                            <div id="uploadImagesContainer">
                                {{-- <div class="form-group">
                                    <div class="justify-content-between align-items-center" style="display:flex;padding-bottom: 5px;"
                                        id="image_modal_action_tab">
                                        <div class="h5">Actions</div>
                                        <div class="" btn-group role="group">
                                            <button onclick="removeSelectedImages()" type="button" class="btn btn-secondary"
                                                style="display: inline-flex;align-items:center;gap:5px;">
                                                <i style="width:20px" data-feather="trash-2"></i> Remove Images
                                            </button>
                                            <button onclick="selectImageAll()" id="select_all_image_btn" type="button"
                                                class="btn btn-primary" style="display: inline-flex;align-items:center;gap:5px;">
                                                <i style="width:18px" data-feather="check-square"></i> Select All
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                                <input id="uploadImages" name="uploadImages[]" type="file" multiple>
                            </div>

                            <div class="modal-content d-none">
                                <div class="modal-body">


                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="image_files_text" placeholder="No Images Selected"
                                                disabled>
                                            <div class="input-group-append">
                                                <label class="btn btn-secondary" for="images_1" onclick="loadImagesContainer(this)"
                                                    id="file_select_button">Select or Add Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="justify-content-between align-items-center" style="display:flex;padding-bottom: 5px;"
                                            id="image_modal_action_tab">
                                            <div class="h5">Actions</div>
                                            <div class="" btn-group role="group">
                                                <button onclick="removeSelectedImages(this)" type="button" class="btn btn-secondary"
                                                    style="display: inline-flex;align-items:center;gap:5px;">
                                                    <i style="width:20px" data-feather="trash-2"></i> Remove Images
                                                </button>
                                                <button onclick="selectImageAll()" id="select_all_image_btn" type="button"
                                                    class="btn btn-primary" style="display: inline-flex;align-items:center;gap:5px;">
                                                    <i style="width:18px" data-feather="check-square"></i> Select All
                                                </button>
                                            </div>
                                        </div>
                                        <div class="images_container">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-3" id="files" role="tabpanel">
                            <p class="mb-0 text-muted">
                                @include("explorer.simulator")
                            </p>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<style>


    #uploadImagesContainer * .file-drop-zone {
        overflow-x: unset;
        height: unset;
    }

    #uploadImagesContainer * .file-preview-thumbnails {
        display: unset;
    }


    #uploadImagesContainer * .kv-file-zoom {
        display: unset
    }

    #uploadImagesContainer * .has-error .help-block {
        display: unset;
    }

    .selectable_image {
        position: absolute;
        display: flex;
        border: none;
        margin: 10px;
        z-index: 10;
        background: black;
        top: 0;
        right: 0;
        /* padding: 2px; */
        transition: 0.1s all ease-out;
    }
</style>
<script defer>

    // Images tab script
    var images_root_path = "{{$currentPath}}"


    $(document).ready(function () {
        fetchTaskFileImages()
    });

    // function removeSelectedImages() {
    //     let checkboxes = $("#uploadImagesContainer * .file-preview-thumbnails > .file-preview-frame > input[type=checkbox]")

    //     for(let i = 0; i < checkboxes.length; i++)
    //     {

    //         let id = checkboxes[i].getAttribute("data-id")


    //         if(checkboxes[i].checked){
    //             console.log(document.getElementById(id).getElementsByClassName("kv-file-remove")[0])
    //             setTimeout(() => {
    //             console.log(document.getElementById(id).getElementsByClassName("kv-file-remove")[0].click())
    //             }, 100);
    //             // console.log(id)
    //         }
    //     }

    // }

    // function selectImageAll() {
    //     let click_on_images = (flag) => {
    //         $(".images_container * input[type='checkbox']").each(function(index, element) {
    //             element.checked = flag
    //         });
    //     }
    //     if (image_check.classList.contains("active")) {
    //         click_on_images(false)
    //         image_check.classList.remove("active")
    //     } else {
    //         click_on_images(true)
    //         image_check.classList.add("active")
    //     }
    // }

    function fetchTaskFileImages() {
        $.ajax(`{{route('explorer.kerajeeGetImages')}}`, {
            type: "GET",
            data: {
                uploadFolderPath: btoa(images_root_path)
            },
            success: function(data, status, xhr) {
                    $("#uploadImages").fileinput({
                        // maxFileSize: 2000,
                        // maxFilesNum: 10,
                        // theme: "fas",
                        uploadUrl: "{{route('explorer.uploadImages')}}",
                        uploadAsync: true,
                        deleteUrl: "{{route('explorer.delete')}}",
                        uploadExtraData: {
                        _token: "{{csrf_token()}}",
                        uploadFolderPath: btoa(images_root_path)
                        },
                        deleteExtraData: {
                        _token: "{{csrf_token()}}",
                        uploadFolderPath: btoa(images_root_path)

                        },
                        overwriteInitial: false,
                        // processDelay: 1000,
                        // queueDelay: 100,
                        maxAjaxThreads: 999999,

                        removeFromPreviewOnError:true,
                        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],

                        showUpload: false, // hide upload button
                        showRemove: false, // hide remove button
                        msgDuplicateFile: 'File "{name}" of same size "{size} KB" has already been selected earlier. Skipping duplicate selection.',
                        browseOnZoneClick: true,
                        dropZoneTitleClass: 'file-drop-zone-title ',
                        dropZoneClickTitle: "",
                        dropZoneTitle: `<i class="bi bi-cloud-upload" style="font-size: 4em;"></i>
                        <div style="font-size: 0.8em;">Drag and drop file here or click</div>`,

                        initialPreview: data.initialPreview,
                        initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                        initialPreviewConfig: data.initialPreviewConfig

                    })
                    // .on('fileenabled', function(event) {
                    //     console.log('File enabled');
                    // })

                    // .on('fileloaded', function(event, file, previewId, fileId, index, reader) {

                    //     document.getElementById(fileId).innerHTML += `<input type="checkbox" data-id="${fileId}" class="form-check-input selectable_image">`

                    //     console.log("fileloaded");

                    // })
                    .on("filebatchselected", function(event, files) {
                        $("#uploadImages").fileinput("upload");
                    })
                    .on('fileuploaderror', function(event, data, msg) {
                        if(msg.search("already exists") != -1)
                        {
                            setTimeout(() => {
                            document.getElementById("thumb-uploadImages-"+data.fileId ).getElementsByClassName("kv-file-remove")[0].click()
                        }, 500);
                        }


                        console.log(data)
                        console.log('File uploaded Error', data.previewId, data.index, data.fileId, msg);
                    })
                    // .on('fileuploaded', function(e, params) {
                    //     console.log('file uploaded', e, params);
                    // })
                    // .on('filesuccessremove', function(e, id) {
                    //     console.log('file success remove', e, id);
                    // });


                    // let frames = $("#uploadImagesContainer * .file-preview-thumbnails > .file-preview-frame")
                    // for(let i = 0; i < frames.length; i++)
                    // {
                    //     // console.log(frames[i])
                    //     setTimeout(() => {

                    //     frames[i].innerHTML += `<input type="checkbox" data-id="${frames[i].getAttribute("data-fileid")}" class=" selectable_image">`
                    //     }, 1000);
                    // }




            },
            error: function(xhr, textStatus, errorMessage) {
                showToast("Unable to load images from \"" + (images_root_path) + "\". Check your network connection or try again", "danger")
            },
        })
    }

</script>

@endsection
