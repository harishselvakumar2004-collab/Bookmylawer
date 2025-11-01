<?php 
include 'con.php';  

function display_delete_account_form() {     
    echo '<!DOCTYPE html>     
    <html lang="en">     
    <head>         
        <meta charset="UTF-8">         
        <meta name="viewport" content="width=device-width, initial-scale=1.0">         
        <title>Delete Account - BookMyLawyer</title>         
        <style>             
            body {                 
                font-family: Arial, sans-serif;                 
                line-height: 1.6;                 
                margin: 0;                 
                padding: 0;                 
                background-color: #f4f4f4;             
            }             
            .container {                 
                max-width: 800px;                 
                margin: 50px auto;                 
                padding: 20px;                 
                background: #fff;                 
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);                 
                text-align: center;             
            }             
            h1, h2 {                 
                color: #333;             
            }             
            p {                 
                color: #555;             
            }             
            form {                 
                margin-top: 20px;             
            }             
            label {                 
                display: block;                 
                margin-bottom: 10px;                 
                font-weight: bold;                 
                text-align: left;             
            }             
            input[type="text"], input[type="email"], input[type="password"] {                 
                width: 100%;                 
                padding: 10px;                 
                margin-bottom: 20px;                 
                border: 1px solid #ccc;                 
                border-radius: 4px;             
            }             
            input[type="submit"] {                 
                padding: 12px 25px;                 
                background-color: #d9534f;                 
                border: none;                 
                color: white;                 
                font-size: 16px;                 
                border-radius: 4px;                 
                cursor: pointer;                 
                transition: background 0.3s;             
            }             
            input[type="submit"]:hover {                 
                background-color: #c9302c;             
            }         
        </style>         
        <script>             
            function confirmDeletion(event) {                 
                event.preventDefault();                  
                if (confirm("Your BookMyLawyer account will be permanently deleted in 24 hours. Do you wish to proceed?")) {                     
                    document.getElementById("deleteForm").submit();                 
                }             
            }         
        </script>     
    </head>     
    <body>         
        <div class="container">             
            <h1>Delete Your BookMyLawyer Account</h1>             
            <p>If you wish to delete your account, please provide the required details below. This action is irreversible. <br> 
            For any queries, contact us at <strong>252434018.sclas@saveetha.com</strong>.</p>             

            <form id="deleteForm" action="delete_account.php" method="post" onsubmit="confirmDeletion(event)">                 
                <label for="username">Username:</label>                 
                <input type="text" id="username" name="username" required>                                  

                <label for="email">Email:</label>                 
                <input type="email" id="email" name="email" placeholder="252434018.sclas@saveetha.com" required>                                  

                <label for="password">Password:</label>                 
                <input type="password" id="password" name="password" required>                                  

                <input type="submit" value="Delete Account">             
            </form>         
        </div>     
    </body>     
    </html>'; 
}  

display_delete_account_form(); 
?>
