<?php
//Include non-vendor files
require '../core/About/src/Validation/Validate.php';

//Declare Namespaces
use About\Validation;

//Validate Declarations
$valid = new About\Validation\Validate();
$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];
$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

    $valid->validation = [
        'name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter your last name'
        ]],
        'email'=>[[
                'rule'=>'email',
                'message'=>'Please enter a valid email'
            ],[
                'rule'=>'notEmpty',
                'message'=>'Please enter an email'
        ]],
        'message'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please add a message'
        ]],
    ];


    $valid->check($input);
}

if(empty($valid->errors) && !empty($input)){
    $message = "<div>Success!</div>";
}else{
    $message = "<div>Error!</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Chad Svastisalee CSM | Contact</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Chad Svastisalee Contact Page">
        <meta name="keywords" content="Chad Svastisalee, Full Stack, LAMP, MEAN, Web Design, Developer, CSM, Project Manager">
        <link rel="stylesheet" type="text/css" href="./dist/css/main.css">
    </head>
<body>
    <header>
        <span class="logo">Chad Svastisalee CSM</span>
            <a id="toggleMenu">Menu<a>
            <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="resume.html">Resume</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1 class="clearfix">
        <span class="float-left">Chad E Svastisalee</span>
        <span class="float-right">Full Stack Agile Developer</span>
        </h1>
    <section>
    <h1>Chad Svastisalee</h1>
    <p>Contact me about any Web, Print and Promotion projects. Experienced Full Stack Developer, specializing in LAMP, MEAN, Application and Mobile development in Linux, Android, iOS. Specializing in UX, IX and Web Design. Need Project Management? Certified Scrum Master CSM and experienced Project Manager.</p>

    <?php echo (!empty($message)?$message:null); ?>

    <form action="contact.php">
        <div>
          <label for="name">Name</label>
          <input id="name" type="text" name="name" value="<?php echo $valid->userInput('name'); ?>">
          <div class="text-error"><?php echo $valid->error('name'); ?></div>
        </div>

        <div>
          <label for="email">Email</label>
          <input id="email" type="text" name="email" value="<?php echo $valid->userInput('email'); ?>">
          <div class="text-error"><?php echo $valid->error('email'); ?></div>
        </div>

        <div>
          <label for="message">Message</label>
          <textarea id="message" name="message"><?php echo $valid->userInput('message'); ?></textarea>
          <div class="text-error"><?php echo $valid->error('message'); ?></div>
        </div>

        <div>
          <input type="submit" value="Send">
        </div>

</form>
</section>

</main>
<script>
    var toggleMenu = document.getElementById('toggleMenu');
    var nav = document.querySelector('nav');
    toggleMenu.addEventListener(
      'click',
      function(){
        if(nav.style.display=='block'){
          nav.style.display='none';
        }else{
          nav.style.display='block';
        }
      }
    );
  </script>
</body>
</html>