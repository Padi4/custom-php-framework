create table report
(
    id      integer not null
        constraint report_pk
            primary key autoincrement,
    reporter text not null,
    description text not null
);
