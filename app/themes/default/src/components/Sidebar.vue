<template>
    <div class="sidebar">
        <div class="sidebar-top">
            <div class="brand">
                <a href="/admin"><img src="/assets/images/admin-logo.png" class="img-fluid logo"></a>
            </div>
        </div>

        <div>
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/modules/page/">pages</a>
                        <router-link to="/admin/modules/page/" class="nav-link">page</router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>