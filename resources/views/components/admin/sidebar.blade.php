<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{asset('assets/admin/assets/images/logo-icon.png')}}" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Maxton</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">info</i></div>
                    <div class="menu-title">О нас</div>
                </a>
                <ul>
                    <li><a href="{{route("admin.about_us.edit", 1)}}"><i class="material-icons-outlined">arrow_right</i>О нас</a>
                    </li>
                    <li><a href="{{route("admin.user_rules.edit", 1)}}"><i class="material-icons-outlined">arrow_right</i>Правила пользователя</a>
                    </li>
                    <li><a href="{{route("admin.privacy_policies.edit", 1)}}"><i class="material-icons-outlined">arrow_right</i>Политика конфиденциальности</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">g_translate</i></div>

                    <div class="menu-title">Языки и словарь</div>
                </a>
                <ul>
                    <li><a href="{{route("admin.languages.index")}}"><i class="material-icons-outlined">arrow_right</i>Языки</a>
                    </li>
                    <li><a href="{{route("admin.translates.index")}}"><i class="material-icons-outlined">arrow_right</i>Словарь</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">flight</i></div>

                    <div class="menu-title">Туры и путешествия</div>
                </a>
                <ul>
                    <li><a href="{{route("admin.tours.index")}}"><i class="material-icons-outlined">arrow_right</i>Туры</a>
                    </li>
                    <li><a href="{{route("admin.cities.index")}}"><i class="material-icons-outlined">arrow_right</i>Города</a>
                    </li>
                    <li><a href="{{route("admin.airports.index")}}"><i class="material-icons-outlined">arrow_right</i>Аэропорты</a>
                    </li>
                    <li><a href="{{route("admin.transfers.index")}}"><i class="material-icons-outlined">arrow_right</i>Трансферы</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
