<?php return array(
    'list/category/([0-9]+)'=>'category/catList/$1',
    'category/([0-9]+)'=>'category/index/$1',
    'list/manufactur/([0-9]+)'=>'category/manList/$1',
    'manufactur/([0-9]+)'=>'category/manufactur/$1',
    
    'cart/delete/([0-9]+)'=>'cart/delete/$1',
    'cart/checkout'=>'cart/checkout',
    'cart/ajax'=>'cart/ajax',
    'cart'=>'cart/index',
//
//    'postav/nazira/ajax' => 'adminNazira/ajax',
//    'postav/nazira/change' => 'adminNazira/change',
//    'postav/nazira/logout' => 'adminNazira/logout',
//    'postav/nazira/view' => 'adminNazira/view',
//    'nazira' => 'adminNazira/index',
    
    'postav/view/([0-9]+)' => 'adminPostav/view/$1',
    'postav/ajax' => 'adminPostav/ajax',
    'postav/review' => 'adminPostav/review',
    'postav/change' => 'adminPostav/change',
    'postav/price' => 'adminPostav/price',
    'postav/save' => 'adminPostav/save',
    'postav/upload' => 'adminPostav/upload',
    'postav/logout' => 'adminPostav/logout',
    'postav' => 'adminPostav/index',
    
    'party/orders/([0-9]+)' => 'adminPartyStat/orders/$1',
    'party/stat' => 'adminPartyStat/index',
    
    
    'admin/product/update/([0-9]+)' =>'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' =>'adminProduct/delete/$1',
    'admin/product/create' =>'adminProduct/create',
    'admin/product'=>'adminProduct/index',
    
    'admin/category/update/([0-9]+)'=>'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)'=>'adminCategory/delete/$1',
    'admin/category/create'=>'adminCategory/create',
    'admin/category'=>'adminCategory/index',
    
    'admin/user/update/([0-9]+)'=>'adminUser/update/$1',
    'admin/user/login/([0-9]+)'=>'adminUser/login/$1',
    'admin/user/klient/([0-9]+)'=> 'adminUser/klient/$1',
    'admin/user/delete/([0-9]+)'=> 'adminUser/delete/$1',
    'admin/user/create'=>'adminUser/create',
    'admin/user'=>'adminUser/index',
    
    'admin/order/view/([0-9]+)'=>'adminOrder/view/$1',
    'admin/order/update/([0-9]+)'=>'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)'=>'adminOrder/delete/$1',
    'admin/order/ajax' => 'adminOrder/ajax',
    'admin/order/add' => 'adminOrder/add',
    'admin/order/addition' => 'adminOrder/addition',
    'admin/order/remove' => 'adminOrder/remove',
    'admin/order/party' => 'adminOrder/party',
    'admin/order/change' => 'adminOrder/change',
    'admin/order'=>'adminOrder/index',
    
    'admin/party/view/([0-9]+)' => 'adminParty/view/$1',
    
    'admin/print/view/([0-9]+)'=>'adminPrint/view/$1',
    'admin/print/seller/([0-9]+)'=>'adminPrint/seller/$1',
    'admin/print/driver/([0-9]+)'=>'adminPrint/driver/$1',
    'admin/print/deliver/([0-9]+)'=>'adminPrint/deliver/$1',
    'admin/print/clear/([0-9]+)'=>'adminPrint/clear/$1',
    'admin/print/ajax' => 'adminPrint/ajax',
    
    'admin/seller/update/([0-9]+)'=>'adminSeller/update/$1',
    'admin/seller/delete/([0-9]+)'=>'adminSeller/delete/$1',
    'admin/seller/create'=>'adminSeller/create',
    'admin/seller'=>'adminSeller/index',
    
    'admin/stat/single/([0-9]+)'=>'adminStat/single/$1',
    'admin/stat/date/([0-9]+)'=>'adminStat/time',
    'admin/stat/income'=>'adminStat/income',
    'admin/stat/items'=>'adminStat/items',
    'admin/stat/user'=>'adminStat/index',
    
    'admin/weekday/([0-9]+)'=>'adminCall/day/$1',
    'admin/single/call/([0-9]+)'=>'adminCall/single/$1',
    'admin/calling'=>'adminCall/index',
    
//    'admin/manufactur/update/([0-9]+)'=>'adminManufactur/update/$1',
//    'admin/manufactur/delete/([0-9]+)'=>'adminManufactur/delete/$1',
//    'admin/manufactur/create'=>'adminManufactur/create',
//    'admin/manufactur'=>'adminManufactur/index',
    
    'admin/item/update/([0-9]+)' => 'adminItem/update/$1',
    'admin/item/([0-9]+)' => 'adminItem/index/$1',
    'admin/item/ajax' => 'adminItem/ajax',
    'admin/item/create' => 'adminItem/create',
    
    'admin/region/update/([0-9]+)'=>'adminRegion/update/$1',
    'admin/region/create'=>'adminRegion/create',
    'admin/region'=>'adminRegion/index',
    
    'admin/sort/list/([0-9]+)' => 'adminSort/list/$1',
    'admin/sort/photo/([0-9]+)' => 'adminSort/photo/$1',
    'admin/ajax' => 'adminSort/ajax',
    
    'admin/test/seller' => 'adminTest/seller',
    'admin/test/number' => 'adminTest/number',
    'admin/test' => 'adminTest/index',
    
    'user/register'=>'user/register',
    'user/login'=>'user/login',
    'user/logout'=>'user/logout',
    
    'admin/logout'=>'admin/logout',
    'admin/region/([0-9]+)'=>'admin/region/$1',
    'admin'=>'admin/index',
    'index'=>'site/index',
    ''=>'site/enter',
);