@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Search</h1>
        <p>Please tap your card to the reader to search for user information.</p>
        <input type="text" id="cardInput" class="form-control" placeholder="Tap card here" autofocus>

        <!-- Display area for user information -->
        <div id="userInfo" class="mt-4"></div>
    </div>

    <script>
        document.getElementById('cardInput').addEventListener('input', function(e) {
            var inputLength = 10; // Adjust according to the expected length of card data
            if (e.target.value.length === inputLength) {
                fetchUserInformation(e.target.value);
                e.target.value = ''; // Clear the input field after the data is captured
            }
        });

        function fetchUserInformation(cardInfo) {
            fetch(`/fetch-user/${cardInfo}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        document.getElementById('userInfo').innerHTML = `<p class="text-danger">${data.error}</p>`;
                    } else {
                        document.getElementById('userInfo').innerHTML = displayUserInfo(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('userInfo').innerHTML =
                        `<p class="text-danger">Error retrieving user information.</p>`;
                });
        }

        function displayUserInfo(user) {
            return `<div>
                <h4>User Information:</h4>
                <p>Name: ${user.name}</p>
                <p>Email: ${user.email}</p>
                <p>Photo: <img src="${user.photo}" alt="User Photo" style="height: 100px;"></p>
                <!-- Add more user details as needed -->
            </div>`;
        }
    </script>
@endsection
