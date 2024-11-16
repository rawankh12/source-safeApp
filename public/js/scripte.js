document.addEventListener('DOMContentLoaded', function() {
    const themeToggleBtn = document.getElementById('mode-toggle');
    const themeIcon = themeToggleBtn.querySelector('i');
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const header = document.querySelector('.header');
    const footer = document.querySelector('.footer');

    themeToggleBtn.addEventListener('click', function() {
        const isDarkMode = body.classList.toggle('dark-mode');
        body.classList.toggle('light-mode', !isDarkMode);
        header.classList.toggle('dark-mode', isDarkMode);
        header.classList.toggle('light-mode', !isDarkMode);
        sidebar.classList.toggle('dark-mode', isDarkMode);
        sidebar.classList.toggle('light-mode', !isDarkMode);
        footer.classList.toggle('dark-mode', isDarkMode);
        footer.classList.toggle('light-mode', !isDarkMode);
        if (isDarkMode) {
            themeIcon.classList.replace('lni-sun', 'lni-night');
        } else {
            themeIcon.classList.replace('lni-night', 'lni-sun');
        }
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    });

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        const isDarkMode = savedTheme === 'dark';
        body.classList.add(`${savedTheme}-mode`);
        header.classList.add(`${savedTheme}-mode`);
        sidebar.classList.add(`${savedTheme}-mode`);
        footer.classList.add(`${savedTheme}-mode`);
        themeIcon.classList.add(isDarkMode ? 'lni-night' : 'lni-sun');
        themeIcon.classList.remove(isDarkMode ? 'lni-sun' : 'lni-night');
    } else {
        body.classList.add('dark-mode');
        header.classList.add('dark-mode');
        sidebar.classList.add('dark-mode');
        footer.classList.add('dark-mode');
        themeIcon.classList.add('lni-night');
    }
});
