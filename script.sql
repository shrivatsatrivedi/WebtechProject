CREATE TABLE Product (
    ProductID INT PRIMARY KEY,
    Name VARCHAR(255),
    Category VARCHAR(255),
    Price DECIMAL(10, 2),
    Quantity INT
);

CREATE TABLE Supplier (
    SupplierID INT PRIMARY KEY,
    Name VARCHAR(255),
    Contact VARCHAR(255),
    ProductID INT,
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    ProductID INT,
    Quantity INT,
    Date DATE,
    Status VARCHAR(50),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    Name VARCHAR(255),
    Contact VARCHAR(255)
);

CREATE TABLE Transaction (
    TransactionID INT PRIMARY KEY,
    ProductID INT,
    Quantity INT,
    Date DATE,
    Type VARCHAR(50),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Location (
    LocationID INT PRIMARY KEY,
    Name VARCHAR(255),
    Address VARCHAR(255)
);

CREATE TABLE SupplierContact (
    SupplierContactID INT PRIMARY KEY,
    SupplierID INT,
    ContactPerson VARCHAR(255),
    Email VARCHAR(255),
    Phone VARCHAR(20),
    FOREIGN KEY (SupplierID) REFERENCES Supplier(SupplierID)
);

CREATE TABLE Employee (
    EmployeeID INT PRIMARY KEY,
    Name VARCHAR(255),
    Position VARCHAR(255),
    Contact VARCHAR(255)
);

CREATE TABLE Warehouse (
    WarehouseID INT PRIMARY KEY,
    LocationID INT,
    Capacity INT,
    FOREIGN KEY (LocationID) REFERENCES Location(LocationID)
);

CREATE TABLE CustomerOrder (
    OrderID INT PRIMARY KEY,
    CustomerID INT,
    ProductID INT,
    Quantity INT,
    Date DATE,
    Status VARCHAR(50),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Shipment (
    ShipmentID INT PRIMARY KEY,
    OrderID INT,
    ShipmentDate DATE,
    Carrier VARCHAR(255),
    TrackingNumber VARCHAR(50),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

-- Insert data into Product table
INSERT INTO Product (ProductID, Name, Category, Price, Quantity)
VALUES (1, 'Laptop', 'Electronics', 999.99, 10),
       (2, 'Printer', 'Electronics', 199.99, 5),
       (3, 'Chair', 'Furniture', 49.99, 20);

-- Insert data into Supplier table
INSERT INTO Supplier (SupplierID, Name, Contact, ProductID)
VALUES (1, 'ABC Electronics', '123-456-7890', 1),
       (2, 'XYZ Furniture', '987-654-3210', 3);

-- Insert data into Orders table
INSERT INTO Orders (OrderID, ProductID, Quantity, Date, Status)
VALUES (1, 1, 5, '2024-04-05', 'Pending'),
       (2, 3, 10, '2024-04-06', 'Shipped');

-- Insert data into Customer table
INSERT INTO Customer (CustomerID, Name, Contact)
VALUES (1, 'John Doe', '111-222-3333'),
       (2, 'Jane Smith', '444-555-6666');

-- Insert data into Transaction table
INSERT INTO Transaction (TransactionID, ProductID, Quantity, Date, Type)
VALUES (1, 1, 1, '2024-04-07', 'Sale'),
       (2, 3, 2, '2024-04-08', 'Purchase');

-- Insert data into Location table
INSERT INTO Location (LocationID, Name, Address)
VALUES (1, 'Main Store', '123 Main St'),
       (2, 'Warehouse 1', '456 Warehouse Ave');

-- Insert data into SupplierContact table
INSERT INTO SupplierContact (SupplierContactID, SupplierID, ContactPerson, Email, Phone)
VALUES (1, 1, 'John Smith', 'john@abc.com', '111-222-3333'),
       (2, 2, 'Jane Doe', 'jane@xyz.com', '444-555-6666');

-- Insert data into Employee table
INSERT INTO Employee (EmployeeID, Name, Position, Contact)
VALUES (1, 'Mike Johnson', 'Manager', '999-888-7777'),
       (2, 'Emily Brown', 'Sales Associate', '666-777-8888');

-- Insert data into Warehouse table
INSERT INTO Warehouse (WarehouseID, LocationID, Capacity)
VALUES (1, 2, 100),
       (2, 1, 200);

-- Insert data into CustomerOrder table
INSERT INTO CustomerOrder (OrderID, CustomerID, ProductID, Quantity, Date, Status)
VALUES (1, 1, 1, 2, '2024-04-09', 'Pending'),
       (2, 2, 3, 1, '2024-04-10', 'Shipped');

-- Insert data into Shipment table
INSERT INTO Shipment (ShipmentID, OrderID, ShipmentDate, Carrier, TrackingNumber)
VALUES (1, 1, '2024-04-11', 'UPS', '1234567890'),
       (2, 2, '2024-04-12', 'FedEx', '0987654321');

-- Insert data into Product table
INSERT INTO Product (ProductID, Name, Category, Price, Quantity)
VALUES (4, 'Tablet', 'Electronics', 299.99, 8),
       (5, 'Desk Lamp', 'Home & Garden', 39.99, 15),
       (6, 'Office Chair', 'Furniture', 89.99, 10);

-- Insert data into Supplier table
INSERT INTO Supplier (SupplierID, Name, Contact, ProductID)
SELECT 
    3, 
    'Gadget World', 
    '555-555-5555', 
    ProductID
FROM 
    Product
WHERE 
    Category = 'Electronics'
LIMIT 1;

-- Insert data into Orders table
INSERT INTO Orders (ProductID, Quantity, Date, Status)
SELECT 
    ProductID, 
    3, 
    '2024-04-13', 
    'Pending'
FROM 
    Product
WHERE 
    Category = 'Furniture';

-- Insert data into Customer table
INSERT INTO Customer (CustomerID, Name, Contact)
VALUES 
    (3, 'Alice Johnson', '555-555-5555'),
    (4, 'Bob Smith', '666-666-6666');

-- Insert data into Transaction table
INSERT INTO Transaction (TransactionID, ProductID, Quantity, Date, Type)
SELECT 
    3, 
    ProductID, 
    2, 
    '2024-04-15', 
    'Purchase'
FROM 
    Product
WHERE 
    Category = 'Furniture';
