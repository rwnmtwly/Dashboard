CREATE TABLE products(
    id BIGSERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(250) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    sale DECIMAL(10,2),
    seller VARCHAR(150),
    quantity INTEGER,
    descrition TEXT,
    date_added DATE DEFAULT CURRENT_TIMESTAMP,
    category VARCHAR(100)
);