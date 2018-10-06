@extends('layouts.app')

@section('content')
    <zaikok-home
        token="{{ env('TOKEN') }}"
    ></zaikok-home>
@endsection
