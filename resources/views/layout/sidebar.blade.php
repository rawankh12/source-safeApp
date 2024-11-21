<aside id="sidebar" class='light-mode' style="background-color: white">
    <div class="d-flex flex-column align-items-center">
        <div class="sidebar-logo">
            <img src="{{ asset('img/photo.jpg') }}" class="image">
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/ios/50/home.png" alt="home" />
                <span>{{ __('messages.home') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <img width="25" height="25" src="https://img.icons8.com/windows/32/gender-neutral-user.png"
                    alt="gender-neutral-user" />
                <span>{{ __('messages.profile') }}</span>
            </a>
        </li>
        {{-- <li class="sidebar-item">

            <a href="{{ route('users') }}" class="sidebar-link {{ request()->routeIs('users') ? 'active' : '' }}">

                <i class="lni lni-car-alt"></i>
                <span>المستخدمين</span>
            </a>
        </li>   --}}
        <li class="sidebar-item">
            <a href="{{ route('mygroup') }}" class="sidebar-link {{ request()->routeIs('mygroup') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/ios/50/apple-files.png"
                    alt="apple-files" />
                <span>{{ __('messages.mygroups') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('user.files') }}" class="sidebar-link {{ request()->routeIs('user.files') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/ios/50/apple-files.png"
                    alt="apple-files" />
                <span>{{ __('messages.myfiles') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('membergroup') }}"
                class="sidebar-link {{ request()->routeIs('membergroup') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/hatch/64/group-folder.png"
                    alt="group-folder" />
                <span>{{ __('messages.membergroup') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showJoinRequests') }}"
                class="sidebar-link {{ request()->routeIs('showJoinRequests') ? 'active' : '' }}">
                <img width="20" height="20"
                    src="https://img.icons8.com/glyph-neue/64/add-user-group-woman-woman.png"
                    alt="add-user-group-woman-woman" />
                <span>{{ __('messages.showJoinRequests') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showaddfileRequests') }}"
                class="sidebar-link {{ request()->routeIs('showaddfileRequests') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/add-file.png"
                    alt="add-file" />
                <span>{{ __('messages.showaddfileRequests') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showinviteRequests') }}"
                class="sidebar-link {{ request()->routeIs('showinviteRequests') ? 'active' : '' }}">
                <img width="20" height="20" src="https://img.icons8.com/metro/26/invite.png" alt="invite" />
                <span>{{ __('messages.showinviteRequests') }}</span>
            </a>
        </li>
    </ul>
    </div>
</aside>
