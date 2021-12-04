<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo">
            <a href="{{ route('index') }}">
                <img width="80px" alt="Logo" src="{{ asset('assets/media/logos/slb.png') }}" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        Self Love Bible Admin Panel
    </h3>

    <!-- end:: Title -->


    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: User bar -->

        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                <span class="kt-hidden kt-header__topbar-username">{{ Auth::user()->name }}</span>
                <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_21.jpg') }}" />
                <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }}">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg') }}" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    </div>
                    <div class="kt-user-card__name">
                        {{ Auth::user()->name }}
                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <div class="kt-notification__custom kt-space-between">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">
                                {{ __('Sign out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->
