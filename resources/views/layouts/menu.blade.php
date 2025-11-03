<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Parking</h3>
        </a>

        <div class="navbar-nav w-100">
            @can('Главная страница')
                <a href="{{ route('home') }}"
                   class="nav-item nav-link @if(request()->is('/') || request()->is('home')) active @endif">
                    <i class="fa fa-tachometer-alt me-2"></i>Главная
                </a>
            @endcan

            @php
                $linkActiveStatic = ['statistics*'];
            @endphp
            @can('Просмотр статистика')
                <a href="{{ route('statistics.main') }}"
                   class="nav-item nav-link {{ request()->is($linkActiveStatic) ? 'active' : '' }}">
                    <i class="fa fa-chart-line me-2"></i>Статистика
                </a>
            @endcan

            @php
                $linkActiveParkingHistory = ['parking_history/index*'];
            @endphp
            @can('Просмотр истории парковок')
                <a href="{{route('parking_history.index')}}"
                   class="nav-item nav-link {{ request()->is($linkActiveParkingHistory) ? 'active' : '' }}">
                    <i class="fa fa-ban me-2"></i>
                     <span class="small">История парковок</span>
                </a>
            @endcan

            @php
                $linkActiveBlacklist = ['blacklist*'];
            @endphp
            @can('Просмотр черный список')
                <a href="{{route('blacklist.index')}}"
                   class="nav-item nav-link {{ request()->is($linkActiveBlacklist) ? 'active' : '' }}">
                    <i class="fa fa-ban me-2"></i>Black List
                </a>
            @endcan

            @php
                $linkActiveWhitelist = ['whitelist*'];
            @endphp
            @can('Просмотр белый список')
                <a href="{{route('whitelist.index')}}"
                   class="nav-item nav-link {{ request()->is($linkActiveWhitelist) ? 'active' : '' }}">
                    <i class="fa fa-check-circle me-2"></i>White List
                </a>
            @endcan

            @php
                $linkActiveTariff = ['tariff*'];
            @endphp
            @can('Просмотр тариф')
                <a href="{{route('tariff.index')}}"
                   class="nav-item nav-link {{ request()->is($linkActiveTariff) ? 'active' : '' }}">
                    <i class="fa fa-money-bill-wave me-2"></i>Тарифы
                </a>
            @endcan

            @php
                $linkActivePayment = ['payment*'];
            @endphp
            @can('Просмотр платежей')
                <a href="{{route('payment.index')}}" 
                   class="nav-item nav-link {{ request()->is($linkActivePayment) ? 'active' : '' }}">
                    <i class="fa fa-credit-card me-2"></i>Платежи
                </a>
            @endcan

            @php
                $linkActiveSubscription = ['subscription*'];
            @endphp
            @can('Просмотр подписок')
                <a href="{{route('subscription.index')}}"
                   class="nav-item nav-link {{ request()->is($linkActiveSubscription) ? 'active' : '' }}">
                    <i class="fa fa-receipt me-2"></i>Подписки
                </a>
            @endcan
            

            @php
                $linkActive = ['users*', 'roles*', 'accesses*'];
            @endphp
            @canany(['Просмотр пользователей','Просмотр доступы','Просмот ролей'])
                <a href="{{ route('users.index') }}"
                   class="nav-item nav-link {{ request()->is($linkActive) ? 'active' : '' }}">
                    <div style="display: flex">
                        <div>
                            <i class="fa fa-users-cog me-2"></i>
                        </div>
                        <div>
                            Пользователи и роли
                        </div>
                    </div>
                </a>
            @endcanany
            @php
                $linkActivePhotos = ['parking_history/photos*'];
            @endphp
            @can('Просмотр истории парковок')
                <a href="{{ route('parking_history.photosList') }}"
                class="nav-item nav-link {{ request()->is($linkActivePhotos) ? 'active' : '' }}">
                    <i class="fa fa-camera me-2"></i>Фотофиксация
                </a>
            @endcan
            {{-- <hr> --}}
            {{-- <a href="" class="nav-item nav-link">
                <div style="display: flex">
                    <div>
                        <i class="fa fa-cogs me-2"></i>
                    </div>
                    <div>
                        Настройка системы
                    </div>
                </div>
            </a> --}}
        </div>
    </nav>
</div>
