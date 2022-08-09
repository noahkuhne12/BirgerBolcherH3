<?php
    $sql = "SELECT `customer`.* 
    FROM `customer` 
    JOIN `order` ON `order`.`CustomerID` = `customer`.`ID` 
    JOIN `order_product` ON `order_product`.`OrderID` = `order`.`ID` 
    JOIN `product` ON `product`.`ID` = `order_product`.`ProductID` 
    WHERE `order_product`.`Price`>= 5
    GROUP BY `customer`.`ID`;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 5 Lav en liste over alle dem der har købt for over 5kr.</h2></div>
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
while($row = $result->fetch_assoc()){
?>
              <tr>
                <td><?= $row["ID"] ?></td>
                <td><?= $row["FirstName"] ?></td>
                <td><?= $row["LastName"] ?></td>
                <td><?= $row["Email"] ?></td>
                <td><?= $row["TelefonNumber"] ?></td>
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

