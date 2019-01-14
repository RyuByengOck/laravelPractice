@extends('layouts.master')

@section('content')
    <p>저는 자식뷰의 'content' 입니다.</p>

    @include('partials/footer')

@endsection

@section('style')
    <style>
        body { background: green; color: white; }
    </style>
@endsection

@section('script')
    @parent
    <script>
			alert('저는 자식 뷰의 "script" 섹션입니다.');
    </script>
@endsection


@section('script')

    <script>
        alert('저는 조각 뷰의 "script" 섹션입니다.');
    </script>

@endsection