//  // تبديل الثيم
//  document.addEventListener('DOMContentLoaded', function() {
//     const themeToggleBtn = document.getElementById('mode-toggle');
//     const themeIcon = themeToggleBtn.querySelector('img');
//     const body = document.body;
//     const sidebar = document.getElementById('sidebar');
//     const header = document.querySelector('.header');
//     const footer = document.querySelector('.footer');

//     // استرداد الثيم المحفوظ
//     const savedTheme = localStorage.getItem('theme');
//     if (savedTheme) {
//         applyTheme(savedTheme);
//     } else {
//         applyTheme('light'); // الوضع الافتراضي
//     }

//     // تبديل الثيم عند النقر
//     themeToggleBtn.addEventListener('click', function() {
//         const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
//         const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
//         applyTheme(newTheme);
//         localStorage.setItem('theme', newTheme); // حفظ الثيم الجديد
//     });

//     // تابع لتطبيق الثيم
//     function applyTheme(theme) {
//         if (theme === 'dark') {
//             body.classList.add('dark-mode');
//             body.classList.remove('light-mode');
//             if (sidebar) {
//                 sidebar.classList.add('dark-mode');
//                 sidebar.classList.remove('light-mode');
//             }

//             if (header) {
//                 header.classList.add('dark-mode');
//                 header.classList.remove('light-mode');
//             }

//             if (footer) {
//                 footer.classList.add('dark-mode');
//                 footer.classList.remove('light-mode');
//             }

//             themeIcon.src = 'https://img.icons8.com/ios/50/moon-symbol.png'; // أيقونة الوضع الليلي
//         } else {
//             body.classList.add('light-mode');
//             body.classList.remove('dark-mode');

//             if (sidebar) {
//                 sidebar.classList.add('light-mode');
//                 sidebar.classList.remove('dark-mode');
//             }

//             if (header) {
//                 header.classList.add('light-mode');
//                 header.classList.remove('dark-mode');
//             }

//             if (footer) {
//                 footer.classList.add('light-mode');
//                 footer.classList.remove('dark-mode');
//             }

//             themeIcon.src = 'https://img.icons8.com/ios/50/sun.png'; // أيقونة الوضع النهاري
//         }
//     }
// });