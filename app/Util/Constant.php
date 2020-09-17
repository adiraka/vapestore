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
    const CATEGORY_DRIP_TIP = 'DRIP_TIP';
    const CATEGORY_LIST = [
    	self::CATEGORY_LIQUID => 'Liquid',
	    self::CATEGORY_DEVICE => 'Device',
	    self::CATEGORY_COTTON => 'Cotton',
	    self::CATEGORY_AUTOMIZER => 'Automizer',
	    self::CATEGORY_CATRIDGE => 'Catridge',
	    self::CATEGORY_COIL => 'Coil',
        self::CATEGORY_DRIP_TIP => 'Drip Tip'
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

    const CATRIDGE_TYPE_CATRIDGE = 'CATRIDGE';
    const CATRIDGE_TYPE_LIST = [
        self::CATRIDGE_TYPE_CATRIDGE => 'Catridge',
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

    const ALL_TYPE_LABEL = [
    	self::LIQUID_TYPE_FREEBASE => 'Freebase',
    	self::LIQUID_TYPE_SALTNIC => 'SaltNic',
    	self::DEVICE_TYPE_ELECTRICAL => 'Electrical',
    	self::DEVICE_TYPE_MECHA => 'Mecha',
    	self::DEVICE_TYPE_POD => 'Pod',
    	self::COTTON_TYPE_KENDO => 'Kendo',
    	self::COTTON_TYPE_BACON => 'Bacon',
    	self::COTTON_TYPE_MORPHIN => 'Morphin',
    	self::COTTON_TYPE_ATOMIX => 'Atomix',
    	self::COIL_TYPE_FUSED => 'Fused Clapton',
    	self::COIL_TYPE_ALIEN_FUSED => 'Alien Fused Clapton',
    	self::AUTOMIZER_TYPE_RDA => 'RDA',
    	self::AUTOMIZER_TYPE_RTA => 'RTA',
    	self::DRIP_TIP_TYPE_810 => '810',
    	self::DRIP_TIP_TYPE_510 => '510',
        self::CATRIDGE_TYPE_CATRIDGE => 'Catridge'
    ];

    const ALL_TYPE_DESCRIPTION_LABEL = [
        self::LIQUID_TYPE_FREEBASE => 'We sell best Freebase Liquid',
        self::LIQUID_TYPE_SALTNIC => 'SaltNic',
        self::DEVICE_TYPE_ELECTRICAL => 'Electrical',
        self::DEVICE_TYPE_MECHA => 'Mecha',
        self::DEVICE_TYPE_POD => 'Pod',
        self::COTTON_TYPE_KENDO => 'Kendo',
        self::COTTON_TYPE_BACON => 'Bacon',
        self::COTTON_TYPE_MORPHIN => 'Morphin',
        self::COTTON_TYPE_ATOMIX => 'Atomix',
        self::COIL_TYPE_FUSED => 'Fused Clapton',
        self::COIL_TYPE_ALIEN_FUSED => 'Alien Fused Clapton',
        self::AUTOMIZER_TYPE_RDA => 'RDA',
        self::AUTOMIZER_TYPE_RTA => 'RTA',
        self::DRIP_TIP_TYPE_810 => '810',
        self::DRIP_TIP_TYPE_510 => '510',
        self::CATRIDGE_TYPE_CATRIDGE => 'Catridge'
    ];

    const CATEGORY_TYPE_LIST = [
        self::CATEGORY_LIQUID => self::LIQUID_TYPE_LIST,
        self::CATEGORY_DEVICE => self::DEVICE_TYPE_LIST,
        self::CATEGORY_COTTON => self::COTTON_TYPE_LIST,
        self::CATEGORY_AUTOMIZER => self::AUTOMIZER_TYPE_LIST,
        self::CATEGORY_CATRIDGE => self::CATRIDGE_TYPE_LIST,
        self::CATEGORY_COIL => self::COIL_TYPE_LIST,
        self::CATEGORY_DRIP_TIP => self::DRIP_TIP_TYPE_LIST
    ];

    const BLOG_STATUS_PUBLISHED = 'PUBLISHED';
    const BLOG_STATUS_UNPUBLISHED = 'UNPUBLISHED';
    const BLOG_STATUS_LIST = [
        self::BLOG_STATUS_PUBLISHED => 'Published',
        self::BLOG_STATUS_UNPUBLISHED => 'Unpublished'
    ];

    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';
    const GENDER_LABEL = [
        self::GENDER_MALE => 'Male',
        self::GENDER_FEMALE => 'Female'
    ];

    const COURIER_JNE = 'jne';
    const COURIER_TIKI = 'tiki';
    const COURIER_POS = 'pos';
    const COURIER_LABEL = [
        self::COURIER_JNE => 'JNE',
        self::COURIER_TIKI => 'TIKI',
        self::COURIER_POS => 'POS'
    ];

    const INVOICE_STATUS_UNPAID = 'UNPAID';
    const INVOICE_STATUS_PAID = 'PAID';
    const INVOICE_STATUS_EXPIRED = 'EXPIRED';

    const ORDER_STATUS_PAYMENT = 'PAYMENT';
    const ORDER_STATUS_PACKING = 'PACKING';
    const ORDER_STATUS_SEND = 'SEND';
    const ORDER_STATUS_COMPLETED = 'COMPLETED';
    const ORDER_STATUS_CANCELLED = 'CANCELLED';

    const MONTH_JAN = '1';
    const MONTH_FEB = '2';
    const MONTH_MAR = '3';
    const MONTH_APR = '4';
    const MONTH_MEI = '5';
    const MONTH_JUN = '6';
    const MONTH_JUL = '7';
    const MONTH_AUG = '8';
    const MONTH_SEP = '9';
    const MONTH_OCT = '10';
    const MONTH_NOV = '11';
    const MONTH_DEC = '12';

    const MONTH_LABEL = [
        self::MONTH_JAN => 'January',
        self::MONTH_FEB => 'February',
        self::MONTH_MAR => 'March',
        self::MONTH_APR => 'April',
        self::MONTH_MEI => 'May',
        self::MONTH_JUN => 'June',
        self::MONTH_JUL => 'July',
        self::MONTH_AUG => 'August',
        self::MONTH_SEP => 'September',
        self::MONTH_OCT => 'October',
        self::MONTH_NOV => 'November',
        self::MONTH_DEC => 'December'
    ];
}