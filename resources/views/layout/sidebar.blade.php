<aside id="sidebar">
     <div class="d-flex flex-column align-items-center" style="margin-top: 30px; margin-bottom:10px;">
        <h2 style=" size:0.5rem; color:black;">{{ Auth::user()->name }}</h2>
        <hr style="width: 100px; color:black;">
        {{-- <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/artstation.png" alt="artstation"/> --}}
    </div> 
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/ios/50/home.png" alt="home" />
                <span>{{ __('messages.home') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <img class="sidebar-icon" width="25" height="25" src="https://img.icons8.com/windows/32/gender-neutral-user.png"
                    alt="gender-neutral-user" />
                <span>{{ __('messages.profile') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('mygroup') }}" class="sidebar-link {{ request()->routeIs('mygroup') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/ios/50/apple-files.png"
                    alt="apple-files" />
                <span>{{ __('messages.mygroups') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('user.files') }}" class="sidebar-link {{ request()->routeIs('user.files') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/ios/50/apple-files.png"
                    alt="apple-files" />
                <span>{{ __('messages.myfiles') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('membergroup') }}"
                class="sidebar-link {{ request()->routeIs('membergroup') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/hatch/64/group-folder.png"
                    alt="group-folder" />
                <span>{{ __('messages.membergroup') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showJoinRequests') }}"
                class="sidebar-link {{ request()->routeIs('showJoinRequests') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20"
                    src="https://img.icons8.com/glyph-neue/64/add-user-group-woman-woman.png"
                    alt="add-user-group-woman-woman" />
                <span>{{ __('messages.showJoinRequests') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showaddfileRequests') }}"
                class="sidebar-link {{ request()->routeIs('showaddfileRequests') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/add-file.png"
                    alt="add-file" />
                <span>{{ __('messages.showaddfileRequests') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('showinviteRequests') }}"
                class="sidebar-link {{ request()->routeIs('showinviteRequests') ? 'active' : '' }}">
                <img class="sidebar-icon" width="20" height="20" src="https://img.icons8.com/metro/26/invite.png" alt="invite" />
                <span>{{ __('messages.showinviteRequests') }}</span>
            </a>
        </li>
    </ul>
    </div>
</aside>
