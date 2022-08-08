<?php

    $sql = 'SELECT `customer`.`ID`, `customer`.`FirstName`, `customer`.`LastName`
    , `address`.`Address`, `postnummber`.`City`, `postnummber`.`PostNummber`
    , `order`.`Date`
    FROM `order` 
    INNER JOIN `customer` ON `order`.`CustomerID` = `customer`.`ID` 
    INNER JOIN `address` ON `address`.`ID` = `order`.`AddressID` 
    INNER JOIN `postnummber` ON `address`.`PostNummberID` = `postnummber`.`ID` 
    ORDER BY `order`.`Date` DESC LIMIT 1;';
    
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
    $sql1 = $sql;

?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>3 Opg. Udskriv den kunde, der har den seneste ordre, samt udskriv selve ordren.</h2>
        </div>
        <div class="table-responsive">
            <h3>kunde</h3>
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">Kunde</th>
                <th scope="col">Faktureringsadresse</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){    
    $temp = $row["ID"];
?>
              <tr>
                <td><?= $row["FirstName"]."".$row["LastName"] ?></td>
                <td><?= $row["Address"].", ".$row["PostNummber"]." ".$row["City"] ?></td>
              </tr>
<?php
}
?>
            </tbody>
          </table>
          <h3>order</h3>
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">product navn</th>
                <th scope="col">antal</th>
                <th scope="col">pris</th>
                <th scope="col">Dato</th>                
              </tr>
            </thead>
            <tbody>
<?php
    $sql = 'SELECT `order`.`Date`,`address`.`Address`, `postnummber`.`City`, `postnummber`.`PostNummber`
    , `order_product`.`Amount`, `order_product`.`Price`, `product`.`Name`
    FROM `order`
    INNER JOIN `address` ON `address`.`ID` = `order`.`AddressID` 
    INNER JOIN `postnummber` ON `address`.`PostNummberID` = `postnummber`.`ID` 
    INNER JOIN `order_product` ON `order_product`.`OrderID` = `order`.`ID` 
    INNER JOIN `product` ON `order_product`.`ProductID` = `product`.`ID`  
    WHERE `order`.`CustomerID` = '.$temp.'
    ORDER BY `order`.`Date` ASC;';

    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
    $sql2 = $sql;
while($row = $result->fetch_assoc()){    
?>
              <tr>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["Amount"] ?></td>
                <td><?= $row["Price"] ?></td>
                <td><?= $row["Date"] ?></td>
              </tr>
<?php
}
?>
            </tbody>
          </table>
        </div>
        <div class="card-footer bg-transparent border-success">
            <h3>
                <?=$sql1?>
            </h3>
            <h3>
                <?=$sql2?>
            </h3>
          </div>
      </div>

