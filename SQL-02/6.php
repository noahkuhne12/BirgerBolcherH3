<?php
    $sql = "SELECT product.ID, product.Name
    FROM product
    WHERE product.Name LIKE '%e%'
    ORDER BY product.ID ASC;"
    ;
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>Opg. 6 - Find og udskriv navene på alle bolcher, hvor der i navnet findes mindst ét “e”.</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Navn</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){    
?>
              <tr>
                <th scope="row"><?= $row["ID"] ?></th>
                <td><?= $row["Name"] ?></td>
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

