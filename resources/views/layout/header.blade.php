<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<header class="header">
    <div class="header-container">
        <div class="header-icons">
            <!-- صندوق البحث -->
            <div class="search-container"
                style="direction: rtl; display: flex; align-items: center; border: 1px solid #ccc; border-radius: 15px; padding: 5px; gap: 5px;">
                <input type="text" id="search-input" placeholder="{{ __('messages.search') }}"
                    style="border: none; outline: none; flex: 1; direction: ltr; ">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/search--v1.png"
                    alt="search--v1" style="cursor: pointer;" id="search-button">
            </div>
            <!-- زر تبديل الوضع -->
            <button id="mode-toggle" style="margin-top: 10px;">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/sun.png" alt="sun" />
            </button>
            {{-- <select class="form-control changeLang text-center">
                <option value="ar" {{ session()->get('language') == 'ar' ? 'selected' : '' }}>Arabic</option>
                <option value="en" {{ session()->get('language') == 'en' ? 'selected' : '' }}>English</option>
            </select> --}}
            <img width="40" height="40" src="https://img.icons8.com/color/48/google-translate.png" alt="Switch Language" id="languageSwitcher"
                style="cursor: pointer;">

            {{-- <button id="languageSwitcher" class="btn btn-link">
                <img src="{{ session()->get('language') == 'ar' ? 'https://img.icons8.com/color/48/google-translate.png' : 'https://img.icons8.com/color/48/google-translate.png' }}"
                    alt="google-translate">
            </button> --}}
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmlogout(event)">
                @csrf
                <button id="profile-btn" type="submit">
                    <img width="30" height="30" src="https://img.icons8.com/sf-regular/48/exit.png"
                        alt="exit" />
                </button>
            </form>
        </div>
    </div>
</header>
{{-- <script type="text/javascript">
    var url = "{{ route('langChange') }}";
    $(".changeLang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });
</script> --}}
<script type="text/javascript">
    var url = "{{ route('langChange') }}";
    var currentLanguage = "{{ session()->get('language') }}"; 
    document.getElementById('languageSwitcher').addEventListener('click', function() {
        var nextLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
        window.location.href = url + "?lang=" + nextLanguage;
    });
</script>
<script>
    document.querySelector('#search-button').addEventListener('click', function() {
        const query = document.querySelector('#search-input').value;
        if (query.trim() !== '') {
            window.location.href = `/search?query=${encodeURIComponent(query)}`;
        }
    });
    document.querySelector('#search-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            const query = this.value;
            if (query.trim() !== '') {
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            }
        }
    });
</script>
<style>
    .header img {
        border-radius: 50%;
    }

    .header .user-info {
        display: flex;
        align-items: center;
    }

    .header .user-info span {
        margin-left: 10px;
    }
</style>
