
create database if not exists `TheShoppingCart`;

use `TheShoppingCart`;

create table if not exists Customer (
  `customer_id` int(11) primary key auto_increment,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `cellphone` varchar(20),
  `email` varchar(255),
  `password` varchar(255)
);

create table if not exists Category (
  `category_id` int(11) primary key auto_increment,
  `category_name` varchar(50)
);

create table if not exists Product (
  `product_id` int(11) primary key auto_increment,
  `product_name` varchar(255),
  `description` varchar(255),
  `price` double(10,2),
  `photo_id` varchar(255),
  `category_id` int(11),
   foreign key fk_prod_cat_id (`category_id`) references Category(`category_id`)
);

create table if not exists Campus (
  `campus_id` int(11) primary key auto_increment,
  `campus_name` varchar(255)
);

create table if not exists Inventory (
  `product_id` int(11),
  `campus_id` int(11),
  `stock` int(11),
  primary key (`product_id`, `campus_id`),
  foreign key fk_inv_prod_id (`product_id`) references Product (`product_id`),
  foreign key fk_inv_campus_id (`campus_id`) references Campus (`campus_id`)
);

create table if not exists Favorites (
  `customer_id` int(11),
  `product_id` int(11),
  primary key (`customer_id`, `product_id`),
  foreign key fk_fav_cust_id (`customer_id`) references Customer (`customer_id`),
  foreign key fk_fav_prod_id (`product_id`) references Product (`product_id`)
);

create table if not exists OrderTable (
  `order_table_id` int(11) primary key auto_increment,
  `customer_id` int(11),
  `order_id` varchar(255),
  `date_of_purchase` date,
  `delivery_date` date,
  `payment` double(10,2),
  foreign key fk_ord_cust_id (`customer_id`) references Customer (`customer_id`)
);

create table if not exists OrderLine (
  `product_id` int(11),
  `order_id` varchar(255),
  `quantity` int(11),
  primary key (`product_id`, `order_id`),
  foreign key fk_lin_prod_id (`product_id`) references Product (`product_id`)
);