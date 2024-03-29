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
                        <h3>{{ $entity->entity }}</h3>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personnel" role="tab" aria-selected="true">Personnel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#business" role="tab" aria-selected="false">Business</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tradrtypes" role="tab" aria-selected="false">Trade Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#prequal" role="tab" aria-selected="false">PreQual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#joblist" role="tab" aria-selected="false">Job List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#checklists" role="tab" aria-selected="false">CheckLists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#swms" role="tab" aria-selected="false">SWMS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#files" role="tab" aria-selected="false">Files</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane p-3 active" id="personnel" role="tabpanel">
                            <div class="table-responsive mb-0 fixed-solution">
                                <table class="table table-bordered mb-0 table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>PCBU / Admin</th>
                                            <th>Orders</th>
                                            <th>Accounts</th>
                                            <th>Contact</th>
                                            <th>User Group</th>
                                            <th>App Onboarding</th>
                                            <th>Reset Password</th>
                                        </tr>
                                    </thead>
                                    <tbody class="personnel_tab">

                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div>
                        <div class="tab-pane p-3" id="business" role="tabpanel">
                            <form action="">
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Name:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->entity}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">ABN:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->abn}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Registered Name:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->entity}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Trading Type:</label>
                                    <div class="col-sm-8">
                                        <select class="select2 pl-1 form-control" name="trading_type" id="trading_type" style="width: 100%; height:30px;">
                                            <option value="" disabled selected>Select Trading Type</option>
                                            <option value="0" {{ 'Company' == $entity->trading_type ? 'selected' : ''}}>Company</option>
                                            <option value="1" {{ 'Trust' == $entity->trading_type ? 'selected' : ''}}>Trust</option>
                                            <option value="2" {{ 'Sole Trader' == $entity->trading_type ? 'selected' : ''}}>Sole Trader</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Phone:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->mobile}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Fax Number:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->fax}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Postal Address Street:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="{{$entity->address}}" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">City:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Postal Code:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px !important;">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">State/Province:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" value="" id="example-text-input" style="width: 100%; height:30px;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane p-3" id="tradrtypes" role="tabpanel">
                            <div class="form-group row" id="tradeList">

                            </div>
                        </div>
                        <div class="tab-pane p-3" id="prequal" role="tabpanel">
                            <p class="mb-0 text-muted">
                                ?????????????????????????????????????????????
                            </p>
                        </div>
                        <div class="tab-pane p-3" id="joblist" role="tabpanel">
                            <div class="table-responsive mb-0 fixed-solution">
                                <table class="table table-bordered mb-0 table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Site Location/Name</th>
                                            <th>Primary Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td>{{$job->id}}</td>
                                            <td>{{$job->site->site_address}}<br>{{$job->title}}</td>
                                            <td class="row">@if($job->user){{$job->user->name}}@endif
                                                <ul class="list-group list-group-horizontal-md col-6">
                                                    <li class="list-group-item">Swms: 0</li>
                                                    <li class="list-group-item">Wkrs: 5</li>
                                                    <li class="list-group-item">Ords: 0</li>
                                                    <li class="list-group-item">PQual: 0</li>
                                                </ul>
                                                <span class="list-group-item col-3"><a href="#">CheckList</a>
                                                    <a href="#" class="ml-4">Status</a></span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div>
                        <div class="tab-pane p-3" id="checklists" role="tabpanel">
                            <p class="text-muted mb-0">
                                ?????????????????????????????????????????????
                            </p>
                        </div>
                        <div class="tab-pane p-3" id="swms" role="tabpanel">
                            <p class="text-muted mb-0">
                                ?????????????????????????????????????????????
                            </p>
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

<div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntityLabel" aria-hidden="true">
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

