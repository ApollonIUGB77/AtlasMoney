<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" type="text/css" href="NewAccount3.css" />
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="server.php" method="POST" style="border: 1px solid #ccc">
      <?php if(isset($_GET['error'])): ?>
        <div class="error">
          <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php endif; ?>
      <div class="container">
        <h1 style="text-align: center; font-family: verdana;">REGISTRATION</h1>
        <P style="background-color: tomato; font-family: courier; font-size: 110%">
          <b> Please fill in this form to create your account </b>
        </P>
        <!--------- To check user regidtration status ------->
        <hr />
        <label for="name"><b>NAME </b></label>
        <input type="text" name="name" placeholder="name" required /> <br />
        <label for="email"><b>EMAIL </b></label>
        <input type="text" name="email" placeholder="Email" required /> <br />
        <label for="phone"><b>PHONE NUMBER </b></label>
        <select name="phone" placeholder="PhoneNumber">
          <option value="+225">+225</option>
          <option value="+226">+226</option>
          <option value="+227">+227</option>
          <option value="+228">+228</option>
        </select>
        <input type="text" name="phone" placeholder="PhoneNumber" maxlength="10" required /><br />
        <label for="psw"><b>PASSWORD</b></label>
        <input type="password" name="password" placeholder="password" maxlength="4" required /><br />
        <label for="psw"><b>REPEAT PASSWORD</b></label>
        <input type="password" name="repeatPassword" placeholder="Repeat Password" maxlength="4" required /><br />
        <label for="checkbox"
          >Stay logged in
          <input type="checkbox" checked="checked" name="remenber" style="margin-bottom: 15px" />
          <br />
        </label>
        <label for="checkbox"
          > By creating an account you agree to our <a href="Terms.docx" style="color: dodgerblue">Terms & Privacy</a>.
          <input type="checkbox" name="Privacy" id="Agreement" value="1" required />
          <br />
          <br />
        </label>
        <div class="clearfix">
          <a href="index.php"><button type="button" class="cancelbtn"> Cancel </button></a>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
  </body>
</html>
