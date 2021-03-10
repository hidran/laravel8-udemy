@extends('errors::minimal')
<h2>{{ var_dump($exception->getTrace()) }}</h2>
@section('title', __('Page Expired2'))
@section('code', '419')
@section('message', __('Page Expired'))
