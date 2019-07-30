
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        namespace app\Patterns\Observer;
        
        
        require_once 'app/Patterns/Observer/Programmes.php';
        require_once 'app/Patterns/Observer/ProgrammeData.php';
        
        
        $Information = new ProgrammeData();
        
        echo "<p><h4>Information<br />";
        echo "Price: " . $Information->getPrice() . "<br/>";
        echo "Duration: " . $Information->getDuration() . "<br/>";
        echo "Certificate: " . $Information->getCertificate() . "<br/>";
        echo "Requirement: " . $Information->getRequirement() . "<br/>" . '<br/>';
        
        $ComputerScience = new ComputerScience($Information);
        
        //Changes made and set for comparison
        $Information->setPrice(50000);
        $Information->setDuration(5);
        $Information->setCertificate('CCNA');
        $Information->setRequirement('Pass Bahasa Melayu');
        
        
        ?>
     
    </body>
     
</html>
