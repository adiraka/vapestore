<?php

namespace App\Util;

class Constant {

    const USER_ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    const USER_ROLE_ADMIN = 'ADMIN';
    const USER_ROLE_CUSTOMER = 'CUSTOMER';

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    const STATUS_LABELS = [
    	self::STATUS_ACTIVE => 'Active',
    	self::STATUS_INACTIVE => 'Inactive'
    ];

}