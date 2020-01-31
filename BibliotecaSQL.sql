drop database if exists library;
create database library;
use  library;

create table Log(
	date_of_log		datetime,
    user			int,
    text_log		varchar(255),/*Error text*/
    error_place		varchar(255)/*Web error*/
);

create table members(
/*Tabla miembros --> Tabla independiente*/
    member_id       int auto_increment primary key,
    name            varchar(255),
    lastname1       varchar(255),
    lastname2       varchar(255),
    e_mail          varchar(255) unique,
    password_user   varchar(255),
    dni				varchar(255) not null unique,
    phone           int(9),
    postalNumber    varchar(5),
    penalty			date,
    total_books_reserved	int default 0,
    librarian		boolean default 0
); 

create table book(
    book_id         int auto_increment primary key,
    location		int unique,
    title           varchar(255),
    ISBN            varchar(25),
    author          varchar(45),
    editorial       varchar(45),
    theme           varchar(45),
    category        varchar(45),
    FirtsAddBookDate     datetime default current_timestamp,
    quantity        int,
    img				varchar(255),
    price			float(10,2)
);

create table copy_book(
    id_copyBook     		int auto_increment primary key,
    originalBook_id         int,
    languages       		varchar(25),
    addBookDate				datetime default current_timestamp,
    reserved        		boolean default 0,
    available       		boolean default 1,
    foreign key (OriginalBook_id) references book (book_id)
        on delete no action on update cascade
);

create table reservation(
	id_reservation	int auto_increment primary key,
    Copybook_id     int,
    user_id       int,
    date_reserve    datetime default current_timestamp,
    date_end        datetime,
    date_devolution   datetime,
    foreign key (Copybook_id) references copy_book (id_copyBook)
		on delete no action on update cascade,
    foreign key(user_id) references members(member_id)
        on delete no action on update cascade
);

create table cart(
	id_cart			int auto_increment primary key,
    id_user			int,
    date_create		datetime default current_timestamp,/*moment when you insert the firts product*/
    date_end		datetime,/*moment when you finish the trassation*/
    finished		boolean default false,
    total_products	int default 0
);	

create table cart_product(
	id_item			int auto_increment primary key ,
	id_product		int,/*id of the copy of the book*/
    title           varchar(255),
    quantity		int,
    date_insert		datetime default current_timestamp,/*date when you insert the product into the cart*/
    cart_id			int,
    foreign key (cart_id) references cart (id_cart) 
		on delete no action on update cascade,
	foreign key (id_product) references copy_book (id_copyBook)
		on delete no action on update cascade
);