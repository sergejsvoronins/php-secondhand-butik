# Secondhand Butik


Det är ett REST API där routing byggt med url.
## Att komma igång
Först klonar man projektet från github till rätt mapp. Tex i fall man använder XAMPP då klonar man projektet till mappen xamp på sin dator. 
Länk till projektet:  https://github.com/sergejsvoronins/php-secondhand-butik.git
Sedan kan man skapa en databas i tex phpMyAdmin med hjälp av db.sql filen som går att importera. 

För att testa alla endpoints användar man tex POSTMAN. 

## Endpoints:

URL http://localhost/project/[endpoint]

### Hämta alla säljare och visa som en JSON objekt
        metod: "GET"
        endpoint: sellers
        
        Tex på svar
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
### Hämta alla produkter och visa som en JSON objekt
        metod: "GET"
        endpoint: products

        Tex på svar
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
### Hämta specifik säljare och visa som en JSON objekt
        metod: "GET"
        endpoint: sellers/id
        
        Tex på svar
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
### Hämta specifik produkt och visa som en JSON objekt
        metod: "GET"
        endpoint: products/id
        
        Tex på svar
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
### Uppdatera specifik produkt med försäljnings datum som motsvarar att produkten har status "såld"
        metod: "PUT"
        endpoint: products/id
        
        Tex på svar 
                {
                    "message": "Product  with ID = 4 has been updated"
                }
        I fall produkten är såld får man svar
                {
                    "message": "Product  with ID = 4 is already sold"
                }
### Skapa en produkt där skickar man ett JSON objekt
        metod: "POST"
        endpoint: products
        
        För att skapa en produkt måste man skicka ett JSONobjekt som ser ut så:
                {
                    "name":"adidas t-shirt",
                    "size_id": 2,
                    "category_id":3,
                    "price":100,
                    "seller_id": 3
                }
        Svaret man får
                {
                    "message": "Product is created",
                    "id": "78"
                }       
        
### Skapa en säljare där skickar man ett JSON objekt
        metod: "POST"
        endpoint: sellers
        
        För att skapa en säljare måste man skicka ett JSONobjekt som ser ut så:
                {
                    "first_name" : "Namn",
                    "last_name" : "Efternamn",
                    "epost" : "namne@efternamn.se",
                    "mobile" : "0892834698"
                }
        Svaret man får
                {
                    "message": "Seller is created",
                    "id": "84"
                }
## Databas
Databasen som APIet pratar med består av 4 tabeller
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


