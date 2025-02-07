@extends('sidebar')

@section('content')
    <link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">

    {{-- the users who are are logged in will be able to see the dashboard  --}}
    @auth()
        <div>
            <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger btn-lg logout-btn "
                    id="logoutBtn">Logout</button></a>
        </div>

        <div class="content" id="content">
            <div class="container-fluid">
                @if (session('loginsuccess'))
                    <div class="alert alert-success " role="alert">
                        {{ session('loginsuccess') }}
                    </div>
                @endif
                <!-- Dashboard Content -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3"
                            style="background: linear-gradient(to right, #4c5659, #a37f9dcf);border-radius:10px;">
                            <div class="card-body">
                                <h5 class="card-title">Total Expenses</h5>
                                <h2>{{ $amount }}</h2>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Remaining Budget</h5>
                                <h2>$800</h2>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-4 ">
                        <div class="card text-white bg- mb-3 "
                            style="background: linear-gradient(to top, #5d3396, #621eaa) ;border-radius:10px;">
                            <div class="card-body">
                                <h5 class="card-title">Top Category</h5>
                                <h2>
                                    @if (Str::length($maxamount) > 0)
                                        {{ $maxamount->category . ' - ' . $maxamount->total_amount }}
                                    @else
                                        0
                                </h2>
                                @endif

                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Alerts</h5>
                                <p>Overspending in Transport</p>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <!-- Graphs -->
                <div class="row">
                    <div class="col-md-6">
                        <h4>Expense By Category </h4>
                        <canvas id="monthlyChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        {{-- <h4>Yearly Expenses</h4> --}}
                        <canvas id="yearlyChart"></canvas>
                    </div>
                </div>

                <!-- Recent Expenses -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Recent Expenses</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($recentExpenses->isEmpty())
                                <td  colspan="4" class="text-center">No expenses found for this user.</td>
                                @else
                                    @foreach ($recentExpenses as $recentExpense)
                                        <tr>
                                            <td>{{ $recentExpense->date->format('d M, Y') }}</td>
                                            <td>{{ $recentExpense->category }}</td>
                                            <td>{{ $recentExpense->amount }}</td>
                                            <td>{{ $recentExpense->description }}</td>
                                    @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endauth






    {{-- the user who are not logged in will be able to see the about us page --}}
    @guest

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
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        const categories = @json($categories);
        const amounts = @json($amounts);
        // Example Chart Data
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');

        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Expenses by Category',
                    data: amounts,
                    backgroundColor: [
                        'rgba(107, 90, 250, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',

                    ],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 0
                }]
            }
        });

        // new Chart(yearlyCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        //         datasets: [{
        //             label: 'Yearly Expenses',
        //             data: [1000, 800, 1200, 900, 1100],
        //             borderColor: '#007bff',
        //             fill: false
        //         }]
        //     }
        // });
    </script>



@endsection
