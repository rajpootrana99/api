    @extends('layouts.base')
        <!-- the fileinput plugin styling CSS file -->
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <!-- buffer.min.js and filetype.min.js are necessary in the order listed for advanced mime type parsing and more correct
         preview. This is a feature available since v5.5.0 and is needed if you want to ensure file mime type is parsed
         correctly even if the local file's extension is named incorrectly. This will ensure more correct preview of the
         selected file (note: this will involve a small processing overhead in scanning of file contents locally). If you
         do not load these scripts then the mime type parsing will largely be derived using the extension in the filename
         and some basic file content parsing signatures. -->

    @section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Explorer</h4>
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
                        <div class="col-sm-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb blue-grey lighten-4">

                                </ol>
                            </nav>
                        </div>

                    </div><!--end card-header-->
                    {{-- <div class="card-header">
                        <div class="col-sm-12">
                            <a href="" data-toggle="modal" data-target="#addFolder" id="addFolderButton" class="btn btn-primary" style="float:right;margin-left: 10px"><i class="fa fa-plus"></i> New Folder </a>
                        </div>
                    </div><!--end card-header--> --}}
                    <div class="card-body">
                        <div class="table-responsive mb-0 fixed-solution">
                            <table id="explorer_datatable" class="table dt-responsive nowrap mb-0 table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        {{-- <th><i data-feather="plus-square"></i></th> --}}
                                        <th></th>
                                        <th width="45%">Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Date Modified</th>
                                        <th></th>
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

    {{-- <div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntityLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="addEntityLabel">Add Site</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form method="post" id="addEntityForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="type" id="type" style="width: 100%; height:30px;">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="0">Client</option>
                                        <option value="1">Suplier</option>
                                    </select>
                                    <span class="text-danger error-text type_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="select2 pl-1 form-control" name="active" id="active" style="width: 100%; height:30px;">
                                        <option value="" disabled selected>Select Active</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger error-text active_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="entity" id="entity" placeholder="Enter Entity">
                                    <span class="text-danger error-text entity_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="email" placeholder="Enter Email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="address" id="address" placeholder="Enter Address">
                                    <span class="text-danger error-text address_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="primary_phone" id="primary_phone" placeholder="Enter Primary Phone">
                                    <span class="text-danger error-text primary_phone_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="mobile" id="mobile" placeholder="Enter Mobile">
                                    <span class="text-danger error-text mobile_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="fax" id="fax" placeholder="Enter Fax">
                                    <span class="text-danger error-text fax_error"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="director" id="director" placeholder="Enter Director">
                                    <span class="text-danger error-text director_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="trade" id="trade" placeholder="Enter Trade">
                                    <span class="text-danger error-text trade_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="abn" id="abn" placeholder="Enter ABN">
                                    <span class="text-danger error-text abn_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="inc" id="inc" placeholder="Enter Inc">
                                    <span class="text-danger error-text inc_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="abbrev" id="abbrev" placeholder="Enter Abbrev">
                                    <span class="text-danger error-text abbrev_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="contract_signed" id="contract_signed" placeholder="Enter Contract Signed">
                                    <span class="text-danger error-text contract_signed_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="payment_terms" id="payment_terms" placeholder="Enter Payment Terms">
                                    <span class="text-danger error-text payment_terms_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="pl_expirey" id="pl_expirey" placeholder="Enter PL Expiry">
                                    <span class="text-danger error-text pl_expirey_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="wc_expirey" id="wc_expirey" placeholder="Enter WC Expiry">
                                    <span class="text-danger error-text wc_expirey_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="item_type" id="item_type" placeholder="Enter Item Type">
                                    <span class="text-danger error-text item_type_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" style="width: 100%; height:30px;" type="text" name="path" id="path" placeholder="Enter Path">
                                    <span class="text-danger error-text path_error"></span>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div><!--end modal-footer-->
                </form>
            </div>
        </div><!--end modal-content-->
    </div>
 --}}

    <div class="modal fade" id="editFileFolder" tabindex="-1" role="dialog" aria-labelledby="editFileFolderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="editFileFolderLabel"></h6>
                    <button type="button" class="close " id="editFileFolderClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form id="editFileFolderForm" onsubmit="saveEditedData(); return false">

                    <div class="modal-body">
                            <input type="hidden" name="fileFolderPath" id="fileFolderPath">

                            <div class="form-group ">
                                <label for="editFileFolderName" id="editFileFolderNameLabel" >Folder Name</label>
                                <input type="text" class="form-control" id="editFileFolderName" required value="">
                            </div>

                            <div class="form-group ">
                                <label for="editFileFolderType" id="editFileFolderTypeLabel" >Type</label>
                                <input type="text" class="form-control" disabled id="editFileFolderType" value="">
                            </div>

                            <div class="form-group">
                                <label for="editFileFolderSequence" id="editFileFolderSequenceLabel" class="mt-2">Sequence</label>
                                <input type="number" class="form-control" id="editFileFolderSequence" value="0">
                            </div>

                            <div class="form-group">
                                <label for="editFileFolderParentFolder" id="editFileFolderParentFolderLabel" class="mt-2">Parent Folder</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editFileFolderParentFolder" disabled value="">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button" onclick="loadFolderTree()" data-toggle="modal" data-target="#selectFolder" >Change</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="editShareWithSuppliers" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                        <label class="custom-control-label" for="editShareWithSuppliers">Share with Suppliers</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="editShareWithClients" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                        <label class="custom-control-label" for="editShareWithClients">Share with Clients</label>
                                    </div>
                                </div>
                            </div>

                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" id="editFileFolderButton" class="btn btn-primary btn-sm">Add</button>
                    </div><!--end modal-footer-->
                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="uploadFileLabel">Upload Files</h6>
                    <button type="button" class="close " id="uploadFileClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form action="javascript:void(0)" enctype="multipart/form-data" id="uploadFileForm" class="needs-validation" novalidate>

                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="">
                            <input type="text" name="uploadFolderPath" id="uploadFolderPath" hidden>
                        </div>


                        <div class="form-group" id="uploadFilesContainer">
                            <input id="uploadFiles" name="uploadFiles[]" type="file" multiple>
                        </div>

                        <div class="form-group">
                            <label for="uploadFileOwner" class="mt-2" id="uploadFileOwnerLabel">Owner</label>
                            <div class="input-group has-validation">
                                <select class="form-select form-control" name="uploadFileOwner" id="uploadFileOwner" required>
                                    <option  value="" disabled selected >Select Owner</option>
                                </select>
                                <span class="input-group-append">
                                    <button class="btn btn-light" style="    font-size: x-large;" type="button">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </span>
                                <div class="invalid-feedback">
                                    Please select atleast one owner.
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="uploadFileGroup" class="mt-2" id="uploadFileGroupLabel">Group</label>
                            <div class="input-group has-validation">
                                <select class="form-select form-control" name="uploadFileGroup" id="uploadFileGroup" required>
                                    <option value="" disabled selected>Select Group</option>
                                </select>
                                <span class="input-group-append">
                                    <button class="btn btn-light" style="    font-size: x-large;" type="button">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </span>
                                <div class="invalid-feedback">
                                    Please select atleast one group.
                                </div>
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="uploadFileStatus" class="mt-2" id="uploadFileStatusLabel">Status</label>
                            <div class="input-group has-validation">
                                <select class="form-select form-control" name="uploadFileStatus" id="uploadFileStatus" required>
                                    <option value="" disabled  selected>Select Status</option>
                                </select>
                                <span class="input-group-append">
                                    <button class="btn btn-light" style="    font-size: x-large;" type="button">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </span>
                                <div class="invalid-feedback">
                                    Please select atleast one status.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uploadFileFolder" id="uploadFileFolderLabel" class="mt-2">Folder</label>
                            <select class="form-select form-control" name="uploadFileFolder" id="uploadFileFolder" required>
                                <option value="" disabled  selected>Select Folder</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select atleast one folder.
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="uploadFileNumber" id="uploadFileNumberLabel" class="mt-2">Number</label>
                            <input type="number" class="form-control" name="uploadFileNumber" id="uploadFileNumber" required value="" placeholder="Number">
                            <div class="invalid-feedback">
                                Please enter number.
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="uploadFileRevision" id="uploadFileRevisionLabel" class="mt-2">Revision</label>
                            <input type="text" class="form-control" name="uploadFileRevision" id="uploadFileRevision" required placeholder="Revision" value="">
                            <div class="invalid-feedback">
                                Please enter revision.
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="uploadFileRevisionDate" id="uploadFileRevisionDateLabel" class="mt-2">Revision Date</label>
                            <input type="date" class="form-control" name="uploadFileRevisionDate" id="uploadFileRevisionDate" required value="">
                            <div class="invalid-feedback">
                                Please select revision date.
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" name="uploadFileOptions[]" id="uploadFileInduction"
                                        data-parsley-multiple="groups" data-parsley-mincheck="2">
                                    <label class="custom-control-label" for="uploadFileInduction">
                                        Induction (Must read during induction (WHS only))
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <div class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" name="uploadFileOptions[]" id="uploadFileShared"
                                        data-parsley-multiple="groups" data-parsley-mincheck="2">
                                    <label class="custom-control-label" for="uploadFileShared">
                                        Shared (Checked means All personnel can view. Unchecked means only your employees can view.)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <div class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" name="uploadFileOptions[]"  id="uploadFileQuote"
                                        data-parsley-multiple="groups" data-parsley-mincheck="2">
                                    <label class="custom-control-label" for="uploadFileQuote">
                                        Quote Package Document
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end modal-body-->
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="uploadFileButton" class="btn btn-primary btn-sm">Upload</button>
                    </div><!--end modal-footer-->
                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <div class="modal fade" id="selectFolder" tabindex="-1" role="dialog" aria-labelledby="selectFolderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="selectFolderLabel">Select Folder</h6>
                    <button type="button" class="close " id="selectFolderClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="selectFolderTree"></div>
                        </div>


                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" id="selectFolderButton" class="btn btn-primary btn-sm">Select</button>
                    </div><!--end modal-footer-->
                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <div class="modal fade" id="createFolder"tabindex="-1" role="dialog" aria-labelledby="createFolderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title m-0 text-white" id="createFolderLabel">Add New Folder</h6>
                    <button type="button" class="close " id="createFolderClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div><!--end modal-header-->
                <form onsubmit="createFolder(); return false" id="createFolderForm">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="createFolderName" id="createFolderNameLabel" >Folder Name</label>
                            <input type="text" class="form-control" id="createFolderName" required value="">
                        </div>
                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" id="createFolderButton" class="btn btn-primary btn-sm">Yes</button>
                    </div><!--end modal-footer-->
                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>

    <script defer>
        let table = null
        let editIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
        let uploadIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>';
        let trashIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';

        let root_path = "{{$currentPath}}"
        let navigationStack = null;
        let csrf = "{{csrf_token()}}"


        function updateNavigation()
            {
                let breadcrumb = document.getElementsByClassName("breadcrumb")[0]
                root_path = root_path.toWellFormed()
                let pathArray = root_path.split("/");
                // console.log(pathArray)
                navigationStack = new Array();
                let storagePathString = "";
                let breadString = "";
                for (let i = 0; i < pathArray.length; i++)
                {
                    if( i == 0  ) storagePathString += pathArray[i];
                    else storagePathString += "/"+pathArray[i];

                    navigationStack.push(storagePathString);
                    if ( i < pathArray.length-1 )
                    {
                        breadString += '<li class="breadcrumb-item">'+
                                            '<a class="black-text" onclick="navigateTo(\''+storagePathString+'\')" href="Javascript:void(0);"> '+ pathArray[i][0].toUpperCase() + (pathArray[i].length > 1 ? pathArray[i].substring(1, pathArray[i].length) : "") +' </a>'+
                                            '<i class="fas fa-angle-double-right mx-2" aria-hidden="true"></i>'+
                                            '</li>';
                    }
                    else if( i == pathArray.length-1 )
                    {
                        breadString += '<li class="breadcrumb-item active"> '+ pathArray[i][0].toUpperCase() + (pathArray[i].length > 1 ? pathArray[i].substring(1, pathArray[i].length) : "") +' </li>'
                    }
                }
                breadcrumb.innerHTML = breadString;
            }
            updateNavigation();


        $(document).ready(function() {

            let DATA = null;


            table = $("#explorer_datatable").DataTable({
                searching: true,
                paging: false,
                ordering: false,
                serverSide: true,
                processing: true,
                select: true,
                data: null,
                drawCallback: function (settings) {
                    $(".tooltip").remove()

                    console.log("table has be redrawn")

                    var toolbar = document.querySelector("#explorer_datatable_wrapper > .row > div");
                    if( root_path.split("/").length > 2 ) toolbar.innerHTML = '<button data-toggle="modal" data-target="#createFolder" class="btn btn-primary mr-1" style="" title="New Folder"><i class="fa fa-plus"></i> New Folder </button>'
                    else toolbar.innerHTML = ""
                    //activating tooltips
                    setTimeout(() => {
                        $('[data-toggle="tooltip"]').tooltip()
                    }, 200);
                },
                ajax: {
                        url: "{{ route("explorer.get") }}",
                        type: "POST",
                        data: function (params) {
                            params.path = root_path
                            // params.query = ""
                            params._token = "{{csrf_token()}}"
                        }
                },


                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {
                            // console.log(data)

                            DATA = data
                            if(DATA.ifFileCount > 0){
                                return '<i class="bi bi-plus-square btn-light" title="Has Files"></i>';
                            }
                            return ' ';
                        },
                    },
                    {
                        data: 'Name',
                        render: function (data, type, row) {
                            // console.log(data)
                            let iconDesc = DATA.type == "File Folder" ? "bi-folder-fill" : ("bi-filetype-"+DATA.type.toLowerCase());
                            let routeDesc = DATA.type == "File Folder" ? "href=\"Javascript:void(0);\" onclick=\"navigateTo('"+DATA.encodedRoute+"')\"" : "href='"+DATA.fileRoute+"' download ";
                            let temp = '<a  ' + routeDesc + ' style="display: flex;align-items:center;column-gap:5%">'+
                                '<i class="bi '+ iconDesc +' h2"></i>'+
                               "<span class='text-truncate' data-toggle='tooltip' data-placement='top' title data-original-title='"+ atob(DATA.encodedRoute) +"'> "+ ( DATA.searchResult == "true" ? DATA.name+"<div class='text-muted'>"+atob(DATA.encodedRoute)+"</div>" : DATA.name ) +"</span>"+
                            "</a>";
                            // console.log(temp)
                            return temp;
                        },
                    },
                    {
                        data: 'Type',
                        render: function (data, type, row) {
                            // console.log(data)
                            return DATA.type;
                        },
                    },
                    {
                        data: 'Size',
                        render: function (data, type, row) {
                            return DATA.size;
                        },
                    },
                    {
                        data: 'Date Modified',
                        render: function (data, type, row) {
                            return DATA.dateModified;
                        },
                    },
                    {
                        data: null,
                        render: function (data, type, row) {

                            return '<button data-toggle="modal" data-target="#editFileFolder" onclick="loadEditingData(\''+ data.encodedRoute +'\')" class="btn btn-light folder_action_button" onclick="deleteFileFolder(this)" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit">'+ editIcon +'</button>'+
                            ( root_path.split("/").length >= 2 ? '<button data-toggle="modal" data-target="#uploadFile" onclick="loadUploadFolderInfo(\''+ data.encodedRoute +'\')" class="btn btn-light  folder_action_button" style="" data-toggle="tooltip" data-placement="top" title="Upload" data-original-title="Upload Files in Current Folder">'+ uploadIcon +'</button>' : " ") +
                            '<button class="btn btn-light folder_action_button" onclick="deleteFileFolder(\''+ data.encodedRoute +'\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">'+ trashIcon +'</button>'
                            ;

                        },
                    },
                ],
                order: []
            })


            // $(".dropify").dropfiy()

        })

        function navigateTo(path)
        {
            root_path = atob(path);
            table.ajax.reload(null, false)
            updateNavigation()
            console.log("reached 1");
        }

        function loadUploadFileInputDialog()
        {
            $("#uploadFilesContainer")[0].innerHTML = '<input id="uploadFiles" name="uploadFiles[]" type="file" multiple>'
            $("#uploadFiles").fileinput({
                    // maxFileSize: 2000,
                    // maxFilesNum: 10,
                    // theme: "fas",
                    msgFilerequired: false,
                    required: true,
                    hideThumbnailContent: false,
                    showBrowse: false,
                    showUpload: false,
                    browseOnZoneClick: true,
                    overwriteInitial: true,
                    initialPreviewShowDelete: true,
                    removeFromPreviewOnError: true,
                    showRemove: true,
                    showUpload: false,
                    dropZoneTitleClass: 'file-drop-zone-title ',
                    dropZoneClickTitle: "",
                    dropZoneTitle: '<i class="bi bi-cloud-upload" style="font-size: 4em;"></i><div style="font-size: 0.8em;">Drag and drop file here or click</div>'
                });
        }


        function loadUploadFolderInfo(file)
        {
            var form = document.getElementById("uploadFileForm");
            $('#uploadFileForm').trigger("reset");
            loadUploadFileInputDialog()

            $.ajax("{{route('explorer.getUploadFolderInfo',"")}}" + "/" + file,{
                    type: "GET",
                    // data: formData,
                    success: function (data, status, xhr) {
                        if( !!data.uploadFolderPath ){
                            // showToast("Files uploaded successfully in folder \""+ atob(data.uploadFolderPath) + "\".", "success")
                            // storing path
                                $("#uploadFolderPath").val(file)
                                //filling owners
                                let input = document.getElementById("uploadFileOwner");
                                input.innerHTML = '<option  value="" disabled selected >Select Owner</option>';
                                for (let i = 0; i < data.owner.length; i++) {
                                    let temp = '<option value="'+(i+1)+'" >'+ data.owner[i] +'</option>';
                                    input.innerHTML += temp
                                }
                                //filling groups
                                input = document.getElementById("uploadFileGroup");
                                input.innerHTML = '<option  value="" disabled selected >Select Group</option>';
                                for (let i = 0; i < data.group.length; i++) {
                                    let temp = '<option value="'+(i+1)+'" >'+ data.group[i] +'</option>';
                                    input.innerHTML += temp
                                }
                                //filling status
                                input = document.getElementById("uploadFileStatus");
                                input.innerHTML = '<option  value="" disabled selected >Select Status</option>';
                                for (let i = 0; i < data.status.length; i++) {
                                    let temp = '<option value="'+(i+1)+'" >'+ data.status[i] +'</option>';
                                    input.innerHTML += temp
                                }
                                //filling folder
                                input = document.getElementById("uploadFileFolder");
                                input.innerHTML = '<option  value="" disabled selected >Select Folder</option>';
                                for (let i = 0; i < data.folder.length; i++) {
                                    let temp = '<option value="'+(i+1)+'" >'+ data.folder[i] +'</option>';
                                    input.innerHTML += temp
                                }



                        }
                        else {
                            showToast("Unable to load folder \""+ atob(file) +"\" data. Try Later!", "danger")
                            $("#uploadFileClose").click()
                        }
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        showToast("Unable to load folder \""+ atob(file) +"\" data. Check your network connection or try again", "danger")
                        $("#uploadFileClose").click()
                    },
                })

            $("#uploadFileForm").on('submit', function (e, v) {
                if(this.checkValidity()) uploadFiles()
            })
        }

        function uploadFiles()
        {
            var form = document.getElementById("uploadFileForm");
            var formData = new FormData(form);

            var folderPath = atob($("#uploadFolderPath").val());
            $.ajax("{{route('explorer.uploadFiles')}}",{
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data, status, xhr) {
                        if( data == "true" ){
                            showToast("Uploaded Files successfully in folder \""+ folderPath + "\".", "success")
                            navigateTo(folderPath)
                        }
                        else showToast("Cannot Upload Files in \""+ (folderPath) +"\". Try Later!", "danger")

                        $("#uploadFileClose").click()
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        showToast("Cannot Upload Files in \""+ (folderPath) +"\". Check your network connection or try again", "danger")
                    },
                })


                // $('#event_result').html('Selected: ' + r.join(', '));
        }

        let editFileFolderObject = {
            name: null,
            path: null,
            isDir: null,
            type: null,
            oldParentFolderPath: null,
            newParentFolderPath: null,
            sequence: 0,
            share_with_suppliers: null,
            share_with_clients: null,
        };

        function loadFolderTree()
        {

            // $treeRoot = btoa()
            $('#selectFolderTree').jstree({
                'core': {
                    'data': {
                        'url': '{{route("explorer.getFolderTree","explorer")}}',
                        'dataType': 'json',
                    }
                }
            });

            $('#selectFolderTree')
            // listen for event
            .on('changed.jstree', function (e, data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }

                editFileFolderObject.newParentFolderPath = data.node.id;
                // console.log(newParentFolderPath)
                // $('#event_result').html('Selected: ' + r.join(', '));
            })
            // create the instance
            .jstree();


            $('#selectFolderButton').on('click', function (e, data) {
              $('#editFileFolderParentFolder').val(editFileFolderObject.newParentFolderPath)
                $('#selectFolderClose').click()
            })

        }

        function loadEditingData(file)
        {
            $.ajax("{{route('explorer.getEditData')}}",{
                type: "POST",
                data: { file: file, _token : csrf },
                success: function (data, status, xhr) {
                    editFileFolderObject.name = data.name
                    editFileFolderObject.path = data.path
                    editFileFolderObject.type = data.type
                    editFileFolderObject.isDir = data.isDir
                    editFileFolderObject.oldParentFolderPath = data.parentPath

                    $('#editFileFolderLabel').html("Edit " + (data.type == "File Folder" ? "Folder" : "File"))
                    $('#editFileFolderName').val(data.name)
                    $('#editFileFolderType').val(data.type == "File Folder" ? "File Folder" : data.type.toUpperCase())
                    $('#editFileFolderSequence').val(0)
                    $('#editFileFolderParentFolder').val(data.parentPath)
                },
                error: function (xhr, textStatus, errorMessage) {
                    showToast("Cannot retireive file/folder info \""+ atob(file) +"\". Check your network connection or try again", "danger")
                },
            })

        }

        function saveEditedData()
        {

                editFileFolderObject.name =  $('#editFileFolderName').val()
                editFileFolderObject.sequence = $('#editFileFolderSequence').val()
                editFileFolderObject.newParentFolderPath = $('#editFileFolderParentFolder').val()
                editFileFolderObject._token = csrf

                $.ajax("{{route('explorer.saveEditedData')}}",{
                    type: "POST",
                    data: editFileFolderObject,
                    success: function (data, status, xhr) {
                        if( data == "true" ){
                            showToast("\""+ editFileFolderObject.path + "\" has been edited successfully", "success")
                            navigateTo(root_path)
                        }
                        else showToast("Cannot Edit \""+ editFileFolderObject.path +"\". Try Later!", "danger")
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        showToast("Cannot Edit \""+ editFileFolderObject.path +"\". Check your network connection or try again", "danger")
                    },
                })

                $("#editFileFolderClose").click()
                // $('#event_result').html('Selected: ' + r.join(', '));

        }

        function createFolder()
        {
            $.ajax("{{route('explorer.createFolder')}}",{
                type: "POST",
                data: { name: $("#createFolderName").val(), path: root_path, _token : csrf },
                success: function (data, status, xhr) {
                    if( data == "true" ){
                        showToast("Folder \""+ $("#createFolderName").val() + "\" has been created successfully", "success")
                        navigateTo(root_path)
                    }
                    else showToast("Cannot Create folder \""+ $("#createFolderName").val() +"\". Try Later!", "danger")
                },
                error: function (xhr, textStatus, errorMessage) {
                    showToast("Cannot create folder \""+ $("#createFolderName").val() +"\". Check your network connection or try again", "danger")
                },
            })

            $("#createFolderClose").click()

        }

        function deleteFileFolder(file)
        {
            $.ajax("{{route('explorer.delete')}}",{
                type: "POST",
                data: { file: file, _token : csrf },
                success: function (data, status, xhr) {
                    if( data == "true" ){
                        showToast("\""+atob(file) + "\" has been deleted successfully", "success")
                        navigateTo(root_path)
                    }
                    else showToast("Cannot Delete \""+ atob(file) +"\". Try Later!", "danger")
                },
                error: function (xhr, textStatus, errorMessage) {
                    showToast("Cannot delete \""+ atob(file) +"\". Check your network connection or try again", "danger")
                },
            })

        }


        function showToast(text, type)
        {
            let types = {
                success: ["#03d87f", "#fff"],
                danger: ["#f5325c", "#fff"],
            }
            Toastify({
            text: text,
            duration: 3000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: types[type][0],
                color: types[type][1]
            }
            }).showToast();
        }




    </script>

    <script defer>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }


            form.classList.add('was-validated')

            // if(form.checkValidity() && form.id == "#uploadFileForm") uploadFiles()

            }, false)
        })
        })()
    </script>
   <style>
        .breadcrumb{
            font-size: 1.15em;
            padding: 0
        }
        .breadcrumb * i{
            display: flex;
            align-items: center;
        }
        .breadcrumb-item::before{
            display: none !important
        }

        .nav-buttons{
            padding: 0.1rem .5rem;
        }

        .nav-buttons > i{
            font-size: 1.2em;
        }

        .table{
            border: 1px solid #1717170d;
            border-radius: 3px;
            font-family: inherit;
            font-size: inherit
        }
        .table * td{
            padding: 10px
        }
        .table * th{
            padding: 10px
        }
        tr * th:nth-child(1), td:nth-child(1){
            width: 1%
        }
        tr > td:nth-child(1), th:nth-child(1) > svg{
            width: 15px;
        }
        .table .thead-light th{
            /* background-color: #1717170d; */
        }
        .folder_action_button{
            margin-right: 5px;
        }
        .folder_action_button > svg{
            width: 17px;
        }

        .file-drop-zone{
            /* height: 260px; */
            overflow-x: auto;
        }

        .file-preview-thumbnails{
            display: flex;
        }

        .file-drop-zone-title{
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: center;
            /* padding: 0; */
            color: unset
        }


        .kv-file-zoom{
            display: none
        }

        .has-error .help-block {
    display: none;
}
    </style>


<script defer src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
<script defer src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>

<!-- the main fileinput plugin script JS file -->
<script defer src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    @endsection
