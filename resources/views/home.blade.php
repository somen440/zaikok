@extends('layouts.app')

@section('content')
    <zaikok-home
        token="{{ $token }}"
    ></zaikok-home>
@endsection
