load data local infile '/tmp/load_data/datos_descuentos_buscador_prueba.2.0.csv' into table products 
CHARACTER SET utf8
fields terminated by ',' 
enclosed by '\"' 
lines terminated by '\r\n' 
IGNORE 1 LINES
(title, description, start_date, end_date, price, image, sold, tags) SET id = NULL;