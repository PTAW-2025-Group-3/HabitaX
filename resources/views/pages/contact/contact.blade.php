@extends('layout.app')

@section('title', 'Contact')

@section('content')
  @include('pages.contact.sections.header')
  @include('pages.contact.sections.info-box')
  @include('pages.contact.sections.form')
  @include('pages.contact.sections.faq')

@endsection
