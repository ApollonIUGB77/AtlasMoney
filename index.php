<DOCTYPE html>
    <html>
        <head>
            <title> LOGIN </title>
            <link rel="stylesheet" type="text/css" href="">
        </head>
        <body>
        <div class="loginbox">
            <img src="ATLAS MONEY(1).png" class="avatar" alt="AVATAR skull">
            <h1>LOGIN</h1>
            <form action="login.php" method="POST">
                <?php if (isset($_GET['error'])) 
                {
                ?>
                    <p class="error"> <?php echo $_GET['error']; ?></p>
                <?php 
                } ?>
                <form>
                    <P>Phone Number</P>
                    <input type="text" name="phone" placeholder="Please enter your phone number" maxlength="10">
                    <P>Password </P>
                    <input type="password" name="password" maxlength="4" placeholder="Enter your ( 4 ) digit password"> <br>
                    <p> <a href="register.php"> Create a new account ? </a> </p> <br>
                    <p> <a href="forgetPassword.php"> Forget password ? </a> </p> <br>
                    <div class="flex-parent jc-center">
                    <button type="submit" class="button button1"> CONNECT </button>
                    </div>
                    <style>
                        .button 
                        {
                            display: block;
                            width: 100%;
                            border: none;
                            background-color: #04AA6D;
                            padding: 14px 28px;
                            font-size: 16px;
                            cursor: pointer;
                            text-align: center;
                            border-radius: 20%;
                        }
                        .button1 
                        {
                            background-color: black;
                            color: white;
                            border: 5px solid black;
                        }
                        .button1:hover 
                        {
                            cursor: pointer;
                            background: white;
                            color: #000;
                        }
                        .flex-parent 
                        {
                            display: flex;
                        }
                        .jc-center 
                        {
                            justify-content: center;
                        }
                        body 
                            {
                                margin: 0;
                                padding: 0;
                                background-image:  url("atlas.gif") ;
                                background-size: auto;
                                background-position: center;
                                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                            }

                            .loginbox 
                            {
                                width: 320px;
                                height: 420px;
                                background: whitesmoke;
                                color: black;
                                top: 50%;
                                left: 50%;
                                position: absolute;
                                transform: translate(-50%, -50%);
                                box-sizing: border-box;
                                padding: 70px 30px;
                                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                            }

                            .avatar 
                            {
                                width: 100px;
                                height: 100px;
                                border-radius: 60%;
                                position: absolute;
                                top: -50px;
                                left: calc(50% - 50px);
                            }

                            h1 
                            {
                                margin: 0;
                                padding: 0 0 20px;
                                text-align: center;
                                font-size: 22px;
                                color: rgb(10, 9, 9);
                            }

                            .loginbox p 
                            {
                                margin: 0;
                                padding: 0;
                                font-weight: bold;
                            }

                            .loginbox input 
                            {
                                width: 100%;
                                margin-bottom: 20px;
                            }

                            .loginbox input[type="text"],
                            input[type="password"] 
                            {
                                border: none;
                                border-bottom: 1px solid black;
                                background: transparent;
                                outline: none;
                                height: 40px;
                                color: rgb(0, 0, 0);
                                font-size: 16px;
                            }
                            .error 
                            {
                                background-color: red;
                                color: blue;
                                padding: 10px; 
                                width: 95%;
                                border-radius: 5px;
                                margin: 20 px auto;
                            }
                    </style>
                </form>
            </form>
         </body>
    </html>