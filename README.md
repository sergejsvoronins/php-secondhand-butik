Secondhand Butik

======BESKRIVNING======

Det är ett REST API där routing byggt med url.

Endpoints:
    Att hämta alla säljare och visa som en JSON objekt
        metod: "GET"
        endpoint: sellers
    Att hämta alla produkter och visa som en JSON objekt
        metod: "GET"
        endpoint: products
    Att hämta specifik säljare och visa som en JSON objekt
        metod: "GET"
        endpoint: sellers/id
    Att hämta specifik produkt och visa som en JSON objekt
        metod: "GET"
        endpoint: products/id
    Att uppdatera specifik produkt med försäljnings datum
        metod: "PUT"
        endpoint: products/id
    Att skapa en produkt där skickar man ett JSON objekt
        metod: "POST"
        endpoint: products
    Att skapa en säljare där skickar man ett JSON objekt
        metod: "POST"
        endpoint: sellers
    
Databasen som APIet pratar med består av 4 tabeller
    categories
        id int AI
        name varchar(32)
        creating_date date
    products
        id int AI
        name varchar(32)
        size_id int
        category_id int
        price int
        seller_id int
        creating_date date
        selling_date date
    sellers
        id int AI
        first_name varchar(32)
        last_name varchar(32)
        epost varchar(32)
        mobile varchar(13)
        creating_date date
    sizes
        id int AI
        name varchar(3)
        description(varchar32)
        creating_date date

======INSTRUKTIONER======

Först klonar man projektet från github till rätt mapp. Tex i fall man använder XAMPP då klonar man projektet till mappen xamp på sin dator. 
Länk till projektet:  https://github.com/sergejsvoronins/php-secondhand-butik.git
Sedan kan man skapa en databas i tex phpMyAdmin med hjälp av db.sql filen som går att importera. 

För att testa alla endpoints användar man tex POSTMAN. Då urlen ska se ut:

http://localhost/project/[endpoint]