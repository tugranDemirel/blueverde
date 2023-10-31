<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/admin/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ auth()->user()->name }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu"  data-simplebar="true">
        <li>
            <a href="{{ route('admin.index') }}">
                <div class="parent-icon"><i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">Anasayfa</div>
            </a>
        </li>
        <li class="menu-label">Müşteri Yönetimi</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person-check"></i>
                </div>
                <div class="menu-title">Müşteriler</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.tr_customer.index') }}" ><i class="bi bi-arrow-right-short"></i>Yurtiçi Müşteri</a>
                <li> <a href="{{ route('admin.tr_customer.index') }}" ><i class="bi bi-arrow-right-short"></i>Yurtdışı Müşteri</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>