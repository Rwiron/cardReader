@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Search</h1>
        <p id="tapMessage">Please tap your card to the reader to search for user information.</p>
        <input type="text" id="cardInput" class="form-control" style="position: absolute; left: -9999px;" autofocus>

        <!-- Display area for user information -->
        <div id="userInfo" class="mt-4"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const cardInput = document.getElementById('cardInput');

            // Ensure the input field is always focused
            cardInput.focus();
            cardInput.addEventListener('focusout', () => cardInput.focus());

            // Allow input from card reader
            cardInput.addEventListener('input', function(e) {
                var inputLength = 10; // Adjust according to the expected length of card data
                if (e.target.value.length === inputLength) {
                    fetchUserInformation(e.target.value);
                    e.target.value = ''; // Clear the input field after the data is captured
                }
            });
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
                <p>Photo: <img src="${user.photo}" alt="User Photo" style="height: 100px;"></p>
                <p>Name: ${user.name}</p>
                <p>Email: ${user.email}</p>
                <!-- Add more user details as needed -->
            </div>`;
        }
    </script>
@endsection
