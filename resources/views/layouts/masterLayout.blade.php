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

    {{-- Aktivitas Komunitas --}}
    @include('components.aktifkom')
    {{-- Aktivitas Komunitas End --}}

    {{-- Join Comunity --}}
    @include('components.joincomunity')
    {{-- Join Comunity End --}}

    {{-- Relevance --}}
    {{-- @include('components.relevance') --}}
    {{-- Relevance End --}}

    {{-- Footer --}}
    @include('components.footer')
    {{-- Footer End --}}

</main>


@include('components.scripts')