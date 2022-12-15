FROM mysql:latest

RUN mysql -u root -p
RUN root
RUN CREATE USER 'bengak'@'db' IDENTIFIED BY 'bengak';
RUN GRANT ALL PRIVILEGES ON * . * TO 'bengak'@'db';
RUN FLUSH PRIVILEGES;