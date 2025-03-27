@extends('layouts.app')

@section('title', 'Contact')

@section('content')
  @include('contact._header')
  @include('contact._info-box')
  @include('contact._form')
  @include('contact._faq')

@endsection
