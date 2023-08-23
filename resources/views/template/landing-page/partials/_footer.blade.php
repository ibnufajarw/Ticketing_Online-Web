<footer class="text-center py-3 {{ request()->is('login') || request()->is('register') ? 'footer-fixed' : '' }}">

    <p class="fs-12 mb-0 text-white">Copyright &copy; {{ date('Y') }} <span class="text-title">EasyIN</span></p>
</footer>
