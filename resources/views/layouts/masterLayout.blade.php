@include('components.head')

@include('components.navbar')


<main id="main">
    {{-- Hero --}}
    @include('components.hero')
    {{-- Hero End --}}

    {{-- Transformasi-Pendidikan --}}
    @include('components.transpendik')
    {{-- Transformasi-Pendidikan End --}}

    {{-- Transformasi-Organisasi --}}
    @include('components.transorg')
    {{-- Transformasi-Organisasi End --}}

    {{-- Benefit --}}
    {{-- @include('components.benefit') --}}
    {{-- Benefit End --}}

    {{-- Infographic --}}
    {{-- @include('components.infographic') --}}
    {{-- Infographic End --}}

    {{-- Relevance --}}
    {{-- @include('components.relevance') --}}
    {{-- Relevance End --}}

    {{-- Footer --}}
    @include('components.footer')
    {{-- Footer End --}}

</main>


@include('components.scripts')