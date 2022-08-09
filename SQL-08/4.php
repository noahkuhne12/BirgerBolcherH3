

<?php

    $sql = "SELECT `customer`.* ,COUNT(`order`.`ID`) AS `order_count`
    FROM `customer` 
    JOIN `order` ON `order`.`CustomerID` = `customer`.`ID` 
    JOIN `order_product` ON `order_product`.`OrderID` = `order`.`ID` 
    GROUP BY `customer`.`ID`
    ORDER BY `order_count` DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 4 Lav en liste over alle kunder og gruppér dem efter antal ordre.</h2></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fornavn</th>
                    <th scope="col">Efternavn</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefon nr.</th>
                </tr>
            </thead>
            <tbody>
<?php
$oldCount = 2147483646;
while($row = $result->fetch_assoc()){
  if($oldCount > $row["order_count"]){
?>
              <tr>
                <td colspan="6" scope="col">Kunder med <?= $row["order_count"] ?> ordre</td>
              </tr>
<?php
    }
?>
              <tr>
                <td><?= $row["ID"] ?></td>
                <td><?= $row["FirstName"] ?></td>
                <td><?= $row["LastName"] ?></td>
                <td><?= $row["Email"] ?></td>
                <td><?= $row["TelefonNumber"] ?></td>
                <td><?= $row["order_count"] ?></td>
              </tr>
<?php
  $oldCount = $row["order_count"];
}
?>
?>
            </tbody>
          </table>
        </div>
        <div class="card-footer border-secondary">
            <h3><?= $sql ?></h3>
        </div>
      </div>
