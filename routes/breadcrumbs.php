<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

Breadcrumbs::for('dashboard_home', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

Breadcrumbs::for('edit_profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit'));
});

Breadcrumbs::for('change_password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Change Password', route('password.edit'));
});

Breadcrumbs::for('edit_user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('user.edit'));
});

Breadcrumbs::for('edit_password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Change Password', route('password.edit'));
});

// Home > About
Breadcrumbs::for('file_manager', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Media Library', route('filemanager.index'));
});

//Dashboard > Roles 
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Roles", route('roles.index'));
});

Breadcrumbs::for('detail_role', function ($trail, $role) {
    $trail->parent('roles', $role);
    $trail->push($role->name, route('roles.show', ['role' => $role]));
});

Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('roles');
    $trail->push('Add Role', route('roles.create'));
});

Breadcrumbs::for('edit_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push($role->name, route('roles.edit', ['role' => $role]));
});

//Dashboard > Users 
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("User", route('users.index'));
});

Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('users');
    $trail->push('Add User', route('users.create'));
});

Breadcrumbs::for('edit_new_user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->name, route('users.edit', ['user' => $user]));
});

//Dashboard > Banner
Breadcrumbs::for('banners', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Banner", route('banners.index'));
});

Breadcrumbs::for('add_banner', function ($trail) {
    $trail->parent('banners');
    $trail->push('Add Banner', route('banners.create'));
});

Breadcrumbs::for('detail_banner', function ($trail, $banner) {
    $trail->parent('banners');
    $trail->push($banner->banner_name, route('banners.show', ['banner' => $banner]));
});

//Dashboard > City
Breadcrumbs::for('cities', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("City", route('city.index'));
});

Breadcrumbs::for('add_city', function ($trail) {
    $trail->parent('cities');
    $trail->push('Add City', route('city.create'));
});

Breadcrumbs::for('detail_city', function ($trail, $city) {
    $trail->parent('cities');
    $trail->push($city->city_name, route('city.show', ['city' => $city]));
});

//Dashboard > Region
Breadcrumbs::for('regions', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Region", route('region.index'));
});

Breadcrumbs::for('add_region', function ($trail) {
    $trail->parent('regions');
    $trail->push('Add Region', route('region.create'));
});

Breadcrumbs::for('detail_region', function ($trail, $region) {
    $trail->parent('regions');
    $trail->push($region->region_name, route('region.show', ['region' => $region]));
});

//Dashboard > Post Category
Breadcrumbs::for('categories_posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Post Category", route('categories-post.index'));
});

Breadcrumbs::for('add_category', function ($trail) {
    $trail->parent('categories_posts');
    $trail->push('Add Post Category', route('categories-post.create'));
});

Breadcrumbs::for('detail_category', function ($trail, $categoriesPosts) {
    $trail->parent('categories_posts', $categoriesPosts);
    $trail->push($categoriesPosts->category_title, route('categories-post.show', ['categories_post' => $categoriesPosts]));
});

//Dashboard > Post Tag
Breadcrumbs::for('tags', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Post Tag", route('tags.index'));
});

Breadcrumbs::for('add_tag', function ($trail) {
    $trail->parent('tags');
    $trail->push('Add Post', route('tags.create'));
});

Breadcrumbs::for('detail_tag', function ($trail, $tag) {
    $trail->parent('tags', $tag);
    $trail->push($tag->tag_title, route('tags.show', ['tag' => $tag]));
});

//Dashboard > Posts
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Posts", route('posts.index'));
});

Breadcrumbs::for('add_post', function ($trail) {
    $trail->parent('posts');
    $trail->push('Add Post', route('posts.create'));
});

Breadcrumbs::for('detail_post', function ($trail, $post) {
    $trail->parent('posts', $post);
    $trail->push($post->post_title, route('posts.show', ['post' => $post]));
});

//Dashboard > Post Category
Breadcrumbs::for('categories_gallery', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Gallery Category", route('categories-gallery.index'));
});

Breadcrumbs::for('add_category_cat', function ($trail) {
    $trail->parent('categories_gallery');
    $trail->push('Add Gallery Category', route('categories-gallery.create'));
});

Breadcrumbs::for('detail_category_cat', function ($trail, $categoriesGallery) {
    $trail->parent('categories_gallery', $categoriesGallery);
    $trail->push($categoriesGallery->cat_gallery_name, route('categories-gallery.show', ['categories_gallery' => $categoriesGallery]));
});

//Dashboard > Gallery
Breadcrumbs::for('gallery', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Gallery", route('gallery.index'));
});

Breadcrumbs::for('add_gallery', function ($trail) {
    $trail->parent('gallery');
    $trail->push('Add Gallery', route('gallery.create'));
});

Breadcrumbs::for('detail_gallery', function ($trail, $gallery) {
    $trail->parent('gallery', $gallery);
    $trail->push($gallery->image_name, route('gallery.show', ['gallery' => $gallery]));
});

//Dashboard > Partner
Breadcrumbs::for('partner', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Partner", route('partner.index'));
});

Breadcrumbs::for('add_partner', function ($trail) {
    $trail->parent('partner');
    $trail->push('Add Partner', route('partner.create'));
});

Breadcrumbs::for('detail_partner', function ($trail, $partner) {
    $trail->parent('partner', $partner);
    $trail->push($partner->partner_name, route('partner.show', ['partner' => $partner]));
});

