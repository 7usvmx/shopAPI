CREATE OR REPLACE VIEW productsView as 
SELECT products.* , categories.* FROM products
INNER JOIN categories ON categories.catID = products.productCat


https://husamabdallah.com/api/shop/products/productsView.php

SELECT productsView.*, 1 as favorite FROM productsView
INNER JOIN
favorites on favorites.productID = productsView.productID AND favorites.userID = 1
WHERE catID = 1 
UNION ALL
SELECT * , 0 as favorite FROM productsView
WHERE productID != (
SELECT productsView.productID FROM productsView
INNER JOIN
favorites on favorites.productID = productsView.productID AND favorites.userID = 1
)


    CREATE OR REPLACE VIEW productsView AS
    SELECT productsView.*, 1 as favorite FROM productsView
    UNION ALL 
    SELECT * , 0 as favorite FROM productsView 
    WHERE 
    productID NOT IN ( SELECT productsView.productID FROM productsView);




CREATE OR REPLACE VIEW favoritesView AS
SELECT favorites.*, products.*, users.usersID FROM favorites
INNER JOIN 
    users ON users.usersID = favorites.userID
INNER JOIN 
    products ON products.productID = favorites.product_ID;






    //! Cart View 

CREATE OR REPLACE VIEW cartView AS 
SELECT SUM(products.productPrice) AS amount, COUNT(cart.cartProductID) AS quantity , products.*, cart.* FROM `cart`
INNER JOIN products on products.productID = cart.cartProductID
GROUP BY cart.cartUsersID , cart.cartProductID


SELECT SUM(amount) as totalAmount , SUM(quantity) AS allProductsQuantity  FROM cartView
WHERE cartUsersID = 1
GROUP BY cartUsersID , cartProductID