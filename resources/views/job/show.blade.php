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
                            ????
                        </div>
                        <div class="tab-pane p-3" id="files" role="tabpanel">
                            <p class="mb-0 text-muted">
                            </p>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    
</script>
@endsection