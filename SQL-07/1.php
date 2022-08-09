<?php
    $sql = "SELECT `customer`.`FirstName`, `customer`.`LastName`, 
    COUNT(`order`.`ID`) AS `order_count` 
    FROM `order`
    INNER JOIN `customer` ON `customer`.`ID` = `order`.`CustomerID` 
    GROUP BY `order`.`CustomerID`;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>
      <div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 1 - Udskriv alle kunder fra databasen, som har afgivet en ordre, samt lad det fremgå, hvor mange ordrer hver kunde har liggende i systemet</h2></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">Navn</th>
                <th scope="col">Ordre lagt</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){
?>
              <tr>
                <td><?= $row["FirstName"]." ".$row["LastName"] ?></td>
                <td><?= $row["order_count"] ?></td>
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
