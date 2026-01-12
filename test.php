<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <title>Our first example</title>
</head>
<body>
    <?php $courseCode = "EBS2040"?>
    <?php $firstLine = "Welcome to Build Your Own Dynamic Website ($courseCode)!"?>
    <?php $secondLine = "Let's get cracking!"?>
    <?php $date = date("F j, Y")?>

    <h1> <?php echo $firstLine ?> </h1>
    <p> <?php echo $secondLine ?> </p>
    <p>Today's date is: <?php echo $date ?> </p>
<!-- used br inside p to get the second line without the double space -->
    <p> <?php echo 'Hello World! "How are you today".', "<br> I'm fine, thank you.</br>"?> </p>
</body>
</html> 