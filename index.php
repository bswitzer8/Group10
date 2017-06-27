<?php 

require 'backend/config.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <?php if(!isset($_SESSION["user_id"]) && empty($_SESSION["user_id"])) include 'css/css.html'; ?>
</head>

<?php 

if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
{
  
  require 'app/views/main.html';
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { 

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { 
        
        require 'backend/register.php';
        
    }
}

?>
<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Register</a></li>
        <li class="tab active"><a href="#login">Sign In</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Listastic!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
          
          <button class="button button-block" name="login" />Sign In</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Join Listastic!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Register</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
