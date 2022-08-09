<?php
$stmt = $conn->prepare("SELECT `product`.`Name` FROM `product`");
$stmt->execute();
$candyResult = $stmt->get_result();

$candy = $_GET["Candy"] ?: '';
$sql = "SELECT `order`.`ID`, 
CONCAT(`customer`.`FirstName`, ' ', `customer`.`LastName`) 
AS `customer_fullname`, `order`.`Date` 
FROM `order` 
JOIN `order_product` ON `order_product`.`OrderID` = `order`.`ID`
JOIN `customer` ON `customer`.`ID` = `order`.`CustomerID` 
JOIN `product` ON `product`.`ID` = `order_product`.`ProductID` 
WHERE `product`.`Name` = ? GROUP BY `order`.`ID` ORDER BY `customer_fullname` ASC, `Date` DESC;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $candy);
$stmt->execute();
$result = $stmt->get_result();
?>
      <form>
        <input type="hidden" name="SQL" value="07" />
        <div class="form-group">
          <div class="input-group">
            <select class="form-select" name="Candy">
<?php
while($row = $candyResult->fetch_assoc()){
?>
            <option<?= $_GET["Candy"] == $row["Name"] ? ' selected' : '' ?>><?= $row["Name"] ?></option>
<?php
}
?>            </select>
            <button type="submit" class="btn btn-primary">Søg</button>
          </div>
        </div>
      </form>
      <div class="card border-secondary mb-3">
        <div class="card-header"><h2>Opg. 3 - Opret en dropdownliste, med alle bolchenavne, samt en submitknap. Når et bolche vælges og der klikkes på knappen, vises alle de kunder, som har købt bolchet, samt selve ordren eller hvis der er flere, alle ordrerne</h2></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">Ordre ID</th>
                <th scope="col">Navn</th>
                <th scope="col">Ordre dato</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){
?>
              <tr>
                <td><?= $row["ID"] ?></td>
                <td><?= $row["customer_fullname"] ?></td>
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
