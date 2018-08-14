create table if not exists Customer (
  `customer_id` int(11) primary key auto_increment,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `cellphone` varchar(20),
  `email` varchar(255),
  `photo` varchar(255),
  `password` varchar(255)
);

create table if not exists Product (
  `product_id` int(11) primary key auto_increment,
  `name` varchar(255),
  `description` varchar(255),
  `price` double(10,2),
  `photo_id` int(11),
  `promotion` char(1),
  `category` varchar(255)
);

create table if not exists Campus (
  `campus_id` int(11) primary key auto_increment,
  `address` varchar(255),
  `telephone` varchar(255)
);

create table if not exists Inventory (
  `product_id` int(11),
  `campus_id` int(11),
  `quantity` int(11),
  primary key (`product_id`, `campus_id`),
  foreign key fk_prod_id (`product_id`) references Product (`product_id`),
  foreign key fk_campus_id (`campus_id`) references Campus (`campus_id`)
);

create table if not exists Favorites (
  `customer_id` int(11),
  `product_id` int(11),
  primary key (`customer_id`, `product_id`),
  foreign key fk_cust_id (`customer_id`) references Customer (`customer_id`),
  foreign key fk_prod_id (`product_id`) references Product (`product_id`)
);

create table if not exists OrderTable (
  `order_id` int(11) primary key auto_increment,
  `customer_id` int(11),
  `date_of_purchase` date,
  `delivery_date` date,
  `payment` double(10,2),
  foreign key fk_cust_id (`customer_id`) references Customer (`customer_id`)
);

create table if not exists OrderLine (
  `product_id` int(11),
  `order_id` int(11),
  `quantity` int(11),
  primary key (`product_id`, `campus_id`),
  foreign key fk_prod_id (`product_id`) references Product (`product_id`),
  foreign key fk_order_id (`order_id`) references OrderTable (`order_id`)
);