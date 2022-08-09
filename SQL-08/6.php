<?php
    $sql = "SELECT `customer`.`FirstName`, `customer`.`LastName` FROM `order` 
    INNER JOIN `customer` ON `customer`.`ID` = `order`.`CustomerID` 
    INNER JOIN `order_product` ON `order_product`.`OrderID` = `order`.`ID` 
    INNER JOIN `product` ON `product`.`ID` = `order_product`.`ProductID` 
    WHERE `product`.`Name` = 'Blå Haj' GROUP BY `order`.`CustomerID`;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 6 - Lav en liste over alle dem der har købt en eller flere blå haj bolcher"</h2></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">Navn</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){
?>
              <tr>
                <td><?= $row["FirstName"]." ".$row["LastName"] ?></td>
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