<div class="modal fade" id="editEntity" tabindex="-1" role="dialog" aria-labelledby="editEntityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 text-white" id="editEntityLabel"></h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="editEntityForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="entity_id" id="entity_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_type" name="type" id="edit_type" style="width: 100%; height:30px;">
                                    <option value="0">Client</option>
                                    <option value="1">Suplier</option>
                                </select>
                                <span class="text-danger error-text type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="select2 pl-1 form-control edit_active" name="active" id="edit_active" style="width: 100%; height:30px;">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-danger error-text active_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="entity" id="edit_entity" placeholder="Enter Entity">
                                <span class="text-danger error-text entity_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="email" name="email" id="edit_email" placeholder="Enter Email">
                                <span class="text-danger error-text email_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="address" id="edit_address" placeholder="Enter Address">
                                <span class="text-danger error-text address_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="primary_phone" id="edit_primary_phone" placeholder="Enter Primary Phone">
                                <span class="text-danger error-text primary_phone_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="mobile" id="edit_mobile" placeholder="Enter Mobile">
                                <span class="text-danger error-text mobile_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="fax" id="edit_fax" placeholder="Enter Fax">
                                <span class="text-danger error-text fax_update_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="director" id="edit_director" placeholder="Enter Director">
                                <span class="text-danger error-text director_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="trade" id="edit_trade" placeholder="Enter Trade">
                                <span class="text-danger error-text trade_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abn" id="edit_abn" placeholder="Enter ABN">
                                <span class="text-danger error-text abn_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="inc" id="edit_inc" placeholder="Enter Inc">
                                <span class="text-danger error-text inc_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="abbrev" id="edit_abbrev" placeholder="Enter Abbrev">
                                <span class="text-danger error-text abbrev_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="contract_signed" id="edit_contract_signed" placeholder="Enter Contract Signed">
                                <span class="text-danger error-text contract_signed_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="payment_terms" id="edit_payment_terms" placeholder="Enter Payment Terms">
                                <span class="text-danger error-text payment_terms_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="pl_expirey" id="edit_pl_expirey" placeholder="Enter PL Expiry">
                                <span class="text-danger error-text pl_expirey_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="wc_expirey" id="edit_wc_expirey" placeholder="Enter WC Expiry">
                                <span class="text-danger error-text wc_expirey_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="item_type" id="edit_item_type" placeholder="Enter Item Type">
                                <span class="text-danger error-text item_type_update_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" style="width: 100%; height:30px;" type="text" name="path" id="edit_path" placeholder="Enter Path">
                                <span class="text-danger error-text path_update_error"></span>
                            </div>
                        </div>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>

