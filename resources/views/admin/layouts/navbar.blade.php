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
                <li> <a href="{{ route('admin.tr_customer.index') }}" ><i class="bi bi-arrow-right-short"></i>Yurtiçi Müşteri</a></li>
                <li> <a href="{{ route('admin.other_customer.index') }}" ><i class="bi bi-arrow-right-short"></i>Yurtdışı Müşteri</a></li>
            </ul>
        </li>
        <li class="menu-label">Kategori Yönetimi</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person-check"></i>
                </div>
                <div class="menu-title">Kategori İşlemleri</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.category.index') }}" ><i class="bi bi-arrow-right-short"></i>Kategoriler</a></li>
                <li> <a href="{{ route('admin.category.tag.index') }}" ><i class="bi bi-arrow-right-short"></i>Kategori Etiketleri</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Ürün Yönetimi</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person-check"></i>
                </div>
                <div class="menu-title">Ürün İşlemleri</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.product.index') }}" ><i class="bi bi-arrow-right-short"></i>Ürünler</a></li>
                <li> <a href="{{ route('admin.product.tag.index') }}" ><i class="bi bi-arrow-right-short"></i>Ürün Etiketleri</a></li>
            </ul>
        </li>
        <li class="menu-label">Teklif Yönetimi</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person-check"></i>
                </div>
                <div class="menu-title">Teklif İşlemleri</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.offer.index') }}" ><i class="bi bi-arrow-right-short"></i>Teklifler</a></li>
            </ul>
        </li>
        <li class="menu-label">Ayarlar</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person-check"></i>
                </div>
                <div class="menu-title">Sistem Ayarları</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.delivery.index') }}" ><i class="bi bi-arrow-right-short"></i>Teslimat Şekli</a>
                <li> <a href="{{ route('admin.term_of_offer.index') }}" ><i class="bi bi-arrow-right-short"></i>Teklif Şartları</a></li>
                <li> <a href="{{ route('admin.currency.index') }}" ><i class="bi bi-arrow-right-short"></i>Para Birimleri</a></li>
                <li> <a href="{{ route('admin.product.tag.index') }}" ><i class="bi bi-arrow-right-short"></i>İmzalar</a></li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</aside>
