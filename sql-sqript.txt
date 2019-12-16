create table books
(
    id          int auto_increment
        primary key,
    name        varchar(255) not null,
    isbn        varchar(30)  not null,
    description longtext     null,
    image       varchar(255) not null,
    constraint UNIQ_4A1B2A92CC1CF4E6
        unique (isbn)
)
    collate = utf8_unicode_ci;


create table roles
(
    id   int auto_increment
        primary key,
    name varchar(60) not null
)
    collate = utf8_unicode_ci;

create table users
(
    id         int auto_increment
        primary key,
    first_name varchar(60)  not null,
    last_name  varchar(60)  not null,
    email      varchar(255) not null,
    password   varchar(255) not null,
    active     tinyint(1)   not null,
    constraint UNIQ_1483A5E9E7927C74
        unique (email)
)
    collate = utf8_unicode_ci;

create table users_books
(
    user_id int not null,
    book_id int not null,
    primary key (user_id, book_id),
    constraint FK_AD6C8EDB16A2B381
        foreign key (book_id) references books (id),
    constraint FK_AD6C8EDBA76ED395
        foreign key (user_id) references users (id)
)
    collate = utf8_unicode_ci;

create index IDX_AD6C8EDB16A2B381
    on users_books (book_id);

create index IDX_AD6C8EDBA76ED395
    on users_books (user_id);

create table users_roles
(
    user_id int not null,
    role_id int not null,
    primary key (user_id, role_id),
    constraint FK_51498A8EA76ED395
        foreign key (user_id) references users (id),
    constraint FK_51498A8ED60322AC
        foreign key (role_id) references roles (id)
)
    collate = utf8_unicode_ci;

create index IDX_51498A8EA76ED395
    on users_roles (user_id);

create index IDX_51498A8ED60322AC
    on users_roles (role_id);

insert into roles (name) values ('ROLE_USER'), ('ROLE_ADMIN');