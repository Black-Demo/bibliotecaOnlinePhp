create database testcard;
use testcard;
CREATE TABLE customers (
 id int(11) NOT NULL AUTO_INCREMENT,
 name varchar(100)   NOT NULL,
 email varchar(100)   NOT NULL,
 phone varchar(15)   NOT NULL,
 address text   NOT NULL,
 created datetime NOT NULL,
 modified datetime NOT NULL,
 PRIMARY KEY (id)
);

CREATE TABLE products (
 id int(11) NOT NULL AUTO_INCREMENT,
 name varchar(200)   NOT NULL,
 description text   NOT NULL,
 price float(10,2) NOT NULL,
 created datetime NOT NULL,
 modified datetime NOT NULL,
 PRIMARY KEY (id)
) ;
CREATE TABLE orders (
 id int(11) NOT NULL AUTO_INCREMENT,
 customer_id int(11) NOT NULL,
 total_price float(10,2) NOT NULL,
 created datetime NOT NULL,
 modified datetime NOT NULL,
 PRIMARY KEY (id),
 KEY customer_id (customer_id),
 CONSTRAINT orders_ibfk_1 FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE ON UPDATE NO ACTION
) ;
CREATE TABLE order_items (
 id int(11) NOT NULL AUTO_INCREMENT,
 order_id int(11) NOT NULL,
 product_id int(11) NOT NULL,
 quantity int(5) NOT NULL,
 PRIMARY KEY (id),
 KEY order_id (order_id),
 CONSTRAINT order_items_ibfk_1 FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE NO ACTION
) ;