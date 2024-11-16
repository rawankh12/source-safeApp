<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<header class="header">
    <div class="header-container">
        <div class="header-icons">
            <!-- صندوق البحث -->
            <div class="search-container"
                style="direction: ltr; display: inline-block; border: 1px solid #ccc; border-radius: 5px; padding: 5px;">
                <img width="10" height="15" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search"
                    style="cursor: pointer; vertical-align: middle;">
                <input type="text" id="search-input" placeholder='ابحث هنا...' style="border: none; outline: none;">
            </div>

            <!-- زر تبديل الوضع -->
            <button id="mode-toggle" style="margin-top: 10px;">
                <img width="30" height="30" src="https://img.icons8.com/ios/50/sun.png" alt="sun"/>
            </button>
            <!-- محول اللغة -->
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                @php
                    // تحديد اللغة الأخرى للتبديل إليها
                    $otherLocale = $current_locale === 'en' ? 'ar' : 'en';
                @endphp
                <a href="{{ route('setLocale', ['locale' => $otherLocale]) }}">
                    <img width="40" height="40" src="https://img.icons8.com/plasticine/50/google-translate.png"
                        alt="google-translate" />
                </a>
            </div>
        </div>
    </div>
</header>
<style>
    .header img {
        width: 40px;
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

</html>
