<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management Dashboard</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
        <h1>Inventory Management Dashboard</h1>
        <div class="dashboard">
            <div class="card">
                <h2>Number of Items</h2>
                <p>
                <?php
                    include('db.php');

                    $totalItemCount = 0;
                    $totalCount = 0;

                    $tables = array("Product", "Supplier", "Orders", "Customer", "Transaction", "Location", "SupplierContact", "Employee", "Warehouse", "CustomerOrder", "Shipment");

                    foreach ($tables as $table) {
                        $query = "SELECT COUNT(*) as count FROM $table";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        $totalCount += $row['count'];
                    }

                    echo $totalCount;
                ?>
                </p>
            </div>


            <div class="card">
                <h2>Add Item to Inventory</h2>
                <form action="add_item.php" method="POST" id="addItemForm">
                    <select name="table" id="tableSelect" onchange="handleTableChange()" required>
                        <option value="Product">Product</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Orders">Orders</option>
                        <option value="Customer">Customer</option>
                        <option value="Transaction">Transaction</option>
                        <option value="Location">Location</option>
                        <option value="SupplierContact">Supplier Contact</option>
                        <option value="Employee">Employee</option>
                        <option value="Warehouse">Warehouse</option>
                        <option value="CustomerOrder">Customer Order</option>
                        <option value="Shipment">Shipment</option>
                    </select>
                    <div id="additionalFields">
                        <!-- Additional input fields will be dynamically added here -->
                    </div>
                    <button type="submit" onclick="addItem()">Add Item</button>
                </form>
            </div>

            <script>
                function handleTableChange() {
                    var tableSelect = document.getElementById("tableSelect");
                    var selectedTable = tableSelect.value;
                    var additionalFieldsDiv = document.getElementById("additionalFields");
                    additionalFieldsDiv.innerHTML = ""; // Clear previous additional fields

                    switch (selectedTable) {
                        case 'Product':
                            additionalFieldsDiv.innerHTML += '<input type="text" name="name" placeholder="Name" required>';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="category" placeholder="Category" required>';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="price" placeholder="Price" step="0.01" required>';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="quantity" placeholder="Quantity" required>';
                            break;
                        case 'Supplier':
                            additionalFieldsDiv.innerHTML += '<input type="text" name="name" placeholder="Name" required>';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="contact" placeholder="Contact">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="productID" placeholder="Product ID">';
                            break;
                        case 'Orders':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="productID" placeholder="Product ID">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="quantity" placeholder="Quantity">';
                            additionalFieldsDiv.innerHTML += '<input type="date" name="date" placeholder="Date">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="status" placeholder="Status">';
                            break;
                        case 'Customer':
                            additionalFieldsDiv.innerHTML += '<input type="text" name="name" placeholder="Name" required>';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="contact" placeholder="Contact">';
                            break;
                        case 'Transaction':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="productID" placeholder="Product ID">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="quantity" placeholder="Quantity">';
                            additionalFieldsDiv.innerHTML += '<input type="date" name="date" placeholder="Date">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="type" placeholder="Type">';
                            break;
                        case 'Location':
                            additionalFieldsDiv.innerHTML += '<input type="text" name="name" placeholder="Name">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="address" placeholder="Address">';
                            break;
                        case 'SupplierContact':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="supplierID" placeholder="Supplier ID">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="contactPerson" placeholder="Contact Person">';
                            additionalFieldsDiv.innerHTML += '<input type="email" name="email" placeholder="Email">';
                            additionalFieldsDiv.innerHTML += '<input type="tel" name="phone" placeholder="Phone">';
                            break;
                        case 'Employee':
                            additionalFieldsDiv.innerHTML += '<input type="text" name="name" placeholder="Name" required>';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="position" placeholder="Position">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="contact" placeholder="Contact">';
                            break;
                        case 'Warehouse':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="locationID" placeholder="Location ID">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="capacity" placeholder="Capacity">';
                            break;
                        case 'CustomerOrder':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="customerID" placeholder="Customer ID">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="productID" placeholder="Product ID">';
                            additionalFieldsDiv.innerHTML += '<input type="number" name="quantity" placeholder="Quantity">';
                            additionalFieldsDiv.innerHTML += '<input type="date" name="date" placeholder="Date">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="status" placeholder="Status">';
                            break;
                        case 'Shipment':
                            additionalFieldsDiv.innerHTML += '<input type="number" name="orderID" placeholder="Order ID">';
                            additionalFieldsDiv.innerHTML += '<input type="date" name="shipmentDate" placeholder="Shipment Date">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="carrier" placeholder="Carrier">';
                            additionalFieldsDiv.innerHTML += '<input type="text" name="trackingNumber" placeholder="Tracking Number">';
                            break;
                        default:
                            break;
                    }
                }

                function addItem(selectedTable) {
                    var filterValue = document.getElementById("filter").value;
                    window.location.href = "main.php?add_item=" + filterValue;
                }
            </script>

            <div class="card">
                <h2>Inventory</h2>
                <div class="filter-section">
                    <label for="filter">Filter:</label>
                    <select name="filter" id="filter">
                        <option value="Product">Product</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Orders">Orders</option>
                        <option value="Customer">Customer</option>
                        <option value="Transaction">Transaction</option>
                        <option value="Location">Location</option>
                        <option value="SupplierContact">Supplier Contact</option>
                        <option value="Employee">Employee</option>
                        <option value="Warehouse">Warehouse</option>
                        <option value="CustomerOrder">Customer Order</option>
                        <option value="Shipment">Shipment</option>
                    </select>
                    <button onclick="filterTable()">Filter</button>
                </div>
                <table id="inventory-table">

                    <?php
                        include('db.php');

                        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'Product';

                        switch ($filter) {
                            case 'Product':
                                $columns = array('ProductID', 'Name', 'Category', 'Price', 'Quantity');
                                $table = 'Product';
                                break;
                            case 'Supplier':
                                $columns = array('SupplierID', 'Name', 'Contact', 'ProductID');
                                $table = 'Supplier';
                                break;
                            case 'Orders':
                                $columns = array('OrderID', 'ProductID', 'Quantity', 'Date', 'Status');
                                $table = 'Orders';
                                break;
                            case 'Customer':
                                $columns = array('CustomerID', 'Name', 'Contact');
                                $table = 'Customer';
                                break;
                            case 'Transaction':
                                $columns = array('TransactionID', 'ProductID', 'Quantity', 'Date', 'Type');
                                $table = 'Transaction';
                                break;
                            case 'Location':
                                $columns = array('LocationID', 'Name', 'Address');
                                $table = 'Location';
                                break;
                            case 'SupplierContact':
                                $columns = array('SupplierContactID', 'SupplierID', 'ContactPerson', 'Email', 'Phone');
                                $table = 'SupplierContact';
                                break;
                            case 'Employee':
                                $columns = array('EmployeeID', 'Name', 'Position', 'Contact');
                                $table = 'Employee';
                                break;
                            case 'Warehouse':
                                $columns = array('WarehouseID', 'LocationID', 'Capacity');
                                $table = 'Warehouse';
                                break;
                            case 'CustomerOrder':
                                $columns = array('OrderID', 'CustomerID', 'ProductID', 'Quantity', 'Date', 'Status');
                                $table = 'CustomerOrder';
                                break;
                            case 'Shipment':
                                $columns = array('ShipmentID', 'OrderID', 'ShipmentDate', 'Carrier', 'TrackingNumber');
                                $table = 'Shipment';
                                break;
                            default:
                                $columns = array('ProductID', 'Name', 'Category', 'Price', 'Quantity');
                                $table = 'Product';
                        }

                        $query = "SELECT " . implode(", ", $columns) . " FROM " . $table;
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Error fetching data: " . mysqli_error($connection));
                        }

                        echo "<table>";
                        echo "<tr>";
                        foreach ($columns as $column) {
                            echo "<th>$column</th>";
                        }
                        echo "</tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            foreach ($columns as $column) {
                                echo "<td>".$row[$column]."</td>";
                            }
                            echo "</tr>";
                        }

                        echo "</table>";

                        mysqli_close($connection);
                        ?>

                </table>
            </div>
        </div>
    </div>

    <script>
        function filterTable() {
            var filterValue = document.getElementById("filter").value;
            // Redirect to the same page with the filter as URL parameter
            window.location.href = "main.php?filter=" + filterValue;
        }
    </script>
</body>
</html>
