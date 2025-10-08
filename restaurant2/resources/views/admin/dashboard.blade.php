@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('content_title', 'Dashboard Overview')

@section('content')
  @isset($content_view)
      @include($content_view)
  @else
      <!-- Initial content for the dashboard overview -->
      <p class="text-gray-700">Select an option from the sidebar to get started.</p>
  @endisset
@endsection

@section('scripts')
  <!-- Any specific scripts for the dashboard can go here -->
@endsection
