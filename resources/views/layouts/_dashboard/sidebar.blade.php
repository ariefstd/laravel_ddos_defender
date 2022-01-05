<div class="logo-details" style="display: flex;">

    <div class="img-box">
        <img src="{{ asset('img/faviconbz.png') }}" alt="">
    </div>
    <a href="{{ route('dashboard.index') }}" class="{{ set_active(['dashboard.index']) }}">
        <div class="logo_name">Administrator</div>
    </a>
    <i class='bx bx-menu' id="btn"></i>
</div>

<ul class="nav-list">

    <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
    <span class="ket">Data</span><br>
    @canany(['Manage Cities', 'Manage Regions'])
    <li>
        <div class="iocn-link">
            <a href="#" class="{{ set_active(['city.index', 'city.show', 'city.edit', 'city.create', 'region.index', 'region.show', 'region.edit', 'region.create']) }}">
                <i class='bx bx-map'></i>
                <span class="link_name">Location</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 0px;"></i>
            </a>
            <span class="tooltip">Location</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Cities')
            <li><a href="{{ route('city.index') }}" class="{{ set_active(['city.index', 'city.show', 'city.edit', 'city.create']) }}">City</a></li>
            @endcan
            @can('Manage Regions')
            <li><a href="{{ route('region.index') }}" class="{{ set_active(['region.index', 'region.show', 'region.edit', 'region.create']) }}">Region</a></li>
            @endcan
        </ul>
    </li>
    @endcanany

    @can('Manage Markets')
    <li>
        <a href="{{ route('market.index') }}" class="{{ set_active(['market.index', 'market.show', 'market.edit', 'market.create']) }}">
            <i class='bx bx-store-alt'></i>
            <span class="links_name">Pasar</span>
        </a>
        <span class="tooltip">Pasar</span>
    </li>
    @endcan

    @canany(['Manage Stalls', 'Manage Stall Categories'])
    <li>
        <div class="iocn-link">
            <a href="#" class="{{ set_active(['categories-food.index', 'categories-food.show', 'categories-food.edit', 'categories-food.create', 'stall.index', 'stall.show', 'stall.edit', 'stall.create']) }}">
                <i class='bx bx-store'></i>
                <span class="link_name">Kios</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 24px;"></i>
            </a>
            <span class="tooltip">Kios</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Stalls')
            <li><a href="{{ route('stall.index') }}" class="{{ set_active(['stall.index', 'stall.show', 'stall.edit', 'stall.create']) }}">Kios Content</a></li>
            @endcan

            @can('Manage Stall Categories')
            <li><a href="{{ route('categories-food.index') }}" class="{{ set_active(['categories-food.index', 'categories-food.show', 'categories-food.edit', 'categories-food.create']) }}">Product Category</a></li>
            @endcanany
        </ul>
    </li>
    @endcanany

    @can('Manage Rentals')
    <li>
        <a href="{{ route('rental.index') }}" class="{{ set_active(['rental.index', 'rental.edit', 'rental.create']) }}">
            <i class='bx bxs-store'></i>
            <span class="links_name">Rental</span>
        </a>
        <span class="tooltip">Rental</span>
    </li>
    @endcan

    <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
    <span class="ket">Content</span>
    @can('Manage Flash News')
    <li>
        <a href="{{ route('flash-news.index') }}" class="{{ set_active(['flash-news.index', 'flash-news.show', 'flash-news.edit', 'flash-news.create']) }}">
            <i class='bx bx-paper-plane'></i>
            <span class="links_name">Flash News</span>
        </a>
        <span class="tooltip">Flash News</span>
    </li>
    @endcan

    @can('Manage Banners')
    <li>
        <a href="{{ route('banners.index') }}" class="{{ set_active(['banners.index', 'banners.show', 'banners.edit', 'banners.create']) }}">
            <i class='bx bx-flag'></i>
            <span class="links_name">Banner</span>
        </a>
        <span class="tooltip">Banner</span>
    </li>
    @endcan

    @canany(['Manage Promos', 'Manage Banner Promos'])
    <li>
        <div class="iocn-link">
            <a href="#" class="{{ set_active(['promo.index', 'promo.show', 'promo.edit', 'promo.create']) }}">
                <i class='bx bx-book-open'></i>
                <span class="link_name">Promo</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 9px;"></i>
            </a>
            <span class="tooltip">Promo</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Banner Promos')
            <li><a href="{{ route('banner-promo.index') }}" class="{{ set_active(['banner-promo.index', 'banner-promo.show', 'banner-promo.edit', 'banner-promo.create']) }}">Banner Promo</a></li>
            @endcanany

            @can('Manage Promos')
            <li><a href="{{ route('promo.index') }}" class="{{ set_active(['promo.index', 'promo.show', 'promo.edit', 'promo.create']) }}">Promo Content</a></li>
            @endcanany
        </ul>
    </li>
    @endcanany

    @canany(['Manage Posts', 'Manage Post Categories', 'Manage Tags'])
    <li>
        <div class="iocn-link">

            <a href="#" class="{{ set_active(['categories-post.index', 'categories-post.show', 'categories-post.edit', 'categories-post.create', 'tags.index', 'tags.show', 'tags.edit', 'tags.create', 'posts.index', 'posts.show', 'posts.edit', 'posts.create']) }}">
                <i class='bx bx-news'></i>
                <span class="link_name">Post</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 24px;"></i>
            </a>
            <span class="tooltip">Post</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Posts')
            <li><a href="{{ route('posts.index') }}" class="{{ set_active(['posts.index', 'posts.show', 'posts.edit', 'posts.create']) }}">Post Content</a></li>
            @endcan

            @can('Manage Post Categories')
            <li><a href="{{ route('categories-post.index') }}" class="{{ set_active(['categories-post.index', 'categories-post.show', 'categories-post.edit', 'categories-post.create']) }}">Category</a></li>
            @endcan

            @can('Manage Tags')
            <li><a href="{{ route('tags.index') }}" class="{{ set_active(['tags.index', 'tags.show', 'tags.edit', 'tags.create']) }}">Tag</a></li>
            @endcanany
        </ul>
    </li>
    @endcanany

    @canany(['Manage Galleries', 'Manage Gallery Categories'])
    <li>
        <div class="iocn-link">
            <a href="#" class="{{ set_active(['categories-gallery.index', 'categories-gallery.show', 'categories-gallery.edit', 'categories-gallery.create', 'gallery.index', 'gallery.show', 'gallery.edit', 'gallery.create']) }}">
                <i class='bx bx-images'></i>
                <span class="link_name">Gallery</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 9px;"></i>
            </a>
            <span class="tooltip">Gallery</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Galleries')
            <li><a href="{{ route('gallery.index') }}" class="{{ set_active(['gallery.index', 'gallery.show', 'gallery.edit', 'gallery.create']) }}">Gallery Content</a></li>
            @endcanany

            @can('Manage Gallery Categories')
            <li><a href="{{ route('categories-gallery.index') }}" class="{{ set_active(['categories-gallery.index', 'categories-gallery.show', 'categories-gallery.edit', 'categories-gallery.create']) }}">Category</a></li>
            @endcanany
        </ul>
    </li>
    @endcanany

    @can('Manage Partners')
    <li>
        <a href="{{ route('partner.index') }}" class="{{ set_active(['partner.index', 'partner.show', 'partner.edit', 'partner.create']) }}">
            <i class='bx bx-link'></i>
            <span class="links_name">Link & Afiliasi</span>
        </a>
        <span class="tooltip">Link & Afiliasi</span>
    </li>
    @endcan

    @canany(['Manage Teams', 'Manage Category Team'])
    <li>
        <div class="iocn-link">
            <a href="#" class="">
                <i class='bx bxs-user'></i>
                <span class="link_name">Team</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 18px;"></i>
            </a>
            <span class="tooltip">Team</span>
        </div>
        <ul class="sub-menu">
            @canany(['Manage Teams'])
            <li><a href="{{ route('team.index') }}" class="">Team Content</a></li>
            @endcanany

            @canany(['Manage Category Team'])
            <li><a href="{{ route('categories-team.index') }}" class="">Category</a></li>
            @endcanany
        </ul>
    </li>
    @endcanany

    @can('Manage Catalogs')
    <li>
        <a href="{{ route('catalog.index') }}" class="{{ set_active(['catalog.index', 'catalog.show', 'catalog.edit', 'catalog.create']) }}">
            <i class='bx bx-book-heart'></i>
            <span class="links_name">Catalog</span>
        </a>
        <span class="tooltip">Catalog</span>
    </li>
    @endcan

    @can('Manage Metas')
    <li>
        <a href="{{ route('metas.index') }}" class="{{ set_active(['metas.index', 'metas.show', 'metas.edit', 'metas.create']) }}">
            <i class='bx bx-bookmarks'></i>
            <span class="links_name">Meta Pages</span>
        </a>
        <span class="tooltip">Meta Pages</span>
    </li>
    @endcan

    <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
    <span class="ket">Media</span>
    <li>
        <a href="{{ route('filemanager.index') }}" class="{{ set_active(['filemanager.index']) }}">
            <i class='bx bx-box'></i>
            <span class="links_name">Media Library</span>
        </a>
        <span class="tooltip">Media Library</span>
    </li>

    <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
    <span class="ket">Setting</span>
    @canany(['Manage Profiles', 'Manage Passwords'])
    <li>
        <div class="iocn-link">
            <a href="#">
                <i class='bx bx-edit'></i>
                <span class="link_name">Profile</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: 11px;"></i>
            </a>
            <span class="tooltip">Profile</span>
        </div>
        <ul class="sub-menu">
            @can('Manage Profiles')
            <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
            @endcan

            @can('Manage Passwords')
            <li><a href="{{ route('password.edit') }}">Change Password</a></li>
            @endcan
        </ul>
    </li>
    @endcanany

    @canany(['Manage Roles', 'Manage Users'])
    <li class="credentials">
        <div class="iocn-link">
            <a href="#" class="{{ set_active(['roles.index', 'roles.show', 'roles.edit', 'roles.create', 'users.index', 'users.show', 'users.edit', 'users.create']) }}">
                <i class='bx bxs-user-account'></i>
                <span class="link_name">Credentials</span>
                <i class='bx bxs-chevron-down arrow' style="margin-left: -17px;"></i>
            </a>
            <span class="tooltip">Credentials</span>
        </div>
        <ul class="sub-menu">

            <li><a href="{{ route('roles.index') }}" class="{{ set_active(['roles.index', 'roles.show', 'roles.edit', 'roles.create']) }}">Roles</a></li>



            <li><a href="{{ route('users.index') }}" class="{{ set_active(['users.index', 'users.show', 'users.edit', 'users.create']) }}">Add User</a></li>

        </ul>
    </li>
    @endcanany
    <!-- <li class="profile">
        <div class="profile-details">
            <div class="name_job">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="job">{{ Auth::user()->roles->first()->name }}</div>
            </div>

        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out' id="log_out"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </li> -->

</ul>