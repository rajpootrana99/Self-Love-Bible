<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item {{(request()->is('admin')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
                <li class="kt-menu__item  kt-menu__item--submenu {{(request()->is('topic','month','day','challenge')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-calendar-2"></i><span class="kt-menu__link-text">Calender</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Calender</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('topic.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Topic</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('month.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Month</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('day.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Day</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('challenge.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Challenge</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item {{(request()->is('meditation')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('meditation.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-hospital"></i><span class="kt-menu__link-text">Meditation</span></a></li>
                <li class="kt-menu__item  kt-menu__item--submenu {{(request()->is('category','fitness')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-bicycle"></i><span class="kt-menu__link-text">Fitness</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Fitness</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('category.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('fitness.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Fitness</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item {{(request()->is('notification')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('notification.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-bell-2"></i><span class="kt-menu__link-text">Notification</span></a></li>
                <li class="kt-menu__item {{(request()->is('user')) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('user.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user-1"></i><span class="kt-menu__link-text">User</span></a></li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
