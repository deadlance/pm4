@extends('layouts.master')

@section('title', 'Hello World')

@section('content')
    Welcome Page

    @if(isset($rawContentData))
    <div class="row">
        <div class="col-sm-12">
            <pre>
                {!! $rawContentData or "" !!}
            </pre>
        </div>
    </div>
    @endif

@endsection

@section('footer')
@endsection


