# Secondhand Butik


It's a REST API for a web service where routing is built using URLs.
The web service is intended for creating sellers and products/clothes that the seller leaves in the store for sale in the database.
## Getting started
First, clone the project from GitHub to the correct folder. For example, if you are using XAMPP, then clone the project to the xamp folder on your computer.
Link to the project: https://github.com/sergejsvoronins/php-secondhand-butik.git
Then you can create a database in local MySql, for example using phpMyAdmin with the help of the db.sql file that can be imported.

To test all endpoints, use, for example, POSTMAN. 

## Endpoints:

URL http://localhost/project/[endpoint]

### Get all sellers
        metod: "GET"
        endpoint: sellers
        
        Response
               {
                "count": 8,
                "result": [
                {
                    "id": 1,
                    "first_name": "Sergejs",
                    "last_name": "Voronins",
                    "epost": "s@v.se",
                    "mobile": "0720801071",
                    "creating_date": "2023-05-29"
                },
                ...
### Get all products
        metod: "GET"
        endpoint: products

        Response
                {
                "count": 6,
                "result": [
                {
                    "id": 4,
                    "name": "Jeans",
                    "price": 300,
                    "creating_date": "2023-05-29",
                    "selling_date": null
                },
                {
                    "id": 6,
                    "name": "byxor",
                    "price": 250,
                    "creating_date": "2023-05-30",
                    "selling_date": null
                },
                ...
### Get single seller
        metod: "GET"
        endpoint: sellers/id
        
        Response
                {
                "id": 1,
                "first_name": "Sergejs",
                "last_name": "Voronins",
                "epost": "s@v.se",
                "mobile": "0720801071",
                "creating_date": "2023-05-29",
                "products_count": 2,
                "sold_products_count": 0,
                "total_selling_price": 0,
                "products_list": [
                    {
                        "id": 4,
                        "name": "Jeans",
                        "size": "XS",
                        "category": "pants",
                        "price": 300,
                        "creating_date": "2023-05-29",
                        "selling_date": null
                    },
                    ...
### Get single product
        metod: "GET"
        endpoint: products/id
        
        Response
                {
                    "id": 4,
                    "name": "Jeans",
                    "size": "XS",
                    "category": "pants",
                    "price": 300,
                    "selle_ID": 1,
                    "seller_name": "Sergejs Voronins",
                    "creating_date": "2023-05-29",
                    "selling_date": null
                }
### Update specific product with sales date that means that product is sold
        metod: "PUT"
        endpoint: products/id
        
        Response 
                {
                    "message": "Product  with ID = 4 has been updated"
                }
        I fall produkten är såld får man svar
                {
                    "message": "Product  with ID = 4 is already sold"
                }
### Create product
        metod: "POST"
        endpoint: products
        
        To create a product you have to send JSON object in below format:
                {
                    "name":"adidas t-shirt",
                    "size_id": 2,
                    "category_id":3,
                    "price":100,
                    "seller_id": 3
                }
        Response you will get
                {
                    "message": "Product is created",
                    "id": "78"
                }       
        
### Create seller
        metod: "POST"
        endpoint: sellers
        
        To create a seller you have to send JSON object in below format:
                {
                    "first_name" : "Namn",
                    "last_name" : "Efternamn",
                    "epost" : "namne@efternamn.se",
                    "mobile" : "0892834698"
                }
        Response you will get
                {
                    "message": "Seller is created",
                    "id": "84"
                }
## Databas
Database that API is talking to include 4 tables
### categories
    id: int AI
    name: varchar(32)
    creating_date: date
### products
    id: int AI
    name: varchar(32)
    size_id: int
    category_id: int
    price: int
    seller_id: int
    creating_date: date
    selling_date: date
### sellers
    id: int AI
    first_name: varchar(32)
    last_name: varchar(32)
    epost: varchar(32)
    mobile: varchar(13)
    creating_date: date
### sizes
    id: int AI
    name: varchar(3)
    description: varchar(32)
    creating_date: date


