@extends('layouts.master')

@section('title', 'Menu Builder: View')

@section('content')

    <form action="/MenuBuilder" method="post">

        @for($i = 0; $i < count($menuData); $i++)

            <label for="">Menu</label>
            <input type="text" name="menuNode[{{$i}}][id]" id="id" value="{{ $menuData[$i]['id'] }}" maxlength="3" size="3" />
            <input type="text" name="menuNode[{{$i}}][name]" id="name" value="{{ $menuData[$i]['name'] }}" /><br />


        @endfor

    </form>


        {!! $menuData !!}

@endsection

@section('footer')
@endsection