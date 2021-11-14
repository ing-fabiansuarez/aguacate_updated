<div class="row">
    <div class="col-md-12 text-center">
        <h3 style="color: #D290F4;"><?= $category['name_category'] ?></h3>
        <h2>
            <span class="item_price">$ <?= number_format($product->price_product) ?></span> <!-- <del>- $900</del> -->
        </h2>
        <div class="occasional">
            <h5>TALLAS DISPONIBLES :</h5>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <?php foreach ($sizes as $size) : ?>
                    <label class="btn btn-secondary <?php if ($size['quantity_stock'] <= 0) {
                                                        echo 'disabled';
                                                    } ?>">
                        <input type="radio" name="id_size" id="input_id_size" value="<?= $size['id_size'] ?>" required> <?= $size['name_size'] ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div style="width: 100%;" class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
            <input type="hidden" name="r" value="addproduct">
            <input type="hidden" id="input_id_product" name="id_product" value="<?= $product->id_product ?>">
            <input type="submit" value="Agregar al Carrito" class="button">
        </div>

    </div>
</div>