//Dashboard > Market
Breadcrumbs::for('market', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Pasar", route('market.index'));
});

Breadcrumbs::for('add_market', function ($trail) {
    $trail->parent('market');
    $trail->push('Add Pasar', route('market.create'));
});

Breadcrumbs::for('detail_market', function ($trail, $market) {
    $trail->parent('market', $market);
    $trail->push($market->market_name, route('market.show', ['market' => $market]));
});

//Dashboard > Food Category
Breadcrumbs::for('categories_food', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Product Category", route('categories-food.index'));
});

Breadcrumbs::for('add_food', function ($trail) {
    $trail->parent('categories_food');
    $trail->push('Add Product Category', route('categories-food.create'));
});

Breadcrumbs::for('detail_food', function ($trail, $categoriesFood) {
    $trail->parent('categories_food', $categoriesFood);
    $trail->push($categoriesFood->food_name, route('categories-food.edit', ['categories_food' => $categoriesFood]));
});

//Dashboard > Stall
Breadcrumbs::for('stall', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Kios", route('stall.index'));
});

Breadcrumbs::for('add_stall', function ($trail) {
    $trail->parent('stall');
    $trail->push('Add Kios', route('stall.create'));
});

Breadcrumbs::for('detail_stall', function ($trail, $stall) {
    $trail->parent('stall', $stall);
    $trail->push($stall->stall_name, route('stall.show', ['stall' => $stall]));
});

//Dashboard > Rental
Breadcrumbs::for('rental', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Rental Kios", route('rental.index'));
});

Breadcrumbs::for('add_rental', function ($trail) {
    $trail->parent('rental');
    $trail->push('Add Rental Kios', route('rental.create'));
});

Breadcrumbs::for('detail_rental', function ($trail, $rental) {
    $trail->parent('rental', $rental);
    $trail->push($rental->rental_name, route('rental.edit', ['rental' => $rental]));
});

//Dashboard > Banner Promo
Breadcrumbs::for('banner_promos', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Banner Promo", route('banner-promo.index'));
});

Breadcrumbs::for('add_banner_promo', function ($trail) {
    $trail->parent('banner_promos');
    $trail->push('Add Banner Promo', route('banner-promo.create'));
});

Breadcrumbs::for('detail_banner_promo', function ($trail, $bannerPromo) {
    $trail->parent('banner_promos', $bannerPromo);
    $trail->push($bannerPromo->banner_name, route('banner-promo.show', ['banner_promo' => $bannerPromo]));
});

//Dashboard > Promo
Breadcrumbs::for('promos', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Promo", route('promo.index'));
});

Breadcrumbs::for('add_promo', function ($trail) {
    $trail->parent('promos');
    $trail->push('Add Promo', route('promo.create'));
});

Breadcrumbs::for('detail_promo', function ($trail, $promo) {
    $trail->parent('promos', $promo);
    $trail->push($promo->promo_title, route('promo.show', ['promo' => $promo]));
});

//Dashboard > Catalog
Breadcrumbs::for('catalogs', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Catalog", route('catalog.index'));
});

Breadcrumbs::for('add_catalog', function ($trail) {
    $trail->parent('catalogs');
    $trail->push('Add Catalog', route('catalog.create'));
});

Breadcrumbs::for('detail_catalog', function ($trail, $catalog) {
    $trail->parent('catalogs', $catalog);
    $trail->push($catalog->catalog_name, route('catalog.show', ['catalog' => $catalog]));
});

//Dashboard > Meta
Breadcrumbs::for('metas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Metas", route('metas.index'));
});

Breadcrumbs::for('add_meta', function ($trail) {
    $trail->parent('metas');
    $trail->push('Add Meta', route('metas.create'));
});

Breadcrumbs::for('detail_meta', function ($trail, $meta) {
    $trail->parent('metas', $meta);
    $trail->push($meta->meta_title, route('metas.show', ['meta' => $meta]));
});

//Dashboard > Flash News
Breadcrumbs::for('flash_news', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Flash News", route('flash-news.index'));
});

Breadcrumbs::for('add_news', function ($trail) {
    $trail->parent('flash_news');
    $trail->push('Add Flash News', route('flash-news.create'));
});

Breadcrumbs::for('detail_news', function ($trail, $flashNews) {
    $trail->parent('flash_news', $flashNews);
    $trail->push($flashNews->news_name, route('flash-news.show', ['flash_news' => $flashNews]));
});

//Dashboard > Category Team
Breadcrumbs::for('categories_team', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Team Category", route('categories-team.index'));
});

Breadcrumbs::for('add_cat_team', function ($trail) {
    $trail->parent('categories_team');
    $trail->push('Add Team Category', route('categories-team.create'));
});

Breadcrumbs::for('detail_cat_team', function ($trail, $categoriesTeam) {
    $trail->parent('categories_team');
    $trail->push($categoriesTeam->category_name, route('categories-team.show', ['categories_team' => $categoriesTeam]));
});

//Dashboard > Team
Breadcrumbs::for('teams', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Team", route('team.index'));
});

Breadcrumbs::for('add_team', function ($trail) {
    $trail->parent('teams');
    $trail->push('Add Team', route('team.create'));
});

Breadcrumbs::for('detail_team', function ($trail, $team) {
    $trail->parent('teams');
    $trail->push($team->team_name, route('team.show', ['team' => $team]));
});
