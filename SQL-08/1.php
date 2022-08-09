<?php
    $sql = "SELECT `order`.`ID`, `customer`.`FirstName`, `customer`.`LastName`
    , `address`.`Address`, `postnummber`.`PostNummber`, `postnummber`.`City`,`order`.`Date` 
    FROM `order` 
    JOIN `customer` ON `customer`.`ID` = `order`.`CustomerID` 
    JOIN  `address` ON `address`.`ID` = `order`.`AddressID` 
    JOIN `postnummber` ON `postnummber`.`ID` = `address`.`PostNummberID` 
    WHERE `customer`.`ID` = 4;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 1 - Hent alle ordrer fra kunde nummer 4 ud</h2></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">order ID</th>
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
                <td><?= $row["FirstName"]." ".$row["LastName"] ?></td>
                <td><?= $row["Address"]."".$row["PostCode"]." ".$row["City"] ?></td>
                <td><?= $row["Date"] ?></td>
              </tr>
<?php
}
?>
            </tbody>
          </table>
        </div>
        <div class="card-footer border-secondary">
            <h3><?= $sql ?></h3>
        </div>
      </div>

