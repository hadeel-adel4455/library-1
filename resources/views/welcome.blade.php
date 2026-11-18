
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background-color: #243447;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background-color: #3c526b;
        }

        .main {
            margin-left: 230px;
        }

        header {
            background-color: white;
            color: #243447;
            text-align: center;
            padding: 25px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 40px 20px;
        }

        .card {
            background-color: white;
            width: 200px;
            padding: 25px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 3px 10px #ddd;
        }

        .card h2 {
            color: #243447;
        }

        .card p {
            color: #666;
        }

        .card a {
            display: inline-block;
            background-color: #243447;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .card a:hover {
            background-color: #3c526b;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>Library System</h2>

        <a href="/">Home</a>
        <a href="/staff">Staff</a>
        <a href="/books">Books</a>
        <a href="/clients">Clients</a>
        <a href="/computers">Computers</a>
    </aside>

    <div class="main">

        <header>
            <h1>Library Management System</h1>
            <p>Welcome to Our Library</p>
        </header>

        <div class="container">

            <div class="card">
                <h2>Staff</h2>
                <p>Manage library staff.</p>
                <a href="/staff">Open</a>
            </div>

            <div class="card">
                <h2>Books</h2>
                <p>Manage library books.</p>
                <a href="/books">Open</a>
            </div>

            <div class="card">
                <h2>Clients</h2>
                <p>Manage library clients.</p>
                <a href="/clients">Open</a>
            </div>

            <div class="card">
                <h2>Computers</h2>
                <p>Manage library computers.</p>
                <a href="/computers">Open</a>
            </div>

        </div>

    </div>

</body>
</html>
