<div class="header">
    <div class="mobile-menu">
        <button id="open-mobile">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
    </div>

    @yield('page-header')

    <div class="header-buttons">
        <label class="swap tooltip" data-tip="{{ __('ui.switch_theme') }}">
            <input type="checkbox" data-toggle-theme="dark,light" data-act-class="ACTIVECLASS" />
            <div class="swap-on"><i class="fa-regular fa-sun"></i></div>
            <div class="swap-off"><i class="fa-regular fa-moon"></i></div>
        </label>

        <x-admin.notifications-ui.index :notifications="\App\Support\AdminNotificationsUiExamples::all()" />
    </div>
</div>
