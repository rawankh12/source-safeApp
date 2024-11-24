<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Notifications</title>
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <header class="header">
        <div class="header-container">
            <div class="header-icons">
                <!-- زر الإشعارات -->
                <button id="notification-icon" style="position: relative;">
                    <img width="25" height="25" src="https://img.icons8.com/puffy-filled/32/alarm.png"
                        alt="alarm" />
                    <span id="notification-badge"
                        style="display: none; position: absolute; top: -5px; right: -5px; background-color: red; color: white; font-size: 12px; border-radius: 50%; width: 20px; height: 20px; display: flex; justify-content: center; align-items: center;">
                        0
                    </span>
                </button>
                <!-- نافذة الإشعارات المنبثقة -->
                <div id="notification-popup" style="display:none;">
                    <ul id="notification-list"></ul>
                </div>
                <!-- صندوق البحث -->
                <div class="search-container"
                    style="direction: rtl; display: flex; align-items: center; border: 1px solid #ccc; border-radius: 15px; padding: 5px; gap: 5px;">
                    <input type="text" id="search-input" placeholder="{{ __('messages.search') }}"
                        style="border: none; outline: none; flex: 1; direction: ltr;">
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/search--v1.png"
                        alt="search--v1" style="cursor: pointer;" id="search-button">
                </div>
                <!-- زر تبديل الوضع -->
                <button id="mode-toggle" style="margin-top: 10px;">
                    <img width="35" height="35" src="https://img.icons8.com/ios/50/sun.png" alt="sun" />
                </button>

                <!-- زر تبديل اللغة -->
                <img width="40" height="40" src="https://img.icons8.com/color/48/google-translate.png"
                    alt="Switch Language" id="languageSwitcher" style="cursor: pointer;">

                <!-- زر تسجيل الخروج -->
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

    <script type="text/javascript">
        var url = "{{ route('langChange') }}";
        var currentLanguage = "{{ session()->get('language') }}";

        // تغيير اللغة
        document.getElementById('languageSwitcher').addEventListener('click', function() {
            var nextLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
            window.location.href = url + "?lang=" + nextLanguage;
        });

        // البحث
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

        // تحديث عدد الإشعارات
        function updateNotificationCount() {
            fetch('/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notification-badge');
                    if (data.unreadCount > 0) {
                        badge.style.display = 'flex';
                        badge.textContent = data.unreadCount;
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error({{ __('messages.error') }}, error);
                });
        }

        // عرض الإشعارات
        document.getElementById('notification-icon').addEventListener('click', function() {
            const notificationPopup = document.getElementById('notification-popup');

            if (notificationPopup.style.display === 'none' || notificationPopup.style.display === '') {
                notificationPopup.style.display = 'block';
                fetchNotifications();
                markNotificationsAsRead();
            } else {
                notificationPopup.style.display = 'none';
            }
        });

        // التابع لجلب الإشعارات من الخادم
        function fetchNotifications() {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    const notificationList = document.getElementById('notification-list');
                    notificationList.innerHTML = '';

                    // التحقق من وجود إشعارات
                    if (data.length === 0) {
                        notificationList.innerHTML = '<li>{{ __('messages.no_notifications') }}</li>';
                    } else {
                        // إضافة كل إشعار إلى القائمة
                        data.forEach(notification => {
                            const listItem = document.createElement('li');
                            listItem.textContent = notification.data.message;
                            notificationList.appendChild(listItem);
                        });
                    }
                })
                .catch(error => {
                    console.error({{ __('messages.error') }}, error);
                });
        }
        // التابع لتحديث حالة الإشعارات إلى مقروءة
        function markNotificationsAsRead() {
            fetch('/notifications/mark-as-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => {
                    console.error({{ __('messages.error') }}, error);
                });
        }
        // أول استدعاء لتحديث الإشعارات
        updateNotificationCount();
        setInterval(updateNotificationCount, 10000);
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

        #notification-popup {
            position: absolute;
            top: 50px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 10px;
        }

        #notification-popup ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #notification-popup ul li {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        #notification-popup ul li:last-child {
            border-bottom: none;
        }
    </style>

</body>

</html>
