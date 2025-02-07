<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">  
</head>
<body>
{{-- <h1>This is my project of expenses tracker</h1> --}}

<div>
    <a href="{{ route('login') }}"> <button type="button" class="btn btn-primary btn-lg login-btn"
            id="myBtn">Login</button></a>
</div>

<div class="container" id="content">
    <div class="container-fluid">

        <h1>About us</h1>
        <header class="about-header">
            <h1>Welcome to SmartSpend Tracker</h1>
            <p>Your trusted partner for smarter financial decisions!</p>
        </header>

        <!-- About Us Content -->
        <div class="container my-5">
            <!-- Our Mission -->
            <section class="mb-5">
                <h2 class="section-title">Our Mission</h2>
                <p class="text-center">
                    At <span class="fw-bold text-primary">SmartSpend Tracker</span>, our mission is to make personal
                    finance simple, accessible, and impactful for everyone.
                    We’re here to help you manage your expenses effortlessly and achieve your financial goals with
                    ease.
                </p>
            </section>

            <!-- Why Choose Us -->
            <section class="mb-5">
                <h2 class="section-title">Why Choose Us?</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <div class="icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h5>Easy to Use</h5>
                        <p>A user-friendly interface designed for everyone.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="icon-box">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <h5>Powerful Insights</h5>
                        <p>Visualize your spending with detailed reports.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="icon-box">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h5>Secure & Private</h5>
                        <p>Your financial data is encrypted and safe with us.</p>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section class="mb-5">
                <h2 class="section-title">Features We Offer</h2>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">✔ Add and categorize expenses effortlessly.</li>
                            <li class="list-group-item">✔ Set and manage monthly budgets with alerts.</li>
                            <li class="list-group-item">✔ View detailed monthly and yearly expense reports.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">✔ Export data to Excel or CSV for analysis.</li>
                            <li class="list-group-item">✔ Access your tracker anywhere, anytime.</li>
                            <li class="list-group-item">✔ Completely secure and user-friendly.</li>
                        </ul>
                    </div>
                </div>
            </section>


        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 SmartSpend Tracker. All rights reserved.</p>
        </footer>


    </div>
</div>

</body>
</html>
