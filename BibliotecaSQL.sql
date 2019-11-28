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
    password_user   varchar(255),
    dni				varchar(25),
    phone           int(9),
    postalNumber    int(5),
    librarian		boolean default 0
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
    Copybook_id         int,
    member_id       int,
    date_at         datetime default current_timestamp,
    date_end        datetime,
    real_date_end   datetime,
    primary key(Copybook_id,member_id,date_at),
    foreign key (Copybook_id) references copy_book (id_copyBook)
		on delete no action on update cascade,
    foreign key(member_id) references members(member_id)
        on delete no action on update cascade
);