<div class="modal fade" id="deleteEntity" tabindex="-1" role="dialog" aria-labelledby="deleteEntityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="deleteEntityLabel">Delete</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            <form method="post" id="deleteEntityForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="entity_id" name="entity_id">
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
    function tradeTypesChange(e) {
        var trade_type_id = e.value;
        var entity_id = <?php echo $entity->id ?>;
        let formData = new FormData();
        formData.append('trade_type_id', trade_type_id);
        formData.append('entity_id', entity_id);
        if (e.checked) {
            $.ajax({
                type: "post",
                url: "/addTradeType",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    showToast(response.message, "success");
                    event.preventDefault();
                },
                error: function(error) {

                }
            });
        } else {
            $.ajax({
                type: "post",
                url: "/removeTradeType",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    showToast(response.message, "danger");
                    event.preventDefault();
                },
                error: function(error) {

                }
            });
        }

    };

    let orderentityuserflag, accountentityuserflag = false;

    function orderChange(e, user_id) {
        if (orderentityuserflag === true) {
            var orders = e.value;
            var user_id = user_id;
            let formData = new FormData();
            formData.append('orders', orders);
            formData.append('user_id', user_id);
            $.ajax({
                type: "post",
                url: "/changeOrder",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    showToast(response.message, "success");
                    event.preventDefault();
                },
                error: function(error) {

                }
            });
        } else {
            orderentityuserflag = true;
        }
    };

    function accountChange(e, user_id) {
        if (accountentityuserflag === true) {
            var accounts = e.value;
            var user_id = user_id;
            let formData = new FormData();
            formData.append('accounts', accounts);
            formData.append('user_id', user_id);
            $.ajax({
                type: "post",
                url: "/changeAccount",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    showToast(response.message, "success");
                    event.preventDefault();
                },
                error: function(error) {

                }
            });
        } else {
            accountentityuserflag = true;
        }
    };

    $(document).ready(function() {
        var tradeTypes = <?php echo $entity->tradeTypes->pluck('id'); ?>;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchTradeTypes();

        function fetchTradeTypes() {
            $.ajax({
                type: "GET",
                url: "/fetchTradeTypes",
                dataType: "json",
                success: function(response) {
                    $.each(response.tradeTypes, function(key, tradeType) {
                        let checked = "";
                        for (let index = 0; index < tradeTypes.length; index++) {
                            const element = tradeTypes[index];
                            if (element == tradeType.id) {
                                checked = "checked";
                                break;
                            }
                        }
                        $('#tradeList').append('<div class="col-md-12">\
                            <div class="checkbox">\
                                <div class="custom-control custom-checkbox">\
                                    <input type="checkbox" onchange="tradeTypesChange(this)" class="custom-control-input"' + checked + ' id="trade_type' + tradeType.id + '" value="' + tradeType.id + '" >\
                                    <label class="custom-control-label" for="trade_type_' + tradeType.id + '">' + tradeType.name + '</label>\
                                </div>\
                            </div>\
                        </div>');
                    });
                }
            });
        }

        fetchEntityUsers();

        function fetchEntityUsers() {
            $.ajax({
                type: "GET",
                url: '/fetchEntityUsers/' + <?php echo $entity->id ?>,
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.users, function(key, user) {
                        let orderSelect = 0;
                        let accountSelect = 0;
                        if (user.orders === "Yes") {
                            orderSelect = 1;
                        }
                        if (user.accounts === "Yes") {
                            accountSelect = 1;
                        }
                        $('.personnel_tab').append('<tr>\
                            <td>' + user.name + '</td>\
                            <td>' + user.role + '</td>\
                            <td>' + user.phone + '</td>\
                            <td>' + user.email + '</td>\
                            <td></td>\
                            <td><select onchange="orderChange(this,' + user.id + ')" class="select2 pl-1 form-control orders_' + user.id + '" name="orders" id="orders_' + user.id + '" style="width:70px;">\
                                    <option value="" disabled>Select Order</option>\
                                    <option value="0">No</option>\
                                    <option value="1">Yes</option>\
                                </select></td>\
                            <td><select onchange="accountChange(this,' + user.id + ')" class="select2 pl-1 form-control accounts_' + user.id + '" name="accounts" id="accounts_' + user.id + '" style="width:70px;" >\
                                    <option value="" disabled>Select Account</option>\
                                    <option value="0">No</option>\
                                    <option value="1">Yes</option>\
                                </select></td>\
                            <td></td>\
                            <td>Contractor</td>\
                            <td><button class="btn btn-primary" style="width:100px"><i class="fas fa-mobile-alt"></i> SMS App</button></td>\
                            <td><button class="btn btn-primary" style="width:100px"><i class="far fa-envelope"></i> Password</button></td>\
                        </tr>');
                        $('.orders_' + user.id).val(orderSelect).change();
                        $('.accounts_' + user.id).val(accountSelect).change();
                    });
                }
            });
        }


        $(document).on('click', '#addEntityButton', function(e) {
            e.preventDefault();
            $(document).find('span.error-text').text('');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var entity_id = $(this).val();
            $('#deleteEntity').modal('show');
            $('#entity_id').val(entity_id);
        });

        $(document).on('submit', '#deleteEntityForm', function(e) {
            e.preventDefault();
            var entity_id = $('#entity_id').val();

            $.ajax({
                type: 'delete',
                url: 'entity/' + entity_id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        $('#deleteEntity').modal('hide');
                    } else {
                        fetchEntities();
                        $('#deleteEntity').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var entity_id = $(this).val();
            $('#editEntity').modal('show');
            $(document).find('span.error-text').text('');
            $.ajax({
                type: "GET",
                url: 'entity/' + entity_id + '/edit',
                success: function(response) {
                    if (response.status == false) {
                        $('#editEntity').modal('hide');
                    } else {
                        var active = 1;
                        if (response.entity.active == 'No') {
                            active = 0;
                        }
                        var type = 1;
                        if (response.entity.type == 'Client') {
                            type = 0;
                        }
                        $('.edit_type').val(type).change();
                        $('.edit_active').val(active).change();
                        $('#entity_id').val(response.entity.id);
                        $('#edit_abn').val(response.entity.abn);
                        $('#edit_entity').val(response.entity.entity);
                        $('#editEntityLabel').text('Entity ID ' + response.entity.id);
                        $('#edit_email').val(response.entity.email);
                        $('#edit_address').val(response.entity.address);
                        $('#edit_primary_phone').val(response.entity.primary_phone);
                        $('#edit_mobile').val(response.entity.mobile);
                        $('#edit_fax').val(response.entity.fax);
                        $('#edit_director').val(response.entity.director);
                        $('#edit_trade').val(response.entity.trade);
                        $('#edit_inc').val(response.entity.inc);
                        $('#edit_abbrev').val(response.entity.abbrev);
                        $('#edit_pl_expirey').val(response.entity.pl_expirey);
                        $('#edit_wc_expirey').val(response.entity.wc_expirey);
                        $('#edit_item_type').val(response.entity.item_type);
                        $('#edit_path').val(response.entity.path);
                        $('#edit_payment_terms').val(response.entity.payment_terms);
                        $('#edit_contract_signed').val(response.entity.contract_signed);
                        $('#edit_path').val(response.entity.path);

                    }
                }
            });
        });

        $(document).on('submit', '#editEntityForm', function(e) {
            e.preventDefault();
            var entity_id = $('#entity_id').val();
            let EditFormData = new FormData($('#editEntityForm')[0]);

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    '_method': 'patch'
                },
                url: "entity/" + entity_id,
                data: EditFormData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#editEntity').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_update_error').text(val[0]);
                        });
                    } else {
                        $('#editEntityForm')[0].reset();
                        $('#editEntity').modal('hide');
                        fetchEntities();
                    }
                },
                error: function(error) {
                    console.log(error)
                    $('#editEntity').modal('show');
                }
            });
        })

        $(document).on('submit', '#addEntityForm', function(e) {
            e.preventDefault();
            let formDate = new FormData($('#addEntityForm')[0]);
            $.ajax({
                type: "post",
                url: "entity",
                data: formDate,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('#addEntity').modal('show')
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addEntityForm')[0].reset();
                        $('#addEntity').modal('hide');
                        fetchEntities();
                    }
                },
                error: function(error) {
                    $('#addEntity').modal('show')
                }
            });
        });
    });
</script>
@endsection