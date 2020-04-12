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

    const CATEGORY_LIQUID = 'LIQUID';
    const CATEGORY_DEVICE = 'DEVICE';
    const CATEGORY_COTTON = 'COTTON';
    const CATEGORY_AUTOMIZER = 'AUTOMIZER';
    const CATEGORY_CATRIDGE = 'CATRIDGE';
    const CATEGORY_COIL = 'COIL';
    const CATEGORY_LIST = [
    	self::CATEGORY_LIQUID => 'Liquid',
	    self::CATEGORY_DEVICE => 'Device',
	    self::CATEGORY_COTTON => 'Cotton',
	    self::CATEGORY_AUTOMIZER => 'Automizer',
	    self::CATEGORY_CATRIDGE => 'Catridge',
	    self::CATEGORY_COIL => 'Coil'
    ];

    const LIQUID_TYPE_FREEBASE = 'FREEBASE';
    const LIQUID_TYPE_SALTNIC = 'SALTNIC';
    const LIQUID_TYPE_LIST = [
    	self::LIQUID_TYPE_FREEBASE => 'Freebase',
    	self::LIQUID_TYPE_SALTNIC => 'SaltNic'
    ];

    const DEVICE_TYPE_ELECTRICAL = 'ELECTRICAL';
    const DEVICE_TYPE_MECHA = 'MECHA';
    const DEVICE_TYPE_POD = 'POD';
    const DEVICE_TYPE_LIST = [
    	self::DEVICE_TYPE_ELECTRICAL => 'Electrical',
    	self::DEVICE_TYPE_MECHA => 'Mecha',
    	self::DEVICE_TYPE_POD => 'Pod'
    ];

    const COTTON_TYPE_KENDO = 'KENDO';
    const COTTON_TYPE_BACON = 'BACON';
    const COTTON_TYPE_MORPHIN = 'MORPHIN';
    const COTTON_TYPE_ATOMIX = 'ATOMIX';
    const COTTON_TYPE_LIST = [
    	self::COTTON_TYPE_KENDO => 'Kendo',
    	self::COTTON_TYPE_BACON => 'Bacon',
    	self::COTTON_TYPE_MORPHIN => 'Morphin',
    	self::COTTON_TYPE_ATOMIX => 'Atomix'
    ];

    const COIL_TYPE_FUSED = 'FUSED';
    const COIL_TYPE_ALIEN_FUSED = 'ALIEN_FUSED';
    const COIL_TYPE_LIST = [
    	self::COIL_TYPE_FUSED => 'Fused Clapton',
    	self::COIL_TYPE_ALIEN_FUSED => 'Alien Fused Clapton'
    ];

    const AUTOMIZER_TYPE_RDA = 'RDA';
    const AUTOMIZER_TYPE_RTA = 'RTA';
    const AUTOMIZER_TYPE_LIST = [
    	self::AUTOMIZER_TYPE_RDA => 'RDA',
    	self::AUTOMIZER_TYPE_RTA => 'RTA'
    ];

    const DRIP_TIP_TYPE_810 = '810';
    const DRIP_TIP_TYPE_510 = '510';
    const DRIP_TIP_TYPE_LIST = [
    	self::DRIP_TIP_TYPE_810 => '810',
    	self::DRIP_TIP_TYPE_510 => '510'
    ];
}