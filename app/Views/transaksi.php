<!DOCTYPE html>
<html>
<head>
    <title>Add Cart</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
  integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
  crossorigin="anonymous"></script>

<body>
    <style>
        .itemsBarang{
            border: 2px solid black;
        }

        .divItemsBarang{
            margin : 10px;
        }
    </style>
    <h2>List Barang</h2>
    <div id="listBarang" class="row divItemsBarang">
        <?php foreach ($MasterData as $key => $value) { ?>
            <div class="col-lg-3 itemsBarang" data-id="<?php echo $key; ?>">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCiSwEAbhIAZ501TbjDlwCcJeVJoyFtL1WIpsgb85bVQ&s">
                <p><?php echo $value['namaBarang']; ?></p>
                <p>Harga : <?php echo $value['harga']; ?></p>
            </div>
        <?php } ?>
    </div>

    <h2>Shopping Cart</h2>
    <form method="post" action="/transaksi.create">
        <div id="divshoppingCart">
            
        </div>
    </form>

    <script>
        var masterBarang = JSON.parse('<?php echo json_encode($MasterData) ?>');
        $( ".itemsBarang" ).on("click", function() {
            var key = $(this).data('id');

            var shoppingItemHtml = `
                <div class="col-lg-3 shoppingItems">
                    <input type="hidden" value="`+masterBarang[key].id+`" name="masterbarang_id[`+key+`]">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCiSwEAbhIAZ501TbjDlwCcJeVJoyFtL1WIpsgb85bVQ&s">
                    <p>`+ masterBarang[key].namaBarang +`</p>
                    <p>Harga : `+ masterBarang[key].harga +`</p>
                </div>
            `;

            $("#divshoppingCart").append(shoppingItemHtml)
        })
    </script>
</body>


</html>