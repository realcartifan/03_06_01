<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep dla uczniów</title>
    <link rel="stylesheet" href="styl.css">
</head>

<form>
    <header>
<h1>Dzisiejsza promocja naszego sklepu</h1>
    </header>
    <div id="columnContainer">
        <aside id='left'>
            <h2>Taniej o 30%</h2>
            <?php
                $db = new mysqli('localhost', 'root', '', 'sklep');
                $q = "SELECT nazwa FROM `towary` WHERE promocja=1;";
                $result = $db->query($q);
                while ($row = $result->fetch_assoc()) {
                    $name = $row['nazwa'];
                    echo '<li>' . $name . '</li>';
                }
                $db->close();
                ?>
            <ol>
                <li>humki</li>
                <li>cienkopis</li>
                <li>pisaki</li>
                <li>markery</li>
            </ol>
        </aside>
    </div>
    <main>
        <h2>sprawdz cene</h2>
        <form action="index.php" method="post"></form>
        <select name="itemSelect" id=""></select>
        <option value="gumki do mazania">gumki do mazania</option>
        <option value="cienkopisy">cienkopisy</option>
        <option value="pisaki 60 sztuki">pisaki 60 sztuki</option>
        <option value="markery 4 sztuki">markery 4 sztuki</option>
        </select>
        <input type="submit"value="sprawdź" >
            </form>
            <p>
            <?php
                
                if (isset($_POST['itemSelect'])) {


                    $db = new mysqli('localhost', 'root', '', 'sklep');
                    $q = "SELECT cena FROM `towary` WHERE nazwa=?";


                    
                    $name = $_POST['itemSelect'];


                    
                    $query = $db->prepare($q);
                    
                    $query->bind_param("s", $name);

                   
                    $query->execute();
                    
                    $result = $query->get_result();

                  
                    $row = $result->fetch_assoc();
                    $price = $row['cena']; 
                    $discountPrice = $price * 0.7; 

                    $outputBuffer = "";
                    $outputBuffer .= "cena regularna: ";
                    $outputBuffer .= $price;
                    $outputBuffer .= "<br>";
                    $outputBuffer .= "cena w promocji: ";
                    $outputBuffer .= $discountPrice;

                    echo  $outputBuffer;

                    $db->close();
                }
                ?>
                </p>
    </main>
    
    <aside id="right">
<h2>konakt</h2>
<p>email<a href="bok@sklep.pl">:bok@sklep.pl</a></p>
<img src="promocja1.png" alt="promocia">
    </aside>
    <footer>
       <h4> pesel:00000000000000000</h4>
    </footer>
</body>

</html>