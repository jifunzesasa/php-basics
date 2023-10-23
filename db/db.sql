CREATE TABLE subscribers (
    subscriber_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subscription_date DATE NOT NULL
) ENGINE = CSV;