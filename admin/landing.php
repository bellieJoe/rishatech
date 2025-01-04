<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RISHATECH ADMIN</title>
    <link rel="stylesheet" href="./css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8rsqVujOnsKL8vU9s2ryJC2EPnm7EY2pb3hlh+Z5Q5i6fM41QI94ukzU+Ue++tCSDzhxu0DWFL4xVZLQw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }
        .hero {
            /* background-image: url("https://source.unsplash.com/1600x900/?nature,landscape"); */
            background-image: url("./img/bg.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            color: #fff;
            background-color: rgba(0,0,0,0.5);
        }
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
            line-height: 1.5;
        }
        .hero button {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            margin-top: 25px;
        }
        .hero button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <div style="text-align: left;">
                <h1 class="display-1" style="color: #333;">RishaTech Admin</h1>
                <p class="lead" style="color: #333;">
                    Manage Sales and Credit easily. Keep track of all transactions in one place.
                   
                </p>
                <div >
                    <a href="?route=home" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

