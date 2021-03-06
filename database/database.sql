
-- Database: `finalproject`


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(15) NOT NULL auto_increment,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` tinytext NOT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `units` int(5) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `confirmed_orders` (
  `id` int(15) NOT NULL auto_increment,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` tinytext NOT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `fees` decimal(10,2) NOT NULL,
  `units` int(5) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `shipping_total` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(400) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `country` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL auto_increment,
  `product_code` varchar(60) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` tinytext NOT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `product_img_names` varchar(100) NOT NULL,
  `product_img_namess` varchar(100) NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `category` varchar(400) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `overall` varchar(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `trending_product` varchar(255)  NULL, 
  `best_sell_product` varchar(255)  NULL, 
  `top_product` varchar(255)  NULL, 
  `shipping_fees` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `product_status` enum('0','1') NOT NULL COMMENT '0-active,1-inactive',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


CREATE TABLE IF NOT EXISTS `shipping_address` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(400) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zip` varchar(400) NOT NULL,
  `country` varchar(400) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
 
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL auto_increment,
  `amount` varchar(255) NOT NULL,
  `paywith` varchar(255) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `card_number` varchar(255)  NULL,
  `telephone` varchar(400)  NULL,
  `cvv_number` varchar(255)  NULL,
  `expiry_date` varchar(255)  NULL,
  `zip` varchar(400)  NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
 
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `admin`(`id`, `fname`, `lname`, `admin_email`, `password`,`date`) VALUES (1,'Project','Group','finalproject@gmail.com','1f32aa4c9a1d2ea010adcf2348166a04',NOW());


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(500) NOT NULL,
  `city` varchar(400) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(400) NOT NULL,
 `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



CREATE TABLE `otp` (
  `ip` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
 
  PRIMARY KEY (`ip`),
   UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `otp_used` (
  `ip` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
 `date` timestamp NOT NULL default CURRENT_TIMESTAMP,

  PRIMARY KEY (`ip`),
   UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

