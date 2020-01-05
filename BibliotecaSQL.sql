drop database if exists library;
create database library;
use  library;

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
    quantity        int
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
    #date_get		datetime,
    #date_max		datetime,
    date_end        datetime,
    date_devolution   datetime,
    foreign key (Copybook_id) references copy_book (id_copyBook)
		on delete no action on update cascade,
    foreign key(user_id) references members(member_id)
        on delete no action on update cascade
);

