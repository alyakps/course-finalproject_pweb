<?php
// navbar.php

// Start the session if it hasn't been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']) && isset($_SESSION['role']);
?>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">

<style>
    /* Add this style to your existing styles */
nav {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 9999; /* Set a higher z-index to ensure it appears above other elements */
        transition: background-color 0.3s ease; /* Add a smooth transition effect */
    }

    /* Add a margin-top to your body content to prevent it from being hidden behind the fixed navbar */
    body {
        margin-top: 64px; /* Adjust this value based on your navbar height */
    }

    /* Add a background color to your navbar when scrolling */
    nav.scrolled {
        background-color: #ffffff; /* Change the background color as needed */
        border-bottom: 1px solid #dddddd; /* Add a border to separate it from the content */
    }

    /* Dark mode styles for the scrolled navbar */
    nav.scrolled.dark-mode {
        background-color: #2d2d2d; /* Change the background color for dark mode */
        border-bottom: 1px solid #444444; /* Add a border for dark mode */
    }

    body {
        font-family: 'DM Sans', sans-serif;
            color: #302B27;
    }
    .self-center {
            font-size: 2xl;
            font-weight: 500; /* Medium */
            color: #302B27;
    }
</style>
<script>
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('nav');
        var scrolled = window.scrollY > 0;
        navbar.classList.toggle('scrolled', scrolled);

        // If you have dark mode, you can toggle a dark-mode class based on your criteria
        // var darkMode = /* your dark mode logic here */;
        // navbar.classList.toggle('dark-mode', darkMode);
    });
</script>
<nav class="bg-white z-[99999] border-gray-200 px-16 w-full fixed top-0 dark:bg-gray-900">
    <div class="max-w flex items-center justify-between mx-auto py-4 h-16 sticky">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> -->
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white" style="font-family: 'Agile Sans', sans-serif; font-weight: 900;">ACC</span>
    </a>
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <a href="profile.php">
                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
            </a>
        </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <?php
    // Periksa peran pengguna
    $isSiswa = ($_SESSION['role'] == 'siswa');
    $isTentor = ($_SESSION['role'] == 'tentor');
    ?>
<ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
    <li>
        <a href="<?= ($isSiswa) ? 'siswa_dashboard.php' : 'tentor_dashboard.php'; ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-base">Dashboard</a>
    </li>
    <li>
        <a href="<?= ($isSiswa) ? 'siswa_classroom.php' : 'tentor_classroom.php'; ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-base">Classroom</a>
    </li>
    <li>
        <a href="<?= ($isSiswa) ? 'materi.php' : 'materi.php'; ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-base">Materi</a>
    </li>
    <?php if ($isSiswa): ?>
        <li>
            <a href="<?= ($isSiswa) ? 'kontak_tentor.php' : '#'; ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-base">Kontak Tentor</a>
        </li>
    <?php endif; ?>
</ul>

</div>

    </div>
    </nav>