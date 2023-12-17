@extends('layouts.base')

{{-- @section("chatify_head")
@include('Chatify::layouts.headLinks') --}}
{{-- @endsection --}}

@section('content')

    <iframe
    src="{{route('chat')}}"
    width="100%"
    height="600px"
    sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
    frameborder="0"
    allowfullscreen="true"
    style="border: 0.5px solid #F0F0F0;border-radius:10px;margin:16px 0;">
    </iframe>

    {{-- @include('Chatify::pages.app') --}}
@endsection



@section("chatify_footer")

{{-- @include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks') --}}
@endsection
