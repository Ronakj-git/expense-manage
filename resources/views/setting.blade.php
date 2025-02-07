@extends('sidebar');


<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            /* color: grey */
        }

        .sidebar.collapsed {
            background-color: rgb(237, 237, 249);
        }

        #content {
            background-color: rgb(237, 237, 249);
            width: 100%;
            height: 100%
        }


        .setting {
            background-color: white;
            border-radius: 10px;
            width: 100%;
            height: 80%;
            margin: 0;
            padding: 12px 0px 0px 15px;
            color: #000000;
        }

        .profile {
            border-radius: 10px;
            background-color: rgb(237, 237, 249);
            padding: 10px 10px 20px 20px;
            width: 1200px;
        }

        .heading {
            /* text-xl font-semibold mb-4; */
            margin-bottom: 20px
        }

        .apperance-setting {
            margin: 30px 0px 0px 0px;
            border-radius: 10px;
            background-color: rgb(237, 237, 249);
            width: 1200px;
            padding: 8px 0px 20px 20px;
        }

        .dark-btn {
            /* px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 */
            background-color: black;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            border: 0px;
        }

        .light-btn {
            margin: 0px 5px;
            /* px-4 py-2 bg-white text-gray-800 border rounded-md hover:bg-gray-100' */
            padding: 5px 10px;
            background-color: white;
            border: 0px;
            border-radius: 5px;
        }

        .privacy-terms {
            /* p-6 bg-gray-50 border rounded-xl */
            padding: 6px 6px 6px 10px;
            background-color: rgb(237, 237, 249);
            border-radius: 10px;
            margin: 30px 10px 20px 0px;
            width: 1200px;
        }

        .edit {
            display: flex;
            justify-content: flex-end;
            padding-right: 5px;
        }

        .content.shifted {
            margin-left: 60px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>
    <div id="content">
        <div class="content">
            <div class="setting">
                <h1>Settings</h1>

                <div class="profile">

                    <i type="button" data-toggle="modal" data-target="#myModal"
                        class="bi bi-pencil-square edit fs-2"></i>
                    <h2 class="heading">User Profile Settings</h2>


                    <form class="space-y-4">
                        <div>
                            <label>Name:</label>
                            @foreach ($users as $user)
                                <span id="displayedUsername">
                                    {{ $user->username }}
                                </span>
                            @endforeach
                        </div>
                        <div>
                            <label>Email:</label>
                            @foreach ($users as $user)
                                {{ $user->email }}
                            @endforeach
                        </div>
                        <div>
                            <label>Password:</label>
                            {{ str_repeat('*', 8) }}
                        </div>
                    </form>
                </div>

                {{-- <div class="apperance-setting">
                    <h2 >Appearance Settings</h2>
                    <div >
                      <button class="dark-btn">Dark Mode</button>
                      <button class="light-btn">Light Mode</button>
                    </div>
                </div> --}}

                <div class="privacy-terms">
                    <h2>Privacy & Terms</h2>
                    <p>Read our <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> to
                        understand how we handle your data.</p>
                </div>

            </div>

        </div>
    </div>




    <!-- Trigger the modal with a button -->


    <!-- Modal -->

    <div class="modal fade" id="myModal"  role="dialog" >
        <div class="modal-dialog" role="document">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit profile</h4>
                </div>
                <div class="modal-body">
                    <form id="form">
                        @csrf
                        <div class="form-group">
                            <label for="username"> Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter name" value="{{ $user->username }}">
                        </div>

                        <div class="form-group">
                            <label for="Email"> Email</label>
                            <input type="text" class="form-control" id="Email" name="email"
                                placeholder="Enter email" value={{ $user->email }} @disabled(true)>
                        </div>

                        {{-- <div class="form-group">
                    <label for="password"> password</label>
                    <input type="text" class="form-control" id="password" name="password"
                       placeholder="Enter password">
                </div> --}}



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updateUsernameBtn" class="btn btn-primary">submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateUsernameBtn').on('click', function() {

            var username = $('#username').val();

            $.ajax({
                url: "{{ route('edit-profile') }}",
                type: "POST",
                data: {

                    username: username
                },
                success: function(response) {
                    if (response.success) {
                        $('#successMessage').text(response.message).fadeIn().delay(3000).fadeOut();
                        $('#myModal').modal('hide');
                        $('#displayedUsername').text(username);

                    }
                    setTimeout(function() {
                        // Refresh page content, no need for a full reload
                        location
                    .reload(); // Or use $('#editUsernameModal').modal('dispose') to reset modal
                    }, 50); // Delay in milliseconds
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.message);
                }
            });
        });
        $('#editUsernameModal').on('hidden.bs.modal', function() {
            $(this).find('input').val(''); // Clear input fields
            $('#successMessage').hide(); // Clear success message if visible
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
