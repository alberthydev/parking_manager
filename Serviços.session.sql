create table user (
    UserId int auto_increment,
    UserName varchar(20),
    UserCPF varchar(11) unique,
    UserRegistrationDate timestamp,
    IdVehicle int not null,
    primary key (UserId),
    foreign key (IdVehicle) references vehicle (IdVehicle)
);

create table vehicle (
    IdVehicle int not null auto_increment,
    VehicleDesc varchar(255) not null,
    VehicleRegistrationDate timestamp,
    primary key (IdVehicle)
);

create table parking (
    IdParking int auto_increment,
    IdUser int not null,
    IdVehicle int not null,
    ParkingDateEntrance timestamp not null,
    ParkingDateLeft timestamp,
    primary key (IdParking),
    foreign key (IdUser) references user (UserId),
    foreign key (IdVehicle) references vehicle (IdVehicle)
)