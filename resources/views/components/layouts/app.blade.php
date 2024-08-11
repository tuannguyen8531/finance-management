<x-layouts.base>
    @if (in_array(Route::currentRouteName(), ['login', 'register']))
        {{ $slot }}
    @else
        <main id="page-top">
            <div id="wrapper">
                @include('components.layouts.sidenav')

                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        @include('components.layouts.topbar')

                        <div class="container-fluid">
                            {{ $slot }}
                        </div>
                    </div>

                    @include('components.layouts.footer')
                </div>
            </div>

            @include('components.layouts.scrolltop')

            @include('components.modals.logout')
        </main>
    @endif
</x-layouts.base>