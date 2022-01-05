<?php

return [
    'authorities' => [
        'Manage Banners' => [
            'Banner Show',
            'Banner Create',
            'Banner Update',
            'Banner Delete'
        ],
        'Manage Cities' => [
            'City Show',
            'City Create',
            'City Update',
            'City Delete'
        ],
        'Manage Regions' => [
            'Region Show',
            'Region Create',
            'Region Update',
            'Region Delete'
        ],
        'Manage Posts' => [
            'Post Show',
            'Post Create',
            'Post Update',
            'Post Delete'
        ],
        'Manage Post Categories' => [
            'Post Category Show',
            'Post Category Create',
            'Post Category Update',
            'Post Category Delete'
        ],
        'Manage Tags' => [
            'Tag Show',
            'Tag Create',
            'Tag Update',
            'Tag Delete'
        ],
        'Manage Galleries' => [
            'Gallery Show',
            'Gallery Create',
            'Gallery Update',
            'Gallery Delete'
        ],
        'Manage Gallery Categories' => [
            'Gallery Category Show',
            'Gallery Category Create',
            'Gallery Category Update',
            'Gallery Category Delete'
        ],
        'Manage Partners' => [
            'Partner Show',
            'Partner Create',
            'Partner Update',
            'Partner Delete'
        ],
        'Manage Markets' => [
            'Market Show',
            'Market Create',
            'Market Update',
            'Market Delete'
        ],
        'Manage Stalls' => [
            'Stall Show',
            'Stall Create',
            'Stall Update',
            'Stall Delete'
        ],
        'Manage Stall Categories' => [
            'Stall Category Show',
            'Stall Category Create',
            'Stall Category Update',
            'Stall Category Delete'
        ],
        'Manage Promos' => [
            'Promo Show',
            'Promo Create',
            'Promo Update',
            'Promo Delete'
        ],
        'Manage Metas' => [
            'Meta Show',
            'Meta Create',
            'Meta Update',
            'Meta Delete'
        ],
        'Manage Flash News' => [
            'Flash New Show',
            'Flash New Create',
            'Flash New Update',
            'Flash New Delete'
        ],
        'Manage Profiles' => [
            'Profile Show',
            'Profile Create',
            'Profile Update',
            'Profile Delete'
        ],
        'Manage Passwords' => [
            'Password Show',
            'Password Create',
            'Password Update',
            'Password Delete'
        ],
        'Manage Roles' => [
            'Role Show',
            'Role Create',
            'Role Update',
            'Role Delete'
        ],
        'Manage Users' => [
            'User Show',
            'User Create',
            'User Update',
            'User Delete'
        ],
        'Manage Teams' => [
            'Team Show',
            'Team Create',
            'Team Update',
            'Team Delete'
        ],
        'Manage Category Team' => [
            'Category Team Show',
            'Category Team Create',
            'Category Team Update',
            'Category Team Delete'
        ],
        'Manage Banner Promos' => [
            'Banner Promo Show',
            'Banner Promo Create',
            'Banner Promo Update',
            'Banner Promo Delete'
        ],
        'Manage Catalogs' => [
            'Catalog Show',
            'Catalog Create',
            'Catalog Update',
            'Catalog Delete'
        ],
        'Manage Rentals' => [
            'Rental Show',
            'Rental Create',
            'Rental Update',
            'Rental Delete'
        ],
    ],

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',
    ],

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * When checking for a permission against a model by passing a Permission
         * instance to the check, this key determines what attribute on the
         * Permissions model is used to cache against.
         *
         * Ideally, this should match your preferred way of checking permissions, eg:
         * `$user->can('view-posts')` would be 'name'.
         */

        'model_key' => 'name',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
