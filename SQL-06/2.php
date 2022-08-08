<?php
    $sql = 'SELECT `order`.`Date`,`customer`.`FirstName`, `customer`.`LastName`
    , `address`.`Address`, `postnummber`.`City`, `postnummber`.`PostNummber`
    FROM `order` 
    INNER JOIN `customer` ON `order`.`CustomerID` = `customer`.`ID` 
    INNER JOIN `address` ON `address`.`ID` = `order`.`AddressID` 
    INNER JOIN `postnummber` ON `address`.`PostNummberID` = `postnummber`.`ID` 
    ORDER BY `order`.`Date` DESC;';
    
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>2 Opg. Udskriv alle ordrer fra databasen, sorteret efter ordredato.</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
              <th scope="col">ID</th>
                <th scope="col">Kunde</th>
                <th scope="col">Faktureringsadresse</th>
                <th scope="col">Dato</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){    
?>
              <tr>
              <td><?= $row["ID"] ?></td>
                <td><?= $row["FirstName"]."".$row["LastName"] ?></td>
                <td><?= $row["Address"].", ".$row["PostNummber"]." ".$row["City"] ?></td>
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
                <?=$sql?>
            </h3>
          </div>
      </div>

