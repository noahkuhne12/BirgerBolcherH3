<?php
    $sql = 'SELECT customer.ID, customer.FirstName, customer.LastName, customer.Email, customer.TelefonNumber, 
    address.Address, postnummber.City, postnummber.PostNummber 
    FROM customer 
    INNER JOIN address 
    ON customer.AddressID = address.ID 
    INNER JOIN postnummber 
    ON address.PostNummberID = postnummber.ID 
    ORDER BY customer.ID ASC;';
    
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>1 Opg. Udskriv alle kunderne fra databasen, sorteret efter deres unikke identifikation.</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
              <th scope="col">ID</th>
                <th scope="col">Fornavn</th>
                <th scope="col">Efternavn</th>
                <th scope="col">Email</th>
                <th scope="col">Telefon nr.</th>
                <th scope="col">Adresse</th>
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
                <td><?= $row["Address"].", ".$row["PostNummber"]." ".$row["City"] ?></td>
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




