@extends('layouts.app')

@section('content')
    <!-- 01 Hero Section -->
    @include('sections.hero')

    <!-- 02 Select Projects Section (Immediately below Hero) -->
    @include('sections.projects')

    <!-- 03 Expertise (Serviços) Section -->
    @include('sections.services')

    <!-- 04 Project Journey Section -->
    @include('sections.journey')

    <!-- 05 FAQ Section -->
    @include('sections.faq')

    <!-- 06 CTA Final Section -->
    @include('sections.cta-contact')
@endsection
