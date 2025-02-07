@extends('sidebar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expense Tracker UI</title>
    <link rel="stylesheet" href="{{ url('/css/add-expense.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

    </style>




</head>

<body>
    <div class="content" id="content">
        <div class="container">
            <div class="leftpanel">
                <h1>Hello, {{ Auth::user()->username }}</h1>
                <div class="total-card">
                    <span id="total-expense">Total:
                        ₹0.00</span>

                </div>
                <div class="breakdown">Breakdown</div>
                <div id="expenses-container">

                </div>

            </div>
            <div class="main">
                <form id="form">
                    @csrf
                    <div class="form-input">
                        <input type="number" id="amount" placeholder="Amount" />
                        <input type="text" id="description" placeholder="Description" />
                        <input type="date" id="date">
                    </div>
                    <div class="category">
                        <span id="category-label">
                            <input type="radio" name="category" id="food" value="food/beverage" />
                            <label for="food">Food/Beverage</label>
                        </span>
                        <span id="category-label">
                            <input type="radio" name="category" id="travel" value="travel/commute" />
                            <label for="travel">Travel/Commute</label>
                        </span>
                        <span id="category-label">
                            <input type="radio" name="category" id="shopping" value="shopping" />
                            <label for="shopping">Shopping</label>
                        </span>
                    </div>
                    <button type="submit">Add to Expense</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>



    <script>
        $(document).ready(function() {
            loadExpenses(); // Load expenses when the page is ready

            $('#form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting the traditional way

                var formdata = {
                    amount: $('#amount').val(),
                    description: $('#description').val(),
                    category: $('input[name="category"]:checked').val(),
                    date: $('#date').val(),

                };


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('add-expense') }}',
                    type: 'POST',
                    data: formdata,
                    success: function(response) {
                        const sanitizedCategory = response.expense.category.replace(
                            /[^a-zA-Z0-9]/g, '-');
                        const categoryId = `#category-${sanitizedCategory}`;
                        const formatedate = moment(response.expense.date).format(
                        'MMMM Do YYYY');

                        // Check if the category card already exists
                        if ($(categoryId).length > 0) {
                            // Append the expense to the existing category list
                            $(`${categoryId} ul`).append(`
                                <li class="list-group-item">
                                    Amount: ${response.expense.amount},
                                    Description: ${response.expense.description},
                                    Date: ${formatedate}
                                </li>
                            `);
                        } else {
                            // Create a new category card if it doesn't exist
                            $('#expenses-container').append(createCategoryCard(response.expense
                                .category, [response.expense]));
                        }

                        // Update total expense
                        $('#total-expense').text('Total: ' + response.totalExpense);

                        // Clear form inputs
                        $('#form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('There was an error saving the expense.');
                    }
                });
            });
        

            function loadExpenses() {
                $.ajax({
                    url: '{{ route('view-expense') }}',
                    method: 'get',
                    success: function(response) {
                        $('#expenses-container').empty(); // Clear current content
                        const groupedExpenses = groupBy(response.expenses, 'category');

                        for (const category in groupedExpenses) {
                            const expenses = groupedExpenses[category];
                            $('#expenses-container').append(createCategoryCard(category, expenses));
                        }

                        $('#total-expense').text('Total: ' + response.totalExpense);
                    },
                    error: function(xhr) {
                        alert('There was an error fetching the expenses.');
                    }
                });
            }

            function groupBy(array, key) {
                return array.reduce((result, currentValue) => {
                    (result[currentValue[key]] = result[currentValue[key]] || []).push(currentValue);
                    return result;
                }, {});
            }

            function createCategoryCard(category, expenses) {
                const sanitizedCategory = category.replace(/[^a-zA-Z0-9]/g, '-');
                const formatedate = moment(expenses.date).format('MMMM Do YYYY');
                let expenseList = '';
                expenses.forEach(expense => {
                    expenseList += `
                    <li class="list-group-item">
                        Amount:<span class="amount">${expense.amount}</span>,
                          Description:<span class="description">${expense.description} </span>,
                         Date:<span class="date">${formatedate}</span>
                    </li>
                `;
                });

                return `
                <div class="card mb-3">
                    <div class="card-header">
                        <button class="btn btn-link" id="btn" data-bs-toggle="collapse" data-bs-target="#category-${sanitizedCategory}">
                            ${category}
                        </button>
                    </div>
                    <div id="category-${sanitizedCategory}" class="collapse">
                        <ul class="list-group list-group-flush">
                            ${expenseList}
                        </ul>
                    </div>
                </div>
            `;
            }



        });
    </script>
</body>

</html>
