-- Create the outfittersdb database
CREATE DATABASE outfittersdb;

-- Switch to the outfittersdb database
USE outfittersdb;

-- Create the 'customers' table
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    email TEXT,
    address VARCHAR(50) NOT NULL,
    password VARCHAR(40) NOT NULL,
    isAdmin BOOLEAN DEFAULT 0
);

-- Insert customer data
INSERT INTO customers (fullname, email, address, password,isAdmin)
VALUES ('admin', 'admin@localhost', '', MD5('admin123'),true),
        ('junhui', 'f31ee@localhost', '123 Nanyang Drive', MD5('1Password!'),false),
        ('charlotte', 'f32ee@localhost', '456 Nanyang Drive', MD5('123456'),false);

-- Create the 'products' table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    img1 VARCHAR(40),
    img2 VARCHAR(40),
    img3 VARCHAR(40),
    img4 VARCHAR(40),
    product_name VARCHAR(100),
    description TEXT,
    gender VARCHAR(10),
    cat VARCHAR(10),
    price DECIMAL(10, 2),
    is_new BOOLEAN

);

-- Insert product data
INSERT INTO products (img1, img2, img3, img4, product_name, description, gender, cat, price,is_new)
VALUES ('M1-final.png', 'M1-1.png', 'M1-2.png', 'M1-3.png', 'Sand Breeze Knit Jacket', 'Embrace the chill with our Sand Breeze Knit Jacket. Crafted for comfort and flexibility, this versatile jacket keeps you warm without sacrificing style. Perfect for pre and post-workout cool-downs or casual outings.', 'men', 'top', 16.50,false),
        ('M2-final.png', 'M2-1.png', 'M2-2.png', 'M2-3.png', 'Espresso Elevation Shirt', 'Elevate your workout wardrobe with our Espresso Elevation Shirt. Designed for performance and style, this moisture-wicking shirt keeps you dry while making a bold statement. Ideal for intense workouts or as a sleek layer for your active lifestyle.', 'men', 'top', 17.50,false),
        ('M3-final.png', 'M3-1.png', 'M3-2.png', 'M3-3.png', 'Essence Tank Top', 'Unleash your essence in our Essence Tank Top. Lightweight and breathable, this tank offers ultimate comfort during your workouts. From lifting to cardio, its stylish design keeps you looking fresh and feeling confident.', 'men', 'top', 18.50,false),
        ('M4-final.png', 'M4-1.png', 'M4-2.png', 'M4-3.png', 'Midnight Flex Joggers', 'Conquer the night in our Midnight Flex Joggers. Engineered for maximum flexibility and comfort, these joggers are perfect for both intense workouts and casual wear. The midnight black colour adds a touch of sleekness to your active style.', 'men', 'pants', 19.50,false),
        ('M5-final.png', 'M5-1.png', 'M5-2.png', 'M5-3.png', 'Black Knit Shorts', 'Keep it cool and casual in our Black Knit Shorts. Whether you\'re hitting the gym or running errands, these shorts offer a perfect blend of comfort and style. The black knit fabric ensures a classic and versatile look.', 'men', 'shorts', 17.50,true),
        ('M6-final.png', 'M6-1.png', 'M6-2.png', 'M6-3.png', 'Active Crest Joggers', 'Achieve peak performance in our Active Crest Joggers. With a modern design and superior comfort, these joggers are your go-to for any active pursuit. The iconic crest detail adds a touch of sporty sophistication.', 'men', 'pants', 19.50,true),

        ('W1-final.png', 'W1-1.png', 'W1-2.png', 'W1-3.png', 'Longline Sports Bra', 'Find the perfect balance of support and style with our Longline Sports Bra. The extended length provides extra coverage, making it ideal for layering or solo wear. Embrace your workout with confidence and comfort.', 'women', 'top', 26.50,false),
        ('W2-final.png', 'W2-1.png', 'W2-2.png', 'W2-3.png', 'Cozy Mocha Hoodie', 'Wrap yourself in warmth and style with our Cozy Mocha Hoodie. Perfect for chilly days or post-workout cooldowns, this hoodie combines fashion and function effortlessly. Embrace the coziness wherever your day takes you.', 'women', 'top', 26.50,false),
        ('W3-final.png', 'W3-1.png', 'W3-2.png', 'W3-3.png', 'Cropped Emerald', 'Stand out in our Cropped Emerald top. The vibrant color adds a pop to your workout wardrobe, while the cropped design keeps you cool during intense sessions. Pair it with high-waisted leggings for a trendy and functional look.', 'women', 'top', 27.50,false),
        ('W4-final.png', 'W4-1.png', 'W4-2.png', 'W4-3.png', 'V Waistband Leggings', 'Shape your style with our V Waistband leggings. The unique V-shaped waistband not only adds a touch of flair but also provides extra support during your workouts. Elevate your activewear collection with this fashion-forward choice.', 'women', 'pants', 18.50,false),
        ('W5-final.png', 'W5-1.png', 'W5-2.png', 'W5-3.png', 'Earthy Performance Joggers', 'Connect with nature in our Earthy Performance Joggers. Designed for both comfort and style, these joggers are perfect for outdoor workouts or casual outings. The earthy tones add a natural touch to your active lifestyle.', 'women', 'pants', 14.50,true),
        ('W6-final.png', 'W6-1.png', 'W6-2.png', 'W6-3.png', 'Fleece Shorts', 'Embrace comfort with our Fleece Shorts. The soft fleece fabric keeps you cozy during your rest days or leisurely activities. Pair them with your favourite tee for a laid-back look that\'s as comfortable as it is stylish.', 'women', 'shorts', 15.50,true);


-- Create the 'orders' table
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_date DATE,
    order_total DECIMAL(10, 2),

    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);
INSERT INTO orders (customer_id, order_date, order_total)
VALUES (1,'2023-10-30',350.00);

-- Create the 'order_details' table
CREATE TABLE order_details (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    item_size VARCHAR(2),
    quantity INT,
    subtotal DECIMAL(10, 2),

    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO order_details (order_id , product_id,item_size,quantity,subtotal)
VALUES (1,1,'M',10,165.00),
        (1,3,'L',20,185.00);
