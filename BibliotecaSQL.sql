drop database if exists library;
create database library;
use  library;

create table members(
/*Tabla miembros --> Tabla independiente*/
    member_id       int auto_increment primary key,
    name            varchar(25),
    lastname1       varchar(25),
    lastname2       varchar(25),
    e_mail          varchar(25),
    password_user   varchar(25),
    dni				varchar(25),
    phone           int(9),
    coutry          varchar(25),
    adress          varchar(25),
    postalNumber    int(5),
    city            varchar(25)
);

create table book(
    book_id         int auto_increment primary key,
    location		int,
    title           varchar(25),
    ISBN            varchar(25),
    author          varchar(45),
    editorial       varchar(45),
    theme           varchar(45),
    category        varchar(45),
    FirtsAddBookDate     datetime default current_timestamp,
    quantity        int,
    location        int,
    foreign key (location) references location (location_id) 
        on delete no action on update cascade
);

create table reservation(
    book_id         int,
    member_id       int,
    date_at         datetime default current_timestamp,
    date_end        datetime,
    real_date_end   datetime,
    primary key(book_id,member_id,date_at),
    foreign key (book_id) references book (book_id)
		on delete no action on update cascade,
    foreign key(member_id) references members(member_id)
        on delete no action on update cascade
);

create table copy_book(
    id_copyBook     		int auto_increment primary key,
    originalBook_id         int,
    languages       		varchar(25),
    addBookDate				datetime default current_timestamp,
    reserved        		boolean,
    available       		boolean,
    foreign key (OriginalBook_id) references book (book_id)
        on delete no action on update cascade
);

