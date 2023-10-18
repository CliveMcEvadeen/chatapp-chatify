<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Chat App</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for message bubbles */
        body {
            background-color: #f4f4f4;
        }
        .chat-container {
            height: 400px;
            overflow-y: scroll;
        }
        .message-bubble {
            max-width: 70%;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
        }
        .user-message {
            background-color: #007bff;
            color: #fff;
            float: right;
        }
        .assistant-message {
            background-color: #f8f8f8;
            float: left;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Professional Chat with ChatGPT
                </div>
                <div class="card-body chat-container">
                    <!-- Chat messages will be displayed here -->
                    <div class="message-bubble user-message">
                        Hello, how can I assist you today?
                    </div>
                    <div class="message-bubble assistant-message">
                        Hi there! Feel free to ask me anything.
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" id="user-message" class="form-control" place holder="Type a message...">
                        <div class="input-group-append">
                            <button id="send-button" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>