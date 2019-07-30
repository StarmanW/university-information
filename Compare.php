
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        require_once 'ConcreteObserver/ComputerScience.php';
        require_once 'ConcreteSubject/ProgrammeData.php';
        
        
        $Information = new ProgrammeData(12000, 6, 'CCNA', 'Must Pass Bahasa Melayu');
        
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
