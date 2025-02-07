 @extends('sidebar')

 @section('content')
     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Expense Report</title>

         <style>
             .content.shifted {
                 margin-left: 20px;
             }

             .content {
                 margin: 0px 0px 0px 30px;
             }

             .form-select {
                 height: 55%;
             }
         </style>
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     </head>

     <body>
         <div class="content" id="content">
             <div class="container">
                 <h2 class="mb text-center">Expense Report</h2>

                 <!-- Filter Section -->
                 <div class="content" id="content">
                     <div class="container">
                         <div class="card p-4 mb-4">
                             <h5 class="card-title">Filters</h5>
                             <form method="GET" action="">
                                 <div class="row g-3">

                                     <div class="col-md-4">
                                         <label for="date" class="form-label"> Date</label>
                                         <input type="date" id="date" name="date" class="form-control">
                                     </div>

                                     <!-- Category Filter -->
                                     <div class="col-md-4">
                                         <label for="category" class="form-label">Category</label>
                                         <select id="category" name="category" class="form-select">
                                             <option value="">All Categories</option>
                                             <option value="Food/Beverage">Food/Beverage</option>
                                             <option value="Travel/commute">Travel/commute</option>
                                             <option value="Shopping">Shopping</option>
                                             <option value="Utilities">Utilities</option>
                                         </select>
                                     </div>

                                     <div class="col-md-4">
                                         <label for="amount" class="form-label"> Amount</label>
                                         <input type="number" id="amount" name="amount" class="form-control"
                                             placeholder="Enter maximum amount">
                                     </div>

                                     <!-- Submit Button -->
                                     <div class="col-md-4 d-flex align-items-end">
                                         <button type="submit" class="btn btn-primary w-100"
                                             id="filter-btn">Filter</button>
                                     </div>
                                     <div class="col-md-4 d-flex align-items-end">
                                         <button id="clear-filter" class="btn btn-secondary mt-2">Clear Filters</button>
                                     </div>

                                     <div class="col-md-4 d-flex align-items-end">
                                         <a href="{{ route('export-expenses') }}" class="btn btn-success"> Export to Excel
                                         </a>
                                     </div>

                                 </div>
                             </form>
                         </div>

                         <!-- Expense Table Section -->
                         <table class="table table-hover table-bordered">
                             <thead class="table-dark">
                                 <tr>
                                     <th>Category</th>
                                     <th>Amount</th>
                                     <th>Description</th>
                                     <th>Date</th>
                                 </tr>
                             </thead>
                             <tbody id="expense-body">
                                 <!-- Example data for illustration -->
                                 @forelse ($expenses as $expense)
                                     <tr>
                                         <td>{{ $expense->category }}</td>
                                         <td>{{ $expense->amount }}</td>
                                         <td>{{ $expense->description }}</td>
                                         <td>{{ $expense->date->format('d M, Y') }}</td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="4" class="text-center">No expenses found for the selected criteria.
                                         </td>
                                     </tr>
                                 @endforelse

                                 {{-- {{ $expenses->links() }} --}}
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
         <script>
             $('#filter-btn').on('click', function(e) {
                 e.preventDefault();

                 var filterDate = $('#date').val();
                 var category = $('#category').val();
                 var amount = $('#amount').val();

                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     url: '{{ route('filter-expenses') }}',
                     type: 'GET',
                     data: {
                         date: filterDate,
                         category: category,
                         amount: amount
                     },
                     success: function(response) {
                         $('#expense-body').empty();

                         if (response.length === 0) {
                             $('#expense-body').append('<tr><td colspan="4">No expenses found</td></tr>');

                         } else {
                             response.forEach(function(expense) {
                                 let formattedDate = new Date(expense.date).toLocaleDateString(
                                     'en-US', {
                                         year: 'numeric',
                                         month: 'long',
                                         day: 'numeric'
                                     });


                                 $('#expense-body').append(`
                        <tr>
                            <td>${expense.category}</td>
                            <td>${expense.amount}</td>
                            <td>${expense.description}</td>
                            <td>${formattedDate}</td>
                        </tr>
                    `);
                             });
                         }
                     },
                     error: function() {
                         alert('Error fetching filtered expenses.');
                     }
                 });
             });

             $('#clear-filter').on('click', function() {
                 $('#date').val('');
                 $('#category').val('');
                 $('#amount').val('');
             });
         </script>


         {{-- <script>
            $('#export-expenses').on('click',function(){
                $.ajax({
                    url:'{{route ('export-expenses')}}',
                    type:'Get',
                    success: function (response) {
                    },
                    error: function () {
                        alert('Failed to export expenses.');

                            }
                        });
            });

        </script> --}}


     </body>

     </html>
 @endsection
