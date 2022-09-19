<?php
    function Welcome($ausername){
        $body = '<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Message two</title>
        <style>
            .message{
                width: 35rem;
                max-width: 90%;
                padding: 20px;
                margin: auto;
                font-size: 16px;
                box-shadow: 0 0 5px .4px #747272;
            }
            .message .welcomeText{
                text-align: center;
                font-family: Tahoma;
                margin: 0;
                padding: 0;
            }
            .message .mainText{
                font-family: tahoma;
                margin: 0;
                padding: 0;
            }
    
            @media screen and (max-width: 480px) {
                .message {
                    font-size: 14px;
                }
            }
        </style>
    </head>
    <body>
        <div class="message">
            <h2 class="welcomeText">
                Welcome To Hazlo Todo <hr>
            </h2>
            <p class="mainText">
                Hi There ' . $ausername . '!! <br><br>
                We\'re Happy To Have You In Our Community! <br>
                Hazlo Todo is here to help you manage your activities/schedules effectively. 
                With Hazlo Todo, you\'d get updates on when your schedules/activities are due <br>You can create
                new schedules and equally update existing schedules <br><br>
            </p>
            <h3 class="mainText">Is An Activity Taking Up Space?</h3>
            <p class="mainText">
                Use the delete button! It\'s that easy!!  <br>
                Add schedules to your archives to help arrange your dashboard even more! <br><br>
                We hope to see you around quite often!✅✨
            </p><br>
            <h3 class="mainText">Any Issues?</h3>
            <p class="mainText">
                Feel free to contact use via: <br>
                Email - hazlotodoapp@gmail.com <br>
                WhatsApp - https://wa.me/2347061763713
            </p>
            <p class="footer" style="text-align: center;">Copyright &copy; 2022 Hazlo Todo</p>
        </div>
    </body>';

    return $body;
    }
?>