<?php

return [
	'admin.auth.getLogin',
	'admin.auth.postLogin',
	'admin.auth.logout',
	'admin.dashboard.home',
	'admin.dashboard.updateDashboard',
	'admin.permissions.update',

	// Exclude Custom Routes
	'admin.settings.changeLang',
	'admin.settings.saveChangeLang',

    'admin.customers.changeStatus',
    'admin.stores.changeStatus',
    'admin.coupons.changeStatus',
    'admin.offers.changeStatus',
    'admin.cities.changeStatus',
    'admin.countries.changeStatus',
    'admin.daily_offers.changeStatus',
    'admin.categories.changeStatus',
    'admin.advertisements.changeStatus',
    'admin.articles_categories.changeStatus',
    'admin.articles.changeStatus',

    'admin.advertisements.uploadImage',
    'admin.advertisements.deleteImage',

    'admin.coupons.import',
    'admin.coupons.export',
    'admin.daily_offers.import',
    'admin.daily_offers.export',
    'admin.categories.import',
    'admin.categories.export',
    

  ];
