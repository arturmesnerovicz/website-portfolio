@extends('layouts.app')

@section('content')
    <!-- 01 Hero Section -->
    @include('sections.hero')

    <!-- 02 Manifesto Section -->
    @include('sections.manifesto')

    <!-- 03 Projetos Selecionados Section -->
    @include('sections.projects')

    <!-- 04 Expertise (Serviços) Section -->
    @include('sections.services')

    <!-- 05 Jornada do Projeto Section -->
    @include('sections.journey')

    <!-- 06 FAQ Section -->
    @include('sections.faq')

    <!-- 07 CTA Final & Contact Section -->
    @include('sections.cta-contact')
@endsection
